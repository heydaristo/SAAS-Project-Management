<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Client extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'address',
        'no_telp',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function project() : HasMany
    {
        return $this->hasMany(ProjectModel::class);
    }
}
