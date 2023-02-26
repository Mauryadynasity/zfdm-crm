@extends('admin.layouts.app')
@section('content')

<section class="content-header">
    <h1>
    {{__('messages.create_user')}}
    <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('messages.home')}}</a></li>
    <li class="active">{{__('messages.create_user')}}</li>
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
          <form name="myForm" id="myForm" action="{{url('admin/save-user')}}" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>{{__('messages.user_name')}} <span style="color:red">*</span></label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" style="width: 100%;" required>
                  @if($errors->has('name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>{{__('messages.email')}}</label>
                <input type="email" name="email" value="{{old('email')}}" class="form-control" style="width: 100%;" required>
                  @if($errors->has('email'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>{{__('messages.phone')}}</label>
                <input type="text" name="phone" value="{{old('phone')}}" maxlength="10" class="form-control numbersOnly" style="width: 100%;" required>
                @if($errors->has('phone'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('phone') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>{{__('messages.password')}}</label>
                <input type="text" name="password" value="{{old('password')}}" class="form-control numbersOnly" style="width: 100%;" required>
                @if($errors->has('password'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('password') }}</span>
                  @endif
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3">
                     <strong>{{__('messages.role')}}: <span style="color:red">*</span></strong>
                     <select name="role_id" id="Role" class="form-control" required>
                        <option value="">--- {{__('messages.role')}} ---</option>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}" @if($role->id==old('role_id')) selected @endif>{{$role->name}}</option>
                        @endforeach
                     </select>
                     @if($errors->has('role_id'))
                         <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('role_id') }}</span>
                     @endif
              </div>
            <div class="col-md-3">
              <div class="form-group">
                <label></label>
                <button type="submit" class="form-control btn btn-primary" style="margin-top: 4px;">{{__('messages.submit_button')}}</button>
              </div>
            </div>
          </div>
          <hr style="height:2px;background-color: #c0c0c0;" />
          <!-- /.row -->
        </div>
        <!-- /.box-body -->

        <table class="table table-bordered border-success yajra-datatable" id="userList" width="100%"></div>
          <thead>
            <tr>
              <th>{{__('messages.sr_no')}}</th>
              <th>{{__('messages.user_name')}}</th>
              <th>{{__('messages.email')}}</th>
              <th>{{__('messages.phone')}}</th>
              <th>{{__('messages.role')}}</th>
              <th>{{__('messages.action')}}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $index => $user)
            <tr>
              <td>{{$index+1}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->phone}}</td>
              <td>{{$user->role->name}}</td>
              <td><a href="{{url('admin/delete-user')}}/{{$user->id}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">{{__('messages.delete_button')}}</a></td>
              @endforeach
            </tr>
          </tbody>
        </table>
      </div>
     

    </section>

@section('scripts')
<script>
$('#userList').dataTable();
$('#myForm').validate();
</script>
@endsection

    @endsection
