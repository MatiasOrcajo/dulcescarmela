<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Constants extends Model
{
    // imagen activa o inactiva en nosotras

    const IMAGE_IS_ACTIVE = 'Si';
    const IMAGE_IS_INACTIVE = 'No';

    const CATEGORY_IS_VISIBLE = 1;
    const CATEGORY_ISNT_VISIBLE = 0;
}
