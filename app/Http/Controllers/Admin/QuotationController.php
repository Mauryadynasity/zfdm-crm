<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\Prospact;
use App\Models\Setting;
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

	function invoice($prospact_id){
		$data = Prospact::where('id',$prospact_id)->get();
		$data = ['title' =>'sdfsdfsdafdssdsfdsfs'];
		$pdf = PDF::loadView('admin.offer.invoice',$data);
		return $pdf->download('itsolutionstuff.pdf');
	}

	public function quotationList(){
		$quotations = Prospact::has('quotations')->get();
		$settingDetails = Setting::first();
		return view('admin.offer.quotation-list',compact('quotations','settingDetails'));
	}

	public function saveQuotation(Request $request) {
		// dd($request->quotation_number);
		$validator = Validator::make($request->all(), [
            'article_description.*' => 'required',
            'number_of_article.*' => 'required',
            'prise_per_article.*' => 'required',
            'price.*' => 'required',
            'quotation_number' => 'required',
            'comments' => 'required',
            'prospact_id' => 'required',
            // 'additional_option_id' => 'required',
        ]);
		if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['message' => $error, 'status' => false]);
			// return response()->json($validator->messages(), 200);
		}

		$check = Quotation::where('prospact_id',$request->prospact_id)->first();
		if($check){
			return response()->json(['message' => 'Quotation has been created already', 'status' => false]);
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
		$check = Quotation::where('prospact_id',$request->prospact_id)->first();
		if($check){
			return response()->json(['message' => 'Quotation has been created already', 'status' => false]);
		}
		return $prospacts;
        // return response()->json(array('success' => true, 'prospacts'=>$prospacts));
	}

	public function viewQuotation(Request $request,$quotationId){
		$prospact = Prospact::where('id',$quotationId)->first();
		$settingDetails = Setting::first();
		if($request->generate_pdf){
            $htmlfile = view('admin.quotation.view-quotation',compact('prospact','settingDetails'))->render();
            $pdf = app()->make('dompdf.wrapper');
            $pdf->loadHTML($htmlfile,'UTF-8')
			->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif'])
			->setWarnings(false);
            return $pdf->download('TR Report.pdf');
		}
		return view('admin.quotation.view-quotation',compact('prospact','settingDetails'));
	}
	public function editQuotation($quotationId){
		$prospact = Prospact::where('id',$quotationId)->first();
		$settingDetails = Setting::first();
		$returnHTML = view('admin.quotation.edit-quotation-content',compact('prospact','settingDetails'))->render();
		return response()->json(array('success' => true, 'html'=>$returnHTML));
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
		foreach($request->article_description as $index=>$row){
			$position = $index+1;
			if($request->article_description[$index]!=''){
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
				'sub_total' => $request->sub_total,
				'ust_number' => $request->ust_number,
				'grand_total' => $request->grand_total,
				'comments' => $request->comments,
			);
			Quotation::updateOrCreate(['number_of_position'=>$position],$updateQuotation);
			}
		}
		return back()->with('message','Quotation Updated Successfully.');
	}

	public function destroy($id){
		Quotation::where('prospact_id',$id)->delete();
		return back()->with('fail','Deleted Successfully.');

	}
}

?>