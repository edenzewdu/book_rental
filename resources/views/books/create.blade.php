@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Book</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Display any validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Download template and Import button --}}
    <div class="d-flex justify-content-between mb-3">
        <p>
            <a href="{{ asset('templates/book_import_template.xlsx') }}" class="btn btn-link">Download Excel Template</a>
        </p>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">
            Import Books
        </button>
    </div>

    {{-- Book create form --}}
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" placeholder="Book title" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Author</label>
            <input type="text" name="author" class="form-control" placeholder="Author" value="{{ old('author') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Genre</label>
            <input type="text" name="genre" class="form-control" placeholder="Genre" value="{{ old('genre') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Published Year</label>
            <input type="number" name="published_year" class="form-control" placeholder="Year" value="{{ old('published_year') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">ISBN <span class="text-danger">*</span></label>
            <input type="text" name="isbn" class="form-control" placeholder="ISBN" value="{{ old('isbn') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Book Image (optional)</label>
            <input type="file" name="book_image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Donor (optional)</label>
            <input type="text" name="donor" class="form-control" placeholder="Donor name" value="{{ old('donor') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Donor's Phone</label>
            <input type="text" name="donor_phone" class="form-control" placeholder="Phone number" value="{{ old('donor_phone') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Available?</label>
            <select name="available" class="form-select">
                <option value="1" {{ old('available', '1') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('available') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>

{{-- Import Modal --}}
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('books.import') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="importModalLabel">Import Books from Excel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="file" name="file" class="form-control" required accept=".xlsx,.xls">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Import</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- Bootstrap 5 JS Bundle --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
