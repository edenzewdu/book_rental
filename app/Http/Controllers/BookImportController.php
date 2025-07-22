<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BooksImport;
use Intervention\Image\ImageManager;
use Maatwebsite\Excel\Validators\ValidationException;

class BookImportController extends Controller
{
    

    public function import(Request $request)
    {
        try {
            Excel::import(new BooksImport, $request->file('file'));
            return back()->with('success', 'Books Imported Successfully!');
        } catch (ValidationException $e) {
            return back()->withErrors(['file' => $e->getMessage()]);
        } catch (\Exception $e) {
            // For any other error
            return back()->withErrors(['file' => 'Import failed: ' . $e->getMessage()]);
        }
    }
    
}
