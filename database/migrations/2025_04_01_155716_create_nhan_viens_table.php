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
        Schema::create('nhan_viens', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->integer('ma_vai_tro')->nullable(); // Foreign Key
            $table->string('ho_va_ten');
            $table->date('ngay_sinh');
            $table->boolean('gioi_tinh');
            $table->string('so_dien_thoai');
            $table->string('email');
            $table->string('password');
            $table->date('ngay_tuyen_dung');
            $table->integer('ma_phong_ban')->nullable(); // Foreign Key
            $table->integer('ma_chuc_danh')->nullable();
            $table->integer('trang_thai');
            $table->string("loai_hop_dong");
            $table->boolean("is_master")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhan_viens');
    }
};
