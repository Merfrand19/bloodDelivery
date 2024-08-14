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
        'receiver_comments',
        'sender_comments',
        'status',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'sending_time' => 'datetime:H:i:s',
        'reception_time' => 'datetime:H:i:s',
    ];

    protected $hidden = [
        'sender_id',
        'receiver_id',
        'created_at',
        'updated_at'
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
