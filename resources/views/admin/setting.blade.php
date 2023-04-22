@extends('admin.layouts.app')
@section('content')

@section('styles')
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
@endsection


<section class="content-header">
    
    <h1>
    Settings
    <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('messages.home')}}</a></li>
    <li class="active">{{__('messages.Setting')}}</li>
    </ol>
</section>


    <!-- Main content -->

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

  <section class="content">

    <!-- Tab for Setting -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Company Setting</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Status Setting</a></li>
        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Quotation Settings</a></li>
        <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Quotation Footer Text Settings</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">

        <form name="myForm" id="myForm" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
            <input type="hidden" name="admin_id" value="{{Auth::guard('admin')->user()->id}}">


        <div class="panel panel-primary">
          <div class="panel-heading">Company Details</div>
          <div class="panel-body">
          
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Company Name<span style="color:red">*</span></label>
                <input type="text" name="company_name" value="{{ $setting ? strtoupper($setting->company_name) : '' }}" class="form-control" style="width: 100%;" required>
                  @if($errors->has('company_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('company_name') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Contact Person’s Name<span style="color:red">*</span></label>
                <input type="text" name="person_name" value="{{ $setting ? strtoupper($setting->person_name) : '' }}" class="form-control" style="width: 100%;" required>
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
               <!--  <input type="file" name="upload_file" value="{{ $setting ? strtoupper($setting->upload_file) : '' }}" class="form-control" style="width: 100%;">
                  @if($errors->has('upload_file'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('upload_file') }}</span>
                  @endif -->
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Company Phone Numbers<span style="color:red">*</span></label>
                <input type="text" name="phone" value="{{ $setting ? strtoupper($setting->phone) : '' }}" minlength="10" maxlength="10" class="form-control numbersOnly" style="width: 100%;" required>
            <div class="text-danger error_application"></div>
                @if($errors->has('phone'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('phone') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Company Mobile Number</label>
                <input type="text" name="mobile_number" value="{{ $setting ? strtoupper($setting->mobile_number) : '' }}" minlength="10" maxlength="10" class="form-control numbersOnly" style="width: 100%;">
                @if($errors->has('mobile_number'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('mobile_number') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Company Landline Number</label>
                <input type="text" name="landline_number" value="{{ $setting ? strtoupper($setting->landline_number) : '' }}" minlength="10" maxlength="10" class="form-control numbersOnly" style="width: 100%;">
                @if($errors->has('landline_number'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('landline_number') }}</span>
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
            <div class="clearfix"></div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Ust Number<span style="color:red">*</span></label>
                <input type="number" name="ust_number" value="{{ $setting ? strtoupper($setting->ust_number) : '' }}"  class="form-control" style="width: 100%;" required>
                @if($errors->has('ust_number'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('ust_number') }}</span>
                  @endif
              </div>
            </div>
              

            {{-- @if($setting->upload_file)
            <div class="col-md-3">
              <div class="form-group">
                  <img id="blah" src="{{ url($setting->upload_file) }}" alt="" / style="width:25%;height:20%;">
                <!-- <img class="form-control" src="{{asset('storage/app/public/'.$setting->upload_file)}}" alt="" srcset="">  -->

                <!-- <img class="form-control" src="{{$setting->upload_file}}" alt="Girl in a jacket" width="500" height="600"> -->
              </div>
            </div>
            @endif --}}
          </div>


          </div>
        </div>


        <div class="panel panel-primary">
          <div class="panel-heading">Company Address</div>
          <div class="panel-body">
            
          <div class="row">
           <div class="col-md-3">
              <div class="form-group">
                <label>Streat Name 1<span style="color:red">*</span></label>
                <input type="text" name="streat_name_1" value="{{ $setting ? strtoupper($setting->streat_name_1) : '' }}"  class="form-control" style="width: 100%;" required>
                @if($errors->has('streat_name_1'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('streat_name_1') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Streat Name 2</label>
                <input type="text" name="streat_name_2" value="{{ $setting ? strtoupper($setting->streat_name_2) : '' }}"  class="form-control" style="width: 100%;">
                @if($errors->has('streat_name_2'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('streat_name_2') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Streat Name 3</label>
                <input type="text" name="streat_name_3" value="{{ $setting ? strtoupper($setting->streat_name_3) : '' }}"  class="form-control" style="width: 100%;">
                @if($errors->has('streat_name_3'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('streat_name_3') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Place Code<span style="color:red">*</span></label>
                <input type="text" name="place_code" value="{{ $setting ? strtoupper($setting->place_code) : '' }}"  class="form-control numbersOnly" maxlength="6" style="width: 100%;" required>
                @if($errors->has('place_code'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('place_code') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Place Name<span style="color:red">*</span></label>
                <input type="text" name="place_name" value="{{ $setting ? strtoupper($setting->place_name) : '' }}"  class="form-control" style="width: 100%;" required>
                @if($errors->has('place_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('place_name') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Country<span style="color:red">*</span></label>
                <input type="text" name="country" value="{{ $setting ? strtoupper($setting->country) : '' }}"  class="form-control" style="width: 100%;" required>
                @if($errors->has('country'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('country') }}</span>
                  @endif
              </div>
            </div>
            <!-- <div class="col-md-3">
              <div class="form-group">
                <label>Address<span style="color:red">*</span></label>
                <textarea type="text" name="company_address" value="{{ $setting ? strtoupper($setting->company_address) : '' }}" class="form-control" style="width: 100%;" required>{{ $setting ? strtoupper($setting->company_address) : '' }}</textarea>
                @if($errors->has('company_address'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('company_address') }}</span>
                  @endif
              </div>
            </div> -->
            </div>

          </div>
        </div>

        <div class="panel panel-primary">
          <div class="panel-heading">Bank Details</div>
          <div class="panel-body">
          
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Bank Name <span style="color:red">*</span></label>
                <input type="text" name="bank_name" value="{{ $setting ? strtoupper($setting->bank_name) : '' }}" class="form-control" style="width: 100%;" required>
                  @if($errors->has('bank_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('bank_name') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>IBAN<span style="color:red">*</span></label>
                <input type="text" name="account_number" value="{{ $setting ? strtoupper($setting->account_number) : '' }}" maxlength="15" class="form-control numbersOnly" style="width: 100%;" required>
                @if($errors->has('account_number'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('account_number') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>BIC<span style="color:red">*</span></label>
                <input type="text" name="ifsc_code" value="{{ $setting ? strtoupper($setting->ifsc_code) : '' }}"  class="form-control" style="width: 100%;" required>
                @if($errors->has('ifsc_code'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('ifsc_code') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Bank address</label>
                <input type="text" name="branch_address" value="{{ $setting ? strtoupper($setting->branch_address) : '' }}" class="form-control" style="width: 100%;">
                @if($errors->has('branch_address'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('branch_address') }}</span>
                  @endif
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Tax No<span style="color:red">*</span></label>
                <input type="text" name="tax_number" value="{{ $setting ? strtoupper($setting->tax_number) : '' }}" class="form-control" style="width: 100%;" required>
                @if($errors->has('tax_number'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('tax_number') }}</span>
                  @endif
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Tax Identification Number</label>
                <input type="text" name="tax_identification_no" value="{{ $setting ? strtoupper($setting->tax_identification_no) : '' }}" class="form-control" style="width: 100%;" required>
                @if($errors->has('tax_identification_no'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('tax_identification_no') }}</span>
                  @endif
              </div>
            </div>
          </div>


          </div>
        </div>


        <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label></label>
            <button class="form-control btn btn-primary" style="margin-top: 4px;">{{__('messages.submit_button')}}</button>
          </div>
        </div>
        </div>

        </form>
        </div>
    
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
        <div class="panel panel-primary">
          <div class="panel-heading">Status Color Setting</div>
          <div class="panel-body">
          <form id="save-color-setting" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
         <table class="table table-hover" id="statusColorSetting">
              <thead>
                <tr>
                  <th>SN#</th>
                  <th>Status</th>
                  <th>Pick Color</th>
                </tr>
              </thead>
              <tbody>
                @foreach($status_master as $index => $status)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$status->status}}
                    <input type="hidden" class="status" name="status[]" value="{{$status->status}}">
                  </td>
                  <td>
                  <div class="input-group my-colorpicker2 colorpicker-element" style="max-width: 200px;">
                    <input type="text" class="form-control" name="color[]" value="{{$status->color}}">
                    <div class="input-group-addon">
                      <i style="background-color: rgb(77, 40, 40);"></i>
                    </div>
                  </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
         </table>
          </div>
        </div>
        <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label></label>
            <button class="form-control btn btn-primary" style="margin-top: 4px;">{{__('messages.submit_button')}}</button>
          </div>
        </div>
        </div>
        </form>
      </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
        <form id="quotation-setting" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
        <input type="hidden" name="admin_user_id" value="{{Auth::guard('admin')->user()->id}}">
        <div class="panel panel-primary">
          <div class="panel-heading">Quotation Setting</div>
          <div class="panel-body">
              <div class="form-group">
                <label for="">Quotation Starting Number</label>
                <input type="text" class="form-control" name="quotation_start_no" id="quotation_start_no" onchange="$('#quotation_current_no').val($('#quotation_start_no').val());" value="{{($setting)?$setting->quotation_start_no:''}}" style="max-width: 200px;" required @if($setting->quotation_start_no>0) readonly @endif>
              </div>
              <div class="form-group">
                <label for="">Quotation Current Number</label>
                <input type="text" class="form-control" name="quotation_current_no" id="quotation_current_no" value="{{($setting)?$setting->quotation_current_no:''}}" style="max-width: 200px;" required readonly>
              </div>
          </div>
        </div>
        <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label></label>
            <button class="form-control btn btn-primary" style="margin-top: 4px;">{{__('messages.submit_button')}}</button>
          </div>
        </div>
        </div>
        </form>
      </div>

      <div class="tab-pane" id="tab_4">
        <form id="footer-text" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
        <input type="hidden" name="admin_user_id" value="{{Auth::guard('admin')->user()->id}}">
        <div class="panel panel-primary">
          <div class="panel-heading">Footer Text Setting</div>
          <div class="panel-body">
              <div class="form-group">
                <label for="">Footer Text</label>
                <textarea class="form-control" name="footer_text" id="footer_text" value="{{($setting)?$setting->footer_text:''}}" style="max-width: 1000px;" required>{{($setting)?$setting->footer_text:''}}</textarea>
              </div>
          </div>
        </div>
        <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label></label>
            <button class="form-control btn btn-primary" style="margin-top: 4px;">{{__('messages.submit_button')}}</button>
          </div>
        </div>
        </div>
        </form>
      </div>
        </div>
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- Tab for Setting -->
    </section>

@section('scripts')
<script src="{{asset('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('bower_components/ckeditor/ckeditor.js')}}"></script>
<script>
CKEDITOR.replace('footer_text')
    //bootstrap WYSIHTML5 - text editor

$('.my-colorpicker2').colorpicker();

$('#statusColorSetting').dataTable();
$('#myForm').validate();
$('#quotation-setting').validate();
$('#myForm').submit(function(e) {
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
          // $('.error_application').text(data.message);
        }
      },
    });
  });

  $('#save-color-setting').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      headers: {
        'X-CSRF-Token': $('meta[name=_token]').attr('content')
      },
      type: 'POST',
      url: "{{ url('admin/save-color-setting') }}",
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
          // $('.error_application').text(data.message);
        }
      },
    });
  });

  $('#quotation-setting').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      headers: {
        'X-CSRF-Token': $('meta[name=_token]').attr('content')
      },
      type: 'POST',
      url: "{{ url('admin/quotation-setting') }}",
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
          // $('.error_application').text(data.message);
        }
      },
    });
  });

  $('#footer-text').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      headers: {
        'X-CSRF-Token': $('meta[name=_token]').attr('content')
      },
      type: 'POST',
      url: "{{ url('admin/footer-text') }}",
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
          // $('.error_application').text(data.message);
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
