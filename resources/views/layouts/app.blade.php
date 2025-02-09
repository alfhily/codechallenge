<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Student Management System</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap">
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-hover: #2563eb;
            --primary-light: #eff6ff;
            --danger-color: #ef4444;
            --success-color: #10b981;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--gray-50);
            color: var(--gray-800);
            line-height: 1.6;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            padding-top: 64px;
        }

        /* Navigation Bar Styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 64px;
            background-color: white;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            z-index: 1000;
            display: flex;
            align-items: center;
            padding: 0 2rem;
            backdrop-filter: blur(8px);
            background-color: rgba(255, 255, 255, 0.9);
        }

        .navbar-brand {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--gray-900);
            text-decoration: none;
            margin-right: 3rem;
            letter-spacing: -0.025em;
        }

        .navbar-nav {
            display: flex;
            gap: 2rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-link {
            color: var(--gray-600);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            padding: 0.5rem 0;
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-link:hover {
            color: var(--gray-900);
        }

        .nav-link.active {
            color: var(--primary-color);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        .navbar-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            border: none;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: white;
            color: var(--gray-700);
            border: 1px solid var(--gray-200);
        }

        .btn-secondary:hover {
            background-color: var(--gray-50);
            border-color: var(--gray-300);
            transform: translateY(-1px);
        }

        /* Alerts */
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            border: 1px solid transparent;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: var(--success-color);
            border-color: #a7f3d0;
        }

        .alert-danger {
            background-color: #fef2f2;
            color: var(--danger-color);
            border-color: #fecaca;
        }

        /* Forms */
        .form-control {
            width: 100%;
            padding: 0.625rem 0.875rem;
            border: 1px solid var(--gray-200);
            border-radius: 0.5rem;
            font-size: 0.875rem;
            color: var(--gray-900);
            transition: all 0.2s ease;
            background-color: white;
        }

        .form-control:hover {
            border-color: var(--gray-300);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        /* Tables */
        .table-container {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 0.75rem 1.5rem;
            text-align: left;
            font-size: 0.875rem;
        }

        th {
            background-color: var(--gray-50);
            font-weight: 500;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.75rem;
        }

        tr:not(:last-child) td {
            border-bottom: 1px solid var(--gray-100);
        }

        tr:hover td {
            background-color: var(--gray-50);
        }

        /* Utilities */
        .shadow-sm {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <a href="/dashboard" class="navbar-brand">Student Management System</a>
        <ul class="navbar-nav">
            <li><a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a></li>
            <li><a href="{{ route('students.upload.form') }}" class="nav-link {{ request()->is('upload') ? 'active' : '' }}">Upload & Manage</a></li>
        </ul>
        <div class="navbar-right">
            <form action="{{ route('logout') }}" method="POST" style="margin: 0">
                @csrf
                <button type="submit" class="btn btn-secondary">Logout</button>
            </form>
        </div>
    </nav>

    @yield('content')

    @yield('scripts')
</body>
</html>
