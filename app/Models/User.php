<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_role',
        'fullname',
        'email',
        'password',
        'profession',
        'experience_level',
        'organization',
        'photo_profile',
        'last_activity'
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

    public function client(): HasMany
    {
        return $this->hasOne(Client::class);
    }

    public function project() : HasMany
    {
        return $this->hasMany(ProjectModel::class);
    }
    public function invoice() : HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function quotation() : HasMany
    {
        return $this->hasMany(Quotation::class);
    }

    public function contract() : HasMany
    {
        return $this->hasMany(Contract::class);
    }

    public function subscription() : HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
