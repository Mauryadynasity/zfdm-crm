@extends('admin.layouts.app')
@section('content')

<section class="content-header">
    <h1>
    {{__('messages.change_pass')}}
    <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">{{__('messages.change_pass')}}</li>
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
          <form name="myForm" id="myForm" action="{{url('/admin/change-password/save/')}}" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>{{__('messages.old_password')}}</label>
                <input type="text" name="old_pass" class="form-control select2 select2-hidden-accessible" style="width: 100%;" required>
                  @if($errors->has('old_pass'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('old_pass') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>{{__('messages.new_password')}}</label>
                <input type="text" name="new_pass" class="form-control select2 select2-hidden-accessible" style="width: 100%;" required>
                  @if($errors->has('new_pass'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('new_pass') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>{{__('messages.confirm_password')}}</label>
                <input type="text" name="con_pass" class="form-control select2 select2-hidden-accessible" style="width: 100%;" required>
                @if($errors->has('con_pass'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('con_pass') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label></label>
                <button type="submit" class="form-control btn btn-primary" style="margin-top: 4px;">{{__('messages.submit_button')}}</button>
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
    $('#myForm').validate();
    </script>
    @endsection

    @endsection
