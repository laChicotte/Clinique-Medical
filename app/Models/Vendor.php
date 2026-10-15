<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $casts = ['v_desc' => \App\Casts\SanitizedHtml::class];
    protected $fillable = [
        'v_name', 'v_phone', 'v_addr', 'v_email', 'v_number', 'v_desc',
    ];

    public function equipements()
    {
        return $this->hasMany('App\Equipement');
    }
}
