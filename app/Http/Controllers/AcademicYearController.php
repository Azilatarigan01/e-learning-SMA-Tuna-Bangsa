<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicYearModel;

class AcademicYearController extends Controller
{
    public function list()
    {
        $data['getRecord'] = AcademicYearModel::getRecord();
        $data['header_title'] = "Tahun Ajaran & Semester";
        return view('admin.academic_year.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Tambah Tahun Ajaran";
        return view('admin.academic_year.add', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'semester' => 'required|in:Ganjil,Genap',
        ]);

        $save = new AcademicYearModel;
        $save->name = trim($request->name);
        $save->semester = trim($request->semester);
        $save->start_date = $request->start_date;
        $save->end_date = $request->end_date;

        if ($request->is_active == 1) {
            // Nonaktifkan semua tahun ajaran lain
            AcademicYearModel::where('id', '>', 0)->update(['is_active' => 0]);
            $save->is_active = 1;
        } else {
            $save->is_active = 0;
        }

        $save->save();

        return redirect('admin/academic_year/list')->with('success', 'Tahun ajaran & semester berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['getRecord'] = AcademicYearModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Tahun Ajaran";
            return view('admin.academic_year.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'semester' => 'required|in:Ganjil,Genap',
        ]);

        $save = AcademicYearModel::getSingle($id);
        $save->name = trim($request->name);
        $save->semester = trim($request->semester);
        $save->start_date = $request->start_date;
        $save->end_date = $request->end_date;

        if ($request->is_active == 1) {
            // Nonaktifkan semua tahun ajaran lain
            AcademicYearModel::where('id', '>', 0)->update(['is_active' => 0]);
            $save->is_active = 1;
        } else {
            $save->is_active = 0;
        }

        $save->save();

        return redirect('admin/academic_year/list')->with('success', 'Tahun ajaran & semester berhasil diperbarui.');
    }

    public function setActive($id)
    {
        AcademicYearModel::where('id', '>', 0)->update(['is_active' => 0]);
        $active = AcademicYearModel::getSingle($id);
        if (!empty($active)) {
            $active->is_active = 1;
            $active->save();
            return redirect('admin/academic_year/list')->with('success', 'Tahun ajaran ' . $active->name . ' (' . $active->semester . ') berhasil diaktifkan sebagai semester berjalan.');
        }
        return redirect('admin/academic_year/list')->with('error', 'Data tidak ditemukan.');
    }

    public function delete($id)
    {
        $record = AcademicYearModel::getSingle($id);
        if (!empty($record)) {
            if ($record->is_active == 1) {
                return redirect('admin/academic_year/list')->with('error', 'Tidak dapat menghapus tahun ajaran yang sedang aktif.');
            }
            $record->delete();
            return redirect('admin/academic_year/list')->with('success', 'Tahun ajaran berhasil dihapus.');
        }
        return redirect('admin/academic_year/list')->with('error', 'Data tidak ditemukan.');
    }
}
