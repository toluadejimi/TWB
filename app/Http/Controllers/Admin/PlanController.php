<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ItemLogImport;
use App\Models\ItemLog;
use Illuminate\Http\Request;
use App\Models\Plan;
use Auth;
class PlanController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:subscriptions');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $item_logs=ItemLog::latest()->paginate(20);
        $gv = ItemLog::where('item_id', 1)->count();
        $ipv = ItemLog::where('item_id', 2)->count();
        $exp = ItemLog::where('item_id', 3)->count();
        $tkk = ItemLog::where('item_id', 5)->count();
     


       return view('admin.plan.index',compact('item_logs','gv', 'ipv', 'exp', 'tkk', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        $request->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
        ]);
    
        $path = $request->file('file');
    
        Excel::import(new ItemLogImport, $path);     


        return response()->json([
            'redirect' => route('admin.plan.index'),
            'message'  => __('Log created successfully.')
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = Plan::findorFail($id);
        $chatbot=$plan->data['chatbot'] ?? false;
        $bulk_message=$plan->data['bulk_message'] ?? false;
        $schedule_message=$plan->data['schedule_message'] ?? false;
        $template_message=$plan->data['template_message'] ?? false;
        $access_chat_list=$plan->data['access_chat_list'] ?? false;
        $access_group_list=$plan->data['access_group_list'] ?? false;

        return view('admin.plan.edit',compact('plan','chatbot','bulk_message','schedule_message','template_message','access_chat_list','access_group_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:100',
            'price' => 'required',
            'days'  => 'required',
            'plan_data*' => 'required',
        ]);

        $plan                 = Plan::findorFail($id);
        $plan->title          = $request->title;
        $plan->price          = $request->price;
        $plan->labelcolor     = $request->labelcolor;
        $plan->iconname       = $request->iconname;      
        $plan->is_featured    = isset($request->is_featured) ? 1 : 0;
        $plan->is_recommended = isset($request->is_recommended) ? 1 : 0;
        $plan->is_trial       = isset($request->is_trial) ? 1 : 0;
        $plan->status         = isset($request->status) ? 1 : 0;
        $plan->days           = $request->days ?? 0;
        $plan->trial_days     = $request->trial_days ?? 0;
        $plan->data           = $request->plan_data ?? [];
        $plan->save();

        return response()->json([
            'redirect' => route('admin.plan.index'),
            'message'  => __('Plan updated successfully.')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = Plan::withCount('activeuser')->findorFail($id);
        if ($plan->activeuser_count != 0) {
            return response()->json([
                    'message' =>  __('You cant delete this plan because this plan already useing some users'),
                ], 403);
        }
        $plan->delete();

        return response()->json([
            'redirect' => route('admin.plan.index'),
            'message'  => __('Plan deleted successfully.')
        ]);

    }
}
