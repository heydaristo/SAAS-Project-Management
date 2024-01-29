<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Subscription extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_user',
        'id_plan',
        'how_long'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plan() : BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function transaction_admin() : HasMany
    {
        return $this->hasMany(TransactionAdmin::class);
    }
}
