<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacherModel;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use Illuminate\Http\Request;
use App\Models\ExamModels;
use App\Models\ExamScheduleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class ExaminationsController extends Controller
{
    public function exam_list(Request $request)
    {
        $data['getRecords'] = ExamModels::getRecord($request);
        return view('admin.examinations.exam.list', $data);
    }

    public function exam_add(Request $request)
    {
        $data['getRecords'] = ExamModels::getRecord($request);
        return view('admin.examinations.exam.add', $data);
    }

    public function exam_insert(Request $request)
    {
        $exam = new ExamModels;
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->created_by = Auth::user()->id;
        $exam->save();

        return redirect('admin/examinations/exam/list')->with('success', "Exam Successfully created");
    }

    public function showEditForm($id)
    {
        $record = ExamModels::find($id);
        if ($record) {
            return view('admin.examinations.exam.edit', compact('record'));
        } else {
            return redirect('admin/examinations/exam/list')->with('error', "Exam tidak ditemukan");
        }
    }

    public function updateExam($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'required|string',
        ]);

        $exam = ExamModels::find($id);
        if (!$exam) {
            return redirect('admin/examinations/exam/list')->with('error', "Exam not found");
        }

        $exam->name = $request->input('name');
        $exam->note = $request->input('note');
        $exam->save();

        return redirect('admin/examinations/exam/list')->with('success', "Exam updated successfully");
    }

    public function delete($id)
    {
        $record = ExamModels::find($id);
        if ($record) {
            $record->delete();
            return redirect('admin/examinations/exam/list')->with('success', "Exam berhasil dihapus");
        } else {
            return redirect('admin/examinations/exam/list')->with('error', "Exam tidak ditemukan");
        }
    }

    public function exam_schedule(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = ExamModels::getExam();

        $result = [];
        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $getSubject = ClassSubjectModel::MySubject($request->get('class_id'));
            foreach ($getSubject as $value) {
                $dataS = [];
                $dataS['subject_id'] = $value->subject_id;
                $dataS['class_id'] = $value->class_id;
                $dataS['subject_name'] = $value->subject_name;
                $dataS['subject_type'] = $value->subject_type;

                $ExamSchedule = ExamScheduleModel::getRecordSingle($request->get('exam_id'), $request->get('class_id'), $value->subject_id);
                if ($ExamSchedule) {
                    $dataS['exam_date'] = $ExamSchedule->exam_date;
                    $dataS['start_time'] = $ExamSchedule->start_time;
                    $dataS['end_time'] = $ExamSchedule->end_time;
                    $dataS['room_number'] = $ExamSchedule->room_number;
                } else {
                    $dataS['exam_date'] = '';
                    $dataS['start_time'] = '';
                    $dataS['end_time'] = '';
                    $dataS['room_number'] = '';
                }
                $result[] = $dataS;
            }
        }

        $data['getRecord'] = $result;
        return view('admin.examinations.exam_schedule', $data);
    }

    public function exam_schedule_insert(Request $request)
    {
        ExamScheduleModel::deleteRecord($request->exam_id, $request->class_id);
        if (!empty($request->schedule)) {
            foreach ($request->schedule as $schedule) {
                if (!empty($schedule['subject_id']) && !empty($schedule['exam_date']) && !empty($schedule['start_time']) && !empty($schedule['end_time']) && !empty($schedule['room_number'])) {
                    ExamScheduleModel::updateOrCreate(
                        [
                            'exam_id' => $request->exam_id,
                            'class_id' => $request->class_id,
                            'subject_id' => $schedule['subject_id']
                        ],
                        [
                            'exam_date' => $schedule['exam_date'],
                            'start_time' => $schedule['start_time'],
                            'end_time' => $schedule['end_time'],
                            'room_number' => $schedule['room_number']
                        ]
                    );
                } else {
                    Log::error('Incomplete schedule data', $schedule);
                }
            }
            return redirect()->back()->with('success', 'Exam Schedule Successfully saved');
        } else {
            return redirect()->back()->with('error', 'No schedules provided');
        }
    }

    // Student 
    public function MyExamTimetable(Request $request)
    {
        $class_id = Auth::user()->class_id;
        $getExam = ExamScheduleModel::getExam($class_id);
        Log::info('getExam:', $getExam->toArray()); // Logging the fetched exams
    
        $result = array();
        foreach ($getExam as $value)
        {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTimetable = ExamScheduleModel::getExamTimetable($value->exam_id, $class_id);
            Log::info('getExamTimetable:', $getExamTimetable->toArray()); // Logging the exam timetable
    
            $resultS = array();
            foreach ($getExamTimetable as $valueS)
            {
                $dataS = array();
                $dataS['subject_name'] = $valueS->subject_name;
                $dataS['exam_date'] = $valueS->exam_date;
                $dataS['start_time'] = $valueS->start_time;
                $dataS['end_time'] = $valueS->end_time;
                $dataS['room_number'] = $valueS->room_number;
                $resultS[] = $dataS;
            }
            $dataE['exam'] = $resultS;
            $result[] = $dataE;
        }
        return view('student.my_exam_timetable', ['getRecord' => $result]);
    }
    
    // Teacher
public function MyExamTimetableTeacher()
{
    $result = array();
    $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);

    foreach ($getClass as $class) {
        $dataC = array();
        $dataC['class_name'] = $class->class_name;

        $getExam = ExamScheduleModel::getExam($class->class_id);
        $examArray = array();

        foreach ($getExam as $exam) {
            $dataE = array();
            $dataE['exam_name'] = $exam->exam_name;

            $getExamTimetable = ExamScheduleModel::getExamTimetable($exam->exam_id, $class->class_id);
            $subjectArray = array(); 

            foreach ($getExamTimetable as $valueS) {
                $dataS = array();
                $dataS['subject_name'] = $valueS->subject_name;
                $dataS['exam_date'] = $valueS->exam_date;
                $dataS['start_time'] = $valueS->start_time;
                $dataS['end_time'] = $valueS->end_time;
                $dataS['room_number'] = $valueS->room_number;
                $subjectArray[] = $dataS;
            }

            $dataE['subject'] = $subjectArray;
            $examArray[] = $dataE;
        }

        $dataC['exam'] = $examArray;
        $result[] = $dataC;
    }

    $data['getRecord'] = $result;
    return view('teacher.my_exam_timetable', $data); 
}


    
}
