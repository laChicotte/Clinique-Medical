<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;

class ImageUpload
{
    public const RULES = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';

    public static function save(Model $model, string $field, ?UploadedFile $file, string $directory, string $default): void
    {
        self::checkDirectory($directory);
        $previous = $model->getRawOriginal($field);
        $stored = null;

        if ($file) {
            Validator::make([$field => $file], [$field => self::RULES])->validate();

            // MIME detection reads the file contents, not its client filename.
            $extension = match ($file->getMimeType()) {
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif',
                default => throw new RuntimeException('Unsupported image type.'),
            };

            $filename = Str::uuid().'.'.$extension;
            $stored = $file->storeAs($directory, $filename, 'public');

            if ($stored === false) {
                throw new RuntimeException('Unable to store the image.');
            }

            $model->$field = $filename;
        } elseif (!$model->$field) {
            $model->$field = $default;
        }

        try {
            if (!$model->save()) {
                throw new RuntimeException('Unable to save the image reference.');
            }
        } catch (Throwable $exception) {
            if ($stored !== null) {
                Storage::disk('public')->delete($stored);
            }
            throw $exception;
        }

        // Keep the old image until the new file and database update succeed.
        if ($stored !== null && $previous !== $model->$field) {
            self::delete($directory, $previous);
        }
    }

    public static function delete(string $directory, ?string $filename): void
    {
        self::checkDirectory($directory);

        if (!$filename || in_array($filename, ['noimage.jpeg', 'nolabimage.jpeg', '.', '..'], true)
            || strpbrk($filename, "/\\\0") !== false) {
            return;
        }

        Storage::disk('public')->delete($directory.'/'.$filename);
    }

    private static function checkDirectory(string $directory): void
    {
        if (!in_array($directory, ['employeeProfiles', 'equipements'], true)) {
            throw new \InvalidArgumentException('Unsupported image directory.');
        }
    }
}
