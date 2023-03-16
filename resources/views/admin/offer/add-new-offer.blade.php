       <div class="modal fade col-md-12" id="modal-default">
          <div class="modal-dialog modal-lg" style="width:80%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title"><strong>Create offer</strong></h3>
              </div>
              <div class="modal-body" style="padding:30px;">


<form name="saveOffers" id="saveOffers" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
      <input type="hidden" name="prospact_id" id="prospact_id">
     
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
            <small class="pull-right">Date: {{date("Y-m-d h:i:sa")}}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>{{$adminDetails->company_name}}</strong><br>
            {{ucfirst($adminDetails->streat_name_1)}}, {{ucfirst($adminDetails->streat_name_2)}}, {{ucfirst($adminDetails->streat_name_3)}}, {{$adminDetails->place_code}}, {{ucfirst($adminDetails->place_name)}}, {{ucfirst($adminDetails->country)}}<br>
            Phone: {{$adminDetails->phone}}<br>
            Email: {{$adminDetails->email}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong class="cus-name"></strong><br>
            Phone: <span class="cus-phone"></span><br>
            Email: <span class="cus-email"></span>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #007612</b><br>
          <br>
          <b>Order ID:</b> 4F3S8J<br>
          <b>Payment Due:</b> 2/22/2014<br>
          <b>Account:</b> 968-34567
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
            <td>Number of employees</td>
            <td>Number advised</td>
            <td>Piece price($)</td>
            <td>price($)</td>
            <td>An notation</td>
            <td>Additional options</td>
            <td>Action</td>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td><input type="text" class="form-control" name="number_of_employee" required></td>
            <td><input type="text" class="form-control" name="number_of_advised" required></td>
            <td><input type="text" class="form-control" name="piece_prise" required></td>
            <td><input type="text" class="form-control" name="prise" required></td>
            <td><textarea class="form-control" name="an_notation" required></textarea></td>
            <td>
            <select class="form-control" name="additional_option_id" required>
            <option value="">---- Select ----</option>  
            @foreach($AdditionalOptions as $AdditionalOption) 
            <option value="{{$AdditionalOption->id}}">{{$AdditionalOption->name}}</option>  
            @endforeach
            </select></td>
            <td style="width:100px;">
            <i onclick="addOffer($(this))" class="fa fa-plus add-more btn btn-success"></i>
            <i onclick="removeOffer($(this))" class="fa fa-minus add-more-remove btn btn-danger" style="display:none;"></i>
            </td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <img src="../../dist/img/credit/visa.png" alt="Visa">
          <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../../dist/img/credit/american-express.png" alt="American Express">
          <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Due 2/22/2014</p>

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
                <th>Shipping:</th>
                <td>$5.80</td>
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
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      <button type="button" onclick="saveOffersFunction()" class="btn btn-primary">Create Offer</button>
    </div>
  </form>
  
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
