<?php

namespace App\Service\Impl;

use App\Models\NewsDraf;
use App\Models\User;
use App\Service\ImageService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class NewsDrafService
{

    protected ImageService $imageService;
    public function __construct( ImageService $imageService) {
        $this->imageService = $imageService;
    }

    public function create(array $data, ?UploadedFile $image, User $user)
    {
        $news = $user->newsDraft()->create($data);
        if ($image) {
            $path =  $this->imageService->uploadImageNews($image, $news, $user);
            $news->image = $path;
            $news->save();
        }
        return $news;
    }
    
    public function update(array $data, $draft ,?UploadedFile $image, User $user)
    {
        $draft->update($data);
        // dd(strtok($draft->image,'?'));

        if($draft->image) {
            $this->imageService->deleteImageNews(strtok($draft->image,"?"));
        }

        if ($image) {
            $path =  $this->imageService->uploadImageNews($image, $draft, $user);
            $draft->image = $path;
            $draft->save();
        }


        return $draft;
    }

    public function delete($id, User $user)
    {

        $news =  $user->newsDraft()->findOrFail($id)->delete();
        return $news;
    }

    public function deleteSelected(array $id,User $user) {
        $result = $user->newsDraft()->whereIn('id',$id)->delete();
        return $result;
    }

    public function deleteAll() {

    }

    public function getAll(User $user)
    {
        return $user->newsDraft()->latest()->get();
    }

    public function getById($id, User $user)
    {
        return $user->newsDraft()->findOrFail($id);
    }

    public function searchByTitle(string $title, User $user)
    {
        return $user->newsDraft()->where("title", "like", "%$title%")->get();
    }
}
