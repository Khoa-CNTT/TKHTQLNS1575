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
        Schema::create('bao_cao_thong_kes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_nhan_vien')->nullable();
            $table->string('ten_bao_cao');
            $table->string('mo_ta');
            $table->integer('loai_bao_cao');
            $table->date('ngay_tao');
            $table->integer('trang_thai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bao_cao_thong_kes');
    }
};
