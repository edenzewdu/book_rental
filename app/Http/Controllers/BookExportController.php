<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\BooksExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Book;

class BookExportController extends Controller
{
    public function export()
    {
        $date = date('Y-m-d'); // current date in YYYY-MM-DD format
        $fileName = "books_{$date}.xlsx";
        return Excel::download(new BooksExport, $fileName);
    }

}
