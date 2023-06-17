<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'favicon',
        'primary_color',
        'secondary_color',
        'tertiary_color',
        'buttons_color',
        'notices_color',
        'request_access_link',
        'help_link',
        'home_banner',
        'home_banner_ref_link',
        'admin_tutorial_link',
        'is_active',
        'admin_id',
        'is_default',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function companyGames()
    {
        return $this->hasMany(CompanyGames::class, 'company_id');
    }
    public function games()
    {
        return $this->belongsToMany(CompanyGames::class, 'company_game', 'game_id', 'company_id')
            ->withPivot('is_premium', 'is_active', 'iframe_link');
    }


    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeDefault($query)
    {
        return $query->where('is_default', 1);
    }

    static function getDefaultOrFirst(){
        $default = Company::query()->where('is_default', 1)->first();
        if($default){
            return $default;
        }
        return Company::query()->where('is_active', 1)->first();
    }

}
