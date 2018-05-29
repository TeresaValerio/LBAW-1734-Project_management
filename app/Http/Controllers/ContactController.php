<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{

    public function addContact(Request $request)
{
    $userId = auth()->user()->id;

    $contact=Contact::create([
        'id_user' => $request->get('contact1'),
        'id_contact' => $request->get('contact2')
    ]);
}
}
