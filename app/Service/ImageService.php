<?php
namespace App\Service;

use App\Models\User;
use Illuminate\Http\UploadedFile;

interface ImageService {
    function uploadProfile(UploadedFile $image, User $user);

    function deleteProfile(User $user);

    function changeProfile($image, User $user);

    function getProfile($user);

    function uploadImageNews($image,$newsDraft, $user);

    function deleteImageNews($imageUrl);

    function deleteImageDirectory($imageUrl);

    // function changeImageNews($image,$newsDraft);
    
    // function getImageNews($newsDraft);

}


?>