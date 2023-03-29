<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\Prospact;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use Hash;
use DataTables;
use PDF;
class QuotationController extends Controller {

	public function __construct() {

		// $this->middleware('auth:admin');
	}

	// function invoice(){
	// 	$data = ['title' => 'Welcome to ItSolutionStuff.com'];
	// 	$pdf = PDF::loadView('admin.invoice', $data);
	// 	return $pdf->download('itsolutionstuff.pdf');
	// }

	public function quotationList(){
		$quotations = Prospact::has('quotations')->get();
		return view('admin.offer.quotation-list',compact('quotations'));
	}

	public function saveQuotation(Request $request) {
		// dd($request->quotation_number);
		$validator = Validator::make($request->all(), [
            'article_description' => 'required',
            'number_of_article' => 'required',
            'prise_per_article' => 'required',
            'price' => 'required',
            'quotation_number' => 'required',
            'comments' => 'required',
            // 'additional_option_id' => 'required',
        ]);
		if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['message' => $error, 'status' => false]);
			// return response()->json($validator->messages(), 200);
		}
		$saveQuotation  = [];
		foreach($request->article_description as $index=>$row){
			if($request->article_description[$index]!=''){
				$saveQuotation[] = array(
					'admin_id' => Auth::guard('admin')->user()->id,
				  'prospact_id' => $request->prospact_id,
				  'number_of_position' => ($index+1),
				  'article_description' => $request->article_description[$index],
				  'number_of_article' => $request->number_of_article[$index],
				  'prise_per_article' => $request->prise_per_article[$index],
				  'price' => $request->price[$index],
				  'quotation_number' => $request->quotation_number,
				  'quotation_date' => $request->quotation_date,
				  'sub_total' => $request->sub_total,
				  'ust_number' => $request->ust_number,
				  'grand_total' => $request->grand_total,
				  'comments' => $request->comments,
			  );
			}
		}
		Quotation::insert($saveQuotation);
    	return response()->json(['message' => 'Quotation has been created', 'status' => true]);
	}

	public function getOfferDetail(Request $request){
		$prospacts = Prospact::where('id',$request->prospact_id)->first();
		return $prospacts;
        // return response()->json(array('success' => true, 'prospacts'=>$prospacts));
	}

	public function viewQuotation($quotationId){
		$prospact = Prospact::where('id',$quotationId)->first();
		return view('admin.offer.view-quotation',compact('prospact'));
	}
	public function editQuotation($quotationId){
		$prospact = Prospact::where('id',$quotationId)->first();
		return view('admin.offer.edit-quotation',compact('prospact'));
	}

	public function updateQuotation(Request $request) {
		$validator = Validator::make($request->all(), [
            // 'number_of_position' => 'required',
            'article_description' => 'required',
            'number_of_article' => 'required',
            'prise_per_article' => 'required',
            'price' => 'required',
            // 'quotation_number' => 'required',
            'comments' => 'required',
        ]);
		// dd($request->all());
		if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['message' => $error, 'status' => false]);
			// return response()->json($validator->messages(), 200);
		}
		$updateQuotation  = [];
		foreach($request->number_of_position as $index=>$position){
			$updateQuotation = array(
			  	'admin_id' => Auth::guard('admin')->user()->id,
				'prospact_id' => $request->prospact_id,
				'number_of_position' => $position,
				'article_description' => $request->article_description[$index],
				'number_of_article' => $request->number_of_article[$index],
				'prise_per_article' => $request->prise_per_article[$index],
				'price' => $request->price[$index],
				'quotation_number' => $request->quotation_number,
				'quotation_date' => $request->quotation_date,
				'sub_total' => 10,
				'ust_number' => 121,
				'grand_total' => 30,
				'comments' => $request->comments,
			);
		Quotation::updateOrCreate(['number_of_position'=>$position],$updateQuotation);
		}
		return back()->with('message','Quotation Updated Successfully.');
	}

	public function destroy($id){
		Quotation::where('prospact_id',$id)->delete();
		return back()->with('fail','Deleted Successfully.');

	}
}

?>