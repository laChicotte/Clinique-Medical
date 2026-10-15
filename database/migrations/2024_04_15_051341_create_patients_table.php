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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('pat_fname', 200);
            $table->string('pat_genre')->nullable();
            $table->string('pat_lname', 80);
            $table->string('pat_dob', 70);
            $table->string('pat_age', 5);
            $table->string('pat_number', 20);
            $table->string('pat_addr', 50);
            $table->string('pat_phone', 50);
            $table->string('pat_type', 20);
            $table->string('pat_ailment', 200);
            $table->integer('pat_transfer_status')->default(0);
            $table->string('pat_transferd_date')->nullable();
            $table->string('pat_transferd_hospital')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
