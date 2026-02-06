<?php
namespace App\Service\Impl;

use App\Models\NewsDraf;
use PhpParser\Node\Expr\Array_;

class NewsConfigService {
    public function create ( Array $data ,NewsDraf $newsDraf )  {
        return $newsDraf->newsDrafConfig()->create($data);
    }
    public function update (Array $data ,NewsDraf $newsDraf )  {
        return $newsDraf
                ->newsDrafConfig()
                ->update($data);
    }

    public function delete ( Array $data ,NewsDraf $newsDraf )  {
        return $newsDraf->newsDrafConfig()->delete();
    }

    public function getDraf(NewsDraf $newsDraf )  {
       return $newsDraf->newsDrafConfig;
    }
}


?>