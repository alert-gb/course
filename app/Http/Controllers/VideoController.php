<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
class VideoController extends Controller
{
    public function index() {
        $videos = Video::all();
        return response()->json($videos, 200);
    }

    public function show($slug) {
        $video = Video::where('slug', $slug)->first();
        return response()->json($video, 200);
    }
}
