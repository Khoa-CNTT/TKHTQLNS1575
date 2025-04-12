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
        Schema::create('quy_dinh_cho_diems', function (Blueprint $table) {
            $table->id();
            $table->string('ma_so')->unique();
            $table->text('noi_dung');
            $table->integer('so_diem');
            $table->integer('loai_diem')->comment('0: thưởng; 1: phạt');
            $table->integer('tinh_trang');
            $table->text('ghi_chu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quy_dinh_cho_diems');
    }
};
