<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    #[Validate("required", message: "Nip tidak boleh kosong")]
    public $nip = "";

    #[Validate("required", message: "password tidak boleh kosong")]
    // #[Validate("min:8", message: "password minimal 8 karakter")]
    public $password = ""; 

    public function login(Request $request) {
       $validated =  $this->validate();


       if(Auth::attempt([
            "nip" => $validated['nip'],
            "password" => $validated['password']
       ])) {
        $request->session()->regenerate();

        dd(Auth::user());
       }

       return back()->with('errors',"Username Atau Password Salah");
    //    return back()->withErrors(["errors" => "Username Atau Password Salah"]);


    }
};
