 <?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiSekarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['usia' => 55, 'nilai_sekarang' => 1.000000],
            ['usia' => 54, 'nilai_sekarang' => 0.959940],
            ['usia' => 53, 'nilai_sekarang' => 0.886310],
            ['usia' => 52, 'nilai_sekarang' => 0.818870],
        ];

        DB::table('nilai_sekarang')->insert($data);
    }
}
