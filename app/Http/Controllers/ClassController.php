<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function list()
    {
        $getRecord = ClassModel::all();

        $sortedRecords = $getRecord->sortBy(function($record) {
            preg_match('/([A-Za-z]+)(\d+)/', $record->name, $matches);
            $type = isset($matches[1]) ? $matches[1] : '';
            $grade = isset($matches[2]) ? (int)$matches[2] : 0;
            return [$grade, $type];
        });

        $data['getRecord'] = $sortedRecords;

        return view('admin.class.list', $data);
    }

    public function add()
    {
        return view('admin.class.add');
    }

    public function insert(Request $request)
    {
        // Validasi duplikasi nama kelas
        $existingClass = ClassModel::where('name', $request->name)->first();
        if ($existingClass) {
            return redirect('admin/class/add')->with('error', "Kelas sudah ada");
        }

        $save = new ClassModel;
        $save->name = $request->name;
        $save->status = $request->status;
        $save->save();

        return redirect('admin/class/list')->with('success', "Class berhasil ditambah");
    }

    public function showEditForm($id)
    {
        $record = ClassModel::find($id);
        if ($record) {
            return view('admin.class.edit', compact('record'));
        } else {
            return redirect('admin/class/list')->with('error', "Class tidak ditemukan");
        }
    }

    public function updateUser(Request $request, $id)
    {
        $record = ClassModel::find($id);
        if ($record) {
            $record->name = $request->name;
            $record->status = $request->status;
            $record->save();

            return redirect('admin/class/list')->with('success', "Class berhasil diupdate");
        } else {
            return redirect('admin/class/list')->with('error', "Class tidak ditemukan");
        }
    }

    public function delete($id)
    {
        $record = ClassModel::find($id);
        if ($record) {
            $record->delete();
            return redirect('admin/class/list')->with('success', "Class berhasil dihapus");
        } else {
            return redirect('admin/class/list')->with('error', "Class tidak ditemukan");
        }
    }
}
