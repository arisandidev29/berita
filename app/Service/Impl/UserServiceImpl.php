<?php

use App\Models\User;
use App\Service\UserService;
use Illuminate\Support\Facades\Hash;

class UserServiceImpl implements UserService {
    public function create($data)
    {
       return User::create([
        "nip" => $data["nip"],
        "name" => $data["name"],
        "role" => $data["role"],
        "password" => Hash::make($data["password"]),
       ]);
    }

    public function update($id, $data)
    {
        $user = User::findOrFail($id);

        $user->fill($data);

        if(isset($data["password"])){
            $user->password = Hash::make($data['password']);
        };

        $user->save();

    }
    
    public function delete($id)
    {
        return User::findOrFail($id)->delete();
    }

    public function getAll()
    {
        return User::where("role","<>","admin")->get();
    }

    public function getById($id)
    {
        return User::findOrFail($id);
    }
}
?>