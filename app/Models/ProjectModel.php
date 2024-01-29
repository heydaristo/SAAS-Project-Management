<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;


class ProjectModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'start_date',
        'end_date',
        'status',
        'id_client',
    ];

    Public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    Public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    Public function quotation(): HasOne
    {
        return $this->hasOne(Quotation::class);
    }

    Public function service(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    Public function invoice(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    Public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
    



}
