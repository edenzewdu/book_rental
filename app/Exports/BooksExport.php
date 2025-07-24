<?php
namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class BooksExport implements FromCollection, WithHeadings, WithMapping, WithDrawings
{
    protected $books;

    public function __construct()
    {
        $this->books = Book::all();
    }

    public function collection()
    {
        return $this->books;
    }

    public function headings(): array
    {
        return ['ID', 'Title', 'Author', 'Genre', 'Published Year', 'ISBN', 'Available', 'Donor', 'Donor Phone', 'Usage Status', 'Image'];
    }

    public function map($book): array
    {
        return [
            $book->id,
            $book->title,
            $book->author,
            $book->genre,
            $book->published_year,
            $book->isbn,
            $book->available ? 'Yes' : 'No',
            $book->donor,
            $book->donor_phone,
            $book->usage_status,
            '', // Image will be added via drawings()
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $row = 2; // Headings are in row 1

        foreach ($this->books as $book) {
            $path = public_path('storage/' . $book->image_path);

            if ($book->image_path && file_exists($path)) {
                $drawing = new Drawing();
                $drawing->setName('Book Image');
                $drawing->setDescription($book->title);
                $drawing->setPath($path);
                $drawing->setHeight(60);
                $drawing->setCoordinates('K' . $row); // 11th column

                $drawings[] = $drawing;
            }

            $row++;
        }

        return $drawings;
    }
}
