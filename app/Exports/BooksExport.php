<?php
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
            '', // Leave image cell blank – the drawing will appear here
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $row = 2; // Start from Excel row 2 (after headings)

        foreach ($this->books as $book) {
            if ($book->image_path && file_exists(public_path('storage/' . $book->image_path))) {
                $drawing = new Drawing();
                $drawing->setName('Book Image');
                $drawing->setDescription($book->title);
                $drawing->setPath(public_path('storage/' . $book->image_path)); // image path
                $drawing->setHeight(60); // image size
                $drawing->setCoordinates('K' . $row); // Column K = 11th column (image column)
                $drawings[] = $drawing;
            }

            $row++;
        }

        return $drawings;
    }
}
