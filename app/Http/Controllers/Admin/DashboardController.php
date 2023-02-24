<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prospect;
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
		$data['prospacts'] = Prospect::all();
		return view('admin.user-dashboard',$data);
	}	

}

?>