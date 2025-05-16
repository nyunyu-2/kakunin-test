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
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);

        $contact = $request->only(['last_name','first_name','gender', 'email', 'tel1','tel2', 'tel3','address','building','category_id', 'detail']);
        return view('confirm', ['contact' => $contact]);
    }

    public function store(Request $request)
    {
        $tel = $request->input('tel1') . $request->input('tel2') . $request->input('tel3');

        $contact = $request->only(['last_name','first_name','gender', 'email','address','building','category_id', 'detail']);

        $contact['tel'] = $tel;

        Contact::create($contact);

        return view('thanks');
    }



}
