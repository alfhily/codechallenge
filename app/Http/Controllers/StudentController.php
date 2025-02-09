<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    /**
     * Show the upload form and student records.
     */
    public function uploadForm(Request $request)
    {
        $query = Student::query();

        // Search by name
        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Fetch unique class values from the database
        $classes = Student::pluck('class')->unique();

        // Filter by class
        if ($request->has('class') && $request->class != '') {
            $query->where('class', $request->class);
        }

        // Paginate results
        $students = $query->paginate(10);

        return view('upload', compact('students', 'classes'));
    }

    /**
     * Handle the Excel file upload and process student data.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048' // Only allow Excel files
    ], [
        'file.mimes' => 'Only Excel files (.xlsx, .xls) are allowed to upload.',
        'file.required' => 'Please select a file to upload.',
    ]);

        $file = $request->file('file');

        // Load the spreadsheet
        $spreadsheet = IOFactory::load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        foreach ($rows as $index => $row) {
            // Skip the first row if it's a header
            if ($index === 0) {
                continue;
            }

            // Extract student data
            $name = $row[0] ?? null;
            $class = $row[1] ?? null;
            $level = $row[2] ?? null;
            $parent_contact = $row[3] ?? null;

            if (!$name || !$class || !$level || !$parent_contact) {
                continue; // Skip empty rows
            }

            // Check if the student record already exists
            $existingStudent = Student::where('name', $name)
                ->where('class', $class)
                ->where('level', $level)
                ->first();

            if (!$existingStudent) {
                // Insert new student record
                Student::create([
                    'name' => $name,
                    'class' => $class,
                    'level' => $level,
                    'parent_contact' => $parent_contact
                ]);
            }
        }

        return redirect()->route('students.upload.form')->with('success', 'Students uploaded successfully!');
    }
}
