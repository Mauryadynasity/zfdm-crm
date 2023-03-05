<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdditionalOption;
use App\Models\Offer;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use Hash;
use DataTables;
use PDF;
class OfferController extends Controller {

	public function __construct() {

		// $this->middleware('auth:admin');
	}

	function invoice(){
		$data = ['title' => 'Welcome to ItSolutionStuff.com'];
		$pdf = PDF::loadView('admin.invoice', $data);
		return $pdf->download('itsolutionstuff.pdf');
	}

	public function saveOffer(Request $request) {
		// dd($request->all());
		$validator = Validator::make($request->all(), [
            'number_of_employee' => 'required',
            'number_of_advised' => 'required',
            'piece_prise' => 'required',
            'prise' => 'required',
            'an_notation' => 'required',
            'additional_option_id' => 'required',
        ]);
		if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['message' => $error, 'status' => false]);
			// return response()->json($validator->messages(), 200);
		}
		
			 Offer::create(
				[
				'admin_id' => Auth::guard('admin')->user()->id,
				'additional_option_id' => $request->additional_option_id,
				'prospact_id' => $request->prospact_id,
				'number_of_employee' => $request->number_of_employee,
				'number_of_advised' => $request->number_of_advised,
				'piece_prise' => $request->piece_prise,
				'prise' => $request->prise,
				'an_notation' => $request->an_notation,
				]
			);

        	return response()->json(['message' => 'Offer has been created', 'status' => true]);
	}
}

?>