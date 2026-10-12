<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignClassTeacherController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssignmentsController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\ExaminationsController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\LearningMaterialController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\GradebookController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\CbtController;
use App\Http\Controllers\NotificationAndAuditController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'AuthLogin']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgotpassword');
Route::post('/forgot-password', [AuthController::class, 'PostForgotPassword'])->name('PostForgotPassword');

// Admin Routes
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    
    Route::prefix('admin')->group(function () {
        Route::get('/list', [AdminController::class, 'list']);
        Route::get('/add', [AdminController::class, 'add']);
        Route::post('/add', [AdminController::class, 'insert']);
        Route::get('/edit/{id}', [AdminController::class, 'showEditForm'])->name('admin.edit');
        Route::post('/update/{id}', [AdminController::class, 'updateUser'])->name('admin.update');
        Route::delete('/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
    });

    // Student Routes
    Route::prefix('student')->group(function () {
        Route::get('/list', [StudentController::class, 'list'])->name('admin.student.list');
        Route::get('/add', [StudentController::class, 'add'])->name('admin.student.add');
        Route::post('/add', [StudentController::class, 'insert'])->name('student.insert');
        Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('student.edit'); 
        Route::put('/update/{id}', [StudentController::class, 'update'])->name('student.update');
        Route::delete('/delete/{id}', [StudentController::class, 'delete'])->name('student.delete');
    });

    // Teacher Routes
    Route::prefix('teacher')->group(function () {
        Route::get('/list', [TeacherController::class, 'list'])->name('admin.teacher.list');
        Route::get('/add', [TeacherController::class, 'add'])->name('admin.teacher.add');
        Route::post('/add', [TeacherController::class, 'insert'])->name('teacher.insert');
        Route::get('/edit/{id}', [TeacherController::class, 'edit'])->name('teacher.edit');
        Route::put('/update/{id}', [TeacherController::class, 'update'])->name('teacher.update');
        Route::delete('/delete/{id}', [TeacherController::class, 'delete'])->name('teacher.delete');
    });

    // Class Routes
    Route::prefix('class')->group(function () {
        Route::get('/list', [ClassController::class, 'list']);
        Route::get('/add', [ClassController::class, 'add']);
        Route::post('/add', [ClassController::class, 'insert']);
        Route::get('/edit/{id}', [ClassController::class, 'showEditForm'])->name('class.edit');
        Route::post('/update/{id}', [ClassController::class, 'updateUser'])->name('class.update');
        Route::delete('/delete/{id}', [ClassController::class, 'delete'])->name('class.delete');
    });

    // Subject Routes
    Route::prefix('subject')->group(function () {
        Route::get('/list', [SubjectController::class, 'list']);
        Route::get('/add', [SubjectController::class, 'add']);
        Route::post('/add', [SubjectController::class, 'insert']);
        Route::get('/edit/{id}', [SubjectController::class, 'showEditForm'])->name('subject.edit');
        Route::post('/update/{id}', [SubjectController::class, 'updateUser'])->name('subject.update');
        Route::delete('/delete/{id}', [SubjectController::class, 'delete'])->name('subject.delete');
    });

    // Class Subject Routes
    Route::prefix('assign_subject')->group(function () {
        Route::get('/list', [ClassSubjectController::class, 'list'])->name('assign_subject.list');
        Route::get('/add', [ClassSubjectController::class, 'add'])->name('assign_subject.add');
        Route::post('/insert', [ClassSubjectController::class, 'insert'])->name('assign_subject.insert');
        Route::get('/edit/{id}', [ClassSubjectController::class, 'showEditForm'])->name('assign_subject.edit');
        Route::put('/update/{id}', [ClassSubjectController::class, 'updateUser'])->name('assign_subject.update');
        Route::delete('/delete/{id}', [ClassSubjectController::class, 'delete'])->name('assign_subject.delete');
    });
// Group for Assign Class Teacher routes
Route::prefix('assign_class_teacher')->group(function () {
    Route::get('/list', [AssignClassTeacherController::class, 'list'])->name('assign_class_teacher.list');
    Route::get('/add', [AssignClassTeacherController::class, 'add'])->name('assign_class_teacher.add');
    Route::post('/insert', [AssignClassTeacherController::class, 'insert'])->name('assign_class_teacher.insert');
    Route::get('/edit/{id}', [AssignClassTeacherController::class, 'showEditForm'])->name('assign_class_teacher.edit');
    Route::put('/update/{id}', [AssignClassTeacherController::class, 'updateUser'])->name('assign_class_teacher.update');
    Route::delete('/delete/{id}', [AssignClassTeacherController::class, 'delete'])->name('assign_class_teacher.delete');
});

// Academic Year & Semester Routes
Route::prefix('academic_year')->group(function () {
    Route::get('/list', [AcademicYearController::class, 'list'])->name('admin.academic_year.list');
    Route::get('/add', [AcademicYearController::class, 'add'])->name('admin.academic_year.add');
    Route::post('/add', [AcademicYearController::class, 'insert'])->name('admin.academic_year.insert');
    Route::get('/edit/{id}', [AcademicYearController::class, 'edit'])->name('admin.academic_year.edit');
    Route::post('/update/{id}', [AcademicYearController::class, 'update'])->name('admin.academic_year.update');
    Route::get('/set_active/{id}', [AcademicYearController::class, 'setActive'])->name('admin.academic_year.set_active');
    Route::delete('/delete/{id}', [AcademicYearController::class, 'delete'])->name('admin.academic_year.delete');
});

// School Room Master Routes
Route::prefix('room')->group(function () {
    Route::get('/list', [RoomController::class, 'list'])->name('admin.room.list');
    Route::get('/add', [RoomController::class, 'add'])->name('admin.room.add');
    Route::post('/add', [RoomController::class, 'insert'])->name('admin.room.insert');
    Route::get('/edit/{id}', [RoomController::class, 'edit'])->name('admin.room.edit');
    Route::post('/update/{id}', [RoomController::class, 'update'])->name('admin.room.update');
    Route::delete('/delete/{id}', [RoomController::class, 'delete'])->name('admin.room.delete');
});

// Extracurricular Routes
Route::prefix('extracurricular')->group(function () {
    Route::get('/list', [ExtracurricularController::class, 'list'])->name('admin.extracurricular.list');
    Route::get('/add', [ExtracurricularController::class, 'add'])->name('admin.extracurricular.add');
    Route::post('/add', [ExtracurricularController::class, 'insert'])->name('admin.extracurricular.insert');
    Route::get('/edit/{id}', [ExtracurricularController::class, 'edit'])->name('admin.extracurricular.edit');
    Route::post('/update/{id}', [ExtracurricularController::class, 'update'])->name('admin.extracurricular.update');
    Route::delete('/delete/{id}', [ExtracurricularController::class, 'delete'])->name('admin.extracurricular.delete');
    Route::get('/members/{id}', [ExtracurricularController::class, 'members'])->name('admin.extracurricular.members');
    Route::post('/members/{id}/add', [ExtracurricularController::class, 'addMember'])->name('admin.extracurricular.add_member');
    Route::delete('/members/{id}/delete/{member_id}', [ExtracurricularController::class, 'deleteMember'])->name('admin.extracurricular.delete_member');
});

// Learning Materials Admin Routes
Route::prefix('materials')->group(function () {
    Route::get('/list', [LearningMaterialController::class, 'adminList'])->name('admin.materials.list');
    Route::delete('/delete/{id}', [LearningMaterialController::class, 'adminDelete'])->name('admin.materials.delete');
});

// Admin Attendance Report
Route::get('/attendance/report', [AttendanceController::class, 'adminReport'])->name('admin.attendance.report');

// Admin Gradebook & Leger Report
Route::get('/gradebook/report', [GradebookController::class, 'adminLeger'])->name('admin.gradebook.report');

// Admin Timetable & Anti-Conflict Schedule Routes
Route::prefix('timetable')->group(function () {
    Route::get('/list', [TimetableController::class, 'adminList'])->name('admin.timetable.list');
    Route::get('/add', [TimetableController::class, 'adminAdd'])->name('admin.timetable.add');
    Route::post('/add', [TimetableController::class, 'adminInsert'])->name('admin.timetable.insert');
    Route::delete('/delete/{id}', [TimetableController::class, 'adminDelete'])->name('admin.timetable.delete');
});
Route::get('/admin/timetable/list', [TimetableController::class, 'adminList']);
Route::get('/admin/timetable/add', [TimetableController::class, 'adminAdd']);

// Admin Notice Board & Announcements Routes
Route::prefix('notice_board')->group(function () {
    Route::get('/list', [NoticeBoardController::class, 'adminList'])->name('admin.notice_board.list');
    Route::get('/add', [NoticeBoardController::class, 'adminAdd'])->name('admin.notice_board.add');
    Route::post('/add', [NoticeBoardController::class, 'adminInsert'])->name('admin.notice_board.insert');
    Route::delete('/delete/{id}', [NoticeBoardController::class, 'adminDelete'])->name('admin.notice_board.delete');
});

// Admin Homeroom & Pastoral Care Report
Route::get('/homeroom/report', [NoticeBoardController::class, 'adminHomeroomReport'])->name('admin.homeroom.report');

// Homework Routes for admin
Route::prefix('admin/homework')->group(function () {
    Route::get('/list', [HomeworkController::class, 'homework'])->name('admin.homework.list');
    Route::get('/add', [HomeworkController::class, 'add'])->name('admin.homework.add');
    Route::post('/ajax_get_subject', [HomeworkController::class, 'ajax_get_subject'])->name('admin.ajax_get_subject');
    Route::post('/add', [HomeworkController::class, 'insert'])->name('admin.homework.insert');
    Route::get('/edit/{id}', [HomeworkController::class, 'showEditForm'])->name('admin.homework.edit');
    Route::put('/update/{id}', [HomeworkController::class, 'updateUser'])->name('admin.homework.update');
    Route::get('/delete/{id}', [HomeworkController::class, 'delete'])->name('admin.homework.delete');
    Route::get('/submitted/{id}', [HomeworkController::class, 'Submitted'])->name('admin.homework.submitted');
});
Route::get('/homework/list', [HomeworkController::class, 'homework']);


  // Group for Examinations routes
  Route::get('/examinations/exam/list', [ExaminationsController::class, 'exam_list'])->name('exam_list');
  Route::get('/examinations/exam/add', [ExaminationsController::class, 'exam_add'])->name('exam_add');
  Route::post('/examinations/exam/add', [ExaminationsController::class, 'exam_insert'])->name('exam_insert');
  Route::get('/examinations/exam/edit/{id}', [ExaminationsController::class, 'showEditForm'])->name('exam_edit');
  Route::put('/examinations/exam/update/{id}', [ExaminationsController::class, 'updateExam'])->name('exam_update');
  Route::delete('/examinations/exam/delete/{id}', [ExaminationsController::class, 'delete'])->name('exam_delete');

   // Group for Exam Schedule
  Route::get('/examinations/exam_schedule', [ExaminationsController::class, 'exam_schedule'])->name('exam_schedule');
  Route::get('/examinations/exam_schedule/add', [ExaminationsController::class, 'examschedule_add'])->name('exams_chedule_add');
  Route::post('/examinations/exam_schedule_insert', [ExaminationsController::class, 'exam_schedule_insert'])->name('exam_schedule_insert');
  Route::get('/examinations/exam_schedule/edit/{id}', [ExaminationsController::class, 'showEditForm'])->name('examschedule_edit');
  Route::put('/examinations/exam_schedule/update/{id}', [ExaminationsController::class, 'updateExamSchedule'])->name('examschedule_update');
  Route::delete('/examinations/exam_schedule/delete/{id}', [ExaminationsController::class, 'delete'])->name('examschedule_delete');

    // Assign Class Teacher Routes
   Route::prefix('teacher/assignments')->group(function () {
    Route::get('/list', [AssignmentsController::class, 'AssignmentsTeacher'])->name('teacher_assignments.list');
    Route::get('/add', [AssignmentsController::class, 'addTeacher'])->name('teacher_assignments.add');
    Route::post('/insert', [AssignmentsController::class, 'insertTeacher'])->name('teacher_assignments.insert');
    });
});

