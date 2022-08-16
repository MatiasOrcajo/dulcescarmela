<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsApp extends Model
{
    use HasFactory;

    protected $table = 'whatsapp';
    protected $fillable = ['number', 'text', 'image'];

    public function generateText($title, $subject) : string
    {
        $string = str_replace(['{title}', ' '], [$title, '%20'], $subject);
        $internationalFormat = '549';

        return 'https://wa.me/'.$internationalFormat.self::first()->number.'?text='.$string;
    }
}
