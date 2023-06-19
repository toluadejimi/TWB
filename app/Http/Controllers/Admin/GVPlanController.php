<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ItemLogImport;
use Illuminate\Http\Request;
use App\Models\Plan;
use Auth;
use Maatwebsite\Excel\Facades\Excel;

class GVPlanController extends Controller
{

    
    public function store(Request $request){
        
 
        $request->validate([
            'file_upload' => 'required|max:10000|mimes:xlsx,xls',
        ]);
    
        $path = $request->file('file_upload');
    
        Excel::import(new ItemLogImport, $path);     

        

        return response()->json([
            'redirect' => route('admin.plan.index'),
            'message'  => __('Log created successfully.')
        ]);

       
    }
}
