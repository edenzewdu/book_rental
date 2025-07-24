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


        if ($request->hasFile('book_image')) {
            $coverPath = $request->file('book_image')->store('covers', 'public');
        } else {
            $coverPath = null;
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
            'image_path' => $coverPath,
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
            'book_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $book = Book::findOrFail($id);

        $data = $request->only([
            'title', 'author', 'genre', 'published_year', 'isbn', 'available',
            'donor', 'donor_phone', 'usage_status'
        ]);

        // Remove existing image if checkbox is selected
        if ($request->has('remove_image') && $book->image_path) {
            if (\Storage::disk('public')->exists($book->image_path)) {
                \Storage::disk('public')->delete($book->image_path);
            }
            $data['image_path'] = null;
        }

        // Replace image if a new one was uploaded
        if ($request->hasFile('book_image')) {
            // Delete old image
            if ($book->image_path && \Storage::disk('public')->exists($book->image_path)) {
                \Storage::disk('public')->delete($book->image_path);
            }

            // Store new one
            $coverPath = $request->file('book_image')->store('covers', 'public');
            $data['image_path'] = $coverPath;
        }

        $book->update($data);

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

    public function showBooks()
    {
        $books = Book::all();
        $authors = Book::select('author')->distinct()->pluck('author');
        return view('books', compact('books', 'authors'));
    }
}
