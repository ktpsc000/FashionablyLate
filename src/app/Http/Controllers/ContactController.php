<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    // Contactアクセス
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    // Confirmアクセス
    public function confirm(ContactRequest $request)
    {

        $contact = $request->only(['first_name', 'last_name','gender','email','tel1','tel2','tel3','address','category_id','building','detail']);
        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;
        $contact['building'] = $contact['building'] ?? '';
        $contact['category_content'] = Category::find($contact['category_id'])->content;
        $request->session()->put('contact', $contact);

        return view('confirm', compact('contact'));
    }

    // Thanksアクセス
    public function thanks(Request $request)
    {
        $contact = $request->session()->get('contact', []);
        dd($contact);
        $request->session()->forget('contact');
        Contact::create($contact);
        return view('thanks');
    }

    // 修正ボタン対応
    public function back(Request $request)
    {
        $contact = $request->session()->get('contact', []);
        $categories = Category::all();
        return view('index', compact('contact', 'categories'));
    }
}
