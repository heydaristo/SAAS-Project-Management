<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
