<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Mail\NewSiteContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller {
    public function store(Request $request) {
        $data = $request->validate([
            "name" => "nullable|string",
            "email" => "required|email",
            "message" => "required|string",
            "attachment" => "nullable"
        ]);

        $newContact = new Contact();
        $newContact->fill($data);

        if(key_exists("attachment", $data)){
            $newContact->attachment = Storage::put("contactAttachment", $data["attachment"]);
        };

        $newContact->save();

        // permette l'invio della mail
        Mail::to("admin@gmail.com")->send(new NewSiteContactMail($newContact));

        // ritornare il contatto appena creato sotto forma di JSON
        return response()->json($newContact);
    }
}
