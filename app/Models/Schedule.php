<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'semester',
        'content',
    ];
    // public function course()
    // {
    //     return $this->belongsTo(Course::class);
    // }
    
}
