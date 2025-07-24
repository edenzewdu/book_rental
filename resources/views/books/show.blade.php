@extends('layouts.app')

@section('content')
<div class="book-detail-container">
    <div class="book-cover">
        <img src="{{ asset('storage/' . ($book->cover_image ?? 'defaults/book.png')) }}" alt="{{ $book->title }}">
    </div>
    <div class="book-info">
        <h1>{{ $book->title }}</h1>
        <p><strong>Author:</strong> {{ $book->author }}</p>
        <p><strong>Description:</strong> {{ $book->description ?? 'No description available.' }}</p>

        <form method="POST" action="{{ route('books.rent', $book->id) }}">
            @csrf
            <button type="submit" class="rent-button">Rent This Book</button>
        </form>
    </div>
</div>
@endsection

<style>
body {
    background-color: #0d0d0d;
    color: white;
}

.book-detail-container {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    padding: 40px;
    max-width: 1000px;
    margin: auto;
}

.book-cover img {
    width: 280px;
    height: 400px;
    object-fit: cover;
    border: 3px solid gold;
    border-radius: 10px;
    box-shadow: 0 0 20px gold;
}

.book-info {
    margin-left: 30px;
    max-width: 600px;
}

.book-info h1 {
    font-size: 2.5rem;
    color: gold;
    margin-bottom: 20px;
}

.book-info p {
    font-size: 1.1rem;
    margin-bottom: 15px;
}

.rent-button {
    background-color: gold;
    color: black;
    padding: 10px 25px;
    font-size: 1.1rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    box-shadow: 0 0 10px gold;
}

.rent-button:hover {
    background-color: white;
    color: #0d0d0d;
}
</style>
