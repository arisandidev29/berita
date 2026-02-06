<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class PromptCleanTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $draft = "
            'title'     => 'Kebakaran Gudang Tekstil di Kalideres',
            'tokoh'     => 'Bapak Ahmad (Pemilik Gudang) dan Petugas Damkar',
            'peristiwa' => 'Si jago merah melahap gudang penyimpanan kain',
            'lokasi'    => 'Kecamatan Kalideres, Jakarta Barat',
            'waktu'     => 'Kamis, 5 Februari 2026 pukul 19:30 WIB',
            'kronogi'   => 'Api diduga berasal dari korsleting listrik di ruang panel belakang, kemudian merambat cepat ke tumpukan bahan katun yang mudah terbakar.'
        ";

        $text = preg_replace('/\s+/', ' ', $draft);

        dump($draft);
        dd(trim($text));
    }
}
