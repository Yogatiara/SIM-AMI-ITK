<?php

namespace App\Livewire\auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Login extends Component
{

    public $email = '';
    public $password = '';

    protected function rules()
    {
        return [
            'email' => 'required|email|ends_with:itk.ac.id',
            'password' => 'required',
        ];
    }


    protected function messages()
    {
        return [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi'
        ];
    }


    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password
        ];

        $user = User::where('email', $this->email)
            ->orWhere('username', $this->email)
            ->first();

        $gerbangResponse = Http::post(config('services.gerbang.api_url') . '/login', $credentials);

        if ($gerbangResponse->successful()) {
            Auth::login($user);
            session()->regenerate();
            return redirect()->intended('/');
        } else if (Auth::attempt($credentials)) {
            session()->regenerate();
            return redirect()->intended('/');
        } else {
            session()->flash('error', 'Login gagal, silakan periksa email dan password Anda.');
            $this->password = '';

        }



    }
    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.auth');
        ;
    }
}
