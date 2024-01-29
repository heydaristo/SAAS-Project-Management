<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable=[
        'plan_name',
        'benefit',
        'price',
    ];

    public function subscription() : HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
