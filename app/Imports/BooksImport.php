<?php

namespace App\Imports;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Concerns\ToModel;

class BooksImport implements ToModel
{
    public function model(array $row)
    {
        $title = $row[0];
        $imagePath = $this->generateDefaultImage($title);

        return new Book([
            'title' => $title,
            'author' => $row[2],
            'genre' => $row[3],
            'published_year' => $row[4],
            'isbn' => $row[5],
            'available' => $row[6] ?? true,
            'donor' => $row[7],
            'donor_phone' => $row[8],
            'usage_status' => $row[9],
            'image_path' => $imagePath,
        ]);
    }

    private function generateDefaultImage($title)
    {
        $filename = 'book_' . Str::slug($title) . '.jpg';
        $path = public_path('book_images/' . $filename);

        if (!file_exists($path)) {
            $img = Image::canvas(400, 600, '#f0f0f0');
            $img->text($title, 200, 300, function ($font) {
                $font->file(public_path('fonts/OpenSans-Bold.ttf')); // Optional
                $font->size(24);
                $font->color('#333');
                $font->align('center');
                $font->valign('middle');
            });
            $img->save($path);
        }

        return 'book_images/' . $filename;
    }
}
