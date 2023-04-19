<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Admin;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use Hash;
use DataTables;
class UserController extends Controller {

	public function __construct() {

		// $this->middleware('auth:admin');
	}

	public function index(Request $request) {
		$data['users'] = Admin::all();
		$data['roles'] = Role::all();
		return view('admin.user.user-list',$data);
	}

	public function create(Request $request){
			$data['roles'] = Role::get();
			return view('admin.user.user_add',$data);
	}

	public function store(Request $request){
		// dd($request->all());
		$request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:tbl_users',
            'phone' => 'required|numeric|digits:10',
            'role_id' => 'required',
            'password' => 'required',
        ],
        [
            'role_id.required' => 'Role field is required',

        ]);
		$adduser = new Admin;
		$adduser->name = $request->name;
		$adduser->email = $request->email;
		$adduser->phone = $request->phone;
		$adduser->role_id = $request->role_id;
		$adduser->password = $request->password;
		$adduser->save();
		 return back()->with('message','User Added Successfully.');
	}

	public function show($id){
		$data['roles'] = Role::get();
		$data['users'] = Admin::where('id',base64_decode($id))->first();
			return view('admin.user.user_edit', $data);
	}
	public function update(Request $request,$id){
		$request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'role_id' => 'required',
        ],
        [
            'role_id.required' => 'Role field is required',

        ]);
		
		$user = Admin::where(['id'=>$id])->update($request->except('profile_img','_token','_method','password'));
		 return redirect()->route('user.index')->with('message','User Updated Successfully.');
	}

	public function destroy($id){
		Admin::where(['id'=>$id])->delete();
		 return back()->with('fail','Deleted Successfully.');

	}

}

?>