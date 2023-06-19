<?php

namespace App\Http\Controllers;

use App\Mail\AdminMail;
use App\Models\ItemLog;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sold;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Facades\Redirect;
use Mail;
use MercadoPago\Item;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class ProductController extends Controller
{


    public function fund_now(request $request)
    {

        $key = env('WEBKEY');
        $ref = "TWB-" . random_int(100000, 999999);

        $url = "https://web.enkpay.com/pay?amount=$request->amount&key=$key&ref=$ref&email=$request->email";


        $trx = new Transaction();
        $trx->amount = $request->amount;
        $trx->user_id = Auth::id();
        $trx->status = 0;
        $trx->trx_ref = $ref;
        $trx->type = 2;
        $trx->save();


        return Redirect::to($url);
    }

    public function verify_trx(request $request)
    {



        $trx_id = $request->trans_id;
        $amount = $request->amount;
        $status = $request->status;

        // dd("hello");

        if ($status == 'success') {
            $getx =  Transaction::where('trx_ref', $trx_id)->where('status', 0)->first() ?? null;

            if ($getx != null) {

                User::where('id', Auth::id())->increment('wallet', $amount);
                Transaction::where('trx_ref', $trx_id)->where('status', 0)->update(['status' => 1]);

            


                $usr = User::where('id', Auth::id())->first() ?? null;

                if($usr->email != null){

                    $data = array(
                        'fromsender' => 'admin@oprime.com.ng', 'Oprime',
                        'subject' => "Wallet Funded",
                        'toreceiver' => Auth::user()->email,
                        'amount' => $amount,
                        'name' => Auth::user()->name,
    
    
    
                    );
    
    
                    Mail::send('mails.fund', ["data1" => $data], function ($message) use ($data) {
                        $message->from($data['fromsender']);
                        $message->to($data['toreceiver']);
                        $message->subject($data['subject']);
                    });

                }

              

                return redirect('user/dashboard')->with('message', "Wallet has been funded with $amount");
            }
        }


        if ($status == 'failed') {

            Transaction::where('trx_ref', $trx_id)->where('status', 0)->update(['status' => 2]);


       

            return redirect('user/dashboard')->with('error', 'Transaction Declined');
        }

        return redirect('user/dashboard')->with('error', 'Transaction Declined');
    }






    public function buyNow(request $request)
    {



        $amount = $request->amount ?? 0;



        if ($amount > Auth::user()->wallet) {

            return redirect('user/dashboard')->with('error', 'Insufficient Balance, Fund your wallet');

        }

        if ($amount > Auth::user()->wallet) {
            return response()->json([
                'redirect' => route('dashboard'),
                'message'  => __('.')
            ]);
        }

        if ($amount == null || $amount == 0) {
            return back()->with('error', 'Please wait try reload your browser and try again');
        }


        $usr = User::where('id', Auth::id())->first() ?? null;

        $get_user_Wallet = User::where('id', Auth::id())->first()->wallet ?? null;


        if ($get_user_Wallet == null) {
            return back()->with('error', 'Please wait try reload your browser and try again');
        }



        if ($amount > $get_user_Wallet) {

            return response()->json([
                'redirect' => route('dashboard'),
                'message'  => __('Insufficient Balance, Fund your wallet.')
            ]);

        } else {

                User::where('id', Auth::id())->decrement('wallet', $amount);

            $pr = ItemLog::where('id', $request->area_code)->first();

            $trx_ref = "TRX - " . random_int(1000000, 9999999);
            $trx = new Transaction();
            $trx->trx_ref = $trx_ref;
            $trx->user_id = Auth::id();
            $trx->amount = $pr->price;
            $trx->type = 1;
            $trx->status = 1;
            $trx->save();



            $sold = new Sold();
            $sold->user_id = Auth::id();
            $sold->area_code = $pr->area_code;
            $sold->amount = $pr->price;
            $sold->data = $pr->data;
            $sold->save();


            $order = new Order();
            $order->order_id = "TRX - " . random_int(1000000, 9999999);
            $order->user_id = Auth::id();
            $order->amount = $pr->price;
            $order->save();


          

            ItemLog::where('id', $request->area_code)->delete();



            //send mail
            $data = array(
                'fromsender' => 'admin@oprime.com.ng', 'Oprime',
                'subject' => "LOG Purchase",
                'toreceiver' => Auth::user()->email,
                'logdata' => $pr->data,
                'area_code' => $pr->area_code,
                'name' => Auth::user()->name,



            );



            Mail::send('mails.log', ["data1" => $data], function ($message) use ($data) {
                $message->from($data['fromsender']);
                $message->to($data['toreceiver']);
                $message->subject($data['subject']);
            });


        
                $details = [
                    'subject' => 'Something bought',
                    'name' => $data['toreceiver'],
                    'data'=> $data['logdata']
                    ];
                    


      
            FacadesMail::to('yekeenoluwaseun0001@gmail.com')->send(
                new AdminMail($details)


            );
            }
            



            return redirect('user/dashboard')->with('message', "Log purchase successful");


        return back()->with('error', "Insufficient Balance, Fund your wallet");
    }

    public function areacode(Request $request)
    {
        $data['states'] = ItemLog::where("item_id", $request->item_id)
            ->get(["area_code", "id"]);

        return response()->json($data);
    }




    /**
     * Write code on Method
     *
     * @return response()
     */
    public function amount(Request $request)
    {
        $data['cities'] = ItemLog::where("id", $request->id)
            ->get(["price", "id"]);

        return response()->json($data);
    }

    // }
}
