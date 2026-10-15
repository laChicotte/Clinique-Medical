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
        Schema::create('vitals', function (Blueprint $table) {
            $table->id();

            $table->string('vit_bodytemp')->nullable();
            $table->string('vit_heartpulse')->nullable();
            $table->string('vit_resprate')->nullable();
            $table->string('vit_bloodpress')->nullable();
            $table->enum('vit_type', ['employee', 'patient']);
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->timestamps();
        
            // Définir les contraintes de clé étrangère
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vitals');
    }
};
