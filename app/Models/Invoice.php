<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_project',
        'id_client',
        'issued_date',
        'status',
        'due_date',
        'total',
        'invoice_pdf'
    ];

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function client() : BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function transaction() : HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    
}