// My Account Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/my-account', [UserController::class, 'showMyAccountForm'])->name('my_account');
    Route::put('/my-account/update/admin/{id}', [UserController::class, 'updateAdminAccount'])->name('update_admin_account');
    Route::put('/my-account/update/teacher/{id}', [UserController::class, 'updateTeacherAccount'])->name('update_teacher_account');
    Route::put('/my-account/update/student/{id}', [UserController::class, 'updateStudentAccount'])->name('update_student_account');
    Route::get('/account', [UserController::class, 'showMyAccountForm'])->name('admin.account');
    Route::get('/admin/account', [UserController::class, 'showMyAccountForm']);
    Route::post('/live-class/update', function (\Illuminate\Http\Request $request) {
        if (!in_array(\Illuminate\Support\Facades\Auth::user()->user_type, [1, 2])) {
            return redirect()->back()->with('error', 'Hanya Guru dan Admin yang dapat memperbarui link Live Class.');
        }
        $request->validate([
            'url' => 'required|url',
            'title' => 'required|string|max:200',
        ]);
        \Illuminate\Support\Facades\Cache::forever('live_class_data', [
            'url' => $request->url,
            'title' => $request->title,
            'teacher_name' => \Illuminate\Support\Facades\Auth::user()->name,
            'updated_at' => now()->timezone('Asia/Jakarta')->format('d M Y, H:i') . ' WIB',
            'is_active' => true,
        ]);
        return redirect()->back()->with('success', 'Ruang Live Class berhasil diaktifkan dan diperbarui!');
    })->name('live_class.update');
});


