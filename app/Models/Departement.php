<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departement;

class Departement extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function hospitals()
    {
        return $this->hasMany(Hospital::class, 'departement_id');
    }
}
