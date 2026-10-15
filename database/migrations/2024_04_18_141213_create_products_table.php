<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('phar_name', 200);
            $table->string('phar_bcode', 200)->unique(); // Rendre la colonne unique
            $table->longText('phar_desc')->nullable();
            $table->string('phar_qty', 200)->default(0);
            $table->unsignedBigInteger('category_id')->nullable(); 
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
