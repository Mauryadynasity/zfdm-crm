
    <form name="updateQuatation" id="updateQuatation" method="post" action="" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
      <input type="hidden" name="prospact_id" value="{{$prospact->id}}">
     
    <div class="content-wrapper-old" style="margin-left:0px">
    <div class="box box-default">
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
            <h3><strong>{{ucfirst($settingDetails ? $settingDetails->company_name:'')}}</strong></h3>
            {{ucfirst($settingDetails ? $settingDetails->streat_name_1:'')}}, {{ucfirst($settingDetails ?$settingDetails->streat_name_2:'')}}, {{ucfirst($settingDetails ? $settingDetails->streat_name_3:'')}}, {{$settingDetails ? $settingDetails->place_code:''}}, {{ucfirst($settingDetails ? $settingDetails->place_name:'')}}, {{ucfirst($settingDetails ? $settingDetails->country:'')}}<br>
            {{__('messages.phone')}}: {{$settingDetails ? $settingDetails->phone:''}}<br>
            {{__('messages.email')}}: {{$settingDetails ? $settingDetails->email:''}}
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
        <div class="col-sm-4 invoice-col text-right">
          <address>
            <h3><strong>{{$prospact->cust_name}}</strong></h3>
            <span> {{$prospact->company_name}}</span><br>
            <span> {{$prospact->street_name}}</span><br>
            <span> {{$prospact->post_code}}</span><br>
            <span> {{$prospact->place_name}}</span><br>
            <strong>{{__('messages.Quotation Number')}}:</strong><span> #{{\App\Models\Setting::getQuotationNo()}}</span><input type="hidden" name="quotation_number" value="{{\App\Models\Setting::getQuotationNo()}}"><br>
            <!-- <strong>{{__('messages.Quotation Date')}}:</strong><span> {{date('d-m-Y', strtotime($prospact->quotation->quotation_date))}}</span><input type="hidden" name="quotation_date" value="{{$prospact->quotation->quotation_date}}"><br> -->
            <strong>{{__('messages.Quotation Date')}}:</strong><input type="date" name="quotation_date" value="{{$prospact->quotation->quotation_date}}"><br>
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
              <tr>
                <td colspan="6" class="text-right">
                  <a onclick="addTr($(this))" class="btn btn-success"><i class="fa fa-plus"></i></a>
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
          <span class="text-danger" id="comments_validate"></span>
        </div>
        <div class="col-xs-6">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">{{__('messages.Subtotal')}}:</th>
                <td class="subtotal">${{$quotation->sub_total}}</td>
                <td hidden>
                  <input type="text" class="subtotal_val" name="sub_total" value="{{$quotation->sub_total}}">
                </td>
              </tr>
              <tr>
                <th>{{__('messages.Tax')}} ({{$settingDetails ? $settingDetails->ust_number:''}}%)</th>
                <td class="gstNumber">${{$quotation->ust_number}}</td>
                <td hidden>
                  <input type="text" class="gstNumber_val" name="ust_number" value="{{$quotation->ust_number}}">
                </td>
              </tr>
              <tr>
                <th>{{__('messages.Grand Total')}}:</th>
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
          <button type="button" class="btn btn-default" data-dismiss="modal">{{__('messages.Close')}}</button>
          
          <button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-save"></i> {{__('messages.submit_button')}}
          </button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
     </form>


<script>
    $('#updateQuatation').submit(function(e) {
    e.preventDefault();
  });

</script>