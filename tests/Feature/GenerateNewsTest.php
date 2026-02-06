<?php

namespace Tests\Feature;

use App\Models\User;
use App\Service\Impl\NewsGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenerateNewsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testGenrate(): void
    {
        $newsGenerator = $this->app->make(NewsGenerator::class);
       $user = User::first(); 
       $draft = $user->newsDraft()->first();

    //    dd($draft->id);

       $newsGenerator->generateNews($draft->id,$user);
    }
}
