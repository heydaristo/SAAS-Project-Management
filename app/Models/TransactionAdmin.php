<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class TransactionAdmin extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_subscription',
        'id_user',
        'amount',
        'date',
        'status'
    ];

    public function subscription() : BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
