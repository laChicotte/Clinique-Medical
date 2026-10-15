<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $casts = ['pres_ins' => \App\Casts\SanitizedHtml::class];
    
    protected $fillable = ['pres_ins', 'patient_id', 'employee_id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
