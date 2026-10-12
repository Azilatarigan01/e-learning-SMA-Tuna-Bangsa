<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignmentsModel;
use App\Models\AssignClassTeacherModel;
use App\Models\SubjectModel;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AssignmentsController extends Controller
{
    public function list()
    {
        $data['getRecord'] = AssignmentsModel::getRecord();
        return view('admin.assignments.list', $data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::all();
        $data['getSubject'] = SubjectModel::all();
        return view('admin.assignments.add', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'assignments_date' => 'required|date',
            'submission_date' => 'required|date',
            'description' => 'required|string',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx,txt'
        ]);

        $assignments = new AssignmentsModel;
        $assignments->class_id = $request->class_id;
        $assignments->subject_id = $request->subject_id;
        $assignments->assignments_date = $request->assignments_date;
        $assignments->submission_date = $request->submission_date;
        $assignments->description = $request->description;
        $assignments->created_by = Auth::id();

        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $filename = $file->getClientOriginalName();
            $destinationPath = public_path('upload/assignments/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            if ($file->move($destinationPath, $filename)) {
                $assignments->document_file = $filename;
            } else {
                Log::error('File upload failed: ' . $filename);
                return redirect()->route('admin.assignments.add')->with('error', 'File upload failed');
            }
        }

        $assignments->save();

        return redirect()->route('admin.assignments.list')->with('success', "Assignments successfully created");
    }

    public function showEditForm($id)
    {
        $assignment = AssignmentsModel::find($id);

        if (!$assignment) {
            return redirect()->route('admin.assignments.list')->with('error', 'Data not found');
        }

        $data['getClass'] = ClassModel::all();
        $data['getSubject'] = SubjectModel::all();
        $data['assignment'] = $assignment;

        return view('admin.assignments.edit', $data);
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'class_id' => 'required|exists:App\Models\ClassModel,id',
            'subject_id' => 'required|exists:App\Models\SubjectModel,id',
            'assignments_date' => 'required|date',
            'submission_date' => 'required|date',
            'description' => 'required|string',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx,txt'
        ]);

        $assignment = AssignmentsModel::find($id);

        if (!$assignment) {
            return redirect()->route('admin.assignments.list')->with('error', 'Data not found');
        }

        $assignment->class_id = $request->class_id;
        $assignment->subject_id = $request->subject_id;
        $assignment->assignments_date = $request->assignments_date;
        $assignment->submission_date = $request->submission_date;
        $assignment->description = $request->description;

        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $filename = $file->getClientOriginalName();
            $destinationPath = public_path('upload/assignments/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            if ($file->move($destinationPath, $filename)) {
                // Hapus file lama jika ada
                if ($assignment->document_file && file_exists($destinationPath . $assignment->document_file)) {
                    unlink($destinationPath . $assignment->document_file);
                }
                $assignment->document_file = $filename;
            } else {
                Log::error('File upload failed: ' . $filename);
                return redirect()->route('admin_assignments.edit', $id)->with('error', 'Failed to upload file.');
            }
        }

        $assignment->save();

        return redirect()->route('admin.assignments.list')->with('success', "Assignments successfully updated");
    }

    public function delete($id)
    {
        $record = AssignmentsModel::find($id);
        if ($record) {
            $record->delete();
            return redirect()->route('admin.assignments.list')->with('success', "Assignments successfully deleted");
        } else {
            return redirect()->route('admin.assignments.list')->with('error', 'Data not found');
        }
    }

    // Teacher side
    public function AssignmentsTeacher(Request $request)
    {
        $teacherId = Auth::user()->id;
        $data['getRecord'] = AssignmentsModel::getMyAssignments($teacherId);
        $data['header_title'] = 'Assignments';
        return view('teacher.assignments.list', $data);
    }
    
    
    

public function addAssignmentsTeacher()
{
    $teacherId = Auth::user()->id;
    $data['getClass'] = AssignClassTeacherModel::getMyClassSubject($teacherId);
    $data['getSubject'] = AssignClassTeacherModel::getMyClassSubject($teacherId);
    $data['header_title'] = 'Add New Assignments';
    $data['selectedClassId'] = null; // Inisialisasi variabel $selectedClassId

    return view('teacher.assignments.add', $data);
}

