<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Services\FilesService;

class CourseController extends Controller
{
    public function index()
    {
        $course = Course::get();
        return Inertia::render('CourseFolder/CourseList', ['response' => $course]);
    }

    public function create()
    {
        return Inertia::render('CourseFolder/CourseCreate');
    }

    public function edit($id)
    {
        $course = Course::find($id);
        // dd($course);
        return Inertia::render('CourseFolder/CourseEdit', ['response' => $course]);
    }

    public function store(Request $request, FilesService $filesService)
    {
        // dd($request->all());

        $photo = $request->photo;

        $path = '';
        if ($photo) {
            $path = $filesService->uploadImg($photo);
            }

        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'photo' => $path,
        ]);

        return back()->with(['message' => '新增成功']);
    }

    public function update(Request $request, $id, FilesService $filesService)
    {
        $course = Course::find($id);
        $photo = $request->photo;
        if ($photo) {
            $path = $filesService->uploadImg($photo);
            
            // if (file_exists(public_path() . $course->photo)) {
            //     File::delete(public_path() . $course->photo);
            // }
        } else {
            $path = $course->photo;
        }

        $course->update([
            'name' => $request->name,
            'description' => $request->description,
            'photo' => $path,
        ]);

        return back()->with(['message' => '更新成功']);
    }

    public function destroy($id, FilesService $filesService)
    {   
        $course = Course::find($id);

        
        // if (file_exists(public_path() . $course->photo)) {
        //     File::delete(public_path() . $course->photo);
        // }
            // 呼叫FilesService的deleteFile去刪除檔案
        $filesService->deleteFile($course->photo);
        $course->delete();

        return back()->with(['message' => '刪除成功']);
    }

     
}
