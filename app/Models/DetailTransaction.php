<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'blood_type_id',
        'blood_quantity',
    ];

    // Les colonnes de la table
    protected $casts = [
        'transaction_id' => 'integer',
        'blood_type_id' => 'integer',
        'blood_quantity' => 'integer',
    ];

    protected $hidden = [
        'transaction_id',
        'created_at',
        'updated_at'
    ];

    // Définir les relations
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class, 'blood_type_id');
    }
}
