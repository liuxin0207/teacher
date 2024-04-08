<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Logger\ConsoleLogger;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
    // public function index2()
    // {
    //     $schedules = Schedule::get();
    //     // dd($schedules);
        
    //     return Inertia::render('Welcome', ['response' => $schedules]);
    // }
}
