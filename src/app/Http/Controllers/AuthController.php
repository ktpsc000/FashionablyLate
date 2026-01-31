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

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        $contacts = $query->get();
        $contacts = Contact::Paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }


}
