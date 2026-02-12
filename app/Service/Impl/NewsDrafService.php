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

    public function create(array $data, UploadedFile $image, User $user)
    {
        $news = $user->newsDraft()->create($data);
        if ($image) {
            $path =  $this->imageService->uploadImageNews($image, $news, $user);
            $news->image = $path;
            $news->save();
        }
        return $news;
    }

    public function update(array $data, $id, User $user)
    {
        $news = $user->newsDraft()->findOrFail($id);
        $news->update($data);

        return $news;
    }

    public function delete($id, User $user)
    {

        $news =  $user->newsDraft()->findOrFail($id)->delete();
        return $news;
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
