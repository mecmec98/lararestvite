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
            $table->decimal('rate_value');
            $table->integer('rate_minimum');

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
