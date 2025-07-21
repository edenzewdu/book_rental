<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookImportController extends Controller
{
    public function import(Request $request)
    {
        Excel::import(new BooksImport, $request->file('file'));

        return back()->with('success', 'Books Imported Successfully!');
    }
        

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $coverPath = 'defaults/book.png'; // default

        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('covers', 'public');
        }

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'published_year' => $request->published_year,
            'isbn' => $request->isbn,
            'available' => true,
            'donor' => $request->donor,
            'donor_phone' => $request->donor_phone,
            'usage_status' => $request->usage_status,
            'cover_image' => $coverPath,
        ]);

        return redirect()->back()->with('success', 'Book added successfully.');
    }


}
