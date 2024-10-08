<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class HospitalType extends Model
{
    use HasFactory;
    protected $fillable = ['type'];

    public function hospitals()
    {
        return $this->hasMany(User::class, 'user_id');
    }
}
