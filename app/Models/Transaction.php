<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Transaction extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_project',
        'id_invoice',
        'id_payment',
        'id_user',
        'created_date',
        'is_income',
        'source',
        'description',
        'category',
        'amount',
        'created_at',
        'updated_at',
    ];

    public function project() : BelongsTo
    {
        return $this->belongsTo(ProjectModel::class);
    }

    public function invoice() : BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function payment() : BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
