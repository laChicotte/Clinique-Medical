<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    use HasFactory;
    protected $fillable = ['su_name', 'su_status'];

    // Relation avec le modèle Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Relation avec le modèle Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
