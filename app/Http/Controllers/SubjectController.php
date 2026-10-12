<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;

class SubjectController extends Controller
{
    public function list()
    {
        $data['getRecord'] = SubjectModel::getRecord();
        return view('admin.subject.list', $data);
    }

    public function add()
    {
        return view('admin.subject.add');
    }

    public function insert(Request $request)
    {
        // Validasi duplikasi nama mata pelajaran
        $existingSubject = SubjectModel::where('name', $request->name)->first();
        if ($existingSubject) {
            return redirect()->back()->with('error', "Mata pelajaran sudah ada");
        }
    
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'status' => 'required|integer'
        ]);
    
        // Simpan data mata pelajaran baru
        $save = new SubjectModel;
        $save->name = $request->name;
        $save->type = $request->type;
        $save->status = $request->status;
        $save->created_by = Auth::user()->id;
        $save->is_delete = 0;
        $save->save();
    
        return redirect('admin/subject/list')->with('success', "Mata Pelajaran berhasil ditambah");
    }
    

    public function showEditForm($id)
    {
        $record = SubjectModel::find($id);
        if ($record) {
            return view('admin.subject.edit', compact('record'));
        } else {
            return redirect('admin/subject/list')->with('error', "Mata Pelajaran tidak ditemukan");
        }
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'status' => 'required|integer'
        ]);

        $record = SubjectModel::find($id);
        if ($record) {
            $record->name = $request->name;
            $record->type = $request->type;
            $record->status = $request->status;
            $record->save();

            return redirect('admin/subject/list')->with('success', "Mata Pelajaran berhasil diupdate");
        } else {
            return redirect('admin/subject/list')->with('error', "Mata Pelajaran tidak ditemukan");
        }
    }

    public function delete($id)
    {
        $record = SubjectModel::find($id);
        if ($record) {
            $record->softDelete();
            return redirect('admin/subject/list')->with('success', "Mata Pelajaran berhasil dihapus");
        } else {
            return redirect('admin/subject/list')->with('error', "Mata Pelajaran tidak ditemukan");
        }
    }

//student part
public function MySubject()
{
    $class_id = Auth::user()->class_id;
    $data['getRecords'] = ClassSubjectModel::MySubject($class_id);
    return view('student.my_subject', $data);
}

}




