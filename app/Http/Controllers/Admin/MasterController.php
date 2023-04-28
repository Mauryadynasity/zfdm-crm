<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\StatusMaster;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use Hash;
use DataTables;
class MasterController extends Controller {

	public function __construct() {

		// $this->middleware('auth:admin');
	}
	public function index(Request $request) {
		$data['status_master'] = StatusMaster::all();
    	$data['setting'] = Setting::where('admin_id',Auth::guard('admin')->user()->id)->orderBy('id','DESC')->first();
		return view('admin.master.status-master',$data);
	}

    public function saveStatus(Request $request){
        StatusMaster::Create(
            [	
                'status' => $request->status,
                'color' => $request->color,
            ]
        );
        return response()->json(['message' => 'Status has been saved', 'status' => true]);

    }

	public function saveColorSetting(Request $request){
		$updateStatusColor  = [];
		foreach($request->status as $index=>$row){
				$updateStatusColor = array(
				'color' => $request->color[$index],
			);
			StatusMaster::updateOrCreate(['status'=>$row],$updateStatusColor);
			}
		return response()->json(['message' => 'Color has been saved', 'status' => true]);

	}


	
}

?>