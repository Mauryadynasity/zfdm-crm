@extends('admin.layouts.app')
@section('content')


@section('styles')
<style type="text/css">
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
                {{ session()->get('fail') }}
                  </div>
                @endif
              </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-body">
            <!-- <button type="button" class="btn btn-default" onClick="addNewOffer($(this))" data-toggle="modal" data-target="#modal-default">
              Create offer
            </button> -->
            <button type="button" class="btn btn-default" onClick="addNewOffer()">
              Create offer
            </button>
        </div>

        <table class="table table-bordered border-success yajra-datatable" width="100%" id="myTable">
          <thead>
            <tr>
              <th>S.NO</th>
              <th>Kundan Name</th>
              <th>Firma Name</th>
              <th>E-Mail</th>
              <th>Streasse</th>
              <th>PLZ</th>
              <th>Ort</th>
              <th>Telefon</th>
              <th>Gekommen</th>
              <th>Wollen Angebot</th>
              <th>Anzahi Mitarbeiter</th>
              <th>Telefon</th>
              <th>Telefon</th>
              <th>Telefon</th>
              <th>Telefon</th>
              <th>Telefon</th>
              <th>Telefon</th>
              <th>Telefon</th>
              <th>Telefon</th>
              <th>Telefon</th>
              <th>status</th>
              <th>Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach($prospacts as $prospact)
            <tr>
              <td class="prospact_id">{{$prospact->id}}</td>
              <td class="company_name">{{$prospact->company_name}}</td>
              <td class="title">{{$prospact->title}}</td>
              <td>{{$prospact->first_name}}</td>
              <td>{{$prospact->cust_name}}</td>
              <td>{{$prospact->cust_email}}</td>
              <td>{{$prospact->cust_address}}</td>
              <td>{{$prospact->postcode}}</td>
              <td>{{$prospact->place_name}}</td>
              <td>{{$prospact->cust_phone}}</td>
              <td>{{$prospact->wants_offer}}</td>
              <td>{{$prospact->no_employee}}</td>
              <td>{{$prospact->cust_msg}}</td>
              <td>{{$prospact->packet}}</td>
              <td>{{$prospact->cust_source}}</td>
              <td>{{$prospact->callback}}</td>
              <td>{{$prospact->date_of_contact}}</td>
              <td>{{$prospact->protocol}}</td>
              <td>{{$prospact->no_device}}</td>
              <td>{{$prospact->owner_id}}</td>
              <td>{{$prospact->status}}</td>
              <td><a href="{{url('admin/delete-user')}}/{{$prospact->id}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

          @include('admin.offer.add-new-offer')

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
          window.open("{{url('admin/invoice')}}");
          // $("#modal").modal('hide');
          }else{
            // alert(data.message);
          }
        },
      });
    });

    $('#myTable tbody').on( 'click', 'tr', function () {
        $('#myTable tbody tr').removeClass('selected');
        $(this).toggleClass('selected');
    });

    </script>
    @endsection

    @endsection

