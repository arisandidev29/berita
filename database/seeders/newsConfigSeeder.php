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
        $user = User::where("nip","123456789")->get()->first();

        $news = $user->newsDraft;


        foreach($news as $item) {
            NewsConfig::create([
                "news_draf_id" => $item->id
            ]);
        }
    }
}
