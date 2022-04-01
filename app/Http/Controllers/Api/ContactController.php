<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller {
    public function store(Request $request) {
        $data = $request->validate([
            "name" => "nullable|string",
            "email" => "required|email",
            "message" => "required|string",
            "attachment" => "nullable|file"
        ]);

        $newContact = new Contact();
        $newContact->fill($data);

        if(key_exists("attachment", $data)){
            $newContact->attachment = Storage::put("contactAttachment", $data["attachment"]);
        };

        $newContact->save();

        // ritornare il contatto appena creato sotto forma di JSON
        return response()->json($newContact);
    }
}
