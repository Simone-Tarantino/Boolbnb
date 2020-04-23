<?php

namespace App\Http\Controllers\Admin;
use App\House;
use App\ContactUS;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::id();

        $results = DB::table('houses')
            ->join('contactus', 'houses.id', '=', 'contactus.house_id')
            // ->join('users', 'houses.id', '=', 'users.id')
            ->where('user_id', '=', $user)
            ->orderBy('contactus.created_at', 'desc')
            ->get();


        return view('admin.messages.index', compact('results'));
    }

    // public function show(Contactus $result)
    // {
    //     $user = Auth::id();

    //     dd($user);

    //     if (empty($result)) {
    //         abort('404');
    //     }

    //     return view('admin.messages.show', compact('result'));
    // }
}
