<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'userName',
    ];
    protected $casts = [
        'comments' => 'array', // Cast comments attribute to array
    ];
}
