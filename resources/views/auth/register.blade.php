<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Student Management System</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap">
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --danger-color: #dc2626;
            --success-color: #059669;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--gray-100) 100%);
            color: var(--gray-800);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        .page-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .brand {
            margin-bottom: 2rem;
            text-align: center;
        }

        .brand h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 0.5rem;
        }

        .brand p {
            color: var(--gray-600);
            font-size: 0.875rem;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 
                        0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .card-body {
            padding: 2rem;
        }

        h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-800);
        }

        .alert {
            padding: 0.875rem 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }

        .alert-danger {
            background-color: #fef2f2;
            color: var(--danger-color);
            border: 1px solid #fecaca;
        }

        .alert ul {
            margin: 0.5rem 0 0;
            padding-left: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-700);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--gray-300);
            border-radius: 8px;
            font-size: 0.875rem;
            color: var(--gray-800);
            transition: all 0.15s ease;
            background-color: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .form-control::placeholder {
            color: var(--gray-600);
        }

        .password-feedback {
            margin-top: 0.375rem;
            font-size: 0.813rem;
        }

        .password-feedback.valid {
            color: var(--success-color);
        }

        .password-feedback.invalid {
            color: var(--danger-color);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s ease;
            white-space: nowrap;
            width: 100%;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            margin-bottom: 1rem;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-secondary {
            background-color: var(--gray-100);
            color: var(--gray-700);
        }

        .btn-secondary:hover {
            background-color: var(--gray-200);
        }

        @media (max-width: 640px) {
            .page-container {
                padding: 1rem;
            }
            
            .card-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="page-container">
        <div class="brand">
            <h1>Student Management System</h1>
            <p>Create your account</p>
        </div>

        <div class="container">
            <div class="card-header">
                <h2>Register</h2>
            </div>

            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('/auth/register') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" 
                               id="name"
                               name="name" 
                               class="form-control" 
                               value="{{ old('name') }}" 
                               placeholder="Enter your full name"
                               required 
                               autofocus>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" 
                               id="email"
                               name="email" 
                               class="form-control" 
                               value="{{ old('email') }}" 
                               placeholder="Enter your email"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-control" 
                               placeholder="Choose a password"
                               required 
                               onkeyup="validatePassword()">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="form-control" 
                               placeholder="Confirm your password"
                               required 
                               onkeyup="validatePassword()">
                        <div id="password-match-message" class="password-feedback"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Account</button>
                    <a href="{{ route('login') }}" class="btn btn-secondary">Back to Login</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        function validatePassword() {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("password_confirmation").value;
            const message = document.getElementById("password-match-message");

            if (confirmPassword === "") {
                message.textContent = "";
                message.className = "password-feedback";
            } else if (password === confirmPassword) {
                message.textContent = "✓ Passwords match";
                message.className = "password-feedback valid";
            } else {
                message.textContent = "× Passwords do not match";
                message.className = "password-feedback invalid";
            }
        }
    </script>
</body>
</html>
