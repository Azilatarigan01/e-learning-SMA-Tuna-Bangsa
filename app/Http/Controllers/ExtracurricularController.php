<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExtracurricularModel;
use App\Models\ExtracurricularMemberModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ExtracurricularController extends Controller
{
    // ==========================================
    // ADMIN ACTIONS
    // ==========================================
    public function list()
    {
        $data['getRecord'] = ExtracurricularModel::getRecord();
        $data['header_title'] = "Manajemen Ekstrakurikuler";
        return view('admin.extracurricular.list', $data);
    }

    public function add()
    {
        $data['getTeachers'] = User::where('user_type', 2)->where('is_delete', 0)->orderBy('name', 'asc')->get();
        $data['header_title'] = "Tambah Ekstrakurikuler Baru";
        return view('admin.extracurricular.add', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:50',
            'quota' => 'required|numeric|min:1',
        ]);

        $save = new ExtracurricularModel;
        $save->name = trim($request->name);
        $save->category = trim($request->category);
        $save->teacher_id = !empty($request->teacher_id) ? $request->teacher_id : null;
        $save->day_of_week = trim($request->day_of_week);
        $save->start_time = trim($request->start_time);
        $save->end_time = trim($request->end_time);
        $save->location = trim($request->location);
        $save->quota = (int) $request->quota;
        $save->status = trim($request->status ?? 0);
        $save->description = trim($request->description);
        $save->icon = trim($request->icon ?? 'fa-star');
        $save->save();

        return redirect('admin/extracurricular/list')->with('success', 'Ekstrakurikuler ' . $save->name . ' berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['getRecord'] = ExtracurricularModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['getTeachers'] = User::where('user_type', 2)->where('is_delete', 0)->orderBy('name', 'asc')->get();
            $data['header_title'] = "Edit Ekstrakurikuler";
            return view('admin.extracurricular.edit', $data);
        }
        abort(404);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:50',
            'quota' => 'required|numeric|min:1',
        ]);

        $save = ExtracurricularModel::getSingle($id);
        if (empty($save)) {
            return redirect('admin/extracurricular/list')->with('error', 'Data tidak ditemukan.');
        }

        $save->name = trim($request->name);
        $save->category = trim($request->category);
        $save->teacher_id = !empty($request->teacher_id) ? $request->teacher_id : null;
        $save->day_of_week = trim($request->day_of_week);
        $save->start_time = trim($request->start_time);
        $save->end_time = trim($request->end_time);
        $save->location = trim($request->location);
        $save->quota = (int) $request->quota;
        $save->status = trim($request->status);
        $save->description = trim($request->description);
        if (!empty($request->icon)) {
            $save->icon = trim($request->icon);
        }
        $save->save();

        return redirect('admin/extracurricular/list')->with('success', 'Data ekstrakurikuler berhasil diperbarui.');
    }

    public function delete($id)
    {
        $record = ExtracurricularModel::getSingle($id);
        if (!empty($record)) {
            ExtracurricularMemberModel::where('extracurricular_id', $id)->delete();
            $record->delete();
            return redirect('admin/extracurricular/list')->with('success', 'Ekstrakurikuler dan seluruh data anggotanya berhasil dihapus.');
        }
        return redirect('admin/extracurricular/list')->with('error', 'Data tidak ditemukan.');
    }

    public function members($id)
    {
        $data['getEkskul'] = ExtracurricularModel::getSingle($id);
        if (empty($data['getEkskul'])) {
            abort(404);
        }

        $data['getMembers'] = ExtracurricularMemberModel::getMembersByEkskul($id);
        $existingStudentIds = $data['getMembers']->pluck('student_id')->toArray();
        $data['availableStudents'] = User::where('user_type', 3)
            ->where('is_delete', 0)
            ->whereNotIn('id', $existingStudentIds)
            ->orderBy('name', 'asc')
            ->get();

        $data['header_title'] = "Kelola Anggota — " . $data['getEkskul']->name;
        return view('admin.extracurricular.members', $data);
    }

    public function addMember($id, Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'role' => 'required|string',
        ]);

        $ekskul = ExtracurricularModel::getSingle($id);
        if (empty($ekskul)) {
            return redirect()->back()->with('error', 'Ekstrakurikuler tidak ditemukan.');
        }

        // Cek kuota
        $currentCount = ExtracurricularMemberModel::where('extracurricular_id', $id)->count();
        if ($currentCount >= $ekskul->quota) {
            return redirect()->back()->with('error', 'Pendaftaran gagal: Kuota maksimal ekskul ini telah penuh (' . $ekskul->quota . ' siswa).');
        }

        // Cek duplikasi
        $exists = ExtracurricularMemberModel::where('extracurricular_id', $id)
            ->where('student_id', $request->student_id)
            ->first();

        if ($exists) {
            return redirect()->back()->with('error', 'Siswa tersebut sudah terdaftar di ekskul ini.');
        }

        $member = new ExtracurricularMemberModel;
        $member->extracurricular_id = $id;
        $member->student_id = $request->student_id;
        $member->role = trim($request->role);
        $member->status = 0;
        $member->notes = 'Ditambahkan langsung oleh Admin';
        $member->save();

        return redirect()->back()->with('success', 'Siswa berhasil didaftarkan ke ' . $ekskul->name);
    }

    public function deleteMember($id, $member_id)
    {
        $member = ExtracurricularMemberModel::where('extracurricular_id', $id)->where('id', $member_id)->first();
        if (!empty($member)) {
            $member->delete();
            return redirect()->back()->with('success', 'Anggota berhasil dikeluarkan dari ekskul.');
        }
        return redirect()->back()->with('error', 'Data anggota tidak ditemukan.');
    }

    // ==========================================
    // STUDENT ACTIONS
    // ==========================================
    public function studentList()
    {
        $studentId = Auth::user()->id;
        $data['myMemberships'] = ExtracurricularMemberModel::getEkskulByStudent($studentId);
        $joinedEkskulIds = $data['myMemberships']->pluck('extracurricular_id')->toArray();

        $data['availableEkskuls'] = ExtracurricularModel::where('status', 0)
            ->with(['teacher', 'members'])
            ->whereNotIn('id', $joinedEkskulIds)
            ->get();

        $data['header_title'] = "Ekstrakurikuler Saya";
        return view('student.my_extracurricular', $data);
    }

    public function studentJoin($id)
    {
        $studentId = Auth::user()->id;
        $ekskul = ExtracurricularModel::getSingle($id);

        if (empty($ekskul) || $ekskul->status != 0) {
            return redirect()->back()->with('error', 'Ekstrakurikuler tidak aktif atau tidak ditemukan.');
        }

        // Cek duplikasi
        $exists = ExtracurricularMemberModel::where('extracurricular_id', $id)
            ->where('student_id', $studentId)
            ->first();

        if ($exists) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar di ekstrakurikuler ini.');
        }

        // Cek kuota
        $currentCount = ExtracurricularMemberModel::where('extracurricular_id', $id)->count();
        if ($currentCount >= $ekskul->quota) {
            return redirect()->back()->with('error', 'Mohon maaf, kuota pendaftaran ekskul ' . $ekskul->name . ' sudah penuh.');
        }

        $member = new ExtracurricularMemberModel;
        $member->extracurricular_id = $id;
        $member->student_id = $studentId;
        $member->role = 'Anggota';
        $member->status = 0;
        $member->notes = 'Mendaftar mandiri via LMS';
        $member->save();

        return redirect()->back()->with('success', 'Selamat! Anda berhasil mendaftar ke ekstrakurikuler ' . $ekskul->name . '.');
    }

    public function studentLeave($id)
    {
        $studentId = Auth::user()->id;
        $member = ExtracurricularMemberModel::where('extracurricular_id', $id)
            ->where('student_id', $studentId)
            ->first();

        if (!empty($member)) {
            $member->delete();
            return redirect()->back()->with('success', 'Anda telah berhenti dari ekstrakurikuler tersebut.');
        }
        return redirect()->back()->with('error', 'Data keanggotaan tidak ditemukan.');
    }

    // ==========================================
    // TEACHER ACTIONS
    // ==========================================
    public function teacherList()
    {
        $teacherId = Auth::user()->id;
        $data['myEkskuls'] = ExtracurricularModel::where('teacher_id', $teacherId)
            ->with(['members.student'])
            ->get();

        $data['header_title'] = "Ekstrakurikuler yang Saya Bina";
        return view('teacher.my_extracurricular', $data);
    }
}
