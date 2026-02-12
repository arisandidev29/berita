<?php

namespace Tests\Feature;

use App\Models\User;
use App\Service\Impl\ImageKitService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageKitTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testPutFile(): void
    {
        // Storage::disk("imagekit")->put("test.txt","hai");
        
        // // $this->assertEquals("hello world",Storage::disk("imagekit")->get("test.txt"));

        // $image = UploadedFile::fake()->image('hello.jpg');

        // $path = Storage::disk("imagekit")->putFile("testing",$image);

        // $imgPath = Storage::disk("imagekit")->url($path);

        // dd($path,$imgPath);

        $service = App::make(ImageKitService::class);

        $user = User::first();
        $news = $user->newsDraft()->first();

        $fake = UploadedFile::fake()->image('tes.jpg');

        $result = $service->uploadImageNews($fake,$news,$user);
        dd($result);

    }

}
