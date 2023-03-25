       <div class="modal fade col-md-12" id="modal-default">
          <div class="modal-dialog modal-lg" style="width:80%;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title"><strong>Add Quotation</strong></h3>
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
          <h2 class="page-header">
            <i class="fa fa-globe"></i> {{Auth::guard('admin')->user()->name}}
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      @if(Auth::guard('admin')->user()->role_id ==1)
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
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <span class="company-name"></span><br>
            <strong class="cus-name"></strong><br>
            <span class="customer-address"></span><br>
            <strong>Quotation Number:</strong> <span class="quotation_number">00000</span><textarea hidden name="quotation_number" class="quotation_number">00000</textarea><br>
            <strong>Quotation Date:</strong> <span class="quotation_date"><?php echo date("d-m-Y"); ?><textarea name="quotation_date" hidden class="quotation_date"><?php echo date("Y-m-d"); ?></textarea></span><br>
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
            <td>Position</td>
            <td>Article Description</td>
            <td>Price Per Article($)</td>
            <td>No. of Article</td>
            <td>Total Price($)</td>
            <td>Action</td>
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
              <tr>
                <td colspan="6" class="text-right">
                  <button onclick="addTr()" class="btn btn-success"><i class="fa fa-plus"></i></button>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- /.row -->

      <div class="row">
      <div class="col-xs-6 table-responsive">
          <textarea class="form-control" name="comments" placeholder="Enter your comments here in 100 words" maxlength="500" required></textarea>     
        </div>
        <div class="col-xs-6">
          <!-- <p class="lead">Amount Due {{date("Y-m-d")}}</p> -->

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td class="subtotal">$00.00</td>
                <td hidden>
                  <input type="text" class="subtotal_val" name="sub_total" required>
                </td>
              </tr>
              <tr>
                <th>Tax ({{Auth::guard('admin')->user()->setting->ust_number}}%)</th>
                <td class="gstNumber">$00.00</td>
                <td hidden>
                  <input type="text" class="gstNumber_val" name="ust_number" required>
                </td>
              </tr>
              <tr>
                <th>Grand Total:</th>
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
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      <button type="button" onclick="saveOffersFunction()" class="btn btn-primary pull-right">Submit</button>
        </div>
      </div>
      <p class="text-center">Geschäftsführer - Sirsendu Roy <br>
Bankverbindung : Finom Bank IBAN : DE58 1101 0101 5896 8640 92 BIC:SOBKDEB2XXX <br>
Ust.-IdentNr:Folgt Registernummer: HRB99116 Amtsgericht:Hanau</p>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>

    <!-- <div class="modal-footer">
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
        @endif


