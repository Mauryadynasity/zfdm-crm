<div class="modal fade" id="modal-default" >
          <div class="modal-dialog modal-lg" style="width:80%;">
            <div class="modal-content">
              <div class="modal-header">
                <!-- <a href="{{url('admin/user-dashboard')}}" class="close" data-dismiss="modal" aria-label="Close"> -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h3 class="modal-title"><strong>{{__('messages.Add Quotation')}}</strong></h3>
              </div>
              <div class="modal-body" style="padding:30px;">

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
            {{ucfirst($settingDetails ? $settingDetails->streat_name_1:'')}}<br>
            {{$settingDetails ? $settingDetails->place_code:''}}, {{ucfirst($settingDetails ? $settingDetails->place_name:'')}}, {{ucfirst($settingDetails ? $settingDetails->country:'')}}<br>
            {{__('messages.phone')}}: {{$settingDetails ? $settingDetails->phone:''}}<br>
            {{__('messages.email')}}: {{$settingDetails ? $settingDetails->email:''}}<br>
            {{__('messages.website_url')}}: {{$settingDetails ? $settingDetails->website_url:''}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col text-right">
          <address>
          <h3><strong class="company-name"></strong></h3>
            <span class="cus-name"></span><br>
            <span class="street_name"></span><br>
            <span class="post_code"></span><br>
            <span class="place_name"></span><br>
            <strong>{{__('messages.Quotation Number')}}:</strong> <span class="">#{{\App\Models\Setting::getQuotationNo()}}</span><textarea hidden name="quotation_number" class="quotation_number">00000</textarea><br>
            <strong>{{__('messages.Quotation Date')}}:</strong> <span class="quotation_date"><?php echo date("d-m-Y"); ?><textarea name="quotation_date" hidden class="quotation_date"><?php echo date("Y-m-d"); ?></textarea></span><br>
          <!--   <strong>Phone:</strong> <span class="cus-phone"></span><br>
            <strong>Email:</strong> <span class="cus-email"></span><br> -->
          </address>
          <br>
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
            </tr>
            </thead>
            <tbody>
            <tr>
            <td>
              <span class="position_text">1</span>
            </td>
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
            <td></td>
            </tr>
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
          <textarea class="form-control" id="comments" name="comments" placeholder="{{__('messages.Enter your comments here in 5 Character')}}" maxlength="500" required></textarea>
        <span class="text-danger" id="comments_validate"></span>
        </div>
        <div class="col-xs-6">
          <!-- <p class="lead">Amount Due {{date("Y-m-d")}}</p> -->

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">{{__('messages.Subtotal')}}:</th>
                <td class="subtotal">$00.00</td>
                <td hidden>
                  <input type="text" class="subtotal_val" name="sub_total" required>
                </td>
              </tr>
              <tr>
                <th>{{__('messages.Tax')}} ({{$settingDetails ? $settingDetails->ust_number:''}}%)</th>
                <td class="gstNumber">$00.00</td>
                <td hidden>
                  <input type="text" class="gstNumber_val" name="ust_number" required>
                </td>
              </tr>
              <tr>
                <th>{{__('messages.Grand Total')}}:</th>
                <td class="grandTotal">$00.00</td>
                <td hidden>
                  <input type="text" class="grandTotal_val" name="grand_total" required>
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
        <!-- <a href="{{url('admin/user-dashboard')}}" class="btn btn-default pull-left" data-dismiss="modal">Close</a> -->
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{__('messages.Close')}}</button>
      <button type="button" onclick="saveOffersFunction()" class="btn btn-primary pull-right">{{__('messages.submit_button')}}</button>
        </div>
      </div>
     
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>

    <!-- <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      <button type="button" onclick="saveOffersFunction()" class="btn btn-primary">Submit</button>
    </div> -->
  </form>



<table class="get_single_quotation_row">
  <tr class="trRow">
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
</table>


  
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


