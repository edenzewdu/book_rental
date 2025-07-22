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

    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                ->orWhere('author', 'like', "%$search%")
                ->orWhere('genre', 'like', "%$search%")
                ->orWhere('isbn', 'like', "%$search%")
                ->orWhere('donor', 'like', "%$search%")
                ->orWhere('donor_phone', 'like', "%$search%");
            });
        }

        $books = $query->latest()->paginate(10); // Or ->get() if you don’t want pagination

        return view('books.index', compact('books'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'isbn' => 'required|string|unique:books,isbn,' . $id,
            // add other validations as needed
        ]);

        $book = Book::findOrFail($id);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

}
