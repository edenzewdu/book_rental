@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Book</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems:<br><br>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" value="{{ old('title', $book->title) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" name="author" value="{{ old('author', $book->author) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" name="genre" value="{{ old('genre', $book->genre) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="published_year" class="form-label">Published Year</label>
            <input type="number" name="published_year" value="{{ old('published_year', $book->published_year) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="available" class="form-label">Available</label>
            <select name="available" class="form-control">
                <option value="1" {{ old('available', $book->available) ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !old('available', $book->available) ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="donor" class="form-label">Donor</label>
            <input type="text" name="donor" value="{{ old('donor', $book->donor) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="donor_phone" class="form-label">Donor Phone</label>
            <input type="text" name="donor_phone" value="{{ old('donor_phone', $book->donor_phone) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="usage_status" class="form-label">Usage Status</label>
            <select name="usage_status" class="form-control">
                <option value="new" {{ old('usage_status', $book->usage_status) == 'new' ? 'selected' : '' }}>New</option>
                <option value="used" {{ old('usage_status', $book->usage_status) == 'used' ? 'selected' : '' }}>Used</option>
            </select>
        </div>

        {{-- Image Preview and Remove Option --}}
        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if ($book->image_path)
                <img src="{{ asset('storage/' . $book->image_path) }}" alt="Book Cover" width="100"><br>
                <input type="checkbox" name="remove_image" value="1" id="remove_image">
                <label for="remove_image">Remove current image</label>
            @else
                <p>No image uploaded.</p>
            @endif
        </div>

        {{-- Upload New Image --}}
        <div class="mb-3">
            <label for="book_image" class="form-label">Upload New Image</label>
            <input type="file" name="book_image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Book</button>
    </form>
</div>
@endsection