// Teacher Routes
Route::middleware(['auth', 'teacher'])->prefix('teacher')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/account', [UserController::class, 'showMyAccountForm'])->name('teacher.account');
    Route::put('/account/{id}/update', [UserController::class, 'MyAccount'])->name('teacher.account.update');
    Route::get('/my_class_subject', [AssignClassTeacherController::class, 'MyClassSubject'])->name('teacher.myclasssubject');
    Route::get('/my_student', [StudentController::class, 'MyStudent'])->name('teacher.mystudent');
    Route::get('/my_extracurricular', [ExtracurricularController::class, 'teacherList'])->name('teacher.my_extracurricular');

    Route::prefix('teacher/homework')->group(function () {
        Route::get('/list', [HomeworkController::class, 'TeacherHomework'])->name('teacher.homework.list');
        Route::get('/add', [HomeworkController::class, 'addHomeworkTeacher'])->name('teacher.homework.add');
        Route::post('/ajax_get_subject', [HomeworkController::class, 'ajax_get_subject'])->name('teacher.ajax_get_subject');
        Route::post('/add', [HomeworkController::class, 'insertHomeworkTeacher'])->name('teacher.homework.insert');
        Route::get('/edit/{id}', [HomeworkController::class, 'showEditFormTeacher'])->name('teacher.homework.edit');
        Route::put('/update/{id}', [HomeworkController::class, 'updateTeacher'])->name('teacher.homework.update');
        Route::get('/delete/{id}', [HomeworkController::class, 'delete'])->name('teacher.homework.delete');
        Route::get('/submitted/{id}', [HomeworkController::class, 'SubmittedTeacher'])->name('teacher.homework.submitted');
        Route::get('/my_exam_timetable', [ExaminationsController::class, 'MyExamTimetableTeacher'])->name('teacher.my_exam_timetable');
    });

    // Learning Materials Teacher Routes
    Route::prefix('materials')->group(function () {
        Route::get('/list', [LearningMaterialController::class, 'teacherList'])->name('teacher.materials.list');
        Route::get('/add', [LearningMaterialController::class, 'teacherAdd'])->name('teacher.materials.add');
        Route::post('/ajax_get_subject', [LearningMaterialController::class, 'ajax_get_subject'])->name('teacher.materials.ajax_get_subject');
        Route::post('/add', [LearningMaterialController::class, 'teacherInsert'])->name('teacher.materials.insert');
        Route::get('/edit/{id}', [LearningMaterialController::class, 'teacherEdit'])->name('teacher.materials.edit');
        Route::post('/update/{id}', [LearningMaterialController::class, 'teacherUpdate'])->name('teacher.materials.update');
        Route::delete('/delete/{id}', [LearningMaterialController::class, 'teacherDelete'])->name('teacher.materials.delete');
    });

    // Teacher Attendance Routes
    Route::prefix('attendance')->group(function () {
        Route::get('/take', [AttendanceController::class, 'teacherIndex'])->name('teacher.attendance.take');
        Route::post('/submit', [AttendanceController::class, 'teacherSubmit'])->name('teacher.attendance.submit');
        Route::get('/report', [AttendanceController::class, 'teacherReport'])->name('teacher.attendance.report');
    });

    // Teacher Gradebook Routes
    Route::prefix('gradebook')->group(function () {
        Route::get('/index', [GradebookController::class, 'teacherIndex'])->name('teacher.gradebook.index');
        Route::post('/submit', [GradebookController::class, 'teacherSubmit'])->name('teacher.gradebook.submit');
        Route::get('/report', [GradebookController::class, 'teacherReport'])->name('teacher.gradebook.report');
    });

    // Teacher Weekly Teaching Timetable
    Route::get('/my_timetable', [TimetableController::class, 'teacherTimetable'])->name('teacher.timetable');

    // Teacher Notice Board & Announcements
    Route::get('/notice_board', [NoticeBoardController::class, 'teacherList'])->name('teacher.notice_board.list');
    Route::post('/notice_board/post', [NoticeBoardController::class, 'teacherPost'])->name('teacher.notice_board.post');

    // Teacher Homeroom (Kelas Binaan & Catatan Pembinaan Siswa - PRD Section 6)
    Route::get('/homeroom', [NoticeBoardController::class, 'teacherHomeroom'])->name('teacher.homeroom.index');
    Route::post('/homeroom/guidance', [NoticeBoardController::class, 'teacherStoreGuidance'])->name('teacher.homeroom.guidance');
});


