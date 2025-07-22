@extends('layouts.app')

@section('content')
<div class="container">
    <h2>📚 Book List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <form method="GET" action="{{ route('books.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search books..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>

     <a href="{{ route('books.export') }}" class="btn btn-success">Export Books</a>

    

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Cover</th>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Published</th>
                <th>ISBN</th>
                <th>Donor</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
            <tr>
                <td>
                    <img src="{{ asset('storage/' . ($book->cover_image ?? 'defaults/book.png')) }}" 
                         alt="{{ $book->title }}" width="60" height="80">
                </td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->genre }}</td>
                <td>{{ $book->published_year }}</td>
                <td>{{ $book->isbn }}</td>
                <td>{{ $book->donor }}<br><small>{{ $book->donor_phone }}</small></td>
                <td>{{ $book->available ? '✅ Available' : '❌ Rented' }}</td>
                <td>
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No books found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
