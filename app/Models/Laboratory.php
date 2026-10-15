<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;
    protected $casts = [
        'lab_pat_tests' => \App\Casts\SanitizedHtml::class,
        'lab_pat_results' => \App\Casts\SanitizedHtml::class,
    ];
    protected $fillable = [
        'patient_id',
        'lab_pat_tests',
        'lab_pat_results',
        'employee_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
