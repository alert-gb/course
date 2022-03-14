<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'description', 'photo', 'category_id'];
    // Realtions
    public function category() {
        return $this->belongTo(Category::class);
    }
    public function sections() {
        return $this->hasMany(Section::class);
    }
}
