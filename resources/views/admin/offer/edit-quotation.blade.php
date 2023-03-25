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
          To
          <address>
            <span> {{$prospact->cust_name}}</span><br>
            <span> {{$prospact->company_name}}</span><br>
            <span> {{$prospact->cust_address}}</span><br>
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
            </tr>
            </thead>
            <tbody>
              <?php $position =1; ?>
            @foreach($prospact->quotations as $quotation)
            <tr>
            <td>
            <span class="position_text">{{$position}}</span>
            </td>
            <td>
              <input type="text" class="form-control article_description" name="article_description[]" value="{{$quotation->article_description}}" required>
            </td>
            <td>
              <input type="text" class="form-control prise_per_article numbersOnly" name="prise_per_article[]" value="{{$quotation->prise_per_article}}"  onchange="calculateTotalPrice($(this))" required>
            </td>
            <td>
              <input type="text" class="form-control number_of_article numbersOnly" name="number_of_article[]" value="{{$quotation->number_of_article}}" onchange="calculateTotalPrice($(this))" required>
            </td>
            <td>
              <span class="price_text">${{$quotation->price}}</span>
              <input type="hidden" class="form-control price numbersOnly" name="price[]" value="{{$quotation->price}}" required>
            </td>
            <td></td>
            </tr>
            <?php $position++ ?>
            @endforeach
            </tbody>
            <tfoot>
            <tr hidden class="trRow">
            <td>
              <input type="text" class="form-control article_description" name="article_description[]" required>
            </td>
            <td>
              <input type="text" class="form-control prise_per_article numbersOnly" name="prise_per_article[]"  onchange="calculateTotalPrice($(this))" required>
            </td>
            <td>
              <input type="text" class="form-control number_of_article numbersOnly" name="number_of_article[]"  onchange="calculateTotalPrice($(this))" required>
            </td>
            <td>
              <span class="price_text"></span>
              <input type="hidden" class="form-control price numbersOnly" name="price[]" required>
            </td>
            <td>
              <button onclick="$(this).closest('tr').remove();" class="btn btn-danger"><i class="fa fa-trash"></i></button>
            </td>
            </tr>
              <tr>
                <td colspan="6" class="text-right">
                  <a onclick="addTr()" class="btn btn-success"><i class="fa fa-plus"></i></a>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
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
                <td class="subtotal">${{$quotation->sub_total}}</td>
                <td hidden>
                  <input type="text" class="subtotal_val" name="sub_total" value="{{$quotation->sub_total}}">
                </td>
              </tr>
              <tr>
                <th>Tax ({{Auth::guard('admin')->user()->setting->ust_number}}%)</th>
                <td class="gstNumber">${{$quotation->ust_number}}</td>
                <td hidden>
                  <input type="text" class="gstNumber_val" name="ust_number" value="{{$quotation->ust_number}}">
                </td>
              </tr>
              <tr>
                <th>Grand Total:</th>
                <td class="grandTotal">${{$quotation->grand_total}}</td>
                <td hidden>
                  <input type="text" class="grandTotal_val" name="grand_total" value="{{$quotation->grand_total}}">
                </td>
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
      function calculateTotalPrice($this){
    var currentTr = $this.closest('tr');
    var prise_per_article = currentTr.find('.prise_per_article').val();
    var number_of_article  = currentTr.find('.number_of_article').val();
    var total_price = parseInt(prise_per_article) * parseInt(number_of_article);
    if(Number.isInteger(total_price)){
      currentTr.find('.price').val(total_price);
      currentTr.find('.price_text').html('$'+total_price);
    }
    calculateGrandTotalPrice(total_price);
  }
  function calculateGrandTotalPrice(total_price){
    var grandTotal = 0;
    $('.price').each(function(total_price) {
      var price = parseInt($(this).val());
      if(Number.isInteger(price)){
        grandTotal += price;
      }
    });
    if(Number.isInteger(grandTotal)){
      var gstNumber = parseFloat((grandTotal*18)/100);
      $('.subtotal').html('$'+grandTotal);
      $('.gstNumber').html('$'+gstNumber);
      $('.grandTotal').html('$'+(grandTotal+gstNumber));
      $('.subtotal_val').val(grandTotal);
      $('.gstNumber_val').val(gstNumber);
      $('.grandTotal_val').val((grandTotal+gstNumber));
    }
  }

  function addTr(){
    var position_count = ($('.article_description').length);
    var content = $('.trRow').html();
    var positionDetails = '<td><span class="position_text">'+position_count+'</span></td>';
    position_count = position_count + 1;
    var content_text = '<tr>'+positionDetails+content+'</tr>';
    $('.offerTable tbody').append(content_text);
  }
    </script>
    @endsection

