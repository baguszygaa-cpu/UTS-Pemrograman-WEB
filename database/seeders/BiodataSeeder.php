<?php

namespace Database\Seeders;

use App\Models\Biodata;
use Illuminate\Database\Seeder;

class BiodataSeeder extends Seeder
{
    /**
     * Seed the biodatas table with initial UTS cards.
     */
    public function run(): void
    {
        $items = [
            [
                'nama' => 'Bagus Zyga Wirawan',
                'deskripsi' => '24010110193 merupakan master dari uts ini dengan tugas membuat front-end dan mengirimkannya ke grup',
                'foto' => 'images/zyga.jpeg',
            ],
            [
                'nama' => 'IKLIMAH',
                'deskripsi' => 'dengan NIM 24010110234 merupakan pegawai dan mempunyai tugas mengerjakan back-end pada UTS ini',
                'foto' => 'images/ima.jpeg',
            ],
        ];

        Biodata::query()->delete();

        foreach ($items as $item) {
            Biodata::create($item);
        }
    }
}
