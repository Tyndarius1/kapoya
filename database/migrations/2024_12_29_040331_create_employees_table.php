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
        $table->string('firstname');
        $table->string('middlename')->nullable();
        $table->string('lastname');
        $table->string('address');
        $table->string('contact');
        $table->string('econtact');
        $table->string('position');
        $table->string('employeeid')->unique();
        $table->string('datebirth');
        $table->string('ename');
        $table->string('qr')->nullable();
        $table->string('signature')->nullable();
        $table->string('proimage')->nullable();
        $table->string('color')->nullable();
        // 
     
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
