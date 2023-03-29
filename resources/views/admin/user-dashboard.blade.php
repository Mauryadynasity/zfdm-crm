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
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
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
      <div class="modal fade col-md-12" id="modal-default">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title"><strong>Create offer</strong></h3>
              </div>
              <form name="saveOffers" id="saveOffers" enctype="multipart/form-data">
              <div class="modal-body" style="padding:30px;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
                <input type="hidden" name="prospact_id" id="prospact_id">
              <div class="row">
              <div class="col-md-6 alert alert-info">
                <div class="form-group">
                  <h4>Company Name</h4>
                  <input type="text" class="form-control" name="company_name" id="company_name_text" value="TVS" readonly disabled="disbled" required>
                </div>
              </div>
              <div class="col-md-6 alert alert-info">
                <div class="form-group"><h4>Name</h4>
                  <input type="text" class="form-control" name="user_name" id="user_name_text" value="{{Auth::guard('admin')->user()->name}}" readonly disabled="disbled" required>
                </div>
              </div>
              </div>

                <table class="table table-hover table-responsive offerTable">
                  <thead>
                    <tr>
                    <td>Number of employees</td>
                    <td>Number advised</td>
                    <td>Piece price($)</td>
                    <td>price($)</td>
                    <td>Any Additional Notation</td>
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
                  </tbody>
                  </tr>
                </table>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" onclick="saveOffersFunction()" class="btn btn-primary">Create Offer</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
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
              timer: 5000
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
        var company_name = $(this).find('.company_name').text();
        var prospact_id = $(this).find('.prospact_id').text();
        var title = $(this).find('.title').text();
        $('#company_name_text').val(company_name);
        $('#prospact_id').val(prospact_id);
        // $('#user_name_text').val(title);
    });

    </script>
    @endsection

    @endsection

