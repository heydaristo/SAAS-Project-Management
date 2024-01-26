<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable=[
        'quotation_name',
        'start_date',
        'end_date',
        'status',
        'quotation_pdf',
        'id_client',
        'id_project',
    ];

    public function client() : BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function project() : HasOne
    {
        return $this->hasOne(ProjectModel::class);
    }
}
