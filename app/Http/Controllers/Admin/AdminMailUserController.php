<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\UserMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminMailUserController extends Controller
{
    public function index()
    {
        return view('admin.mail.index');
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $users = User::all()->pluck('email')->toArray();
        $details = [
            'subject' => $request->subject,
            'message' => $request->message,
        ];
        foreach($users as $user) {
            Mail::to($user)->send(new UserMail($details));
        }
        
        return back()->with('message', 'Email sent');


    }
}
