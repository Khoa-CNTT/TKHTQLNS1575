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
        Schema::create('thuong_va_phats', function (Blueprint $table) {
            $table->id();
            $table->integer('id_nhan_vien');
            $table->integer('id_nhan_vien_cho_diem');
            $table->integer('id_quy_dinh');
            $table->integer('diem');
            $table->string('ly_do');
            $table->date('ngay');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thuong_va_phats');
    }
};
