@extends('admin.layouts.app')
@section('content')
@php
$allowed_columns = $permissions->pluck('column')->toArray();
@endphp
<section class="content-header">
    <h1>
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
      <div class="box box-default">
      <div class="box-header with-border box-header-style">
          <h3 class="box-title">{{__('messages.Edit Prospect')}}</h3>

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
          <form name="myForm" id="myForm" method="post" action="{{url('admin/update-prospact')}}" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control" value="{{ $prospact->cust_name }}">
            <input type="hidden" name="prospact_id" value="{{ $prospact->id }}">

            @if(in_array('cust_name',$allowed_columns))
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Customer name')}}<span style="color:red">*</span></label>
                <input type="text" name="cust_name" class="form-control" value="{{ $prospact->cust_name }}" style="width: 100%;" required>
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
                <input type="text" name="company_name" class="form-control" value="{{ $prospact->company_name }}" style="width: 100%;" required>
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
                <input type="email" name="cust_email" class="form-control" value="{{ $prospact->cust_email }}" style="width: 100%;" required>
            <div class="text-danger error_application"></div>
                @if($errors->has('email'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
              </div>
            </div>
            @if(in_array('cust_phone',$allowed_columns))
            @endif
            <div class="clearfix"></div>
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.phone')}}<span style="color:red">*</span></label>
                <input type="phone" name="cust_phone" class="form-control numbersOnly" value="{{ $prospact->cust_phone }}" style="width: 100%;" maxlength="10" required>
            <div class="text-danger error_application"></div>
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
                <input type="date" name="date_of_contact" class="form-control" value="{{ $prospact->date_of_contact }}" style="width: 100%;" required>
            <div class="text-danger error_application"></div>
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
                <input type="text" name="street_name" class="form-control" value="{{ $prospact->street_name }}" style="width: 100%;" maxlength="500">
                @if($errors->has('street_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('street_name') }}</span>
                  @endif
              </div>
            </div>
            @endif
            @if(in_array('post_code',$allowed_columns))
            <div class="clearfix"></div>
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Place Code')}}</label>
                <input type="text" name="post_code" class="form-control numbersOnly" value="{{ $prospact->post_code }}" style="width: 100%;" minlength="6" maxlength="6">
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
                <input type="text" name="place_name" class="form-control" value="{{ $prospact->place_name }}" style="width: 100%;" maxlength="500">
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
                <input type="text" name="wants_offer" class="form-control" value="{{ $prospact->wants_offer }}" style="width: 100%;" maxlength="500">
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
                <input type="text" name="no_employee" class="form-control" value="{{ $prospact->no_employee }}" style="width: 100%;" maxlength="500">
                @if($errors->has('no_employee'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('no_employee') }}</span>
                  @endif
              </div>
            </div>
            @endif
            @if(in_array('no_device',$allowed_columns))
            <div class="clearfix"></div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Number of Devices</label>
                <input type="text" name="no_device" class="form-control" value="{{ $prospact->no_device }}" style="width: 100%;" maxlength="500">
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
                <input type="text" name="device_type" class="form-control" value="{{ $prospact->device_type }}" style="width: 100%;" maxlength="500">
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
                <select name="callback" class="form-control">
                  <option value="">----- Select -----</option>
                  <option value="yes" @if($prospact->callback =='yes') selected @endif>Yes</option>
                  <option value="no" @if($prospact->callback =='no') selected @endif>No</option>
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
                <select name="status" class="form-control">
                <option value="">----- Select -----</option>
                  @foreach($StatusMaster as $status)
                  <option value="{{$status->id}}" @if($prospact->status == $status->id) selected @endif>{{$status->status}}</option>
                  @endforeach
                </select>
                @if($errors->has('status'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('status') }}</span>
                  @endif
              </div>
            </div>
            @endif
            @if(in_array('news',$allowed_columns))
            <div class="clearfix"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label>News</label>
                <textarea type="text" name="news" class="form-control" value="{{ $prospact->news }}" style="width: 100%;" maxlength="500">{{ $prospact->news }}</textarea>
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
                <textarea type="text" name="protocol" class="form-control" value="{{ $prospact->protocol }}" style="width: 100%;" maxlength="500">{{ $prospact->protocol }}</textarea>
                @if($errors->has('protocol'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('protocol') }}</span>
                  @endif
              </div>
            </div>
            @endif
            <div class="clearfix"></div>
            <div class="col-md-3">
              <div class="form-group">
                <label></label>
                <button class="form-control btn btn-primary" style="margin-top: 4px;">{{__('messages.submit_button')}}</button>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label></label>
                <a href="{{url('admin/user-dashboard')}}" class="form-control btn btn-default" style="margin-top: 4px;">{{__('messages.back_button')}}</a>
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
$('#userList').dataTable();
$('#myForm').validate();
// $('#myForm').submit(function(e) {
//     e.preventDefault();
//     var formData = new FormData(this);
//     $.ajax({
//       headers: {
//         'X-CSRF-Token': $('meta[name=_token]').attr('content')
//       },
//       type: 'POST',
//       url: "{{ url('admin/save-prospact') }}",
//       data: formData,
//       cache: false,
//       contentType: false,
//       processData: false,
//       success: function(data) {
//         if(data.status){
//           Swal.fire({
//             position: 'top-middle',
//             icon: 'success',
//             title: data.message,
//             showConfirmButton: false,
//             timer: 3000
//           });
//         }else{
//           // $('.error_application').text(data.message);
//         }
//       },
//     });
//   });

  imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }
</script>
@endsection

    @endsection
