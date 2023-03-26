@extends('admin.layouts.app')
@section('content')


@section('styles')
<style>
@media print {
   .noprint {
      visibility: hidden;
   }
}
</style>
@endsection
     <section class="content-header">
    <h1>
    View Quotation
    </h1>
</section>

<form name="saveOffers" id="saveOffers" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
      <input type="hidden" name="prospact_id" class="prospact_id">
     
    <div class="content-wrapper-old" style="margin-left:0px">
    <!-- Content Header (Page header) -->

    <div class="pad margin no-print"> 
    </div>
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> {{Auth::guard('admin')->user()->name}}
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>{{Auth::guard('admin')->user()->setting->company_name}}</strong><br>
            {{ucfirst(Auth::guard('admin')->user()->setting->streat_name_1)}}, {{ucfirst(Auth::guard('admin')->user()->setting->streat_name_2)}}, {{ucfirst(Auth::guard('admin')->user()->setting->streat_name_3)}}, {{Auth::guard('admin')->user()->setting->place_code}}, {{ucfirst(Auth::guard('admin')->user()->setting->place_name)}}, {{ucfirst(Auth::guard('admin')->user()->setting->country)}}<br>
            Phone: {{Auth::guard('admin')->user()->setting->phone}}<br>
            Email: {{Auth::guard('admin')->user()->setting->email}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <!-- 
          <address>
            <strong class="cus-name"></strong><br>
            Phone: <span class="cus-phone"></span><br>
            Email: <span class="cus-email"></span>
          </address> -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <span> {{$prospact->company_name}}</span><br>
            <span> {{$prospact->cust_name}}</span><br>
            <strong>Address:</strong><span> {{$prospact->cust_address}}</span><br>
            <strong>Quotation Number:</strong><span> {{$prospact->quotation->quotation_number}}</span><br>
            <strong>Quotation Date:</strong><span> {{date('d-m-Y', strtotime($prospact->quotation->quotation_date))}}</span><br>
          </address>
          <!-- <b>Invoice #007612</b><br>
          <br>
          <b>Order ID:</b> 4F3S8J<br>
          <b>Payment Due:</b> 2/22/2014<br>
          <b>Account:</b> 968-34567 -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped table-hover table-responsive offerTable">
            <thead>
            <tr>
            <td>Position</td>
            <td>Article Description</td>
            <td>Price Per Article($)</td>
            <td>No. of Article</td>
            <td>Total Price($)</td>
            <!-- <td>Additional options</td> -->
            <!-- <td>Action</td> -->
            </tr>
            </thead>
            <tbody>
              @foreach($prospact->quotations as $quotation)
              <tr>
                <td>{{$quotation->number_of_position}}</td>
                <td>{{$quotation->article_description}}</td>
                <td>{{$quotation->prise_per_article}}</td>
                <td>{{$quotation->number_of_article}}</td>
                <td>${{$quotation->price}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-xs-6">
          <!-- <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">{{$prospact->quotation->comments}}</p>      -->
          <p class="" style="margin-top: 10px;">{{$prospact->quotation->comments}}</p>     
        </div>
        <div class="col-xs-6">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>${{$quotation->sub_total}}</td>
              </tr>
              <tr>
                <th>Tax ({{Auth::guard('admin')->user()->setting->ust_number}}%)</th>
                <td>${{$quotation->ust_number}}</td>
              </tr>
              <tr>
                <th>Grand Total:</th>
                <td>${{$quotation->grand_total}}</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
        <a href="{{url('admin/quotation-list')}}" class="btn btn-default" style="margin-right: 5px;">
            <i class="fa fa"></i> Back
          </a>
          <a onclick="window.print()" target="_blank" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>
      <p class="text-center">Geschäftsführer - Sirsendu Roy <br>
Bankverbindung : Finom Bank IBAN : DE58 1101 0101 5896 8640 92 BIC:SOBKDEB2XXX <br>
Ust.-IdentNr:Folgt Registernummer: HRB99116 Amtsgericht:Hanau</p>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>

   <!--  <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      <button type="button" onclick="saveOffersFunction()" class="btn btn-primary">Submit</button>
    </div> -->
  </form>
  
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
    @endsection

