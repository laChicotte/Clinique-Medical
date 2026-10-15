<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vital extends Model
{
    use HasFactory;

    protected $fillable = [
        'vit_bodytemp', 'vit_heartpulse', 'vit_resprate', 'vit_bloodpress', 'vit_type', 'employee_id', 'patient_id'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
