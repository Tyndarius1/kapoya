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
        Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->string('firstname');
        $table->string('middlename')->nullable();
        $table->string('lastname');
        $table->string('address');
        $table->string('course');
        $table->string('studentid')->unique();
        $table->string('contact');
        $table->string('econtact');
        $table->string('datebirth');
        $table->string('ename');
        $table->string('signature')->nullable();
        $table->string('proimage')->nullable();
        $table->string('qr')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
