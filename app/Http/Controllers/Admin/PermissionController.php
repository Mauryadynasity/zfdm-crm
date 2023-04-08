<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use Hash;
use DataTables;
use PDF;
class PermissionController extends Controller {

	public function __construct() {

		// $this->middleware('auth:admin');
	}
	public function prospectPermission(Request $request){
        $permissions = Permission::where('module_name','prospect')->get();
		return view('admin.permission.prospect-permission',compact('permissions'));
	}
	public function savePermission(Request $request){
		Permission::where('status','yes')->update(['status' => 'no']);
			Permission::whereIn('id',$request->id)->update(['status' => 'yes']);
			return back()->with('message','Permitted Applied Successfully.');

	}
}

?>