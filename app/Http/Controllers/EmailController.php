<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Mail\ContactSended;
use App\Page;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send(EmailRequest $request)
    {
    	$form = $request->all();
    	$page = Page::find(1);
		Mail::to($page->contactEmail)
		->send(new ContactSended($form));
    }

}
