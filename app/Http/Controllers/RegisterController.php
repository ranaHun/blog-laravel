<?php 

namespace App\Http\Controllers;

use App\Models\User;

use App\Providers\RouteServiceProvider;

class RegisterController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function create()
    {
        return view('auth.register');
    }
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }
    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|max:255|confirmed',
        ]);

        auth()->login(User::create($attributes));

        return redirect('/')->with('success', 'Your account has been created.');
    }
}