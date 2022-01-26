<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\{
    App,
    Auth,
    Hash
};

class LoginWithGithubController extends Controller
{
    public function login()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleLogin()
    {
        try {
            $user = Socialite::driver('github')->user();
            $getUserFromModel = User::where('github_id', $user->id)->first();
            if (!$getUserFromModel) {
                $getUserFromModel = $this->registerUser($user);
            }

            Auth::login($getUserFromModel);
            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (\Exception $except) {
            if (App::environment(['local', 'staging'])) {
                return redirect()->back()->with('error', $except->getMessage());
            }
            return redirect()->back()->with('error', 'ERROR: Unable to Connect with Github');
        }
    }

    private function registerUser($user)
    {
        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'email_verified_at' => now(),
            'password' => Hash::make(now()),
            'github_id' => $user->id
        ]);
    }
}
