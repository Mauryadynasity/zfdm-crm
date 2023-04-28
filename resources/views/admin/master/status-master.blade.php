@extends('admin.layouts.app')
@section('content')

@section('styles')
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
@endsection


<section class="content-header">
    
    <h1>
    Status Master
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
          <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Add Status</a></li>
          <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Change Color</a></li>
      </ul>
      <div class="tab-content">
    
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
        <div class="tab-pane active" id="tab_3">
        <form id="status-master" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
        <div class="panel panel-primary">
          <div class="panel-heading">Status Master</div>
          <div class="panel-body">
              <div class="form-group">
                <label for="">Status Name</label>
                <input type="text" class="form-control" id="status" name="status" style="max-width: 200px;" required>
              </div>
                <label for="">Status Color</label>
              <div class="input-group my-colorpicker2 colorpicker-element" style="max-width: 200px;">
                    <input type="text" class="form-control" id="color" name="color" required><br>
                    <div class="input-group-addon">
                      <i style="background-color: rgb(77, 40, 40);"></i>
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

  $('#status-master').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      headers: {
        'X-CSRF-Token': $('meta[name=_token]').attr('content')
      },
      type: 'POST',
      url: "{{ url('admin/status-master') }}",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(data) {
        if(data.status){
            $('#status-master')[0].reset();
          Swal.fire({
            position: 'top-middle',
            icon: 'success',
            title: data.message,
            showConfirmButton: true,
            // timer: 3000
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
