@extends('admin.layouts.app')
@section('content')

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
            @foreach($prospacts as $index => $prospact)
            <tr>
              <td>{{$index+1}}</td>
              <td>{{$prospact->company_name}}</td>
              <td>{{$prospact->title}}</td>
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
    </section>
    @section('scripts')
    <script>
      $(document).ready( function () {
          $('#myTable').dataTable();
      } );
    </script>
    @endsection

    @endsection
