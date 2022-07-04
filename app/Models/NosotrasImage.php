<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NosotrasImage extends Model
{
    use HasFactory;

    protected $table = 'nosotras_images';
    protected $fillable = ['image'];


}
