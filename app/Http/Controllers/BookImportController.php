<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BooksImport;

class BookImportController extends Controller
{
    public function import(Request $request)
    {
        Excel::import(new BooksImport, $request->file('file'));

        return back()->with('success', 'Books Imported Successfully!');
    }
}
