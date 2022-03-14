<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VideoRequest;

use App\Models\Video;
use App\Models\Section;

class SectionVideoController extends Controller
{
    public function index($slug)
    {
        
        try {
            $section = Section::where('slug', $slug)->first();
            $videos = $section->videos()->get();
            return response()->json($videos, 200);
        } catch (\Exception $exp) {
            return response()->json(['message' => 'There is Unhandled Problem', 422], 422);
        }
    }

    public function store(VideoRequest $request, $slug)
    {
        try {
            $section = Section::where('slug', $slug)->first();
            // 2- store poster
            $posterPath = '';
            if ($request->photo) {
                $file = $request->photo;
                $file->store('/', 'posters');
                $fileName = $file->hashName();
                $posterPath = 'images/posters/' . $fileName;
            }

            // 3- store video
            $videoPath = '';
            if ($request->video) {
                $file = $request->video;
                $file->store('/', 'videos');
                $fileName = $file->hashName();
                $videoPath = 'videos/' . $fileName;
            }

            // 3- create new video and store title and slug
            $video = new Video();
            $video->title = $request->title;
            $slug = str_replace(' ', '-', $video->title);
            $video->slug = $slug;
            $video->photo = $posterPath;
            $video->video = $videoPath;
            $video->section_id = $section->id;
            $video->save();
            return response()->json(['message' => 'Video Created Sucessfully ', 200], 200);
        } catch (\Exception $exp) {
            return response()->json(['message' => 'Error On Creating Video Try Again later', 422], 422);
        }
    }
    public function update(VideoRequest $request, $slug)
    {
        try {
            $section = Section::where('slug', $slug)->first();
            $video = Video::where("id", $request->id)->first();
            // 2- store poster
            $posterPath = '';
            if ($request->photo) {
                $file = $request->photo;
                $file->store('/', 'posters');
                $fileName = $file->hashName();
                $posterPath = 'images/posters/' . $fileName;
            }

            // 3- store video
            $videoPath = '';
            if ($request->video) {
                $file = $request->video;
                $file->store('/', 'videos');
                $fileName = $file->hashName();
                $videoPath = 'videos/' . $fileName;
            }

            // 3- create new video and store title and slug
            $video->title = $request->title;
            $slug = str_replace(' ', '-', $video->title);
            $video->slug = $slug;
            unlink($video->photo);
            $video->photo = $posterPath;
            unlink($video->video);
            $video->video = $videoPath;
            $video->section_id = $section->id;
            $video->save();
        } catch (\Exception $exp) {
            return response()->json(['message' => 'Error On Updating Video Try Again later', 422], 422);
        }
    }

    public function show($slug)
    {
        $video = Video::where('slug', $slug)->first();
        return response()->json($video, 200);
    }

    public function delete($id)
    {

        if (!$id) {
            return response()->json(['Internal Server Error', 500], 500);
        }
        $video = Video::find($id);
        if ($video) {
            unlink($video->photo);
            unlink($video->video);
            $video->delete();
            return response()->json(['Video Deleted Succesfully', 200], 200);
        }
    }
}
