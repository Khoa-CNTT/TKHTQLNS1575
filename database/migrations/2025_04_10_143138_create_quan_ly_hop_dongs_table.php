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
        Schema::create('quan_ly_hop_dongs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_nhan_vien')->nullable();
            $table->integer('loai_hop_dong');
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc'); 
            $table->integer('luong_co_ban');
            $table->integer('trang_thai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quan_ly_hop_dongs');
    }
};
