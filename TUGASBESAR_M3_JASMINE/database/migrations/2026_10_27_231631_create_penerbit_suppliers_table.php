<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penerbit_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penerbit');
            $table->string('nama_supplier');
            $table->string('kontak_sales');
            $table->text('alamat');
            $table->string('status')->default('Diproses');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penerbit_suppliers');
    }
};