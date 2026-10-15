<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    // Relation vers vitals
    public function vitals()
    {
        return $this->hasMany(Vital::class);
    }
}
