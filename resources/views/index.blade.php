@extends('layouts.app')

@section('content')
<div class="container">
    <h2>📚 Book List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
