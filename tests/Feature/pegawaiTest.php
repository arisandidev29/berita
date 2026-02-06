<?php

namespace Tests\Feature;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class pegawaiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testGetPegawai(): void
    {
        $user = User::first();

        self::assertNotNull($user->pegawai->jabatan);
    }
}
