<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

    <script>
        // Real-time password match validation
        function validatePassword() {
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("password_confirmation").value;
            let message = document.getElementById("password-match-message");

            if (password === confirmPassword) {
                message.textContent = "Passwords match ✅";
                message.style.color = "green";
            } else {
                message.textContent = "Passwords do not match ❌";
                message.style.color = "red";
            }
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Register</h2>

        {{-- Display Validation Errors --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Registration Form --}}
        <form action="{{ route('register') }}" method="POST">
            @csrf

            {{-- Name Field --}}
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
            </div>

            {{-- Email Field --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            {{-- Password Field --}}
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required onkeyup="validatePassword()">
            </div>

            {{-- Confirm Password Field --}}
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required onkeyup="validatePassword()">
                <small id="password-match-message"></small>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="btn btn-primary w-100">Register</button>

            {{-- Back to Login Link --}}
            <div class="mt-3 text-center">
                <a href="{{ route('login') }}" class="btn btn-secondary">Back to Login</a>
            </div>
        </form>
    </div>
</body>
</html>
