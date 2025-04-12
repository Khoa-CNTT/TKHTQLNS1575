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
        Schema::create('kpi_nhan_viens', function (Blueprint $table) {
            $table->id();
            $table->integer('id_nhan_vien');
            $table->integer('id_tieu_chi');
            $table->integer('diem_duoc_cham')->nullable();
            $table->integer('id_nhan_vien_danh_gia')->nullable();
            $table->date('ngay_danh_gia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpi_nhan_viens');
    }
};
