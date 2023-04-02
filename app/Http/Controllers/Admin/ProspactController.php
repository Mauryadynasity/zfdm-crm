<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prospact;
use App\Models\Permission;
use App\Models\StatusMaster;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DataTables;

class ProspactController extends Controller {

	public function __construct() {

		// $this->middleware('auth:admin');
	}
	public function addProspact(Request $request) {
		return view('admin.prospact.add-prospact');
	}
	public function saveProspact(Request $request) {
		// dd($request->all());
        // $request->validate([
        //     'cust_name' => 'required',
        //     'company_name' => 'required',
        //     'cust_email' => 'required|email',
        //     'cust_phone' => 'required|numeric',
        //     'date_of_contact' => 'required',
        // ]);

			Prospact::Create(
				[	
					'cust_name' => $request->cust_name,
					'company_name' => $request->company_name,
					'cust_email' => $request->cust_email,
					'cust_phone' => $request->cust_phone,
					'date_of_contact' => $request->date_of_contact,
					'street_name' => $request->street_name,
					'post_code' => $request->post_code,
					'place_name' => $request->place_name,
					'wants_offer' => $request->wants_offer,
					'no_employee' => $request->no_employee,
					'no_device' => $request->no_device,
					'device_type' => $request->device_type,
					'callback' => $request->callback,
					'status' => $request->status,
					'news' => $request->news,
					'protocol' => $request->protocol,
					'cust_source' => Auth::guard('admin')->user()->id,
					'admin_id' => Auth::guard('admin')->user()->id,
				]
			);
		return redirect('admin/user-dashboard')->with('message','Prospact Added Successfully.');
	}

	public function editProspact($id) {
		$data['StatusMaster'] = StatusMaster::all();
		$data['prospact'] = Prospact::where('id',$id)->first();
		$data['permissions'] = Permission::where('module_name','prospect')->where('status','yes')->get();
		return view('admin.prospact.edit-prospact',$data);
	}

	public function updateProspact(Request $request) {
		// dd($request->all());
        $request->validate([
            'cust_name' => 'required',
            'company_name' => 'required',
            'cust_email' => 'required|email',
            'cust_phone' => 'required|numeric|digits:10',
            'date_of_contact' => 'required',
        ]);

			 Prospact::where('id',$request->prospact_id)->update(
				[	
					'cust_name' => $request->cust_name,
					'company_name' => $request->company_name,
					'cust_email' => $request->cust_email,
					'cust_phone' => $request->cust_phone,
					'date_of_contact' => $request->date_of_contact,
					'street_name' => $request->street_name,
					'post_code' => $request->post_code,
					'place_name' => $request->place_name,
					'wants_offer' => $request->wants_offer,
					'no_employee' => $request->no_employee,
					'no_device' => $request->no_device,
					'device_type' => $request->device_type,
					'callback' => $request->callback,
					'status' => $request->status,
					'news' => $request->news,
					'protocol' => $request->protocol,
				]
			);
		return redirect('admin/user-dashboard')->with('message','Prospact Updated Successfully.');
	}

	public function destroy($id){
		Prospact::where(['id'=>$id])->delete();
		 return back()->with('fail','Deleted Successfully.');

	}
}

?>