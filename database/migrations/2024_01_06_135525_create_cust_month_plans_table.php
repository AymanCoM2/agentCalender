<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cust_month_plans', function (Blueprint $table) {
            $table->id();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('date')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('state')->nullable(); // O , X , F , P ...etc 
            $table->string('cardCode')->nullable(); // Of the Customer/Client
            $table->string('company')->nullable(); // LB OR TM for  Customer/Client
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cust_month_plans');
    }
};