// Student Routes
Route::middleware(['auth', 'student'])->prefix('student')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/account', [UserController::class, 'showMyAccountForm'])->name('student.account');
    Route::put('/account/{id}/update', [UserController::class, 'updateMyAccount'])->name('student.account.update');
    Route::get('/my_subject', [SubjectController::class, 'MySubject'])->name('MySubject');
    Route::get('/my_extracurricular', [ExtracurricularController::class, 'studentList'])->name('student.my_extracurricular');
    Route::post('/extracurricular/join/{id}', [ExtracurricularController::class, 'studentJoin'])->name('student.extracurricular.join');
    Route::post('/extracurricular/leave/{id}', [ExtracurricularController::class, 'studentLeave'])->name('student.extracurricular.leave');
    
    // Learning Materials Student Routes
    Route::prefix('materials')->group(function () {
        Route::get('/list', [LearningMaterialController::class, 'studentList'])->name('student.materials.list');
        Route::get('/detail/{id}', [LearningMaterialController::class, 'studentDetail'])->name('student.materials.detail');
    });

    // Student Attendance Route
    Route::get('/my_attendance', [AttendanceController::class, 'studentIndex'])->name('student.attendance.index');

    // Student Gradebook / Report Card
    Route::get('/report_card', [GradebookController::class, 'studentReportCard'])->name('student.report_card');

    // Student Weekly Class Timetable
    Route::get('/my_timetable', [TimetableController::class, 'studentTimetable'])->name('student.timetable');

    // Student Notice Board & Announcements
    Route::get('/notice_board', [NoticeBoardController::class, 'studentList'])->name('student.notice_board.list');

    // Student Pastoral Guidance & Character Recognition
    Route::get('/my_guidance', [NoticeBoardController::class, 'studentGuidance'])->name('student.guidance.index');
    
    Route::prefix('student/homework')->group(function () {
        Route::get('/my_homework', [HomeworkController::class, 'StudentHomework'])->name('student.homework.list');
        Route::get('/my_homework/submit_homework/{id}', [HomeworkController::class, 'SubmitHomework'])->name('student.my_homework.sumbit_homework');
        Route::post('/my_homework/submit_homework/{id}', [HomeworkController::class, 'SubmitHomeworkInsert'])->name('student.my_homework.submit_homework.insert');
        Route::post('/ajax_get_subject', [HomeworkController::class, 'ajax_get_subject'])->name('student.ajax_get_subject');
        Route::post('/add', [HomeworkController::class, 'insert'])->name('teacher.homework.insert');
        Route::get('/edit/{id}', [HomeworkController::class, 'showEditForm'])->name('student.homework.edit');
        Route::put('/update/{id}', [HomeworkController::class, 'update'])->name('student.homework.update');
        Route::get('/delete/{id}', [HomeworkController::class, 'delete'])->name('student.homework.delete');
        Route::get('/my_exam_timetable', [ExaminationsController::class, 'MyExamTimetable'])->name('student.my_exam_timetable');
        Route::get('/my_submitted_homework', [HomeworkController::class, 'StudentHomeworkSubmitted'])->name('student.my_submitted_homework.list');

       
    });

});

