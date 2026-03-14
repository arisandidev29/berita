<?php

namespace App\Service\Impl;

use App\Models\NewsDraf;
use App\Models\User;
use App\Service\ImageService;
use ErrorException;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsDrafService
{

    protected ImageService $imageService;
    public function __construct(ImageService $imageService)
    {
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

    public function update(array $data, $draft, ?UploadedFile $image, User $user, $deleteImage = false)
    {
        $draft->update($data);

        // delete current image
        if (($deleteImage || $image ) && $draft->image) {
            $this->imageService->deleteImageNews($draft->image);
            $draft->image = null;
            $draft->save();
        }


        // upload new image
        if ($image) {
            $path =  $this->imageService->uploadImageNews($image, $draft, $user);
            $draft->image = $path;
            $draft->save();
        }

        return $draft;
    }

    public function delete($id, User $user)
    {
        return DB::transaction(function () use ($id,$user) {
            $draft = $user->newsDraft()->findOrFail($id);
            $imagePath = $draft->image;

            $draft->delete();

            return $draft;

        });
    }

    public function deleteSelected(array $id, User $user)
    {
        return DB::transaction(function () use ($id,$user) {
            $drafts = $user->newsDraft()->whereIn('id', $id)->get();
            foreach($drafts as $draft) {
                $draft->delete();
            }            

        });
    }

    public function deleteAll() {}

    public function getAll(User $user)
    {
        return $user->newsDraft()->where("status","<>","publish")->latest()->get();
    }

    public function getPerPagination($paginate, User $user) {
        return $user->newsDraft()->where("status","<>","publish")->paginate($paginate);
    }

    public function getById($id, User $user)
    {
        return $user->newsDraft()->findOrFail($id);
    }

    public function searchByTitle(string $title, User $user)
    {
        return $user->newsDraft()->where("title", "like", "%$title%")->get();
    }

    public function setPublish(NewsDraf $draft)
    {
        return $draft->update([
            "status" => "publish",
        ]);
    }

    public function getUserDraftByYears(User $user) {
          $data = $user->newsDraft()->select(
            DB::raw("count(id) as total"),
            DB::raw("DATE_FORMAT(created_at,'%M') as month")
        )
            ->groupBy("month")
            ->orderBy("month")
            ->get()
            ->pluck('total', 'month');
        return $data;
    }

    public function makeSlug($title)
    {
        $string = $title . " " . now()->timestamp;
        $slug = Str::slug($string);
        return $slug;
    }
}
