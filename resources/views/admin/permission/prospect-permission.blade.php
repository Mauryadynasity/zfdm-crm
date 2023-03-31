@extends('admin.layouts.app')
@section('content')
<section class="content-header">
    <h1>
    {{__('messages.Prospect Permission')}}
    <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">{{__('messages.Prospect Permission')}}</li>
    </ol>
</section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-default">
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
          <form name="myForm" id="myForm" action="{{url('/admin/prospect-permission/')}}" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
          <div class="row">
          <table class="table table-bordered border-success table-hover yajra-datatable" width="100%" id="myTable">
          <thead>
            <tr>
              <th>Sr.No</th>
              <th>Module Name</th>
              <th>Column</th>
              <th>Column Name</th>
              <th>Permission</th>
              <!-- <th>Action</th> -->
              </tr>
          </thead>
          <tbody>
            @foreach($permissions as $index => $permission)
            <tr>
              <td><input type="hidden" name="id[]" value="{{$permission->id}}">{{$permission->id}}</td>
              <td>{{$permission->module_name}}</td>
              <td>{{$permission->column}}</td   >
              <td>{{$permission->column_name}}</td>
              <td>
              <input type="checkbox" class="permission_check" name="status[]" value="{{$permission->status}}" @if($permission->status == 'yes')checked @endif>
              </td>
              <td>
                <!-- <a href="{{url('admin/edit-permission')}}/{{$permission->id}}" title="Save" class="btn btn-primary">Save</a> -->
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
            <div class="col-md-2">
              <div class="form-group">
                <label></label>
                <button type="burton" class="form-control btn btn-primary" onclick="saveRecord()" style="margin-top: 4px;">{{__('messages.submit_button')}}</button>
              </div>
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
    </section>
    @section('scripts')
    <script>
    function saveRecord(){
      $('.permission_check').each(function(){
        if($(this).is(':checked')==false){
          $(this).closest('tr').remove();
        }
      });
    }
    </script>
    @endsection

    @endsection
