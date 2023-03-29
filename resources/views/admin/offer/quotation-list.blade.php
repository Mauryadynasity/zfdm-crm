@extends('admin.layouts.app')
@section('content')


@section('styles')
<style type="text/css">
</style>
@endsection
<section class="content-header">
    <h1>
    {{__('messages.Quotation List')}}
    <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('messages.home')}}</a></li>
    <li class="active"><a href="{{url('admin/user-dashboard')}}">{{__('messages.Prospects')}}</a></li>
    <li class="active"><a href="{{url('admin/quotation-list')}}">{{__('messages.Quotations')}}</a></li>
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
        <!-- <div class="box-body">
          <a href="{{url('admin/user-dashboard')}}" class="btn btn-primary">Prospact List</a>
          </div> -->

        <table class="table table-bordered border-success yajra-datatable" width="100%" id="myTable">
          <thead>
            <tr>
            <th>{{__('messages.sr_no')}}</th>
              <th>{{__('messages.Company Name')}}</th>
              <th>{{__('messages.Customer name')}}</th>
              <th>{{__('messages.Customer Address')}}</th>
              <th>{{__('messages.action')}}</th>
              </tr>
          </thead>
          <tbody>
            @foreach($quotations as $quotation)
            <tr>
              <td class="prospact_id">{{$quotation->id}}</td>
              <td class="company_name">{{$quotation->company_name}}</td>
              <td>{{$quotation->cust_name}}</td>
              <td>{{$quotation->cust_address}}</td>
              <td>
                <a href="{{url('admin/view-quotation')}}/{{$quotation->id}}" title="View" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a href="{{url('admin/edit-quotation')}}/{{$quotation->id}}" title="Edit" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                <a href="{{url('admin/delete-quotation')}}/{{$quotation->id}}" title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
        url: "{{ url('admin/get-offer-details') }}",
        data: {
            'prospact_id' : prospact_id,
        },
        success: function(data) {
          if(data){
            $(".prospact_id").val(data.id);
            $(".cus-name").append(data.cust_name);
            $(".cus-phone").append(data.cust_phone);
            $(".cus-email").append(data.cust_email);
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
        url: "{{ url('admin/save-offer') }}",
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

    // $('#myTable tbody').on( 'click', 'tr', function () {
    //     $('#myTable tbody tr').removeClass('selected');
    //     $(this).toggleClass('selected');
    // });

    </script>
    @endsection

    @endsection

