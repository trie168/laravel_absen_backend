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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            //address
            $table->string('address');
            //latitude
            $table->string('latitude');
            //longitude
            $table->string('longitude');
            //radius
            $table->string('radius_km');
            //phone
            $table->string('phone');
            //tlp
            $table->string('tlp');
            //time_in   (format: 09:00)
            $table->string('time_in');
            //time_out  (format: 17:00)
            $table->string('time_out');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
