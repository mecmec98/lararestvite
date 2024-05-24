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
            $table->decimal('rate_value');
            $table->integer('rate_minimum');
            
            $table->decimal('cc_a');
            $table->decimal('cc_b');
            $table->decimal('cc_c');
            $table->decimal('cc_d');

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
