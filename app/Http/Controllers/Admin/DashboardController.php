<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Prospect;
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
		// $data['prospacts'] = Prospect::all();
		return view('admin.dashboard');
	}
	public function userDashboard(Request $request) {
		$data['adminDetails'] = Setting::where('admin_id',Auth::guard('admin')->user()->id)->first();
		$data['AdditionalOptions'] = AdditionalOption::all();
		$data['prospacts'] = Prospect::all();
		return view('admin.user-dashboard',$data);
	}	

	public function addNewOffer(Request $request) {
		$data['AdditionalOptions'] = AdditionalOption::all();
		$data['adminDetails'] = Setting::where('admin_id',Auth::guard('admin')->user()->id)->first();
		$returnHTML = view('admin.offer.add-new-offer')->with($data)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
	}	

}

?>