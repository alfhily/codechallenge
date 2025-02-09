<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Student Management System</title>
    {{-- Prevent Browser Caching --}}
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
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
            display: flex;
            align-items: center;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: var(--success-color);
            border: 1px solid #a7f3d0;
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
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
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

        .actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 2rem;
        }

        .btn-block {
            width: 100%;
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
            <p>Login to access your account</p>
        </div>
        
        <div class="container">
            <div class="card-header">
                <h2>Login</h2>
            </div>
            
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('/auth/login') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" 
                               id="email"
                               name="email" 
                               class="form-control" 
                               placeholder="Enter your email"
                               value="" 
                               autocomplete="new-email" 
                               required 
                               autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" 
                               id="password"
                               name="password" 
                               class="form-control" 
                               placeholder="Enter your password"
                               value="" 
                               autocomplete="new-password" 
                               required>
                    </div>

                    <div class="actions">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                        <a href="{{ route('register') }}" class="btn btn-secondary btn-block">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        window.onload = function () {
            setTimeout(function() {
                document.querySelector('input[name="email"]').value = "";
                document.querySelector('input[name="password"]').value = "";
            }, 50);
        };
    </script>
</body>
</html>
