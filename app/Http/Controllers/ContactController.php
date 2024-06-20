<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $address = Content::where('type', 'address')->get();
        $phone = Content::where('type', 'phone')->get();
        $email = Content::where('type', 'email')->get();
        $title = 'Contact';
        return view('layouts.contact', compact('address', 'title', 'phone', 'email'));
    }
}
