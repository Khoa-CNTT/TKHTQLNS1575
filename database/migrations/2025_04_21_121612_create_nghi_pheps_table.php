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
        Schema::create('nghi_pheps', function (Blueprint $table) {
            $table->id();
            $table->integer('id_nhan_vien');
            $table->integer('id_loai_vang');
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');
            $table->date('so_ngay_vang');
            $table->string('ly_do');
            $table->integer('tinh_trang');
            $table->integer('nguoi_phe_diet');
            $table->date('ngay_phe_diet');
            $table->string('ghi_chu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nghi_pheps');
    }
};
