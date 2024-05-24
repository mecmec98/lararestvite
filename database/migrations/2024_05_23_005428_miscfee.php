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
        Schema::connection('billingDB')->dropIfExists('miscfee');
        Schema::connection('billingDB')->create('miscfee', function (BluePrint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('misc_name');
            $table->unsignedBigInteger('fee_value');
            $table->boolean('activate')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('miscfee');
    }
};
