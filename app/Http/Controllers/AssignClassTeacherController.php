<?php

namespace App\Http\Controllers;
use App\Models\SubjectModel;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\AssignClassTeacherModel;
use Illuminate\Http\Request;

class AssignClassTeacherController extends Controller
{
    public function list()
    {
        $data['getRecord'] = AssignClassTeacherModel::getRecord();
        return view('admin.assign_class_teacher.list', $data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::all(); 
        $data['getTeacherClass'] = User::getTeacherClass(); // Fetch teacher users
        return view('admin.assign_class_teacher.add', $data);
    }

    public function insert(Request $request)
    {
        // Validasi input
        $request->validate([
            'class_id' => 'required|exists:class,id', // Adjust table name if needed
            'teacher_id' => 'required|array',
            'teacher_id.*' => 'exists:users,id', // Ensure each teacher ID exists in users table
            'status' => 'required|integer'
        ]);

        // Check for duplicate assignments
        foreach ($request->teacher_id as $teacher_id) {
            $existingAssignment = AssignClassTeacherModel::where('class_id', $request->class_id)
                ->where('teacher_id', $teacher_id)
                ->first();

            if ($existingAssignment) {
                return redirect()->back()->with('error', "Guru dengan ID $teacher_id sudah ditugaskan ke kelas ini");
            }
        }

        // Simpan data penugasan guru baru ke kelas
        foreach ($request->teacher_id as $teacher_id) {
            $assignment = new AssignClassTeacherModel;
            $assignment->class_id = $request->class_id;
            $assignment->teacher_id = $teacher_id;
            $assignment->status = $request->status;
            $assignment->created_by = Auth::user()->id;
            $assignment->is_delete = 0;
            $assignment->created_at = now(); 
            $assignment->updated_at = now();
            $assignment->save();
        }

        return redirect()->route('assign_class_teacher.list')->with('success', "Penugasan Guru berhasil ditambah");   
    }

    public function showEditForm($id)
    {
        $data['record'] = AssignClassTeacherModel::find($id);
        if (!$data['record']) {
            return redirect()->route('assign_class_teacher.list')->with('error', 'Data tidak ditemukan');
        }
        $data['getClass'] = ClassModel::all();
        $data['getTeacherClass'] = User::getTeacherClass(); // Fetch teacher users
        return view('admin.assign_class_teacher.edit', $data);
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'class_id' => 'required|exists:class,id', // Adjust table name if needed
            'teacher_id' => 'required|exists:users,id', // Ensure teacher ID exists in users table
            'status' => 'required|integer'
        ]);

        // Check if the assignment already exists
        $existingAssignment = AssignClassTeacherModel::where('class_id', $request->class_id)
            ->where('teacher_id', $request->teacher_id)
            ->where('id', '!=', $id) // Avoid validation with the data being updated
            ->first();

        if ($existingAssignment) {
            return redirect()->back()->with('error', 'Penugasan kelas dan guru yang dipilih sudah ada.');
        }

        $record = AssignClassTeacherModel::find($id);
        if (!$record) {
            return redirect()->route('assign_class_teacher.list')->with('error', 'Data tidak ditemukan');
        }

        $record->class_id = $request->class_id;
        $record->teacher_id = $request->teacher_id;
        $record->status = $request->status;
        $record->save();

        return redirect()->route('assign_class_teacher.list')->with('success', "Penugasan Guru berhasil diperbarui");
    }

    public function delete($id)
    {
        $record = AssignClassTeacherModel::find($id);
        if ($record) {
            $record->delete();
            return redirect()->route('assign_class_teacher.list')->with('success', "Penugasan Guru berhasil dihapus");
        } else {
            return redirect()->route('assign_class_teacher.list')->with('error', 'Data tidak ditemukan');
        }
    }

    public function MyClassSubject()
    {
        $data['getRecords'] = AssignClassTeacherModel::getMyClassSubject(Auth::user()->id);
        return view('teacher.my_class_subject', $data);
    }
}
