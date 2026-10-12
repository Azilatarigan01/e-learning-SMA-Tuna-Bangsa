<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ExamModels extends Model
{
    use HasFactory;

    protected $table = 'exam';

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function getRecord(Request $request)
    {
        $query = self::select('exam.*', 'users.name as created_name')
            ->join('users', 'users.id', '=', 'exam.created_by')
            ->where('exam.is_delete', '=', 0); 
    
        if (!empty($request->input('exam_name'))) {
            $query->where('exam.name', 'like', '%' . $request->input('exam_name') . '%');
        }
    
        if (!empty($request->input('created_date'))) {
            $query->whereDate('exam.created_at', '=', $request->input('created_date'));
        }
    
        return $query->orderBy('exam.id', 'desc')->get();
    }
    

   

static public function getExam()
    {
        $retrun = ExamModels::select('exam.*')
            ->where('exam.is_delete', '=', 0)
            ->orderBy('exam.name', 'asc')
            ->get();
        return $retrun;
    }

}