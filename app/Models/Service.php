<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable=[
        'contract_id',
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
}
