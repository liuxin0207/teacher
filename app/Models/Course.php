<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'photo',
    ];

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    // public function schedule()
    // {
    //     return $this->hasMany(Schedule::class);
    // }
}
