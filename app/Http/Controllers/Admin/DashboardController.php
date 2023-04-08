<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Prospact;
use App\Models\Permission;
use App\Models\StatusMaster;
use App\Models\AdditionalOption;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use Hash;
use DataTables;
class DashboardController extends Controller {

	public function __construct() {

		// $this->middleware('auth:admin');
	}
	// Function for admin dashboard

	public function dashboard(Request $request) {
		// $data['prospacts'] = Prospact::all();
		return view('admin.dashboard');
	}
	public function userDashboard(Request $request) {
		// dd($request->all());
		if($request->status_filter){
			$prospacts = Prospact::where('status',$request->status_filter)->get();
		}else{
			$prospacts = Prospact::where('cust_source',Auth::guard('admin')->user()->id)->get();
		}
		// if(!empty($request->from_date && $request->to_date)){
		// 	$from_date = $request->from_date;
		// 	$to_date = $request->to_date;
		// 	$prospacts = DB::table('tbl_prospects')
		// 		->whereBetween('created_at', [$from_date, $to_date])
		// 		->get();
		// }else{
		// 	$prospacts = Prospact::where('cust_source',Auth::guard('admin')->user()->id)->get();
		// }
		$settingDetails = Setting::first();
		$StatusMaster = StatusMaster::all();
		$quotations = Prospact::has('quotations')->get();
		$permissions = Permission::where('module_name','prospect')
		// ->where('status','yes')
		->get();
		return view('admin.user-dashboard',compact('settingDetails','prospacts','permissions','StatusMaster','quotations'));
	}	

	public function addNewOffer(Request $request) {
		$data['AdditionalOptions'] = AdditionalOption::all();
		$data['settingDetails'] = Setting::first();
		$returnHTML = view('admin.offer.add-new-quotation')->with($data)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
	}	

}

?>