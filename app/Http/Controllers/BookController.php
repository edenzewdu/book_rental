<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
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

        $coverPath = 'defaults/book.png'; // default image path

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

    public function index()
    {
        $books = Book::latest()->get();
        return view('books.index', compact('books'));
    }
}
