<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    const PREMIUM_PLAN_NAME = 'Premium';
    const FREE_PLAN_NAME = 'Free';
    protected $fillable = [
        'name',
        'description',
        'price',
        'statusstatus',
        'company_id',
    ];

    public function scopeCompanyScope($query)
    {
        if (request()->current_company)
            return $query->where('company_id', request()->current_company->id);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function games()
    {
        return $this->belongsToMany(Games::class, 'games_plans', 'plan_id', 'game_id');
    }

    public function gamesPlans()
    {
        return $this->hasMany(GamesPlans::class);
    }
}
