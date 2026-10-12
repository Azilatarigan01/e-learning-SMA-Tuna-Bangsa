<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassDiscussionModel;
use App\Models\ClassDiscussionReplyModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    /**
     * View discussions for Class & Subject.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $classId = null;

        if ($user->user_type == 3) {
            // Student
            $classId = $user->class_id;
        } else {
            // Teacher / Admin
            $classId = $request->get('class_id') ?: 17;
        }

        $classes = ClassModel::where('is_delete', 0)->orderBy('name', 'asc')->get();
        $subjects = [];

        if ($classId) {
            $subjects = SubjectModel::select('subject.id', 'subject.name')
                ->join('class_subject', 'class_subject.subject_id', '=', 'subject.id')
                ->where('class_subject.class_id', $classId)
                ->where('class_subject.is_delete', 0)
                ->orderBy('subject.name', 'asc')
                ->get();
        }

        $selectedSubjectId = $request->get('subject_id');
        $discussions = ClassDiscussionModel::getDiscussionsByClassSubject($classId, $selectedSubjectId);

        $data = [
            'header_title' => 'Forum Diskusi Pembelajaran & Tanya Jawab',
            'user' => $user,
            'classes' => $classes,
            'classId' => $classId,
            'subjects' => $subjects,
            'selectedSubjectId' => $selectedSubjectId,
            'discussions' => $discussions,
        ];

        return view('discussion.index', $data);
    }

    /**
     * Store new discussion thread.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        ClassDiscussionModel::create([
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'is_pinned' => (Auth::user()->user_type == 2 && $request->has('is_pinned')) ? 1 : 0,
            'status' => 0,
        ]);

        return redirect()->back()->with('success', 'Topik diskusi baru berhasil dipublikasikan!');
    }

    /**
     * Store reply to discussion thread.
     */
    public function reply(Request $request)
    {
        $request->validate([
            'discussion_id' => 'required|integer',
            'reply_text' => 'required|string',
        ]);

        ClassDiscussionReplyModel::create([
            'discussion_id' => $request->discussion_id,
            'user_id' => Auth::user()->id,
            'reply_text' => $request->reply_text,
        ]);

        return redirect()->back()->with('success', 'Tanggapan Anda berhasil dikirim ke forum diskusi!');
    }
}
