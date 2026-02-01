<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\Category;


class AuthController extends Controller
{
    // Registerアクセス
    public function register()
    {
        return view('register');
    }

    // Loginアクセス
    public function login()
    {
        return view('login');
    }

    // Login認証エラーをパスワード下に表示
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (! Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'password' => __('auth.failed'),
            ]);
        }
        $request->session()->regenerate();
        return redirect('/admin');
    }

    // Adminアクセス
    public function admin(Request $request)
    {
        $query = Contact::with('category');

        $contacts = $query->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }


}
