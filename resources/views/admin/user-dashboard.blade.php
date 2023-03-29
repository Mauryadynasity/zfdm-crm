@extends('admin.layouts.app')
@section('content')


@section('styles')
<style type="text/css">
  .trRow{
    display: none;
  }
</style>
@endsection
<section class="content-header">
    <h1>
    User Dashboard
    <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">User Dashboard</li>
    </ol>
</section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-default table-responsive">
        <!-- <div class="box-header with-border">
          <h3 class="box-title">Select2</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div> -->
        <!-- /.box-header -->
        <div class="box-body">
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
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-body">
          <a href="{{url('admin/add-prospact')}}" class="btn btn-primary">Add Prospact</a>

            <button type="button" class="btn btn-default mybutton" onClick="addNewOffer()">
              Add Quotation
            </button>
        </div>

        <table class="table table-bordered border-success yajra-datatable" width="100%" id="myTable">
          <thead>
            <tr>
              <th>S.NO</th>
              <th>Company Name</th>
              <th>Customer Name</th>
              <th>Customer Email</th>
              <th>Customer Phone</th>
              <th>Date</th>
              <th>Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach($prospacts as $prospact)
            <tr>
              <td class="prospact_id">{{$prospact->id}}</td>
              <td class="company_name">{{$prospact->company_name}}</td>
              <td>{{$prospact->cust_name}}</td>
              <td>{{$prospact->cust_email}}</td>
              <td>{{$prospact->cust_phone }}</td>
              <td>{{$prospact->date_of_contact}}</td>
              <td>
                <a href="{{url('admin/edit-prospact')}}/{{$prospact->id}}" title="Edit" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                <a href="{{url('admin/delete-prospact')}}/{{$prospact->id}}" title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

          @include('admin.offer.add-new-quotation')

    </section>
    @section('scripts')
    <script>

      $(document).ready( function () {
        $(".mybutton").hide();
          $('#myTable').dataTable();
      } );

    function addOffer($this){
      var currentTrHtml = $this.closest('tr').html();
      $('.offerTable').find('tbody').append("<tr>"+currentTrHtml+"</tr>");
      $this.closest('tr').find('.add-more').hide();
      $this.closest('tr').find('.add-more-remove').show();
    }
    function removeOffer($this){
      if(confirm("Are you sure?") == false){
        return false;
      }
      $this.closest('tr').remove();
    }

  $('#saveOffers').validate();
  function saveOffersFunction(){
  $('#saveOffers').submit();
  }

  function addNewOffer(){
        var selectedTr = $('#myTable tbody tr.selected');
        var prospact_id = selectedTr.find('.prospact_id').text();
        $("#modal-default").modal('show');
        $.ajax({
        headers: {
          'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        type: 'GET',
        url: "{{ url('admin/get-prospact-details') }}",
        data: {
            'prospact_id' : prospact_id,
        },
        success: function(data) {
          if(data){
            $(".prospact_id").val(data.id);
            $(".cus-name").append(data.cust_name);
            $(".company-name").append(data.company_name);
            $(".customer-address").append(data.cust_address);
            $(".postcode").append(data.postcode);
            $(".place_name").append(data.place_name);
            $(".quotation_number").append(data.id);
            // $(".cus-phone").append(data.cust_phone);
            // $(".cus-email").append(data.cust_email);
          }else{
            // alert(data.message);
          }
        },
      });
  }

    $('#saveOffers').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        headers: {
          'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        type: 'POST',
        url: "{{ url('admin/save-quotation') }}",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          if(data.status){
            Swal.fire({
              position: 'top-middle',
              icon: 'success',
              title: data.message,
              showConfirmButton: false,
              timer: 3000
            });
          $('#saveOffers').trigger("reset");
          $('#modal-default').modal('hide');
          // window.open("{{url('admin/view-quotation')}}");
          // $("#modal").modal('hide');
          }else{
            // alert(data.message);
          }
        },
      });
    });

    $('#myTable tbody').on( 'click', 'tr', function () {
        $(".mybutton").show();
        $('#myTable tbody tr').removeClass('selected');
        $(this).toggleClass('selected');
    });

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

    @endsection

