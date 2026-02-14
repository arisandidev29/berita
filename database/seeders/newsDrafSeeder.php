<?php

namespace Database\Seeders;

use App\Models\NewsDraf;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class newsDrafSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where("nip","123456789")->get()->first();

        NewsDraf::create([
            "user_id" => $user->id,
            "title" => "Mtq di bpmp maluku utara",
            "tokoh" => "pimpinan bpmp santoso, walikota tidore",
            "lokasi" => "bpmp malut",
            "Kronologi" => "pembukaan acara mtq di bpmp maluku utara",
        ]); 
        
        $count = 5;
        
        for ($i=0; $i < $count; $i++) { 
            NewsDraf::create([
                "user_id" => $user->id,
                "title" => fake()->words(4,true),
                "tokoh" => fake()->words(5,true),
                "lokasi" => fake()->words(2,true),
                "Kronologi" => fake()->paragraph(2),
            ]); 
        }
    }
}
