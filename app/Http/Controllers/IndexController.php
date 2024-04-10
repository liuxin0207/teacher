<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Logger\ConsoleLogger;

class IndexController extends Controller
{
    public function index(Request $request)
    {   
        $schedules = Schedule::get();
        $course = Course::get();
        $teacher = Teacher::get();

        // 整理學年度和學期資料
        $yearSemesters = $schedules->map(function ($schedule) {
            return $schedule->year . '-' . $schedule->semester;
        })->unique()->values()->all();


        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'yearSemesters' => $yearSemesters, // 將學年度和學期的資料傳遞給前端
            'course' => $course, 
            'teacher' => $teacher,
            'schedules'=>$schedules,
        ]);
    }
}
