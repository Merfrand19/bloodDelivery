<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Hospital extends Model
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'nom', 'adresse', 'coordonneesAtterisage', 'departement_id', 'type_id', 'hasBloodBank', 'isEnable'
    ];

    protected $casts = [
        'hasBloodBank' => 'boolean',
        'isEnable' => 'boolean',
    ];

    protected $hidden = [
        'departement_id','type_id'
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function type()
    {
        return $this->belongsTo(HospitalType::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'hospital_id');
    }

    public function bloodInventory()
    {
        return $this->hasMany(BloodInventory::class, 'hospital_id');
    } 
}
