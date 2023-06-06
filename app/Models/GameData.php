<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameData extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'game_name',
        'signal_type',
        'signal',
    ];
}