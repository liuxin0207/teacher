<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Teacher;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::get();
        
        return Inertia::render('ScheduleFolder/ScheduleList', ['response' => $schedules]);
    }

    public function create()
    {   
        $teachers = Teacher::with('course')->get();

        $newTeachers = $teachers->map(function ($teacher) {
            return [
                'id'=>$teacher->id,
                'name'=>$teacher->name,
                'course_id'=>$teacher->course_id,
                'course_name'=>$teacher->course?->name ?? '',
            ];
        });
        return Inertia::render('ScheduleFolder/ScheduleCreate',['response'=>$newTeachers]);
    }

    public function edit($id)
    {   
        $schedule = Schedule::find($id);
        $teachers = Teacher::with('course')->get();
        $newTeachers = $teachers->map(function ($teacher) {
            return [
                'id' => $teacher->id,
                'name' => $teacher->name,
                'course_id' => $teacher->course_id,
                'course_name' => $teacher->course?->name ?? '',
            ];
        });
        $data = [
            'id' => $schedule->id,
            'year' => $schedule->year,
            'semester' => $schedule->semester,
            'content' => json_decode($schedule->content) ?? [],
            'teacherData' => $newTeachers,
        ];
        return Inertia::render('ScheduleFolder/ScheduleEdit', ['response' => $data]);
    }

    public function store(Request $request)
    {   
        Schedule::create([
            'year' => $request->year,
            'semester' => $request->semester,
            'content' => $request->content,
        ]);
        return back()->with('message', '新增成功');
    }

    public function update(Request $request, $id)
    {   
        $schedule = Schedule::find($id);

        $schedule->update([
            'year' => $request->year,
            'semester' => $request->semester,
            'content' => $request->content,
        ]);
        return back()->with('message', '更新成功');
    }

    public function destroy($id)
    {   
        

        try {
            $schedule = Schedule::find($id);
            $schedule->delete();
            return back()->with('message', '刪除成功');
        } catch(\Throwable $th) {
            return back()->with('error', '刪除失敗');
        }
    }

    public function send($id)
    {
        return back()->with('message', '通知成功');
    }
}
