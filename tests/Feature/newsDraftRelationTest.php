<?php

namespace Tests\Feature;

use App\Models\NewsDraf;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class newsDraftRelationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $news = NewsDraf::first();
        self::assertNotNull($news->newsDrafConfig);


    }
}
