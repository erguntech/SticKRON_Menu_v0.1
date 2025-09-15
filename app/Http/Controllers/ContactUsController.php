<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('pages.contact_us.contact_us_index');
    }

    public function sendMessage(ContactRequest $request)
    {
        Mail::to(settings()->get('app_email'))->send(new ContactMail([
            'user_name' => Auth::user()->getUserFullName(),
            'message' => $request['input-message_content']
        ]));

        return redirect()->route('Contact.Index')
            ->with('result','success')
            ->with('title', "İşlem Başarılı!")
            ->with('content', "Mesajınız başarı ile gönderildi.");
    }
}
