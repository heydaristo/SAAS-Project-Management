<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Service extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_contract',
        'quotation_id',
        'project_id'
    ];

    public function contract() : BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

    public function quotation() : BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

    public function project() : BelongsTo
    {
        return $this->belongsTo(ProjectModel::class);
    }

    public function service_detail() : HasMany
    {
        return $this->hasMany(ServiceDetail::class);
    }
}
