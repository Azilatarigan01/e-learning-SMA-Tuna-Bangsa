<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearningMaterialModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use Illuminate\Support\Facades\Auth;

class LearningMaterialController extends Controller
{
    // ==========================================
    // ADMIN ACTIONS
    // ==========================================
    public function adminList(Request $request)
    {
        $class_id = $request->get('class_id');
        $subject_id = $request->get('subject_id');

        $data['getRecord'] = LearningMaterialModel::getRecordAdmin($class_id, $subject_id);
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getRecord();
        $data['header_title'] = "Bank Materi Pembelajaran Sekolah";
        return view('admin.materials.list', $data);
    }

    public function adminDelete($id)
    {
        $record = LearningMaterialModel::getSingle($id);
        if (!empty($record)) {
            $record->is_delete = 1;
            $record->save();
            return redirect('admin/materials/list')->with('success', 'Materi pembelajaran berhasil dihapus.');
        }
        return redirect('admin/materials/list')->with('error', 'Data tidak ditemukan.');
    }

    // ==========================================
    // TEACHER ACTIONS
    // ==========================================
    public function teacherList(Request $request)
    {
        $teacherId = Auth::user()->id;
        $class_id = $request->get('class_id');
        $subject_id = $request->get('subject_id');

        $data['getRecord'] = LearningMaterialModel::getRecordTeacher($teacherId, $class_id, $subject_id);
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getRecord();
        $data['header_title'] = "Bahan Ajar & Materi Saya";
        return view('teacher.materials.list', $data);
    }

    public function teacherAdd()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Tambah Materi Pembelajaran Baru";
        return view('teacher.materials.add', $data);
    }

    public function teacherInsert(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'title' => 'required|string|max:200',
            'meeting_number' => 'required|string|max:50',
            'description' => 'nullable|string',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,rar|max:25600',
            'video_url' => 'nullable|url',
        ]);

        $material = new LearningMaterialModel;
        $material->class_id = $request->class_id;
        $material->subject_id = $request->subject_id;
        $material->created_by = Auth::user()->id;
        $material->title = trim($request->title);
        $material->meeting_number = trim($request->meeting_number);
        $material->description = trim($request->description);
        $material->video_url = trim($request->video_url);
        $material->is_published = (int) ($request->is_published ?? 1);

        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $destinationPath = public_path('upload/materials/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            $file->move($destinationPath, $filename);
            $material->document_file = $filename;
        }

        $material->save();

        return redirect('teacher/materials/list')->with('success', 'Materi pembelajaran berhasil diunggah.');
    }

    public function teacherEdit($id)
    {
        $material = LearningMaterialModel::getSingle($id);
        if (empty($material) || $material->created_by != Auth::user()->id) {
            abort(404);
        }

        $data['getRecord'] = $material;
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = ClassSubjectModel::MySubject($material->class_id);
        $data['header_title'] = "Edit Materi Pembelajaran";
        return view('teacher.materials.edit', $data);
    }

    public function teacherUpdate($id, Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'title' => 'required|string|max:200',
            'meeting_number' => 'required|string|max:50',
            'description' => 'nullable|string',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,rar|max:25600',
            'video_url' => 'nullable|url',
        ]);

        $material = LearningMaterialModel::getSingle($id);
        if (empty($material) || $material->created_by != Auth::user()->id) {
            return redirect('teacher/materials/list')->with('error', 'Materi tidak ditemukan atau Anda tidak memiliki akses.');
        }

        $material->class_id = $request->class_id;
        $material->subject_id = $request->subject_id;
        $material->title = trim($request->title);
        $material->meeting_number = trim($request->meeting_number);
        $material->description = trim($request->description);
        $material->video_url = trim($request->video_url);
        $material->is_published = (int) $request->is_published;

        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $destinationPath = public_path('upload/materials/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            if (!empty($material->document_file) && file_exists($destinationPath . $material->document_file)) {
                unlink($destinationPath . $material->document_file);
            }

            $file->move($destinationPath, $filename);
            $material->document_file = $filename;
        }

        $material->save();

        return redirect('teacher/materials/list')->with('success', 'Materi pembelajaran berhasil diperbarui.');
    }

    public function teacherDelete($id)
    {
        $material = LearningMaterialModel::getSingle($id);
        if (!empty($material) && $material->created_by == Auth::user()->id) {
            $material->is_delete = 1;
            $material->save();
            return redirect('teacher/materials/list')->with('success', 'Materi berhasil dihapus.');
        }
        return redirect('teacher/materials/list')->with('error', 'Data tidak ditemukan.');
    }

    public function ajax_get_subject(Request $request)
    {
        $class_id = $request->class_id;
        $getSubjects = ClassSubjectModel::MySubject($class_id);
        $html = '<option value="">-- Pilih Mata Pelajaran --</option>';
        foreach ($getSubjects as $value) {
            $html .= '<option value="' . $value->subject_id . '">' . $value->subject_name . '</option>';
        }
        return response()->json(['success' => $html]);
    }

    // ==========================================
    // STUDENT ACTIONS
    // ==========================================
    public function studentList(Request $request)
    {
        $studentClassId = Auth::user()->class_id;
        $subject_id = $request->get('subject_id');

        $data['getRecord'] = LearningMaterialModel::getRecordStudent($studentClassId, $subject_id);
        $data['getSubject'] = ClassSubjectModel::MySubject($studentClassId);
        $data['header_title'] = "Materi Pembelajaran Saya";
        return view('student.materials.list', $data);
    }

    public function studentDetail($id)
    {
        $material = LearningMaterialModel::getSingle($id);
        if (empty($material) || $material->class_id != Auth::user()->class_id || $material->is_published != 1) {
            abort(404);
        }

        $data['getRecord'] = $material;
        $data['header_title'] = $material->title . " — " . $material->meeting_number;
        return view('student.materials.detail', $data);
    }
}
