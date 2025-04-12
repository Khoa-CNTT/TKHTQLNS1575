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
        Schema::create('chi_tiet_hop_dongs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_nhan_vien');
            $table->string('id_loai_hop_dong');
            $table->text('noi_dung');
            $table->date('ngay_ky');
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_hop_dongs');
    }
};
