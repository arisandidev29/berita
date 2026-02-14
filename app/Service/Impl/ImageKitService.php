<?php

namespace App\Service\Impl;

use App\Models\User;
use App\Service\ImageService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageKitService implements ImageService {

        

    public function uploadProfile(UploadedFile $image, User $user)
    {
        $fileName = $user->nip . "." . $image->getClientOriginalExtension(); 
        $path = Storage::disk("imagekit")->putFileAs(
            "user/pegawai",
            $image,
            $fileName
        );

        $user->profile_pic = $path;
        return $user->save();
    }

    public function deleteProfile(User $user)
    {
        $file = Storage::disk("imagekit")->delete($user->profile_pic);
        return (bool) $file;
    }
    
    public function changeProfile($image, User $user)
    {
        $this->deleteProfile($user);

        $this->uploadProfile($image, $user);

    }

    public function getProfile($user)
    {
        return Storage::disk("imagekit")->url($user->profile_pic);
    }

    public function uploadImageNews($image, $newsDraft, $user)
    {
       $user_nip = $user->nip; 
       $news_id = $newsDraft->id;
       $path = "user/" . $user_nip . "/" . "news_$news_id";

       $pathImage = Storage::disk("imagekit")->putFile($path,$image);

       $url =  Storage::disk("imagekit")->url($pathImage);

       $optimizeQuery = "&tr=q-60,f-auto";    

       return $url . $optimizeQuery;

    }

    public function deleteImageNews($imageUrl) {
        $path = parse_url($imageUrl,PHP_URL_PATH);

        $cleanPath = str_replace('/siSpkarisandi/','',$path);

        $image = Storage::disk("imagekit")->delete($cleanPath);

        return $image;
    }



}

?>