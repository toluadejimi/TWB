<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Sold;
use Illuminate\Http\Request;
use App\Models\Smstransaction;
use Carbon\Carbon;
use Auth;
class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        
        $solds = Sold::where('user_id', Auth::id())->latest()->paginate('10');
        $total_sold = Sold::where('user_id', Auth::id())->count();
        $total_amount = Sold::where('user_id', Auth::id())->sum('amount');





        return view('user.log.index',compact('solds','total_sold','total_amount','request'));
    }

}
