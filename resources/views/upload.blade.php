@extends('layouts.app')

@section('title', 'Upload & Manage Students')

@section('styles')
<style>
    .page-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .section {
        background-color: white;
        border-radius: 1rem;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
    }

    .section-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        align-items: start;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 1.5rem;
        text-align: center;
        letter-spacing: -0.025em;
    }

    .section-card {
        background-color: var(--gray-50);
        border-radius: 0.75rem;
        padding: 1.5rem;
    }

    .section-card-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 1rem;
        text-align: center;
    }

    .upload-section {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        align-items: center;
        max-width: 400px;
        margin: 0 auto;
    }

    .file-input-wrapper {
        width: 100%;
        position: relative;
    }

    .file-input-wrapper .form-control {
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        border: 2px dashed var(--gray-200);
        background-color: var(--gray-50);
        transition: all 0.2s ease;
    }

    .file-input-wrapper .form-control:hover {
        border-color: var(--primary-color);
        background-color: var(--primary-light);
    }

    .file-input-label {
        font-size: 0.875rem;
        color: var(--gray-600);
        margin-bottom: 0.5rem;
        display: block;
        text-align: center;
    }

    .search-filters {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        align-items: center;
        max-width: 400px;
        margin: 0 auto;
    }

    .search-filters .form-control {
        width: 100%;
    }

    .buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        width: 100%;
        margin-top: 1rem;
    }

    .buttons .btn {
        min-width: 120px;
        height: 40px;
    }

    .alert {
        max-width: 400px;
        margin: 0 auto 1rem auto;
    }

    .alert ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .table-container {
        margin-top: 2rem;
        overflow-x: auto;
        border: 1px solid var(--gray-200);
        border-radius: 8px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 0.75rem 1rem;
        text-align: left;
        border-bottom: 1px solid var(--gray-200);
    }

    th {
        background-color: var(--gray-50);
        font-weight: 600;
        color: var(--gray-700);
    }

    tr:last-child td {
        border-bottom: none;
    }

    .pagination {
        margin-top: 1rem;
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    .page-link {
        padding: 0.5rem 1rem;
        border: 1px solid var(--gray-200);
        border-radius: 0.375rem;
        color: var(--gray-700);
        text-decoration: none;
    }

    .page-link:hover {
        background-color: var(--gray-50);
    }

    .page-item.active .page-link {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }
</style>
@endsection

@section('content')
<div class="page-container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="section">
        <h2 class="section-title">Student Management</h2>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="section-grid">
            <div class="section-card">
                <h3 class="section-card-title">Upload Student Data</h3>
                <form action="{{ route('students.upload') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateFile()">
                    @csrf
                    <div class="upload-section">
                        <div class="file-input-wrapper">
                            <label class="file-input-label">Choose an Excel file or drag it here</label>
                            <input type="file" class="form-control" name="file" id="file" accept=".xlsx,.xls" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload File</button>
                    </div>
                </form>
            </div>

            <div class="section-card">
                <h3 class="section-card-title">Search and Filter</h3>
                <form method="GET" action="{{ route('students.upload.form') }}">
                    <div class="search-filters">
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Search by name"
                               value="{{ request('search') }}">
                        <select name="class" class="form-control">
                            <option value="">All Classes</option>
                            @foreach($classes as $class)
                                <option value="{{ $class }}" {{ request('class') == $class ? 'selected' : '' }}>
                                    {{ $class }}
                                </option>
                            @endforeach
                        </select>
                        <div class="buttons">
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                            <a href="{{ route('students.upload.form') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(isset($students) && count($students) > 0)
    <div class="section">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Level</th>
                        <th>Parent Contact</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->class }}</td>
                        <td>{{ $student->level }}</td>
                        <td>{{ $student->parent_contact }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination">
            {{ $students->links() }}
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
function validateFile() {
    const fileInput = document.getElementById('file');
    const file = fileInput.files[0];
    const allowedTypes = [
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.ms-excel'
    ];
    
    if (!file) {
        alert('Please select a file');
        return false;
    }
    
    if (!allowedTypes.includes(file.type)) {
        alert('Please upload only Excel files (.xlsx or .xls)');
        return false;
    }
    
    return true;
}

// Add drag and drop functionality
const fileInput = document.querySelector('.file-input-wrapper input');
const fileInputWrapper = document.querySelector('.file-input-wrapper');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    fileInputWrapper.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    fileInputWrapper.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    fileInputWrapper.addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
    fileInputWrapper.querySelector('.form-control').style.borderColor = 'var(--primary-color)';
    fileInputWrapper.querySelector('.form-control').style.backgroundColor = 'var(--primary-light)';
}

function unhighlight(e) {
    fileInputWrapper.querySelector('.form-control').style.borderColor = 'var(--gray-200)';
    fileInputWrapper.querySelector('.form-control').style.backgroundColor = 'var(--gray-50)';
}

fileInputWrapper.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    fileInput.files = files;
}
</script>
@endsection
