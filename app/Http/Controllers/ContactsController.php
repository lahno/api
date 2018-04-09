<?php

namespace App\Http\Controllers;

use App\Model\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function contacts()
    {
        $contacts = Contact::all();

        return view('auth.contacts')->with('contacts', $contacts);
    }
}
