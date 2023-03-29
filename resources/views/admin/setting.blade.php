@extends('admin.layouts.app')
@section('content')
<section class="content-header">
    <h1>
    {{__('messages.Setting')}}
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
          <form name="myForm" id="myForm" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
            <input type="hidden" name="admin_id" value="{{Auth::guard('admin')->user()->id}}">

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Company Name<span style="color:red">*</span></label>
                <input type="text" name="company_name" value="{{ $setting ? $setting->company_name : '' }}" class="form-control" style="width: 100%;" required>
                  @if($errors->has('company_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('company_name') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Contact Person’s Name<span style="color:red">*</span></label>
                <input type="text" name="person_name" value="{{ $setting ? $setting->person_name : '' }}" class="form-control" style="width: 100%;" required>
                @if($errors->has('person_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('person_name') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Company website<span style="color:red">*</span></label>
                <input type="url" name="website_url" value="{{ $setting ? $setting->website_url : '' }}" class="form-control" style="width: 100%;" required>
                @if($errors->has('website_url'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('website_url') }}</span>
                  @endif
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Company Logo</label>
                  <input class="form-control" accept="image/*" type='file' id="imgInp" name="upload_file" />
               <!--  <input type="file" name="upload_file" value="{{ $setting ? $setting->upload_file : '' }}" class="form-control" style="width: 100%;">
                  @if($errors->has('upload_file'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('upload_file') }}</span>
                  @endif -->
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Company Phone Numbers<span style="color:red">*</span></label>
                <input type="text" name="phone" value="{{ $setting ? $setting->phone : '' }}" maxlength="10" class="form-control numbersOnly" style="width: 100%;" required>
                @if($errors->has('phone'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('phone') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Company Email<span style="color:red">*</span></label>
                <input type="email" name="email" value="{{ $setting ? $setting->email : '' }}"  class="form-control" style="width: 100%;" required>
                @if($errors->has('email'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Address<span style="color:red">*</span></label>
                <textarea type="text" name="company_address" value="{{ $setting ? $setting->company_address : '' }}" class="form-control" style="width: 100%;" required>{{ $setting ? $setting->company_address : '' }}</textarea>
                @if($errors->has('company_address'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('company_address') }}</span>
                  @endif
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                {{-- @if($setting->upload_file)
                  <img id="blah" src="{{$setting->upload_file}}" style="width:25%;height:20%;">
                @endif --}}
                <img id="blah" src="" style="width:25%;height:20%;">
              </div>
            </div>
          </div>
          <hr style="height:2px;background-color: #c0c0c0;" />
          <h3>Bank Details</h3>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Bank Name <span style="color:red">*</span></label>
                <input type="text" name="bank_name" value="{{ $setting ? $setting->bank_name : '' }}" class="form-control" style="width: 100%;" required>
                  @if($errors->has('bank_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('bank_name') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>IBAN<span style="color:red">*</span></label>
                <input type="text" name="account_number" value="{{ $setting ? $setting->account_number : '' }}" maxlength="15" class="form-control numbersOnly" style="width: 100%;" required>
                @if($errors->has('account_number'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('account_number') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>BIC<span style="color:red">*</span></label>
                <input type="text" name="ifsc_code" value="{{ $setting ? $setting->ifsc_code : '' }}"  class="form-control" style="width: 100%;" required>
                @if($errors->has('ifsc_code'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('ifsc_code') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Bank Branch address</label>
                <input type="text" name="branch_address" value="{{ $setting ? $setting->branch_address : '' }}" class="form-control" style="width: 100%;">
                @if($errors->has('branch_address'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('branch_address') }}</span>
                  @endif
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Company Registration Code </label>
                <input type="text" name="tax_number" value="{{ $setting ? $setting->tax_number : '' }}" class="form-control" style="width: 100%;">
                @if($errors->has('tax_number'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('tax_number') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label></label>
                <button class="form-control btn btn-primary" style="margin-top: 4px;">{{__('messages.submit_button')}}</button>
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
$('#myForm').submit(function(e) {
  if($(this).valid()==false){
    return false;
  }
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      headers: {
        'X-CSRF-Token': $('meta[name=_token]').attr('content')
      },
      type: 'POST',
      url: "{{ url('admin/save-setting') }}",
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
        }else{
          alert(data.message);
        }
      },
    });
  });

  imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }
</script>
@endsection

    @endsection
