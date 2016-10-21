<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\MailMan;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function submit(ContactRequest $request, MailMan $mailer)
    {
        $mailer->sendContactEmail($request->all());

        return redirect()->route('contact-thank-you');
    }

    public function thankYou()
    {
        return view('contact.thank-you');
    }
}