// Admin Profile Routes
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/profile/change_password', [UserController::class, 'showChangePasswordForm'])->name('admin.change_password');
    Route::post('/admin/profile/change_password', [UserController::class, 'changePassword'])->name('admin.change_password.post');
});

// Parent Portal Routes (PRD Section 3 & 11)
Route::middleware(['auth', 'parent'])->prefix('parent')->group(function () {
    Route::get('/dashboard', [ParentController::class, 'dashboard'])->name('parent.dashboard');
    Route::get('/my_student_grades', [ParentController::class, 'myStudentGrades'])->name('parent.my_student_grades');
    Route::get('/my_student_attendance', [ParentController::class, 'myStudentAttendance'])->name('parent.my_student_attendance');
    Route::get('/my_student_timetable', [ParentController::class, 'myStudentTimetable'])->name('parent.my_student_timetable');
    Route::get('/notice_board', [NoticeBoardController::class, 'studentList'])->name('parent.notice_board');
});

// Class Discussion & Q&A Forum Routes (PRD Section 4 & 15)
Route::middleware(['auth'])->prefix('discussion')->group(function () {
    Route::get('/index', [DiscussionController::class, 'index'])->name('discussion.index');
    Route::post('/store', [DiscussionController::class, 'store'])->name('discussion.store');
    Route::post('/reply', [DiscussionController::class, 'reply'])->name('discussion.reply');
});

