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
        Schema::connection('billingDB')->dropIfExists('rates');
        Schema::connection('billingDB')->create('rates', function (BluePrint $table) {
            $table->bigIncrements('id');
            $table->string('rate_name');
            $table->string('meter_size');
            $table->string('rate_desc');
            $table->integer('rate_minimum');
            
            $table->integer('cc_a');
            $table->integer('cc_b');
            $table->integer('cc_c');
            $table->integer('cc_d');

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