public function insertAssignmentsTeacher(Request $request)
{
    $request->validate([
        'class_id' => 'required|integer',
        'subject_id' => 'required|integer',
        'assignments_date' => 'required|date',
        'submission_date' => 'required|date',
        'description' => 'required|string',
        'document_file' => 'nullable|file|mimes:pdf,doc,docx,txt'
    ]);

    $assignments = new AssignmentsModel;
    $assignments->class_id = $request->class_id;
    $assignments->subject_id = $request->subject_id;
    $assignments->assignments_date = $request->assignments_date;
    $assignments->submission_date = $request->submission_date;
    $assignments->description = $request->description;
    $assignments->created_by = Auth::id();

    if ($request->hasFile('document_file')) {
        $file = $request->file('document_file');

        if ($file) {
            $filename = $file->getClientOriginalName();
            $destinationPath = public_path('upload/assignments/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            if ($file->move($destinationPath, $filename)) {
                $assignments->document_file = $filename;
            } else {
                Log::error('File upload failed: ' . $filename);
                return redirect()->route('teacher.assignments.add')->with('error', 'File upload failed');
            }
        }
    }

    $assignments->save();

    return redirect()->route('teacher.assignments.list')->with('success', "Assignments successfully created");
}

    public function editAssignmentsTeacher($id)
    {
        $assignments = AssignmentsModel::find($id);
    
        if (!$assignments) {
            return redirect()->route('teacher.assignments.list')->with('error', 'Assignment not found');
        }
    
        $data['assignments'] = $assignments;
        $data['getClass'] = ClassModel::all();
        $data['getSubject'] = SubjectModel::all();
    
        return view('teacher.assignments.edit', $data);
    }

    public function updateAssignmentsTeacher(Request $request, $id)
    {
        $request->validate([
            'class_id' => 'required|exists:App\Models\ClassModel,id',
            'subject_id' => 'required|exists:App\Models\SubjectModel,id',
            'assignments_date' => 'required|date',
            'submission_date' => 'required|date',
            'description' => 'required|string',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx,txt'
        ]);

        $teacherId = Auth::id();
        $assignment = AssignmentsModel::where('id', $id)->where('created_by', $teacherId)->first();

        if (!$assignment) {
            return redirect()->route('teacher.assignments.list')->with('error', 'Data not found');
        }

        $assignment->class_id = $request->class_id;
        $assignment->subject_id = $request->subject_id;
        $assignment->assignments_date = $request->assignments_date;
        $assignment->submission_date = $request->submission_date;
        $assignment->description = $request->description;

        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $filename = $file->getClientOriginalName();
            $destinationPath = public_path('upload/assignments/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            if ($file->move($destinationPath, $filename)) {
                // Hapus file lama jika ada
                if ($assignment->document_file && file_exists($destinationPath . $assignment->document_file)) {
                    unlink($destinationPath . $assignment->document_file);
                }
                $assignment->document_file = $filename;
            } else {
                Log::error('File upload failed: ' . $filename);
                return redirect()->route('teacher.assignments.edit', $id)->with('error', 'Failed to upload file.');
            }
        }

        $assignment->save();

        return redirect()->route('teacher.assignments.list')->with('success', "Assignments successfully updated");
    }

    public function deleteAssignmentsTeacher($id)
    {
        $assignment = AssignmentsModel::find($id);
    
        if (!$assignment) {
            return redirect()->route('teacher.assignments.list')->with('error', 'Assignment not found');
        }
    
        // Lakukan proses penghapusan di sini
        $assignment->delete();
    
        return redirect()->route('teacher.assignments.list')->with('success', 'Assignment successfully deleted');
    }
    
    //student side
    public function MyAssignments()
    {
        $studentId = Auth::id();
        $data['getRecord'] = AssignmentsModel::getRecord($studentId);
        $data['header_title'] = 'My Assignments';
        return view('student.assignments.list', $data);
    }

    public function submit(Request $request, $id)
    {
        // Validate the request inputs
        $request->validate([
            'document_file' => 'required|file|mimes:pdf,doc,docx|max:2048', // Adjust the validation rules as per your requirements
            'description' => 'nullable|string|max:1000', // Adjust max length as needed
        ]);
    
        // Handle the file upload
        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('assignments', $filename, 'public');
    
            // Save the submission details to the database
            $assignmentSubmission = new AssignmentSubmission(); // Replace with your model name
            $assignmentSubmission->assignment_id = $id;
            $assignmentSubmission->student_id = auth()->id(); // Assuming you have student ID from the authenticated user
            $assignmentSubmission->file_path = $filePath;
            $assignmentSubmission->description = $request->input('description');
            $assignmentSubmission->save();
        }
    
        // Redirect to the appropriate route after successful submission
        return redirect()->route('student.my_assignments.index')->with('success', 'Assignment submitted successfully.');
    }
    

}