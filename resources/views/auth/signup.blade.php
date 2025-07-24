<!DOCTYPE html>
<html>
<head>
    <title>{{ ucfirst($role) }} Signup</title>
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

    <h2>{{ ucfirst($role) }} Signup</h2>

    <form method="POST" action="{{ url('/signup') }}">
        @csrf
        <input type="hidden" name="role" value="{{ $role }}">

        <label>Name:</label>
        <input type="text" name="name" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Phone Number:</label>
        <input type="text" name="phone_no" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation" required><br>

        <button type="submit">Sign Up</button>
    </form>

    <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
</body>
</html>
