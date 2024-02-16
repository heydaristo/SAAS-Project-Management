<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Client extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'address',
        'no_telp',
        'user_id',
        'email'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function project() : HasMany
    {
        return $this->hasMany(ProjectModel::class);
    }

    public function quotation() : HasMany
    {
        return $this->hasMany(Quotation::class);
    }

    public function contract() : HasMany
    {
        return $this->hasMany(Contract::class);
    }

    public function invoice() : HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
