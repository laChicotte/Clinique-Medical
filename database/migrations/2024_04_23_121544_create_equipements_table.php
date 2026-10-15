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
        Schema::create('equipements', function (Blueprint $table) {
            $table->id();
            $table->string('eqp_code', 200)->nullable();
            $table->string('eqp_name', 200)->nullable();
            $table->longText('eqp_desc')->nullable();
            $table->string('eqp_dept', 20)->nullable();
            $table->integer('eqp_qty')->nullable();
            $table->string('eqp_dpic', 200)->nullable();
            $table->string('eqp_status', 200)->nullable();
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipements');
    }
};
