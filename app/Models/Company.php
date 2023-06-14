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

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeDefault($query)
    {
        return $query->where('is_default', 1);
    }




}
