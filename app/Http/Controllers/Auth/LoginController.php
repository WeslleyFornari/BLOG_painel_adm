<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class LoginController extends Controller
{
    

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

// AUTH GOOGLE
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Verifique se o usuário já existe na base de dados pelo e-mail
        $user = User::where('email', $googleUser->email)->first();

        if ($user) {
            // Fazer login com o usuário existente
            Auth::login($user);
        } else {
            // Caso o usuário não exista, você pode optar por registrá-lo
            $newUser = new User();
            $newUser->name = $googleUser->name;
            $newUser->email = $googleUser->email;
            $newUser->password = bcrypt('senha_aleatoria'); // Defina uma senha aleatória
            $newUser->save();

            // Faça o login com o novo usuário
            Auth::login($newUser);
        }

        return redirect('/home');
    }
}

