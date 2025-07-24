<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Books List</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <script>
        function toggleMode() {
            const body = document.body;
            const toggle = document.getElementById('modeToggle');
            body.classList.toggle('dark-mode');
            localStorage.setItem('theme', body.classList.contains('dark-mode') ? 'dark' : 'light');
            toggle.checked = body.classList.contains('dark-mode');
        }

        window.onload = () => {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark') {
                document.body.classList.add('dark-mode');
                document.getElementById('modeToggle').checked = true;
            }
        };

        function filterBooks() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const selectedAuthor = document.getElementById('authorFilter').value;
            const cards = document.querySelectorAll('.book-card');

            cards.forEach(card => {
                const title = card.querySelector('h3').innerText.toLowerCase();
                const author = card.getAttribute('data-author').toLowerCase();

                const matchesSearch = title.includes(search) || author.includes(search);
                const matchesAuthor = selectedAuthor === '' || author === selectedAuthor.toLowerCase();

                if (matchesSearch && matchesAuthor) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
    <style>
        .controls {
            margin: 20px auto;
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .controls input,
        .controls select {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            max-width: 300px;
            width: 100%;
        }

        body.dark-mode .controls input,
        body.dark-mode .controls select {
            background-color: #2a2a2a;
            color: goldenrod;
            border: 1px solid goldenrod;
        }

        .books-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
            width: 100%;
            max-width: 1000px;
        }

        .book-card {
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            background-color: #fff;
            transition: transform 0.3s, background-color 0.3s, color 0.3s;
        }

        .book-card h3 {
            margin-bottom: 10px;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        body.dark-mode .book-card {
            background-color: #1a1a1a;
            color: goldenrod;
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.1);
        }

        /* Image section */
        .book-image-wrapper {
            position: relative;
            width: 100%;
            max-width: 100px;
            margin-bottom: 10px;
        }

        .book-image {
            width: 100%;
            height: auto;
            border-radius: 6px;
            object-fit: cover;
        }

        .image-title-overlay {
            position: absolute;
            bottom: 4px;
            left: 0;
            right: 0;
            padding: 2px 5px;
            font-size: 10px;
            text-align: center;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            font-weight: 400;
            border-bottom-left-radius: 6px;
            border-bottom-right-radius: 6px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .overlay-title-author {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 6px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            pointer-events: none;
        }

        .overlay-title {
            font-size: 11px;
            color: white;
            text-align: center;
            background: rgba(0, 0, 0, 0.6);
            padding: 2px 5px;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
            font-weight: bold;
            max-height: 2.5em;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .overlay-author {
            font-size: 10px;
            color: white;
            text-align: right;
            background: rgba(0, 0, 0, 0.6);
            padding: 2px 5px;
            border-bottom-right-radius: 6px;
            font-style: italic;
            max-height: 2em;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .book-cover-link {
            display: inline-block;
            margin: 10px;
            width: 130px; /* adjust size as needed */
            height: 190px;
            position: relative;
            text-decoration: none;
        }

        .book-image-wrapper {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
        }

        .book-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Overlay for default image */
        .overlay-title-author {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 6px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            pointer-events: none;
        }

        .overlay-title {
            font-size: 11px;
            color: white;
            text-align: center;
            background: rgba(0, 0, 0, 0.6);
            padding: 2px 5px;
            font-weight: bold;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .overlay-author {
            font-size: 10px;
            color: white;
            text-align: right;
            background: rgba(0, 0, 0, 0.6);
            padding: 2px 5px;
            font-style: italic;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }


    </style>
</head>
<body>

    <!-- Toggle switch -->
    <label class="toggle-switch">
        <input type="checkbox" id="modeToggle" onclick="toggleMode()">
        <span class="toggle-slider"></span>
    </label>

    <h2 style="text-align: center; margin-bottom: 10px;">📚 Available Books</h2>

    <!-- Search and Filter Controls -->
    <div class="controls">
        <input type="text" id="searchInput" placeholder="Search by title or author..." onkeyup="filterBooks()">
        <select id="authorFilter" onchange="filterBooks()">
            <option value="">All Authors</option>
            @foreach($authors as $author)
                <option value="{{ $author }}">{{ $author }}</option>
            @endforeach
        </select>
    </div>

    <!-- Book Cards -->

    <div class="books-container">
        @foreach($books as $book)
            <a href="{{ route('books.show', $book->id) }}" class="book-cover-link">
                <div class="book-image-wrapper">
                    <img src="{{ asset('storage/' . ($book->cover_image ?? 'defaults/book.png')) }}"
                        alt="{{ $book->title }}" class="book-image">

                    @if(!$book->cover_image)
                        <div class="overlay-title-author">
                            <div class="overlay-title">{{ $book->title }}</div>
                            <div class="overlay-author">{{ $book->author }}</div>
                        </div>
                    @endif
                </div>
            </a>
        @endforeach
    </div>


</body>
</html>
