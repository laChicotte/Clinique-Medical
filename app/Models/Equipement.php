<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;
    protected $fillable = [
        'eqp_code', 'eqp_name', 'eqp_desc', 'eqp_dept', 'eqp_qty', 'eqp_status', 'eqp_dpic', 'vendor_id',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
