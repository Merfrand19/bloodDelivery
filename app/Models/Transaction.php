<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'transaction_date',
        'sending_time',
        'reception_time',
        'status',
    ];

    public function sender()
    {
        return $this->belongsTo(Hospital::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Hospital::class, 'receiver_id');
    }
}
