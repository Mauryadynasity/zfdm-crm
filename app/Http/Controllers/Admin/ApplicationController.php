<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Admin;
use App\Models\User;
use App\Models\Application;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use Hash;
use DataTables;
class ApplicationController extends Controller {

	public function __construct() {

		// $this->middleware('auth:admin');
	}
	// Function for admin dashboard

	public function index(Request $request) {
		// dd($request->all());
		if ($request->ajax()) {
			$admin = Auth::guard('admin')->user();
			// dd($admin);
			if($admin->role ==2){
			$userData = User::where('district',$admin->district_id)->first();
			$application = Application::where('user_id',$userData->id)->where('status','approved')->get();
		}else{
			$application = Application::where('deleted_at',null)->get();
		}
        return Datatables::of($application)->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a href="'.url("admin/application/".base64_encode($row->id)).'" class="edit btn btn-success btn-sm">Edit</a>
                 <a href="javascript:void(0)" id="'.$row->id.'"  class="delete btn btn-danger btn-sm">Delete</a>
                 ';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
				return view('admin.application.show-application');
	}

	public function create(Request $request){
			return view('admin.user.user_add');
	}

	public function store(Request $request){
		// dd($request->all());
		$request->validate([
            // 'owner_name' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
		$request->request->add([
			'password' => \Hash::make($request->password),
			// 'profile_image' => UplaodImages($request->profile_img, 'profile_image'),
		]);
		$data = Admin::create($request->except(['profile_img']));
		return true;
		 // return redirect()->route('user.index')->with('message','User Added Successfully.');
	}

	public function show($id){
		$data['users']=Application::where('id',base64_decode($id))->first();
			return view('admin.application.edit-application', $data);
	}
	public function update(Request $request,$id){
		$applicationData = Application::find($id);
		$applicationData->save();
		if($applicationData->id){
			if($request->upload_file){
				$applicationData->addMediaFromRequest('upload_file')->toMediaCollection('upload_file');
			}
		}
		$application = Application::where(['id'=>$id])->update($request->except('upload_file','_token','_method'));
		 return redirect()->route('application.index')->with('message','Statu Updated Successfully.');
	}

	public function destroy($id){
		Application::where(['id'=>$id])->delete();
	}

}

?>