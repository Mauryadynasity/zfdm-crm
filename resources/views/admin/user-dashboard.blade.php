@extends('admin.layouts.app')
@section('content')
@php
$allowed_columns = $permissions->pluck('column')->toArray();
@endphp


@section('styles')
<style type="text/css">
  .trRow{
    display: none;
  }
</style>
@endsection
<section class="content-header">
    <h1>
    <!-- {{__('messages.Prospects')}}
    {{__('messages.'.Auth::guard('admin')->user()->name)}}
    <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('messages.home')}}</a></li>
    <li class="active"><a href="{{url('admin/user-dashboard')}}">{{__('messages.Prospects')}}</a></li>
    <li class="active"><a href="{{url('admin/quotation-list')}}">{{__('messages.Quotations')}}</a></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
      <div class="box box-default">
        <div class="box-header with-border box-header-style">
          <h3 class="box-title">{{__('messages.Prospects')}}</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
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
                {{ session()->get('fail') }}
                  </div>
                @endif
              </div>
          </div>
          <form name="myForm" id="myForm" method="post" action="{{url('admin/save-prospact')}}" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
            <!-- <input type="hidden" name="admin_id" value="{{Auth::guard('admin')->user()->id}}"> -->

          <div class="row">
            @if(in_array('cust_name',$allowed_columns))
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Customer name')}}<span style="color:red">*</span></label>
                <input type="text" name="cust_name" class="form-control" style="width: 100%;" required>
                @if($errors->has('cust_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('cust_name') }}</span>
                  @endif
              </div>
            </div>
            @endif
            @if(in_array('company_name',$allowed_columns))
             <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Company Name')}}<span style="color:red">*</span></label>
                <input type="text" name="company_name" class="form-control" style="width: 100%;" required>
                  @if($errors->has('company_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('company_name') }}</span>
                  @endif
              </div>
            </div>
            @endif
            @if(in_array('cust_email',$allowed_columns))
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.email')}}<span style="color:red">*</span></label>
                <input type="email" name="cust_email" class="form-control" style="width: 100%;" required>
                @if($errors->has('email'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
              </div>
            </div>
            @endif
            <div class="clearfix"></div>
            @if(in_array('cust_phone',$allowed_columns))
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.phone')}}<span style="color:red">*</span></label>
                <input type="text" name="cust_phone" class="form-control numbersOnly" style="width: 100%;" minlength="10" maxlength="10" required>
                @if($errors->has('phone'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('phone') }}</span>
                  @endif
              </div>
            </div>
            @endif
            @if(in_array('date_of_contact',$allowed_columns))
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Date')}}<span style="color:red">*</span></label>
                <input type="date" name="date_of_contact" class="form-control" style="width: 100%;" required>
                @if($errors->has('date_of_contact'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('date_of_contact') }}</span>
                  @endif
              </div>
            </div>
            @endif
            @if(in_array('street_name',$allowed_columns))
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Street Name')}}</label>
                <input type="text" name="street_name" class="form-control" style="width: 100%;" maxlength="500" required>
                @if($errors->has('street_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('street_name') }}</span>
                  @endif
              </div>
            </div>
            @endif
            <div class="clearfix"></div>
            @if(in_array('post_code',$allowed_columns))
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Place Code')}}</label>
                <input type="text" name="post_code" class="form-control numbersOnly" style="width: 100%;" minlength="6" maxlength="6" required>
                @if($errors->has('post_code'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('post_code') }}</span>
                  @endif
              </div>
            </div>
            @endif
            @if(in_array('place_name',$allowed_columns))
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Place Name')}}</label>
                <input type="text" name="place_name" class="form-control" style="width: 100%;" maxlength="500" required>
                @if($errors->has('place_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('place_name') }}</span>
                  @endif
              </div>
            </div>
            @endif
            @if(in_array('wants_offer',$allowed_columns))
            <div class="col-md-2">
              <div class="form-group">
                <label>wants offer</label>
                <input type="text" name="wants_offer" class="form-control" style="width: 100%;" maxlength="500" required>
                @if($errors->has('wants_offer'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('wants_offer') }}</span>
                  @endif
              </div>
            </div>
            @endif
            @if(in_array('no_employee',$allowed_columns))
            <div class="col-md-2">
              <div class="form-group">
                <label>Number of Employees</label>
                <input type="text" name="no_employee" class="form-control" style="width: 100%;" maxlength="500" required>
                @if($errors->has('no_employee'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('no_employee') }}</span>
                  @endif
              </div>
            </div>
            @endif
            <div class="clearfix"></div>
            @if(in_array('no_device',$allowed_columns))
            <div class="col-md-3">
              <div class="form-group">
                <label>Number of Devices</label>
                <input type="text" name="no_device" class="form-control" style="width: 100%;" maxlength="500" required>
                @if($errors->has('no_device'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('no_device') }}</span>
                  @endif
              </div>
            </div>
            @endif
            @if(in_array('device_type',$allowed_columns))
            <div class="col-md-3">
              <div class="form-group">
                <label>Device Type</label>
                <input type="text" name="device_type" class="form-control" style="width: 100%;" maxlength="500" required>
                @if($errors->has('device_type'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('device_type') }}</span>
                  @endif
              </div>
            </div>
            @endif
            @if(in_array('callback',$allowed_columns))
            <div class="col-md-3">
              <div class="form-group">
                <label>Choose Callback</label>
                <select name="callback" class="form-control" required>
                  <option value="">----- Select -----</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
                </select>
                  @if($errors->has('callback'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('callback') }}</span>
                  @endif
              </div>
            </div>
            @endif
            @if(in_array('status',$allowed_columns))
            <div class="col-md-3">
              <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" required>
                <option value="">----- Select -----</option>
                  @foreach($StatusMaster as $status)
                  <option value="{{$status->id}}">{{$status->status}}</option>
                  @endforeach
                </select>
                @if($errors->has('status'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('status') }}</span>
                  @endif
              </div>
            </div>
            @endif
            <div class="clearfix"></div>
            @if(in_array('news',$allowed_columns))
            <div class="col-md-6">
              <div class="form-group">
                <label>News</label>
                <textarea type="text" name="news" class="form-control" style="width: 100%;" maxlength="500" required></textarea>
                @if($errors->has('news'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('news') }}</span>
                  @endif
              </div>
            </div>
            @endif
            @if(in_array('protocol',$allowed_columns))
            <div class="col-md-6">
              <div class="form-group">
                <label>Protocal</label>
                <textarea type="text" name="protocol" class="form-control" style="width: 100%;" maxlength="500" required></textarea>
                @if($errors->has('protocol'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('protocol') }}</span>
                  @endif
              </div>
            </div>
            @endif
            <div class="clearfix"></div>
            <div class="col-md-2">
              <div class="form-group">
                <label></label>
                <button class="form-control btn btn-primary" style="margin-top: 4px;">{{__('messages.submit_button')}}</button>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label></label>
                <a href="{{url('admin/user-dashboard')}}" class="form-control btn btn-default" style="margin-top: 4px;">{{__('messages.back_button')}}</a>
              </div>
            </div>
          </div>
          </form>
          <div class="clearfix"></div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
        <!-- <div class="box-body">
          <a href="{{url('admin/add-prospact')}}" class="btn btn-primary">Add Prospact</a>
          <a href="{{url('admin/quotation-list')}}" class="btn btn-primary">Quotation List</a>
        </div> -->
        <table class="table table-bordered border-success yajra-datatable" width="100%" id="myTable">
          <thead>
            <tr>
              <th>ID</th>
              @foreach($permissions as $permission)
              <th>{{$permission->column_name}}</th>
              @endforeach
              <th>{{__('messages.action')}}</th>
              </tr>
          </thead>
          <tbody>
            @foreach($prospacts as $prospact)
            <tr>
              <td class="prospact_id">{{$prospact->id}}</td>
              @foreach($allowed_columns as $allowed_column)
              <th>{{$prospact->$allowed_column}}</th>
              @endforeach
              <td>
                <a href="{{url('admin/edit-prospact')}}/{{$prospact->id}}" title="Edit" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                <a href="{{url('admin/delete-prospact')}}/{{$prospact->id}}" title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                <button type="button" class="btn btn-danger mybutton" title="Add Quotation" onClick="addNewOffer()">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                </button>
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
        $('.mybutton').prop('disabled', true);
        $(".mybutton").show();
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

  // $('#saveOffers').validate();
$.validator.addMethod("cValidate", function(value, element, min) {
    var message = false;
    if(value==0){
      message = true;
    }
    if(value.length>4){
      message = true;
    }
    return message;
}, "Please provide atleast 5 characters or 0.");

$('#saveOffers').validate({
  rules: {
    comments: {
      required: true,
      cValidate: true
    },
  },
  errorPlacement: function (error, element) {
    var name = $(element).attr("name");
    error.appendTo($("#" + name + "_validate"));
},
});

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
            $(".street_name").append(data.street_name);
            $(".post_code").append(data.post_code);
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
        $('.mybutton').prop('disabled', false);
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
      var gstNumber = parseFloat((grandTotal*'{{$settingDetails->ust_number}}')/100);
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
  $('#myForm').validate();
    </script>
    
    @endsection

    @endsection

