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
        'is_default',
        'company_id',
    ];

    const GAME_TYPES = ['slots', 'cartas', 'roletas', 'dados'];

    public function companyGames()
    {
        return $this->hasMany(CompanyGames::class, 'game_id', 'id');
    }

    public function iframe_link()
    {
        return $this->companyGames()->where('company_id', request()->current_company->id)->first()->iframe_link;
    }

    public function isPremium(): bool
    {
        $premium = Plan::where('name', '!=', 'Free')->companyScope()->first();
        if ($premium) {
            return $this->plans()->where('plan_id', $premium->id)->exists();
        }
        return false;
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'games_plans', 'game_id', 'plan_id');
    }

}
