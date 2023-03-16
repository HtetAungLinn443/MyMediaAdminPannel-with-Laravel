<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login , Register
    public function registerPage()
    {
        return view('registerPage');
    }

    // Login
    public function loginPage()
    {
        return view('loginPage');
    }
    // user login and release token
    public function login(Request $request)
    {
        // email , password
        $user = User::where('email', $request->email)->first();

        if (isset($user)) {
            if (Hash::check($request->password, $user->password)) {
                return response()->json([
                    'user' => $user,
                    'token' => $user->createToken(time())->plainTextToken,
                ]);

            } else {
                return response()->json([
                    'user' => null,
                    'token' => null,
                ]);

            }
        } else {
            return response()->json([
                'user' => null,
                'token' => null,
            ]);

        }
    }

    public function register(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        User::create($data);

        $user = User::where('email', $request->email)->first();
        return response()->json([
            'user' => $user,
            'token' => $user->createToken(time())->plainTextToken,
        ]);
    }

    // Category List
    public function categoryList()
    {
        $category = Category::get();
        $post = Post::get();
        return response()->json([
            'status' => 'this is category',
            'category' => $category,
            'post' => $post,

        ]);

    }
}
