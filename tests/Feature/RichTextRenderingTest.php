<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Equipement;
use App\Models\Laboratory;
use App\Models\Prescription;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Support\Facades\Blade;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class RichTextRenderingTest extends TestCase
{
    #[DataProvider('richTextFields')]
    public function test_model_assignments_clean_rich_text_before_storage(string $class, string $field): void
    {
        $model = new $class();
        $model->$field = '<p onclick="attack()">Dose <strong>10 mg</strong></p><script>attack()</script>';

        $this->assertSame('<p>Dose <strong>10 mg</strong></p>', $model->getAttributes()[$field]);

        $model->$field = null;
        $this->assertNull($model->getAttributes()[$field]);
    }

    public static function richTextFields(): array
    {
        return [
            [Prescription::class, 'pres_ins'],
            [Laboratory::class, 'lab_pat_tests'],
            [Laboratory::class, 'lab_pat_results'],
            [Product::class, 'phar_desc'],
            [Category::class, 'pharm_cat_desc'],
            [Equipement::class, 'eqp_desc'],
            [Vendor::class, 'v_desc'],
        ];
    }

    public function test_every_raw_view_output_uses_the_rich_text_sanitizer(): void
    {
        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(resource_path('views'))) as $file) {
            if (!$file->isFile() || !str_ends_with($file->getFilename(), '.blade.php')) {
                continue;
            }

            preg_match_all('/\{!!\s*(.*?)\s*!!\}/s', file_get_contents($file->getPathname()), $matches);

            foreach ($matches[1] as $expression) {
                $this->assertMatchesRegularExpression(
                    '/^\\\\App\\\\Support\\\\RichText::sanitize\(\$\w+->\w+\)$/',
                    $expression,
                    $file->getPathname()
                );
            }
        }
    }

    public function test_the_real_laboratory_input_escapes_legacy_content_in_its_attribute(): void
    {
        // Hydrate old database content without passing through the write cast.
        $laboratory = new Laboratory();
        $laboratory->setRawAttributes([
            'lab_pat_tests' => '"><img src=x onerror="attack()"><strong>Dose</strong>',
        ]);

        $source = file_get_contents(resource_path('views/admin/labo/labDetailsPatientResult.blade.php'));
        preg_match('/<input id="editor-input-1"[^\r\n]+>/', $source, $matches);
        $this->assertNotEmpty($matches);

        $rendered = Blade::render($matches[0], compact('laboratory'));

        $this->assertStringNotContainsString('<img', $rendered);
        $this->assertStringNotContainsString('onerror', $rendered);
        $this->assertStringContainsString('&lt;strong&gt;Dose&lt;/strong&gt;', $rendered);
        $this->assertStringContainsString('&amp;quot;&amp;gt;', $rendered);
    }

    public function test_legacy_prescriptions_are_sanitized_when_displayed(): void
    {
        $prescription = new Prescription();
        $prescription->setRawAttributes([
            'pres_ins' => '<strong>10 mg</strong><script>attack()</script><img src=x onerror="attack()">',
        ]);

        $source = file_get_contents(resource_path('views/admin/pharmacy/detailsPrescription.blade.php'));
        preg_match('/\{!!.*?!!\}/s', $source, $matches);
        $this->assertNotEmpty($matches);

        $rendered = Blade::render($matches[0], compact('prescription'));

        $this->assertSame('<strong>10 mg</strong>', $rendered);
    }

    public function test_the_real_prescription_textarea_cannot_be_closed_by_legacy_content(): void
    {
        $prescription = new Prescription();
        $prescription->setRawAttributes([
            'pres_ins' => '</textarea><script>attack()</script><strong>Dose</strong>',
        ]);

        $source = file_get_contents(resource_path('views/admin/pharmacy/editPrescription.blade.php'));
        preg_match('/<textarea\b[^>]*name="pres_ins"[^>]*>.*?<\/textarea>/s', $source, $matches);
        $this->assertNotEmpty($matches);

        $rendered = Blade::render($matches[0], compact('prescription'));

        $this->assertSame(1, substr_count($rendered, '</textarea>'));
        $this->assertStringNotContainsString('<script', $rendered);
        $this->assertStringNotContainsString('attack()', $rendered);
        $this->assertStringContainsString('&lt;strong&gt;Dose&lt;/strong&gt;', $rendered);
    }
}
