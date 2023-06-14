<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalSettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'key',
        'value',
    ];
    public function scopeCompanyScope($query)
    {
        return $query->where('company_id', request()->current_company->id);
    }

    public function getSettings(){
        return [
            'request_access_link' => GlobalSettings::query()->companyScope()->where('key', 'request_access_link')->pluck('value')->first(),
            'help_link' => GlobalSettings::query()->companyScope()->where('key', 'help_link')->pluck('value')->first(),
            'home_banner' => GlobalSettings::query()->companyScope()->where('key', 'home_banner')->pluck('value')->first(),
            'home_banner_ref_link' => GlobalSettings::query()->companyScope()->where('key', 'home_banner_ref_link')->pluck('value')->first(),
            'admin_tutorial_link' => GlobalSettings::query()->companyScope()->where('key', 'admin_tutorial_link')->pluck('value')->first(),
        ];
    }
}
