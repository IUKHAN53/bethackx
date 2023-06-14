<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamesPlans extends Model
{
    use HasFactory;

    protected $table = 'games_plans';

    protected $fillable = [
        'game_id',
        'plan_id',
    ];

    public function game()
    {
        return $this->belongsTo(Games::class, 'game_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

}
