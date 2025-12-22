<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Ticket extends Model
{
    protected $fillable = [
        'tenant_id',
        'user_id',
        'title',
        'description',
        'status',
    ];

    // RELASI KE USER (PEMBUAT TICKET)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
