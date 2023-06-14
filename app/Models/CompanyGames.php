<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyGames extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'game_id',
        'is_premium',
        'is_active',
    ];
}
