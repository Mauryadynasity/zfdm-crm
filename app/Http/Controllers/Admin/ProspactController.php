<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prospact;
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
        $request->validate([
            'cust_name' => 'required',
            'company_name' => 'required',
            'cust_email' => 'required|email',
            'cust_phone' => 'required|numeric',
            'date_of_contact' => 'required',
        ]);

			Prospact::Create(
				[	
					'cust_name' => $request->cust_name,
					'company_name' => $request->company_name,
					'cust_email' => $request->cust_email,
					'cust_phone' => $request->cust_phone,
					'date_of_contact' => $request->date_of_contact,
					'cust_address' => $request->cust_address,
					'cust_source' => Auth::guard('admin')->user()->id,
				]
			);
		return redirect('admin/user-dashboard')->with('message','Prospact Added Successfully.');
	}

	public function editProspact($id) {
		$data['prospact'] = Prospact::where('id',$id)->first();
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