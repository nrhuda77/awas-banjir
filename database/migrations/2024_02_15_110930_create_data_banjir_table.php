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
        Schema::create('data_banjir', function (Blueprint $table) {
            $table->id("id_banjir");
            $table->date("tanggal_banjir");
            $table->string("wa");
            $table->string("foto");
            $table->dateTime("awal_banjir");
            $table->dateTime("akhir_banjir");
            $table->string("height");
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_banjir');
    }
};
