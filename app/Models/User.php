<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $appends = ['is_admin'];

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

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function answers() {
        return $this->hasMany(UserAnswer::class);
    }

    public function tokenPurchases() {
        return $this->hasMany(UserTokenPurchase::class);
    }

    public function questioners() {
        return $this->hasMany(Questioner::class);
    }

    /**
     * Determine if the user is an admin.
     *
     * @return bool
     */

    public function isAdmin()
    {
        return $this->role->name === 'admin';
    }

    public function getIsAdminAttribute()
    {
        return $this->isAdmin();
    }

}
