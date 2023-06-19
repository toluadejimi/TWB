<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use App\Mail\Creditmail;
use App\Models\Credit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CreditUserController extends Controller
{
    public function index() {
        return view('admin.credit.index');




    }
    
    public function store(Request $request) {

    $request->validate([
        'email'=> 'required |email',
        'amount'=> 'required',
       
    ]);
    $user=User::whereEmail($request->email)->first();
    if($user){
        $amount=(int)$user->wallet+(int)$request->amount;
        User::whereEmail($request->email)->update([
            'wallet'=> $amount
        ]);

        Credit::create([
            'email'=>$request->email, 
            'amount'=>$request->amount,
            'action'=>$request->action


        ]);

        $details=[
            'subject'=>'WALLET FUNDED',
            'body'=>'Your Account has been credited with'.' '.$request->amount.' '.'Your Total Balance is now'. ' '.$amount

        ];
        Mail::to($request->email)->send(new Creditmail($details));
        return back()->with('success','wallet funded');
        
    }  

        else{
            return back()->with('error','user not found');
        }

    }
}
