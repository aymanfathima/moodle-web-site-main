<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {

        return view('home');
    }

    public function contact()
    {
        return view('contact');
    }

    public function add_contact_us(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $data = $request->all();
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $contact = new \App\Models\ContactUs();
        $contact->fill($data);
        $contact->save();

        return redirect()->back()->with('success', 'Contact Us added successfully');
    }
}