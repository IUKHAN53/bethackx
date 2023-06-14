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
        'iframe_link',
        'is_premium',
        'is_active',
    ];

    public function game()
    {
        return $this->belongsTo(Games::class, 'game_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
