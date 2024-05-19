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
        Schema::connection('billingDB')->create('consumer_profile', function (BluePrint $table) {
            $table->bigIncrements('id');

            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            
            $table->string('address');
            $table->string('phonenumber');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schemma::dropIfExist('consumer_profile');
    }
};
