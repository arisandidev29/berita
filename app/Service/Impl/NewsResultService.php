<?php
namespace App\Service\Impl;

use App\Models\NewsDraf;

class NewsResultService {
    public function create($data,NewsDraf $newsDraf) {
        return $newsDraf->newsResult()->create($data);
    }
    public function update($data,NewsDraf $newsDraf) {
        return $newsDraf->newsResult()->update($data);
    }
    public function delete($data,NewsDraf $newsDraf) {
        return $newsDraf->newsResult()->delete();
    }
}


?>