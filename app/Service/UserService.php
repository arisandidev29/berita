<?php
namespace App\Service;


interface UserService {
    public function create($data);

    public function update($id,$data);

    public function delete($id);

    public function getAll();

    public function getById($id);
}



?>