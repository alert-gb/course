<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;

class CategoryCourseController extends Controller
{

    public function index($slug)
    {
        $category_courses = Category::where('slug', $slug)->first()->courses()->get();
        return response()->json($category_courses, 200);
    }

    public function store(CourseRequest $request, $slug)
    {
        try {
            $category = Category::where('slug', $slug)->first();
            // 1- Start Uploading File
            $path = "";
            if ($request->has('photo') && $request->photo != null && getType($request->photo) !== 'string') {
                $folder = 'courses';
                $file = $request->photo;
                $file->store('/', $folder);
                $filename = $file->hashName();
                $path = 'images/' . $folder . '/' . $filename;
            }
            // End Uploading File

            // 2- Start creating slug 
            $slug = str_replace(' ', '-', $request->title);
            // End creating slug 

            // 3- Start creating category
            $course = new Course();
            $course->title = trim($request->title);
            $course->slug = $slug;
            $course->description = trim($request->description);
            $course->category_id = $category->id;
            $course->photo = $path;
            $course->save();
            // End creating category

            return response()->json(['message' => 'Course Created Successfully'], 201);
        } catch (\Exception $exp) {
            return response()->json(['message' => 'Error On Creating Course'], 422);
        }
    }

    public function update(Request $request, $slug)
    {
        try {
            // 1- Start Uploading File
            $course = Course::where('slug', $slug)->first();
            $path = "";
            if ($request->has('photo') && $request->photo != null && getType($request->photo) !== 'string') {
                $folder = 'courses';
                $file = $request->photo;
                $file->store('/', $folder);
                $filename = $file->hashName();
                $path = 'images/' . $folder . '/' . $filename;
            }
            // End Uploading File

            // 2- Start creating slug 
            // End creating slug 
            // 3- Start creating category
            $newSlug = str_replace(' ', '-', $request->title);
            $course->description = trim($request->description);
            $course->title = trim($request->title);
            $course->slug = $newSlug;
            unlink($course->photo);
            $course->photo = $path;

            if ($course->isDirty(['title', 'description', 'photo']))
                $course->save();
            else
                return response()->json(['message' => 'There Is No Value Updated Yet!'], 422);
            // End creating category

            return response()->json(['message' => 'Course Updated Successfully'], 200);
        } catch (\Exception $exp) {
            return response()->json(['message' => 'Error On Updating Course'], 422);
        }
    }
    public function delete($id)
    {
        try {
            $course = Course::find($id);
            if($course){
                $course->delete();
                if($course->photo)
                unlink($course->photo);
                return response()->json(['message' => 'Course Deleted Successfully'], 200);
            } else {
                return response()->json(['message' => 'This Course Not Found'], 404);
            }

        } catch (\Exception $exp) {
            return response()->json(['message' => 'error on Deleting Course'], 422);
        }
    }
}
