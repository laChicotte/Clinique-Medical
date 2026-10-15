<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Support\ImageUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Mockery;
use PHPUnit\Framework\Attributes\DataProvider;
use RuntimeException;
use Tests\TestCase;

class ImageUploadTest extends TestCase
{
    private array $fixtures = [];

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    public function test_names_are_random_and_extensions_come_from_image_contents(): void
    {
        $names = [];

        foreach (range(1, 2) as $iteration) {
            $employee = $this->employee();
            $employee->shouldReceive('save')->once()->andReturnTrue();

            ImageUpload::save($employee, 'doc_dpic', $this->png('original.jpg'), 'employeeProfiles', 'noimage.jpeg');

            $this->assertMatchesRegularExpression('/^[a-f0-9-]{36}\.png$/', $employee->doc_dpic);
            Storage::disk('public')->assertExists('employeeProfiles/'.$employee->doc_dpic);
            $names[] = $employee->doc_dpic;
        }

        $this->assertNotSame($names[0], $names[1]);
    }

    public function test_replacing_an_image_keeps_the_previous_file_until_save_succeeds(): void
    {
        Storage::disk('public')->put('employeeProfiles/old.jpg', 'old image');
        $employee = $this->employee('old.jpg');
        $employee->shouldReceive('save')->once()->andReturnUsing(function () {
            Storage::disk('public')->assertExists('employeeProfiles/old.jpg');
            return true;
        });

        ImageUpload::save($employee, 'doc_dpic', $this->png(), 'employeeProfiles', 'noimage.jpeg');

        Storage::disk('public')->assertMissing('employeeProfiles/old.jpg');
        Storage::disk('public')->assertExists('employeeProfiles/'.$employee->doc_dpic);
    }

    public function test_failed_database_save_preserves_the_old_image_and_removes_the_new_one(): void
    {
        Storage::disk('public')->put('employeeProfiles/old.jpg', 'old image');
        $employee = $this->employee('old.jpg');
        $employee->shouldReceive('save')->once()->andThrow(new RuntimeException('Save failed'));

        try {
            ImageUpload::save($employee, 'doc_dpic', $this->png(), 'employeeProfiles', 'noimage.jpeg');
            $this->fail('The save exception should propagate.');
        } catch (RuntimeException $exception) {
            $this->assertSame('Save failed', $exception->getMessage());
        }

        Storage::disk('public')->assertExists('employeeProfiles/old.jpg');
        $this->assertSame(['employeeProfiles/old.jpg'], Storage::disk('public')->allFiles());
    }

    public function test_updating_without_a_file_preserves_the_current_image(): void
    {
        $employee = $this->employee('existing.jpg');
        $employee->shouldReceive('save')->once()->andReturnTrue();

        ImageUpload::save($employee, 'doc_dpic', null, 'employeeProfiles', 'noimage.jpeg');

        $this->assertSame('existing.jpg', $employee->doc_dpic);
        $this->assertSame([], Storage::disk('public')->allFiles());
    }

    public function test_storage_failure_does_not_save_the_model_or_delete_the_old_image(): void
    {
        Storage::disk('public')->put('employeeProfiles/old.jpg', 'old image');
        $employee = $this->employee('old.jpg');
        $employee->shouldNotReceive('save');
        $image = $this->png();
        $file = Mockery::mock(UploadedFile::class, [$image->getPathname(), 'photo.png', null, null, true])
            ->makePartial();
        $file->shouldReceive('storeAs')->once()->andReturnFalse();

        try {
            ImageUpload::save($employee, 'doc_dpic', $file, 'employeeProfiles', 'noimage.jpeg');
            $this->fail('The storage failure should propagate.');
        } catch (RuntimeException $exception) {
            $this->assertSame('Unable to store the image.', $exception->getMessage());
        }

        Storage::disk('public')->assertExists('employeeProfiles/old.jpg');
        $this->assertSame('old.jpg', $employee->doc_dpic);
    }

    public function test_a_new_record_without_a_file_receives_the_default_image(): void
    {
        $employee = $this->employee();
        $employee->shouldReceive('save')->once()->andReturnTrue();

        ImageUpload::save($employee, 'doc_dpic', null, 'employeeProfiles', 'noimage.jpeg');

        $this->assertSame('noimage.jpeg', $employee->doc_dpic);
    }

    #[DataProvider('invalidFiles')]
    public function test_invalid_files_are_rejected_before_saving(string $name, string $content): void
    {
        $employee = $this->employee();
        $employee->shouldNotReceive('save');

        try {
            ImageUpload::save($employee, 'doc_dpic', $this->file($name, $content), 'employeeProfiles', 'noimage.jpeg');
            $this->fail('Invalid upload was accepted.');
        } catch (ValidationException $exception) {
            $this->assertArrayHasKey('doc_dpic', $exception->errors());
        }

        $this->assertSame([], Storage::disk('public')->allFiles());
    }

    public static function invalidFiles(): array
    {
        return [
            'PHP disguised as image' => ['photo.png', '<?php echo "attack";'],
            'SVG' => ['photo.svg', '<svg xmlns="http://www.w3.org/2000/svg" onload="attack()"></svg>'],
            'HTML' => ['photo.jpg', '<html><script>attack()</script></html>'],
            'oversized file' => ['photo.png', str_repeat('x', 2048 * 1024 + 1)],
        ];
    }

    public function test_cleanup_protects_shared_placeholders_and_paths_outside_the_directory(): void
    {
        Storage::disk('public')->put('employeeProfiles/noimage.jpeg', 'placeholder');
        Storage::disk('public')->put('equipements/nolabimage.jpeg', 'placeholder');
        Storage::disk('public')->put('outside.jpg', 'keep');

        ImageUpload::delete('employeeProfiles', 'noimage.jpeg');
        ImageUpload::delete('equipements', 'nolabimage.jpeg');
        ImageUpload::delete('employeeProfiles', '../outside.jpg');
        ImageUpload::delete('employeeProfiles', '..\\outside.jpg');

        Storage::disk('public')->assertExists('employeeProfiles/noimage.jpeg');
        Storage::disk('public')->assertExists('equipements/nolabimage.jpeg');
        Storage::disk('public')->assertExists('outside.jpg');
    }

    private function employee(?string $filename = null): Employee
    {
        $employee = Mockery::mock(Employee::class)->makePartial();
        $employee->setRawAttributes(['doc_dpic' => $filename], true);
        return $employee;
    }

    private function png(string $name = 'photo.png'): UploadedFile
    {
        return $this->file($name, base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+jN1sAAAAASUVORK5CYII='
        ));
    }

    private function file(string $name, string $content): UploadedFile
    {
        // Keep the temporary file open, but use real MIME detection rather than
        // the MIME value that Laravel's fake file infers from the filename.
        $temporary = UploadedFile::fake()->createWithContent($name, $content);
        $this->fixtures[] = $temporary;
        return new UploadedFile($temporary->getPathname(), $name, null, null, true);
    }
}
