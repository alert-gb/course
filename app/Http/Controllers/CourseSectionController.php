<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Section;

class CourseSectionController extends Controller
{
    public function index($slug)
    {
        try {
            $sections = Course::where('slug', $slug)->first()->sections()->with('videos')->get();
            return response()->json($sections);
        } catch (\Exception $exp) {
            return response()->json(['message' => 'There is Unhandeled Problem', 422], 422);
        }
    }
    public function show($slug)
    {
        try {
            $firstVideo = Course::where('slug', $slug)->first()->sections()->with('videos')->first()->videos()->first();
            return response()->json($firstVideo);
        } catch (\Exception $exp) {
            return response()->json(['message' => 'There is Unhandeled Problem', 422], 422);
        }
    }
    public function store(SectionRequest $request, $slug)
    {
        try {
            $course = Course::where('slug', $slug)->first();
            if ($request->all()) {
                $section = new Section();
                $title = $section->title = $request->title;
                $section->slug  = str_replace(' ', '-', $title);
                $section->course_id = $course->id;
                $section->save();
                return response()->json(['message' => 'Section Created Successfully', 201], 201);
            } else {
                return response()->json(['message' => 'Enternal Server Error!', 500], 500);
            }
        } catch (\Exception $exp) {
            return response()->json(['message' => 'Error On Creating Section Try Again later', 422], 422);
        }
    }

    public function update(SectionRequest $request, $slug)
    {
        try {

            $section = Section::find($request->id);
            $section->title = $request->title;
            if ($section->isDirty(['title']))
                $section->save();
            else
                return response()->json(['message' => 'There Is No Value Updated Yet!'], 422);

            return response()->json(['message' => 'Section Updated Successfully', 200], 200);
        } catch (\Exception $exp) {
            return response()->json(['message' => 'Error On Updating Section Try Again later', 422], 422);
        }
    }

    public function delete($id)
    {
        try {
            if ($id) {
                $section = Section::find($id);
                $section->delete();
                return response()->json(['message' => 'Section Deleted Successfully', 200], 200);
            } else {
                return response()->json(['message' => 'Enternal Server Error!', 500], 500);
            }
        } catch (\Exception $exp) {
            return response()->json(['message' => 'Error On Deleting Section Try Again later', 422], 422);
        }
    }
}
