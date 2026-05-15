<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();
        $category = Category::find($contact['category_id']);
        return view('confirm', compact('contact', 'category'));
    }

    public function store(Request $request)
    {
        Contact::create($request->all());
        return view('thanks');
    }

    public function admin(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('keyword')) {

            $keyword = $request->keyword;

            $query->where(function ($query) use ($keyword) {

            $query->where('last_name', 'like', "%{$keyword}%")
                ->orWhere('first_name', 'like', "%{$keyword}%")
                ->orWhereRaw(
                    "CONCAT(last_name, first_name) LIKE ?",
                    ["%{$keyword}%"]
                );
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7);
        $categories = Category::all();

    return view('admin', compact('contacts', 'categories'));
    }

    public function export()
    {
        $contacts = Contact::with('category')->get();

        $csvHeader = [
            '姓',
            '名',
            '性別',
            'メールアドレス',
            '電話番号',
            '住所',
            '建物名',
            'お問い合わせの種類',
            'お問い合わせ内容'
        ];

        $csvData = [];

        foreach ($contacts as $contact) {

            $csvData[] = [
                $contact->last_name,
                $contact->first_name,
                $contact->gender,
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                $contact->category->content,
                $contact->detail,
            ];
        }

        $filename = storage_path('app/contacts.csv');

        $handle = fopen($filename, 'w');

        fputcsv($handle, $csvHeader);

        foreach ($csvData as $data) {
            fputcsv($handle, $data);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    public function destroy($id)
    {
        Contact::find($id)->delete();

        return redirect('/admin');
    }
}