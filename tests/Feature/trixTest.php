<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class trixTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $text = "
        **Penyegaran Tenaga Pendidikan: BPMP Malut Serahkan SK ASN PPPK**

**Ternate, 28 Januari 2026** – Bertempat di aula besar 1, Balai Penjaminan Mutu Pendidikan (BPMP) Maluku Utara (Malut) menggelar acara penyerahan Surat Keputusan (SK) kepada Aparatur Sipil Negara (ASN) Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) yang baru. Acara ini menandai pengukuhan resmi para tenaga pendidik yang telah memenuhi kualifikasi dan terpilih untuk bergabung dalam sistem pendidikan di wilayah tersebut.

Penyampaian SK ini merupakan puncak dari serangkaian proses seleksi dan rekrutmen yang telah dilalui oleh para ASN PPPK. Pimpinan BPMP Malut secara langsung menyerahkan SK tersebut kepada para penerima, didampingi oleh jajaran terkait.

Acara yang berlangsung khidmat ini dihadiri oleh para ASN PPPK beserta perwakilan dari unit kerja masing-masing. Penyerahan SK ini diharapkan dapat memberikan semangat baru dan meningkatkan profesionalisme para ASN PPPK dalam menjalankan tugas dan fungsinya di dunia pendidikan Maluku Utara.

Pihak BPMP Malut menyatakan komitmennya untuk terus meningkatkan kualitas sumber daya manusia di sektor pendidikan, sejalan dengan upaya pemerintah dalam mencerdaskan kehidupan bangsa. Penambahan ASN PPPK ini diharapkan dapat memperkuat kapasitas institusi pendidikan di Maluku Utara dalam memberikan layanan pendidikan yang lebih baik bagi seluruh masyarakat.
        ";


        $data = Str::markdown($text);
        dd($data);
    }
}
