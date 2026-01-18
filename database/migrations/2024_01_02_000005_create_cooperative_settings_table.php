<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cooperative_settings', function (Blueprint $table) {
            $table->id();
            $table->string('cooperative_name');
            $table->string('school_name');
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('logo_path')->nullable();
            $table->decimal('simpanan_pokok_amount', 15, 2);
            $table->decimal('simpanan_wajib_amount', 15, 2);
            $table->decimal('shu_cadangan_percent', 5, 2);
            $table->decimal('shu_anggota_percent', 5, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cooperative_settings');
    }
};
