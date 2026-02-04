<?php

namespace Database\Seeders;

use App\Models\NewsConfig;
use App\Models\NewsDraf;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class newsConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where("nip","12345678")->get()->first();
        $newsdraft = NewsDraf::where("user_id",$user->id)->first();

        NewsConfig::create([
            "news_draf_id" => $newsdraft->id
        ]);
    }
}
