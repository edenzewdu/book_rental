@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Book</h2>

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="title" placeholder="Title" class="form-control mb-2" required>
        <input type="text" name="author" placeholder="Author" class="form-control mb-2">
        <input type="text" name="genre" placeholder="Genre" class="form-control mb-2">
        <input type="number" name="published_year" placeholder="Published Year" class="form-control mb-2">
        <input type="text" name="isbn" placeholder="ISBN" class="form-control mb-2">
        <input type="text" name="donor" placeholder="Donor Name" class="form-control mb-2">
        <input type="text" name="donor_phone" placeholder="Donor Phone" class="form-control mb-2">
        <input type="text" name="usage_status" placeholder="Usage Status" class="form-control mb-2">
        
        <label>Book Cover (optional)</label>
        <input type="file" name="cover_image" class="form-control mb-2">

        <button type="submit" class="btn btn-primary">Add Book</button>
    </form>
</div>
@endsection
