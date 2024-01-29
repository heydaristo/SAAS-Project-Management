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
        'id_admin',
        'amount',
        'date',
    ];

    public function subscription() : BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    public function admin() : BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
