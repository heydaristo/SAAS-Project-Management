<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Admin extends Model
{
    use HasFactory;

    protected $fillable=[
        'fullname',
        'email',
        'password',
    ];

    public function transaction_admin() : HasMany
    {
        return $this->hasMany(TransactionAdmin::class);
    }
}