// CBT & Online Exam Routes (PRD Section 4, 5, 15)
Route::middleware(['auth'])->prefix('cbt')->group(function () {
    // Question Bank (Admin & Teacher)
    Route::get('/questions', [CbtController::class, 'questionBankList'])->name('cbt.questions.list');
    Route::get('/questions/add', [CbtController::class, 'questionBankAdd'])->name('cbt.questions.add');
    Route::post('/questions/store', [CbtController::class, 'questionBankStore'])->name('cbt.questions.store');
    Route::get('/questions/delete/{id}', [CbtController::class, 'questionBankDelete'])->name('cbt.questions.delete');

    // Exam Management (Admin & Teacher)
    Route::get('/exams', [CbtController::class, 'examList'])->name('cbt.exams.list');
    Route::get('/exams/add', [CbtController::class, 'examAdd'])->name('cbt.exams.add');
    Route::post('/exams/store', [CbtController::class, 'examStore'])->name('cbt.exams.store');
    Route::get('/exams/results/{id}', [CbtController::class, 'examResults'])->name('cbt.exams.results');

    // Student Exam Player
    Route::get('/student/exams', [CbtController::class, 'studentExamList'])->name('cbt.student.list');
    Route::get('/student/start/{id}', [CbtController::class, 'studentExamStart'])->name('cbt.student.start');
    Route::post('/student/submit/{id}', [CbtController::class, 'studentExamSubmit'])->name('cbt.student.submit');
    Route::get('/student/result/{attempt_id}', [CbtController::class, 'studentExamResult'])->name('cbt.student.result');
});

// Notification Hub Routes (PRD Section 12)
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationAndAuditController::class, 'notificationsIndex'])->name('notifications.index');
    Route::post('/notifications/mark-all-read', [NotificationAndAuditController::class, 'markAllNotificationsRead'])->name('notifications.mark_all_read');
    Route::get('/notifications/read/{id}', [NotificationAndAuditController::class, 'markNotificationReadAndRedirect'])->name('notifications.read_redirect');

    // Print-ready Official Documents (PRD Section 15 & 17)
    Route::get('/report-card/print/{student_id?}', [NotificationAndAuditController::class, 'printStudentReportCard'])->name('report_card.print');
    Route::get('/master-leger/print/{class_id}', [NotificationAndAuditController::class, 'printMasterLeger'])->name('master_leger.print');
});

// Admin Audit Trail & Activity Logs (PRD Section 8 & 14)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/activity_logs', [NotificationAndAuditController::class, 'adminActivityLogs'])->name('admin.activity_logs');
});



