<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ContactUS;
use App\House;
use Mail;

class ContactUSController extends Controller
{
    public function contactUS(House $house)
    {
        return view('contactUS', compact('house'));
    }
    /** * Show the application dashboard. * * @return \Illuminate\Http\Response */
    public function contactUSPost(Request $request, House $house)
    {

        $this->validate($request, 
        [ 
            'house_id' => 'required',
            'email' => 'required|email',
            'message' => 'required'
             ]);
        ContactUS::create($request->all());

        Mail::send(
            'email',
            array(
                'house_id' => $house->id,
                'email' => $request->get('email'),
                'user_message' => $request->get('message')
            ),
            function ($message) {
                $message->from('from@example.com');
                $message->to('questamailnonmiserveaniente@gmail.com', 'Admin')->subject('Cloudways Feedback');
            }
        );

        return back()->with('success', 'Thanks for contacting us!');
    }
}
