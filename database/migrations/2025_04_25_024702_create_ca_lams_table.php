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
        Schema::create('ca_lams', function (Blueprint $table) {
            $table->id();
            $table->string('ten_ca')->nullable();
            $table->time('gio_vao')->nullable();
            $table->time('gio_ra')->nullable();
            $table->integer('trang_thai')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ca_lams');
    }
};
