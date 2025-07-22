@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Book</h2>

    @if ($errors->any())
      <div class="alert alert-danger">
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
        <label class="form-label">Title</label>
        <input type="text" name="title" value="{{ old('title', $book->title) }}" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Author</label>
        <input type="text" name="author" value="{{ old('author', $book->author) }}" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">Genre</label>
        <input type="text" name="genre" value="{{ old('genre', $book->genre) }}" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">Published Year</label>
        <input type="number" name="published_year" value="{{ old('published_year', $book->published_year) }}" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">ISBN</label>
        <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Donor</label>
        <input type="text" name="donor" value="{{ old('donor', $book->donor) }}" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">Donor's Phone</label>
        <input type="text" name="donor_phone" value="{{ old('donor_phone', $book->donor_phone) }}" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">Available?</label>
        <select name="available" class="form-select">
          <option value="1" {{ $book->available ? 'selected' : '' }}>Yes</option>
          <option value="0" {{ !$book->available ? 'selected' : '' }}>No</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Update Book</button>
      <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
