<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{
    use HasFactory;
    protected $fillable = ['type'];

    public function bloodInventory()
    {
        return $this->hasMany(BloodInventory::class, 'blood_type_id');
    } 

}
