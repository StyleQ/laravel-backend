<?php

namespace App\Contact\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class ContactController extends Controller
{


    public function __construct()
    {

    }

    /**
     * Submit the contact form.
     *
     * @return \Illuminate\Http\Response
     */
    public function postSubmit()
    {
        $rules = [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            'message'    => 'required',
        ];

        }

        Mailer::send($input['first_name'], $input['last_name'], $input['email'], $input['message']);

        return Redirect::to('/')->with('success', 'Your message was sent successfully. Thank you for contacting us.');
    }
}
