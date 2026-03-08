<?php
namespace App\Service\Impl;

use App\Models\NewsDraf;
use App\Models\NewsResult;
use App\Models\User;
use Illuminate\Support\Str;

class NewsResultService {
    public function create($data,NewsDraf $newsDraf) {
        return $newsDraf->newsResult()->create($data);
    }
    public function update($data,NewsDraf $newsDraf) {
        return $newsDraf->newsResult()->update($data);
    }
    public function delete($id,NewsResult $newsResult) {
        $news = $newsResult->find($id);
        $result = $news->newsDraf()->delete();
        return $result;
    }

    public function setPublish(NewsDraf $newsDraf) {
        $slug = $this->makeSlug($newsDraf->newsResult->title);

        return $newsDraf->newsResult()->update([
            "is_published" => true,
            "slug" => $slug
        ]);
    }

    public function searchNews(string $search,User $user) {
        $result = $this->getPublishNews($user)->where("news_result.title","like","%$search%")->get();
        return $result;
    }

    public function getPublishNews(User $user) {
        return $user->publishedResult()->where("news_result.is_published",true);
    }

    // helper

    protected function makeSlug($title) {
        $string = $title . " " . now()->timestamp;
        $slug = Str::slug($string);
        return $slug;
    } 

}


?>