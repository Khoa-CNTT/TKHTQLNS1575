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
            $table->id();
            $table->integer('id_phong_ban'); // Liên kết với bảng phongbans
            $table->integer('id_chuc_vu'); // Liên kết với bảng chuc_vus
            $table->string('ho_va_ten'); // Họ và tên nhân viên
            $table->string('email'); // Email duy nhất
            $table->string('password'); // Mật khẩu
            $table->date('ngay_sinh'); // Ngày sinh
            $table->string('dia_chi'); // Địa chỉ
            $table->string('so_dien_thoai'); // Số điện thoại
            $table->integer('luong_co_ban'); // Lương Cơ Bản
            $table->boolean('is_block')->default(0); // Trạng thái khóa tài khoản
            $table->boolean('is_master')->default(0); // Quyền master
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
