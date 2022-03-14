<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    public function index() {
        $sections = Section::all();
        return response()->json($sections, 200);
    }
}
