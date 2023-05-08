<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prospact;
use App\Models\Protocol;
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
	public function internetProspectForm(Request $request) {
		$StatusMaster = StatusMaster::all();
		$permissions = Permission::where('module_name','prospect')->where('status','yes')->get();
		return view('admin.prospact.internet-prospect',compact('permissions','StatusMaster'));
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
					'supply_street' => $request->supply_street,
					'supply_post_code' => $request->supply_post_code,
					'supply_place' => $request->supply_place,
					'no_employee' => $request->no_employee,
					'no_device' => $request->no_device,
					'device_type' => $request->device_type,
					'status' => $request->status,
					'news' => $request->news,
					'protocol' => $request->protocol,
					'cust_source' => $request->cust_source,
					'invoice_address' => $request->invoice_address,
					'supply_address' => $request->supply_address,
					'supply_address_checked' => $request->supply_address_checked,
				
				]
			);
					return response()->json(['message' => 'Prospect Added Successfully!', 'status' => true]);
	}

	public function editProspact($id) {
		$data['StatusMaster'] = StatusMaster::all();
		$data['prospact'] = Prospact::where('id',$id)->first();
		$data['permissions'] = Permission::where('module_name','prospect')->where('status','yes')->get();
		return view('admin.prospact.edit-prospact',$data);
	}

	public function updateProspact(Request $request) {
		// dd($request->all());
        // $request->validate([
        //     'cust_name' => 'required',
        //     'company_name' => 'required',
        //     'cust_email' => 'required|email',
        //     'cust_phone' => 'required|numeric|digits:10',
        //     'date_of_contact' => 'required',
        // ]);

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
					'supply_street' => $request->supply_street,
					'supply_post_code' => $request->supply_post_code,
					'supply_place' => $request->supply_place,
					'no_employee' => $request->no_employee,
					'no_device' => $request->no_device,
					'device_type' => $request->device_type,
					'status' => $request->status,
					'news' => $request->news,
					'protocol' => $request->protocol,
					'invoice_address' => $request->invoice_address,
					'supply_address' => $request->supply_address,
					'supply_address_checked' => $request->supply_address_checked,
				]
			);
			return response()->json(['message' => 'Prospect Updated Successfully!', 'status' => true]);
			// return redirect('admin/user-dashboard')->with('message','Prospact Updated Successfully.');
	}

	public function destroy($id){
		$prospact = Prospact::find($id);
		if(!$prospact){
			return back()->with('fail','Invalid Id.');
		}
		$prospact->quotations()->forceDelete();
		$prospact->forceDelete();
		return back()->with('fail','Deleted Successfully.');

	}

	public function isEmailUnique(Request $request){
		$prospect = Prospact::where('cust_email',$request->cust_email)->first();
		if($prospect){
			return 'false';
		}else{
			return 'true';
		}
	}
	public function isPhoneUnique(Request $request){
		$prospect = Prospact::where('cust_phone',$request->cust_phone)->first();
		if($prospect){
			return 'false';
		}else{
			return 'true';
		}
	}
	public function isEmailUniqueEdit(Request $request){
		$prospect = Prospact::where('cust_email',$request->cust_email)
		->whereNotIn('id',[$request->id])
		->first();
		if($prospect){
			return 'false';
		}else{
			return 'true';
		}
	}
	public function isPhoneUniqueEdit(Request $request){
		$prospect = Prospact::where('cust_phone',$request->cust_phone)
		->whereNotIn('id',[$request->id])
		->first();
		if($prospect){
			return 'false';
		}else{
			return 'true';
		}
	}

	public function prospactList(Request $request){
		$toDate = date('Y-m-d', strtotime('+1 day', strtotime($request->toDate)));
		$prospacts = Prospact::whereBetween('created_at', [$request->fromDate, $toDate])->orderBy('id','DESC')->get();
		$permissions = Permission::where('module_name','prospect')->get();
		$returnHTML = view('admin.prospect.prospect-list',compact('prospacts','permissions'))->render();
		return response()->json(array('success' => true, 'html'=>$returnHTML));
	}
	public function getProtocals(Request $request){
		$protocols = Protocol::get();
		$returnHTML = view('admin.prospect.prospect-protocal',compact('protocols'))->render();
		return response()->json(array('success' => true, 'html'=>$returnHTML));
	}
	
	public function saveProtocol(Request $request) {
		dd(Auth::gaurd('admin')->user()->id);
		Protocol::Create(
			[	
				'prospect_id' => 44,
				'admin_id' => Auth::gaurd('admin')->user()->id,
				'messages' => $request->messages,
				'messages' => $request->messages,
			
			]);
				return response()->json(['message' => 'Prospect Added Successfully!', 'status' => true]);
	}

}


?>