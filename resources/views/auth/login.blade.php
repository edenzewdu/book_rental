<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
    </script>
</head>
<body>

    <!-- Toggle switch -->
    <label class="toggle-switch">
        <input type="checkbox" id="modeToggle" onclick="toggleMode()">
        <span class="toggle-slider"></span>
    </label>

    <h2>Login</h2>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>

    <p>Signup as <a href="{{ route('signup.user') }}">User</a> or <a href="{{ route('signup.admin') }}">Admin</a></p>
</body>
</html>
