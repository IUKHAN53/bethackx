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

    public function getSettings(){
        return [
            'request_access_link' => GlobalSettings::query()->where('key', 'request_access_link')->pluck('value')->first(),
            'help_link' => GlobalSettings::query()->where('key', 'help_link')->pluck('value')->first(),
            'home_banner' => GlobalSettings::query()->where('key', 'home_banner')->pluck('value')->first(),
            'home_banner_ref_link' => GlobalSettings::query()->where('key', 'home_banner_ref_link')->pluck('value')->first(),
            'admin_tutorial_link' => GlobalSettings::query()->where('key', 'admin_tutorial_link')->pluck('value')->first(),
        ];
    }
}
