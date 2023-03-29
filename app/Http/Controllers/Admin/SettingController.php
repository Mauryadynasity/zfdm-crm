<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use Hash;
use DataTables;
class SettingController extends Controller {

	public function __construct() {

		// $this->middleware('auth:admin');
	}
	public function index(Request $request) {
    	$data['setting'] = Setting::where('admin_id',Auth::guard('admin')->user()->id)->orderBy('id','DESC')->first();
		return view('admin.setting',$data);
	}

	public function saveSetting(Request $request) {
		// dd($request->all());
		$validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'person_name' => 'required',
            'website_url' => 'required|url',
            // 'upload_file' => 'required',
            'phone' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'ust_number' => 'required',
            'bank_name' => 'required',
            'ifsc_code' => 'required',
            'account_number' => 'required',
            'branch_address' => 'required',
            'tax_number' => 'required',
            'streat_name_1' => 'required',
            'place_code' => 'required',
            'place_name' => 'required',
            'country' => 'required',
        ]);
		if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['message' => $error, 'status' => false]);
			// return response()->json($validator->messages(), 200);
		}

				$addsetting = Setting::updateOrCreate(
				[	
					'admin_id' => $request->admin_id,
				],[
					'admin_id' => $request->admin_id,
					'company_name' => $request->company_name,
					'person_name' => $request->person_name,
					'website_url' => $request->website_url,
					'phone' => $request->phone,
					'email' => $request->email,
					'ust_number' => $request->ust_number,
					'bank_name' => $request->bank_name,
					'account_number' => $request->account_number,
					'ifsc_code' => $request->ifsc_code,
					'branch_address' => $request->branch_address,
					'tax_number' => $request->tax_number,
					'mobile_number' => $request->mobile_number,
					'landline_number' => $request->landline_number,
					'streat_name_1' => $request->streat_name_1,
					'streat_name_2' => $request->streat_name_2,
					'streat_name_3' => $request->streat_name_3,
					'place_code' => $request->place_code,
					'place_name' => $request->place_name,
					'country' => $request->country,
					'tax_identification_no' => $request->tax_identification_no,
				]
			);
		if($request->upload_file){
			$addsetting->addMediaFromRequest('upload_file')->toMediaCollection('upload_file');
		}
        return response()->json(['message' => 'Configuration has been saved', 'status' => true]);
		// return back()->with('message','Configuration Successfully.');
		// return view('admin.setting');
	}
}

?>