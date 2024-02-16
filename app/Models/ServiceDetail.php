<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ServiceDetail extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_service',
        'service_name',
        'price',
        'pay_method',
        'description'
    ];

    public function service() : BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
