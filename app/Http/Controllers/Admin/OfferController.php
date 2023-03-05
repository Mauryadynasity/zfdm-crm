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
class OfferController extends Controller {

	public function __construct() {

		// $this->middleware('auth:admin');
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
					'admin_id' => $request->admin_id,
					'additional_option_id' => $request->additional_option_id,
					'prospact_id' => $request->prospact_id,
					'number_of_employee' => $request->number_of_employee,
					'number_of_advised' => $request->number_of_advised,
					'piece_prise' => $request->piece_prise,
					'prise' => $request->prise,
					'an_notation' => $request->an_notation,
				]
			);

$pdf = PDF::loadView('admin.invoice', $data);
return $pdf-&gt;download('itsolutionstuff.pdf');

    	// 	 $request->paper_size = 'a4';
		//  $dataPdf = [];
        // if($request->paper_size!=null){
		// 	$data['download'] = 'pdf';
        //     $htmlfile = view('admin.invoice', $dataPdf)->render();
		// 	$pdf = app()->make('dompdf.wrapper');
		// 	$pdf->loadHTML($htmlfile,'UTF-8')
		// 	->setWarnings(false)
		// 	->setPaper($request->paper_size, 'landscape');
        //     return $pdf->download('Invoice.pdf');
        // }


        	return response()->json(['message' => 'Offer has been created', 'status' => true]);
		// return back()->with('message','Configuration Successfully.');
		// return view('admin.setting');
	}
}

?>