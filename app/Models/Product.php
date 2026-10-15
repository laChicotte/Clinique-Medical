<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $casts = ['phar_desc' => \App\Casts\SanitizedHtml::class];
    protected $fillable = ['phar_name', 'phar_bcode', 'phar_desc', 'phar_qty', 'category_id'];

    // Relation avec la catégorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
