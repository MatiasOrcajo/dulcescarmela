<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpinionBackground extends Model
{
    use HasFactory;

    protected $table = 'opinion_background';
    protected $fillable = ['image'];
}
