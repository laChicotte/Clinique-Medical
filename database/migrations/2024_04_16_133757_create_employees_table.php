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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string("doc_fname")->varchar(200);
            $table->string("doc_lname")->varchar(200);
            $table->string("doc_email")->varchar(200)->unique();
            $table->string("doc_number")->varchar(200);
            $table->string("doc_dpic")->varchar(200)->nullable();
            $table->string("doc_dept")->varchar(200)->nullable();
            $table->unsignedTinyInteger('has_account')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
