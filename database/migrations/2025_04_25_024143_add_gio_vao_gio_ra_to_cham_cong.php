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
        Schema::table('cham_congs', function (Blueprint $table) {
            $table->time('thoi_gian_cham_cong')->nullable();
            $table->integer('trang_thai')->default(0); // 0: Đúng Giờ, 1: Sai giờ
            $table->integer('type')->default(0); // 0: Sai giờ Vào, 1: Sai giờ ra
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cham_congs', function (Blueprint $table) {
            //
        });
    }
};
