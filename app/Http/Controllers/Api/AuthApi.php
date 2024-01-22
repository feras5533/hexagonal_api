<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class AuthApi extends Controller
{
  public function login(Request $request)
{
    $request->validate([
        'user_name' => 'required',
        'password' => 'required',
    ]);

    $user = User::where('user_name', $request->user_name)->first();

    if (!$user || !Hash::check($request->password , $user->password)) {
        return response()->json(['result' => false],404);
    }

    return response()->json(['result' => true]);
}

 

   

    public function register(Request $request) 
    {

        $request->validate([
            'user_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Registration successful']);
    }



}