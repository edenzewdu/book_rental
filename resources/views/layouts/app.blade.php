<!DOCTYPE html>
<html>
<head>
    <title>Book Rental App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    @auth
        <div class="d-flex justify-content-between align-items-center p-2 bg-light">
            <span>Welcome, {{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">Logout</button>
            </form>
        </div>
   

    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">📚 Book Rental</a>
            <a class="nav-link" href="{{ route('books.index') }}">View Books</a>
            <a class="nav-link" href="{{ route('books.create') }}">Add Book</a>
        </div>
    </nav>
 @endauth
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
