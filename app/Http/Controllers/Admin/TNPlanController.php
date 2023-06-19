<?php

use App\Http\Controllers\Controller;
use App\Imports\ItemLogImport;
use Illuminate\Http\Request;
use App\Models\Plan;
use Auth;
use Maatwebsite\Excel\Facades\Excel;

class TNPlanController extends Controller
{
    public function store(Request $request){
        
        Excel::import(new ItemLogImport, $request->file);

        return response()->json([
            'redirect' => route('admin.plan.index'),
            'message'  => __('Log created successfully.')
        ]);
        
    }
}
