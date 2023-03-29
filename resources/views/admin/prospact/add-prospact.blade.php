@extends('admin.layouts.app')
@section('content')
<section class="content-header">
    <h1>
      Add Prospact
    <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('messages.home')}}</a></li>
    <li class="active">{{__('messages.Setting')}}</li>
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
          <form name="myForm" id="myForm" method="post" action="{{url('admin/save-prospact')}}" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
            <!-- <input type="hidden" name="admin_id" value="{{Auth::guard('admin')->user()->id}}"> -->

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Customer name<span style="color:red">*</span></label>
                <input type="text" name="cust_name" class="form-control" style="width: 100%;" required>
                @if($errors->has('cust_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('cust_name') }}</span>
                  @endif
              </div>
            </div>
             <div class="col-md-3">
              <div class="form-group">
                <label>Company Name<span style="color:red">*</span></label>
                <input type="text" name="company_name" class="form-control" style="width: 100%;" required>
                  @if($errors->has('company_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('company_name') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email Address<span style="color:red">*</span></label>
                <input type="email" name="cust_email" class="form-control" style="width: 100%;" required>
            <div class="text-danger error_application"></div>
                @if($errors->has('email'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Phone Number<span style="color:red">*</span></label>
                <input type="text" name="cust_phone" class="form-control numbersOnly" style="width: 100%;" minlength="10" maxlength="12" required>
            <div class="text-danger error_application"></div>
                @if($errors->has('phone'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('phone') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Date<span style="color:red">*</span></label>
                <input type="date" name="date_of_contact" class="form-control" style="width: 100%;" required>
            <div class="text-danger error_application"></div>
                @if($errors->has('date_of_contact'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('date_of_contact') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Customer Address</label>
                <textarea type="text" name="cust_address" class="form-control" style="width: 100%;" maxlength="500"></textarea>
            <div class="text-danger error_application"></div>
                @if($errors->has('cust_address'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('cust_address') }}</span>
                  @endif
              </div>
            </div>
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
