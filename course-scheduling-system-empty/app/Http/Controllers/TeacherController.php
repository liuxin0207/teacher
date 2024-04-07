<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class TeacherController extends Controller
{
    public function index()
    {   
        $teacher = Teacher::get();

        return Inertia::render('TeacherFolder/TeacherList',['response'=>$teacher]);
    }

    public function create()
    {   
        $course = Course::get();
        
        return Inertia::render('TeacherFolder/TeacherCreate',['response'=>$course]);
    }

    public function edit($id)
    {   
        $teacher = Teacher::find($id);
        $courses = Course::get();

        $data=[
            'courses'=>$courses,
            'teacher'=>$teacher,
        ];

        return Inertia::render('TeacherFolder/TeacherEdit',['response'=>$data]);
    }

    public function store(Request $request)
    {   
        Teacher::create([
            'course_id'=>$request->courseId,
            'name'=>$request->name,
            'description'=>$request->description,
        ]);

        return back()->with(['message' => '新增成功']);
    }

    public function update(Request $request, $id)
    {   
        $teacher = Teacher::find($id);

        $teacher->update([
            'course_id'=>$request->courseId,
            'name'=>$request->name,
            'description'=>$request->description,
        ]);
        return back()->with(['message' => '更新成功']);
    }

    public function destroy($id)
    {   
        $msg ='';

        try{
                $teacher = Teacher::find($id);

                $teacher->delete();
                $msg ='刪除成功';
        }catch(\Throwable $th){
            $msg ='刪除失敗';
        }
        
        return back()->with(['message' => '刪除成功']);
    }
}
