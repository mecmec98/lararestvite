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
        Schema::connection('billingDB')->dropIfExists('dapitan_addresses');
        Schema::connection('billingDB')->create('dapitan_addresses', function (Blueprint $table) {
            $table->string('Region_Code');
            $table->string('Region');
            $table->string('Province_Code');
            $table->string('Province');
            $table->string('City_Municipality_Code');
            $table->string('City_Municipality');
            $table->string('BarangayCode');
            $table->string('Barangay');
            });    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dapitan_address');
    }
};
