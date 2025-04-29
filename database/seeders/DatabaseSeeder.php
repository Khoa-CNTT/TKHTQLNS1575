<?php

namespace Database\Seeders;

use App\Models\Phongban;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ChucVuseeding::class,
            PhongBanSeeder::class,
            TieuChiKPISeeder::class,
            QuyDinhChoDiemSeeder::class,
            NhanVienSeeder::class,
            LoaiHopDongSeeder::class,
            KpiNhanVienSeeding::class,
            ChamCongSeeder::class,
            ThuongVaPhatSeeder::class,
            ChucNangSeeder::class,
            ChiTietHopDongSeeder::class,
            PhanQuyenSeeder::class,
            ThongBaoSeeder::class,
            CaLamSeeder::class,
        ]);
    }
}
