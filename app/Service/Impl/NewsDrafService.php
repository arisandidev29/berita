<?php
    namespace App\Service\Impl;

use App\Models\NewsDraf;
use App\Models\User;

    class NewsDrafService{
        public function create(Array $data, User $user) {

            $user->newsDraft()->create($data);
        }

        public function update(Array $data, $id, User $user) {
           $news = $user->newsDraft()->findOrFail($id);
           $news->update($data); 

           return $news;
        }

        public function delete($id, User $user) {

            $news =  $user->newsDraft()->findOrFail($id)->delete();
            return $news;
        }

        public function getAll(User $user) {
            return $user->newsDraft()->latest()->get();
        } 

        public function getById($id,User $user) {
            return $user->newsDraft()->findOrFail($id);
        }

        public function searchByTitle(string $title, User $user) {
            return $user->where("title",$title)->get();
        }
    }
?>