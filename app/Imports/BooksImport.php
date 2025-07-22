<?php

namespace App\Imports;

use App\Models\Book;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BooksImport implements ToModel
{
    protected $imageManager;

    public function __construct()
    {
        // Initialize Image Manager with GD driver
        $this->imageManager = new ImageManager(new Driver());
    }

    public function model(array $row)
    {
        // Skip header or empty title
        if (($row[0] ?? '') === 'Title' || empty($row[0])) {
            return null;
        }
        // Validate title
        if (empty($row[0]) || trim($row[0]) === '') {
            throw new ValidationException("Title cannot be empty.");
        }

        // Validate ISBN
        if (empty($row[4]) || trim($row[4]) === '') {
            throw new ValidationException("ISBN cannot be empty.");
        }

        $title = $row[0];
        $imagePath = $this->generateDefaultImage($title);

        return new Book([
            'title' => $title,
            'author' => $row[1] ?? 'Unknown',
            'genre' => $row[2] ?? 'Unknown',
            'published_year' => $row[3] ?? null,
            'isbn' => $row[4],
            'available' => isset($row[5]) ? (bool)$row[5] : true,
            'donor' => $row[6] ?? null,
            'donor_phone' => $row[7] ?? null,
            'usage_status' => $row[8] ?? null,
            'image_path' => $imagePath,
        ]);
    }

    private function generateDefaultImage(string $title): string
    {
        $filename = 'book_' . Str::slug($title) . '.jpg';
        $folder = public_path('book_images');

        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $path = $folder . DIRECTORY_SEPARATOR . $filename;

        if (!file_exists($path)) {
            // Create a new blank image
            $image = $this->imageManager->create(400, 600, '#f0f0f0');

            // Add the title text to the image
            $image->text($title, 200, 300, function ($font) {
                $fontPath = public_path('fonts/OpenSans-Bold.ttf'); // You can use any available font
                if (file_exists($fontPath)) {
                    $font->filename($fontPath);
                }
                $font->size(24);
                $font->color('#333333');
                $font->align('center');
                $font->valign('center');
            });

            $image->save($path);
        }

        return 'book_images/' . $filename;
    }
}
