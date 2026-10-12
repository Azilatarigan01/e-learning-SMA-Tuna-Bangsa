<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassSubjectModel;
use App\Models\SubjectModel;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;

class ClassTimetableController extends Controller
{
    public function list()
    {
        $data['getClass'] = ClassModel::all();
        return view('admin.class_timetable.list', $data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::all();
        $data['getSubject'] = SubjectModel::all();
        return view('admin.class_timetable.add', $data);
    }

    public function insert(Request $request)
    {
        // Validasi input
        $request->validate([
            'class_id' => 'required|exists:App\Models\ClassModel,id',
            'subject_id' => 'required|array',
            'subject_id.*' => 'exists:App\Models\SubjectModel,id',
            'status' => 'required|in:0,1'
        ]);
    
        // Validasi agar tidak ada kelas dan mata pelajaran yang sama
        foreach ($request->subject_id as $subject_id) {
            $existingAssignment = ClassSubjectModel::where('class_id', $request->class_id)
                ->where('subject_id', $subject_id)
                ->first();
    
            if ($existingAssignment) {
                return redirect()->back()->with('error', 'Tidak boleh memilih mata pelajaran yang sama untuk satu kelas.');
            }
        }
    
        // Validasi duplikasi nama kelas mata pelajaran
        $existingClassSubject = ClassSubjectModel::whereHas('class', function($query) use ($request) {
            $query->where('name', $request->name);
        })->first();
    
        if ($existingClassSubject) {
            return redirect()->back()->with('error', "Kelas mata pelajaran sudah ada");
        }
    
        // Menyimpan data penugasan mata pelajaran
        foreach ($request->subject_id as $subject_id) {
            $getAlreadyFirst = ClassSubjectModel::where('class_id', $request->class_id)
                ->where('subject_id', $subject_id)
                ->first();
    
            if ($getAlreadyFirst) {
                $getAlreadyFirst->status = $request->status;
                $getAlreadyFirst->save();
            } else {
                $save = new ClassSubjectModel();
                $save->class_id = $request->class_id;
                $save->subject_id = $subject_id;
                $save->status = $request->status;
                $save->created_by = Auth::user()->id;
                $save->save();
            }
        }
    
        return redirect()->route('assign_subject.list')->with('success', "Assign subject berhasil ditambah");
    }
    

    public function showEditForm($id)
    {
        $data['record'] = ClassSubjectModel::find($id);
        if (!$data['record']) {
            return redirect()->route('assign_subject.list')->with('error', 'Data tidak ditemukan');
        }
        $data['getClass'] = ClassModel::all();
        $data['getSubject'] = SubjectModel::all();
        return view('admin.assign_subject.edit', $data);
    }
    
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'class_id' => 'required|exists:App\Models\ClassModel,id',
            'subject_id' => 'required|exists:App\Models\SubjectModel,id',
            'status' => 'required|in:0,1'
        ]);
    
        // Cek apakah penugasan kelas dan mata pelajaran yang dipilih sudah ada
        $existingAssignment = ClassSubjectModel::where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->where('id', '!=', $id) // Hindari validasi dengan data yang sedang diupdate
            ->first();

        if ($existingAssignment) {
             return redirect()->back()->with('error', 'Penugasan kelas dan mata pelajaran yang dipilih sudah ada.');
        }
        $record = ClassSubjectModel::find($id);
        if (!$record) {
            return redirect()->route('assign_subject.list')->with('error', 'Data tidak ditemukan');
        }
        
    
        $record->class_id = $request->class_id;
        $record->subject_id = $request->subject_id;
        $record->status = $request->status;
        $record->save();
    
        return redirect()->route('assign_subject.list')->with('success', "Assign subject berhasil diperbarui");
    }
    
    public function delete($id)
    {
        $record = ClassSubjectModel::find($id);
        if ($record) {
            $record->delete();
            return redirect()->route('assign_subject.list')->with('success', "Assign subject berhasil dihapus");
        } else {
            return redirect()->route('assign_subject.list')->with('error', 'Data tidak ditemukan');
        }
    }

   
}
