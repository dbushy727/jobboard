<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\MailMan;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $title = 'Contact';
        $description = 'Send us a message, we would love to hear it. Just fill our the contact form and we will get back to you as soon as possible.';
        return view('contact.index', compact('title', 'description'));
    }

    public function submit(ContactRequest $request, MailMan $mailer)
    {
        $mailer->sendContactEmail($request->all());

        return redirect()->route('contact-thank-you');
    }

    public function thankYou()
    {
        $title = 'Contact - Thank You';
        $description = 'Thank you for your submission. We will get back to you as soon as possible.';
        return view('contact.thank-you', compact('title', 'description'));
    }
}
