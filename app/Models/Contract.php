<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable=[
        'contract_name',
        'start_date',
        'end_date',
        'status',
        'contract_pdf',
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
    
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
