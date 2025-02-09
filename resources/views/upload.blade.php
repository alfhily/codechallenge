<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload & Manage Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h2 class="mb-4">Manage Students</h2>

        {{-- Success Message with Close Button --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Upload Form --}}
        <form action="{{ route('students.upload') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <input type="file" class="form-control" name="file" required>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </form>

        {{-- Search and Filter --}}
        <form method="GET" action="{{ route('students.upload.form') }}" class="mb-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control text-center" placeholder="Search by name" value="{{ request('search') }}">
                </div>
                <div class="col-md-6">
                    <select name="class" class="form-control text-center">
                        <option value="">All Classes</option>
                        @foreach($classes as $class)
                            <option value="{{ $class }}" {{ request('class') == $class ? 'selected' : '' }}>
                                {{ $class }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('students.upload.form') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        {{-- Student Records --}}
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Level</th>
                        <th>Parent Contact</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->class }}</td>
                            <td>{{ $student->level }}</td>
                            <td>{{ $student->parent_contact }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $students->links() }} <!-- Pagination -->
    </div>

    <!-- Bootstrap JavaScript for alert close functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
