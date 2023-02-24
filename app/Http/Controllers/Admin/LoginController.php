<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\LoginRequest;;
use Illuminate\Http\Request;
use App\Http\Requests\Users\ChangePassRequest;
use App\Models\User;
use App\Admin;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

	// Function for admin login
	// public function index(Request $request){
	// 		return view('admin.admin');
		
	// }
	public function login(Request $request){
		// dd($request->all());
		$request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
		$user = Admin::where('email',$request->email)->first();
			if(!$user){
				return redirect()->back()->with('fail', 'Please provide valid email and password !');
			}	
        $credentials = $request->only('email', 'password');
		if (Auth::guard('admin')->attempt($credentials)) {
			return redirect('admin/dashboard');
		}else {
			return redirect()->back()->with('fail', 'Please provide valid email and password !');
		}
	}
	// Function for admin logout
	public function logout(Request $request) {
		Auth::guard('admin')->logout();
		return redirect('/admin');
	}
	// Function for change password
	public function changePassword(Request $request) {
		return view('admin.change_password');
	}
	// Function for change password save
   public function changePasswordSave(ChangePassRequest $request){
    $admin = Admin::where(['email' => Auth::guard('admin')->user()->email])->first();
       $data = array(
        'password'=> \Hash::make($request->new_pass),
       );
        if($admin){
            Admin::where('email', $admin->email)->update($data);
           return redirect()->back()->with('message', 'Password changed successfully.');
        }
    }
   public function getUserList(Request $request){
		$adminList = Admin::where('role',$request->admin_type)->get();
		$txt = '';
		if($request->admin_type==2){
			$txt = '<option value="">Select</option>';
		}
		foreach($adminList as $admin){
			$txt .= '<option value="'.$admin->email.'">'.$admin->name.'</option>';
		}
		return $txt;
    }

}
