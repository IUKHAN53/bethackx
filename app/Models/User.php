<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'is_admin',
        'is_super_admin',
        'company_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $freePlan = Plan::where('name', 'Free')->companyScope()->first();
            if ($freePlan) {
                $user->subscribePlan($freePlan->id);
            }
        });
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function isSuperAdmin(): bool
    {
        return $this->is_super_admin;
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function scopeCompanyScope($query)
    {
        return $query->where('company_id', request()->current_company->id);
    }

    public function scopeAdminScope($query)
    {
        return $query->where('is_admin', 1);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id', 'id');
    }

    public function hasPremium(): bool
    {
        $freePlan = Plan::where('name', 'Free')->companyScope()->first();
        return $this->subscriptions()->whereNot('plan_id', $freePlan->id)->count() > 0;
    }

    public function hasPremiumForGame($game_id): bool
    {
        $premium = Plan::where('name','!=', 'Free')->companyScope()->first();
        $plans_id = GamesPlans::query()->where('game_id', $game_id)->where('plan_id', $premium->id)->pluck('plan_id')->toArray();
        return $this->subscriptions()->whereIn('plan_id', $plans_id)->exists();
    }

    public function subscribedPlans(){
        return $this->subscriptions->pluck('plan_id')->toArray();
    }

    public function subscribePlan($plan_id){
        $subscription = new Subscription();
        $subscription->user_id = $this->id;
        $subscription->plan_id = $plan_id;
        $subscription->save();
    }



}
