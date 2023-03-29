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
          <h2 class="page-header">
          {{__('messages.'.Auth::guard('admin')->user()->name)}}
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
        {{__('messages.From')}}
          <address>
            <strong>{{Auth::guard('admin')->user()->setting->company_name}}</strong><br>
            {{ucfirst(Auth::guard('admin')->user()->setting->streat_name_1)}}, {{ucfirst(Auth::guard('admin')->user()->setting->streat_name_2)}}, {{ucfirst(Auth::guard('admin')->user()->setting->streat_name_3)}}, {{Auth::guard('admin')->user()->setting->place_code}}, {{ucfirst(Auth::guard('admin')->user()->setting->place_name)}}, {{ucfirst(Auth::guard('admin')->user()->setting->country)}}<br>
            {{__('messages.phone')}}: {{Auth::guard('admin')->user()->setting->phone}}<br>
            {{__('messages.email')}}: {{Auth::guard('admin')->user()->setting->email}}
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
        {{__('messages.To')}}
          <address>
            <span> {{$prospact->company_name}}</span><br>
            <span> {{$prospact->cust_name}}</span><br>
            <strong>Address:</strong><span> {{$prospact->cust_address}}</span><br>
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
            <td>{{__('messages.Position')}}</td>
            <td>{{__('messages.Article Description')}}</td>
            <td>{{__('messages.Price Per Article($)')}}</td>
            <td>{{__('messages.No. of Article')}}</td>
            <td>{{__('messages.Total Price($)')}}</td>
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
                <th>{{__('messages.Tax')}} ({{Auth::guard('admin')->user()->setting->ust_number}}%)</th>
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

