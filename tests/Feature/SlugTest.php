<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class SlugTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $unique = now()->timestamp;
        $data = "hello my name is arisandi";
        dd(Str::slug($data . $unique));
    }
}
