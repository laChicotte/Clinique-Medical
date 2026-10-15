<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    // Relation vers prescriptions
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    // Relation vers vitals
    public function vitals()
    {
        return $this->hasMany(Vital::class);
    }

    // Relation vers Labo test
    public function laboratories()
    {
        return $this->hasMany(Laboratory::class);
    }
}
