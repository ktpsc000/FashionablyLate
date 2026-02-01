<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    // 検索用
    public function search(Request $request)
    {
        $contacts = Contact::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->GenderSearch($request->gender)->DateSearch($request->created_at)->paginate(7)->withQueryString();
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function reset()
    {
        return redirect('/admin');
    }

    // 削除用
    public function delete(Request $request)
    {

        Contact::findOrFail($request->id)->delete();

        return redirect()->back();
    }


    // エクスポート用
    public function export(Request $request)
    {
        $contacts = Contact::with('category')
            ->CategorySearch($request->category_id)
            ->KeywordSearch($request->keyword)
            ->GenderSearch($request->gender)
            ->DateSearch($request->created_at)
            ->get();

        $csvHeader = [
            'お名前',
            '性別',
            'メールアドレス',
            'お問い合わせ種類',
        ];

        $response = new \Symfony\Component\HttpFoundation\StreamedResponse(function () use ($contacts, $csvHeader) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF");
            fputcsv($handle, $csvHeader);
            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->first_name . ' ' . $contact->last_name,
                    [1=>'男性',2=>'女性',3=>'その他'][$contact->gender],
                    $contact->email,
                    $contact->category->content,
                ]);
            }
            fclose($handle);
        });
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set(
            'Content-Disposition',
            'attachment; filename="contacts.csv"'
        );
        return $response;
    }

}
