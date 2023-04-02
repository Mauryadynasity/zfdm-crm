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
    {{__('messages.View Quotation')}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('messages.home')}}</a></li>
    <li class="active"><a href="{{url('admin/user-dashboard')}}">{{__('messages.Prospects')}}</a></li>
    <li class="active"><a href="{{url('admin/quotation-list')}}">{{__('messages.Quotations')}}</a></li>
    </ol>
</section>

<form name="saveOffers" id="saveOffers">
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
          <!-- <h2 class="page-header">
          {{__('messages.'.Auth::guard('admin')->user()->name)}}
          </h2> -->
          <div class="">
            <img src="{{asset('images/logo.png')}}" alt="">
          </div></BR>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
        <address>
            <strong>{{ucfirst($settingDetails ? $settingDetails->company_name:'')}}</strong><br>
            {{ucfirst($settingDetails ? $settingDetails->streat_name_1:'')}}, {{ucfirst($settingDetails ?$settingDetails->streat_name_2:'')}}, {{ucfirst($settingDetails ? $settingDetails->streat_name_3:'')}}, {{$settingDetails ? $settingDetails->place_code:''}}, {{ucfirst($settingDetails ? $settingDetails->place_name:'')}}, {{ucfirst($settingDetails ? $settingDetails->country:'')}}<br>
            {{__('messages.phone')}}: {{$settingDetails ? $settingDetails->phone:''}}<br>
            {{__('messages.email')}}: {{$settingDetails ? $settingDetails->email:''}}
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
        <div class="col-sm-4 invoice-col text-right">
          <address>
          <span> {{$prospact->cust_name}}</span><br>
            <span> {{$prospact->company_name}}</span><br>
            <span> {{$prospact->street_name}}</span><br>
            <span> {{$prospact->post_code}}</span><br>
            <span> {{$prospact->place_name}}</span><br>
            <strong>{{__('messages.Quotation Number')}}:</strong><span> {{$prospact->quotation->quotation_number}}</span><br>
            <strong>{{__('messages.Quotation Date')}}:</strong><span> {{date('d-m-Y', strtotime($prospact->quotation->quotation_date))}}</span><br>
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
            <td><strong>{{__('messages.Position')}}</strong></td>
            <td><strong>{{__('messages.Article Description')}}</strong></td>
            <td><strong>{{__('messages.Price Per Article($)')}}</strong></td>
            <td><strong>{{__('messages.No. of Article')}}</strong></td>
            <td><strong>{{__('messages.Total Price($)')}}</strong></td>
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
                <th style="width:50%">{{__('messages.Subtotal')}}:</th>
                <td>${{$quotation->sub_total}}</td>
              </tr>
              <tr>
                <th>{{__('messages.Tax')}} ({{$settingDetails ? $settingDetails->ust_number:''}}%)</th>
                <td>${{$quotation->ust_number}}</td>
              </tr>
              <tr>
                <th>{{__('messages.Grand Total')}}:</th>
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
            <i class="fa fa"></i> {{__('messages.back_button')}}
          </a>
          <a onclick="window.print()" target="_blank" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> {{__('messages.Print')}}</a>
          <a href="?generate_pdf=true" target="_blank" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> {{__('messages.Generate PDF')}}</a>
        </div>
      </div>
      <p class="text-center">{{__('messages.quotation_footer_one')}} <br>
      {{__('messages.quotation_footer_two')}} <br>
      {{__('messages.quotation_footer_three')}}
    </p>
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

