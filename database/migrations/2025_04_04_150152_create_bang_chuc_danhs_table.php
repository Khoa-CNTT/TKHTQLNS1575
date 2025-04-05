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
        Schema::create('bang_chuc_danhs', function (Blueprint $table) {
            $table->id("id_chuc_danh");
            $table->string("ten_chuc_danh");
            $table->double("ban_luong");
            $table->boolean("trang_thai");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bang_chuc_danhs');
    }
};
