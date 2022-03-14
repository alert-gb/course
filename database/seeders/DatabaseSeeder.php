<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        // DB::table('videos')->truncate();
        // DB::table('sections')->truncate();
        // DB::table('courses')->truncate();
        // DB::table('categories')->truncate();
        
        \App\Models\Category::factory(9)->create();
        \App\Models\Course::factory(90)->create();
        \App\Models\Section::factory(900)->create();
        \App\Models\Video::factory(9000)->create();
    }
}
