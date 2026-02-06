<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where("nip","123456789")->get()->first();

        Pegawai::create([
            "nama" => "arisandi ",
            "jabatan" => "anak magang",
            "user_id" => $user->id
        ]);
    
    }
}
