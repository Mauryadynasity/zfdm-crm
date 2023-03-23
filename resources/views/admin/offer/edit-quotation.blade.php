@extends('admin.layouts.app')
@section('content')


@section('styles')
<style type="text/css">
</style>
@endsection
     <section class="content-header">
    <h1>
    Edit Quotation
    </h1>
</section>

      <form name="updateQuatation" id="updateQuatation" method="post" action="" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
      <input type="hidden" name="prospact_id" value="{{$prospact->id}}">
     
    <div class="content-wrapper-old" style="margin-left:0px">
    <!-- Content Header (Page header) -->

    <div class="pad margin no-print"> 
    </div>
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
      <div class="form-row">
              <div class="col-md-12">
                @if(session()->has('message'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get('message') }}
                  </div>
                @endif
                @if(session()->has('fail'))
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session()->get('fail') }}
                  </div>
                @endif
              </div>
          </div>
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> {{Auth::guard('admin')->user()->name}}
            <small class="pull-right">{{$prospact->company_name}}</small><br>
            <span class="pull-right">{{$prospact->cust_address}}</span><br>
            <span class="postcode"></span> <br>
            <span class="place_name"></span>  <br>
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
          <!-- To
          <address>
            <strong class="cus-name"></strong><br>
            Phone: <span class="cus-phone"></span><br>
            Email: <span class="cus-email"></span>
          </address> -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <address>
            <!-- <strong></strong><span> {{$prospact->cust_name}}</span><br> -->
            <!-- <strong>Company:</strong><span> {{$prospact->company_name}}</span><br> -->
            <!-- <strong>Address:</strong><span> {{$prospact->cust_address}}</span><br> -->
            <strong>Quotation Number:</strong><span> {{$prospact->quotation->quotation_number}}</span><input type="hidden" name="quotation_number" value="{{$prospact->quotation->quotation_number}}"><br>
            <strong>Quotation Date:</strong><span> {{date('d-m-Y', strtotime($prospact->quotation->quotation_date))}}</span><input type="hidden" name="quotation_date" value="{{$prospact->quotation->quotation_date}}"><br>
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
                <td>{{$quotation->number_of_position}}<input type="hidden" class="form-control" name="number_of_position[]" value="{{$quotation->number_of_position}}" required></td>
                <td><input type="text" class="form-control" name="article_description[]" value="{{$quotation->article_description}}" required></td>
                <td><input type="text" class="form-control" name="prise_per_article[]" value="{{$quotation->prise_per_article}}" required></td>
                <td><input type="text" class="form-control" name="number_of_article[]" value="{{$quotation->number_of_article}}" required></td>
                <td>{{$quotation->price}}<input type="hidden" class="form-control" name="price[]" value="{{$quotation->price}}" required></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-xs-6 table-responsive">
          <textarea class="form-control" name="comments" maxlength="500" required>{{$prospact->quotation->comments}}</textarea>     
        </div>
        <div class="col-xs-6">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>$250.30</td>
              </tr>
              <tr>
                <th>Tax (9.3%)</th>
                <td>$10.34</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>$265.24</td>
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
          
          <button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-save"></i> Save
          </button>
        </div>
      </div>
      <p class="text-center">Geschäftsführer - Sirsendu Roy <br>
Bankverbindung : Finom Bank IBAN : DE58 1101 0101 5896 8640 92 BIC:SOBKDEB2XXX <br>
Ust.-IdentNr:Folgt Registernummer: HRB99116 Amtsgericht:Hanau</p>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
     </form>
  
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
    @endsection

        @section('scripts')
    <script>
  $('#updateQuatation').validate();

    </script>
    @endsection

