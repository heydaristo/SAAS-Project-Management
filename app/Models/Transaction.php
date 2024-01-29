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
        'is_income',
        'source',
        'description',
        'category',
        'created_at',
        'amount',
    ];

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class);
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
