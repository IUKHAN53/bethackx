<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'game_text',
        'description',
        'iframe_link',
        'image',
        'banner',
        'status',
    ];

    const GAME_TYPES = ['slots', 'cartas', 'roletas', 'dados'];
}