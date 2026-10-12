<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\HomeworkModel;
use App\Models\AssignClassTeacherModel; 
use App\Models\HomeworkSubmitModel;
use Illuminate\Support\Facades\Auth;

class HomeworkController extends Controller
{
    public function homework(Request $request)
    {
        $data['getRecord'] = HomeworkModel::getRecord($request); 
        return view('admin.homework.list', $data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        return view('admin.homework.add', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'homework_date' => 'required|date',
            'submission_date' => 'required|date',
            'description' => 'required|string',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx,txt,zip,rar|max:25600'
        ]);

        $homework = new HomeworkModel;
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);

        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $filename = $file->getClientOriginalName();
            $destinationPath = public_path('upload/homework/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            if ($file->move($destinationPath, $filename)) {
                if ($homework->document_file && file_exists($destinationPath . $homework->document_file)) {
                    unlink($destinationPath . $homework->document_file);
                }
                $homework->document_file = $filename;
            }
        }

        $homework->save();

        return redirect()->route('admin.homework.list')->with('success', "Homework successfully created");
    }

    public function ajax_get_subject(Request $request)
    {
        $class_id = $request->class_id;
        $getSubjects = ClassSubjectModel::MySubject($class_id);
        $html = '<option value="">Select Subject</option>';
        foreach ($getSubjects as $value) {
            $html .= '<option value="' . $value->subject_id . '">' . $value->subject_name . '</option>';
        }

        return response()->json(['success' => $html]);
    }

    public function showEditForm($id)
    {
        $getRecord = HomeworkModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubjectModel::MySubject($getRecord->class_id);
        $data['getClass'] = ClassModel::getClass();
        return view('admin.homework.edit', $data);
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'homework_date' => 'required|date',
            'submission_date' => 'required|date',
            'description' => 'required|string',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx,txt'
        ]);

        $homework = HomeworkModel::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);

        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $filename = $file->getClientOriginalName();
            $destinationPath = public_path('upload/homework/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            if ($file->move($destinationPath, $filename)) {
                if ($homework->document_file && file_exists($destinationPath . $homework->document_file)) {
                    unlink($destinationPath . $homework->document_file);
                }
                $homework->document_file = $filename;
            }
        }

        $homework->save();

        return redirect()->route('admin.homework.list')->with('success', "Homework successfully updated");
    }

    public function delete($id)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->is_delete = 1;
        $homework->save();

        return redirect()->back()->with('success', "Homework successfully deleted");
    }

    public function Submitted($homework_id)
{
    $homework = HomeworkModel::getSingle($homework_id);
    if (!empty($homework)) {
        $data['homework_id'] = $homework_id;
        $data['getRecord'] = HomeworkSubmitModel::getRecord($homework_id); 
        return view('admin.homework.submitted', $data);
    } else {
        abort(404);
    }
}

    //teacher side
    public static function TeacherHomework(Request $request)
    {
        $class_ids = array();
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);($request);
        foreach($getClass as $class)
        {
            $class_ids[] = $class->class_id;
        }
        $data['getRecord'] = HomeworkModel::getRecordTeacher($class_ids);
        return view('teacher.homework.list', $data);
    }

    public static function addHomeworkTeacher()
    {
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id); // Corrected the class name
        return view('teacher.homework.add', $data);
    }

    public static function insertHomeworkTeacher(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'homework_date' => 'required|date',
            'submission_date' => 'required|date',
            'description' => 'required|string',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx,txt,zip,rar|max:25600'
        ]);

        $homework = new HomeworkModel;
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);

        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $filename = $file->getClientOriginalName();
            $destinationPath = public_path('upload/homework/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            if ($file->move($destinationPath, $filename)) {
                if ($homework->document_file && file_exists($destinationPath . $homework->document_file)) {
                    unlink($destinationPath . $homework->document_file);
                }
                $homework->document_file = $filename;
            }
        }

        $homework->save();

        return redirect()->route('teacher.homework.list')->with('success', "Homework successfully created");
    }

    public static function showEditFormTeacher($id)
{
    $getRecord = HomeworkModel::getSingle($id);
    $data['getRecord'] = $getRecord;
    $data['getSubject'] = ClassSubjectModel::MySubject($getRecord->class_id);
    $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id); // Corrected the class name
    return view('teacher.homework.edit', $data);
}


    public function updateTeacher(Request $request, $id)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'homework_date' => 'required|date',
            'submission_date' => 'required|date',
            'description' => 'required|string',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx,txt'
        ]);

        $homework = HomeworkModel::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);

        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $filename = $file->getClientOriginalName();
            $destinationPath = public_path('upload/homework/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            if ($file->move($destinationPath, $filename)) {
                if ($homework->document_file && file_exists($destinationPath . $homework->document_file)) {
                    unlink($destinationPath . $homework->document_file);
                }
                $homework->document_file = $filename;
            }
        }

        $homework->save();

        return redirect()->route('teacher.homework.list')->with('success', "Homework successfully updated");
    }
    public function SubmittedTeacher($homework_id)
    {
    $homework = HomeworkModel::getSingle($homework_id);
    if (!empty($homework)) {
        $data['homework_id'] = $homework_id;
        $data['getRecord'] = HomeworkSubmitModel::getRecord($homework_id); 
        return view('teacher.homework.submitted', $data);
    } else {
        abort(404);
    }
    }


    

//Students Side
public static function StudentHomework()
{
    $class_id = Auth::user()->class_id;
    $student_id = Auth::user()->id;
    $data['getRecord'] = HomeworkModel::getRecordStudent($class_id, $student_id);
    return view('student.homework.list', $data);
}

public static function SubmitHomework($homework_id)
{
    $data['getRecord'] = HomeworkModel::getSingle($homework_id);
    return view('student.homework.submit', $data);
}

public static function SubmitHomeworkInsert(Request $request, $homework_id)
{
    $request->validate([
        'document_file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,jpg,jpeg,png|max:25600',
        'description' => 'nullable|string'
    ]);

    $homework = new HomeworkSubmitModel;
    $homework->homework_id = $homework_id;
    $homework->student_id = Auth::user()->id;
    $homework->description = trim($request->description);

    if ($request->hasFile('document_file')) {
        $file = $request->file('document_file');
        $filename = $file->getClientOriginalName();
        $destinationPath = public_path('upload/homework/');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0775, true);
        }

        if ($file->move($destinationPath, $filename)) {
            if ($homework->document_file && file_exists($destinationPath . $homework->document_file)) {
                unlink($destinationPath . $homework->document_file);
            }
            $homework->document_file = $filename;
        }
    }

    $homework->save();

    return redirect()->route('student.homework.list')->with('success', "Homework successfully submitted");
}

public function StudentHomeworkSubmitted(Request $request)
{
    $class_id = Auth::user()->class_id;
    $student_id = Auth::user()->id;
    $data['getRecord'] = HomeworkSubmitModel::getRecordStudent($student_id, $class_id);
    return view('student.homework.submitted_list', $data);
}
}


