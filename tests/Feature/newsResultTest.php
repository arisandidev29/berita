<?php

namespace Tests\Feature;

use App\Models\NewsDraf;
use App\Models\NewsResult;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class newsResultTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {

        $draft = User::first()->newsDraft()->first();
        // dd($draft);
        $draft->newsResult()->create([
            "content_generated" => "test"
        ]);
    }
}
