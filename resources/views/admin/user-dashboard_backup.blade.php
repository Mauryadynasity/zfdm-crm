@extends('admin.layouts.app')
@section('content')
@php
$allowed_columns = $permissions->pluck('column')->toArray();
@endphp


@section('styles')
<style type="text/css">
  .trRow{
    display: none;
  }
  body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  color: white;
  background-color: blue;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
@endsection
<!-- <section class="content-header">
    <h1>
    {{__('messages.Prospects')}}
    {{__('messages.'.Auth::guard('admin')->user()->name)}}
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('messages.home')}}</a></li>
    <li class="active"><a href="{{url('admin/user-dashboard')}}">{{__('messages.Prospects')}}</a></li>
    <li class="active"><a href="{{url('admin/quotation-list')}}">{{__('messages.Quotations')}}</a></li>
    </ol>
</section> -->
<!-- Main content -->
<section class="content">
      <div class="box box-default">
        <div class="box-header with-border box-header-style">
          <h3 class="box-title">{{__('messages.Prospects')}}</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
      
      <!-- Edit prospect form start -->
      <div class="box-body edit-prospect-data " style="display: none;">
          <form name="editForm" id="editForm" method="post" action="{{url('admin/update-prospact')}}" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
            <input type="hidden" class="prospact_id" name="prospact_id">

            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Customer name')}}<span style="color:red">*</span></label>
                <input type="text" name="cust_name" class="form-control cust_name" style="width: 100%;" required>
                @if($errors->has('cust_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('cust_name') }}</span>
                  @endif
              </div>
            </div>
            
            
             <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Company Name')}}<span style="color:red">*</span></label>
                <input type="text" name="company_name" class="form-control company_name" style="width: 100%;" required>
                  @if($errors->has('company_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('company_name') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.email')}}<span style="color:red">*</span></label>
                <input type="email" name="cust_email" class="form-control cust_email" style="width: 100%;" required>
            <div class="text-danger error_application"></div>
                @if($errors->has('email'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
              </div>
            </div>
            
            <div class="clearfix"></div>
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.phone')}}<span style="color:red">*</span></label>
                <input type="phone" name="cust_phone" class="form-control cust_phone numbersOnly" style="width: 100%;" maxlength="10" required>
            <div class="text-danger error_application"></div>
                @if($errors->has('phone'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('phone') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Date')}}<span style="color:red">*</span></label>
                <input type="text" name="date_of_contact" class="form-control date_of_contact" style="width: 100%;" required>
            <div class="text-danger error_application"></div>
                @if($errors->has('date_of_contact'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('date_of_contact') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Street Name')}}</label>
                <input type="text" name="street_name" class="form-control street_name" style="width: 100%;" maxlength="500">
                @if($errors->has('street_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('street_name') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="clearfix"></div>
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Place Code')}}</label>
                <input type="text" name="post_code" class="form-control post_code numbersOnly" style="width: 100%;" minlength="6" maxlength="6">
                @if($errors->has('post_code'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('post_code') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Place Name')}}</label>
                <input type="text" name="place_name" class="form-control place_name" style="width: 100%;" maxlength="500">
                @if($errors->has('place_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('place_name') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="col-md-2">
              <div class="form-group">
                <label>wants offer</label>
                <select name="wants_offer" class="form-control wants_offer" required>
                  <option value="">----- Select -----</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
                </select> 
                  @if($errors->has('wants_offer'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('wants_offer') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="col-md-2">
              <div class="form-group">
                <label>Number of Employees</label>
                <input type="text" name="no_employee" class="form-control no_employee" style="width: 100%;" maxlength="500">
                @if($errors->has('no_employee'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('no_employee') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="clearfix"></div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Number of Devices</label>
                <input type="text" name="no_device" class="form-control no_device" style="width: 100%;" maxlength="500">
                @if($errors->has('no_device'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('no_device') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="col-md-3">
              <div class="form-group">
              <label>Device Type</label>
                <select name="device_type" class="form-control device_type" required>
                  <option value="">----- Select -----</option>
                  <option value="RFID">RFID</option>
                  <option value="BIO">BIO</option>
                </select>
              @if($errors->has('device_type'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('device_type') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="col-md-3">
              <div class="form-group">
                <label>Choose Callback</label>
                <select name="callback" class="form-control callback">
                  <option value="">----- Select -----</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
                </select>
                  @if($errors->has('callback'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('callback') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="col-md-3">
              <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control status">
                <option value="">----- Select -----</option>
                  @foreach($StatusMaster as $status)
                  <option value="{{$status->status}}">{{$status->status}}</option>
                  @endforeach
                </select>
                @if($errors->has('status'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('status') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="clearfix"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label>News</label>
                <textarea type="text" name="news" class="form-control news" style="width: 100%;" maxlength="500"></textarea>
                @if($errors->has('news'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('news') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="col-md-6">
              <div class="form-group">
                <label>Protocal</label>
                <textarea type="text" name="protocol" class="form-control protocol" style="width: 100%;" maxlength="500"></textarea>
                @if($errors->has('protocol'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('protocol') }}</span>
                  @endif
              </div>
            </div>
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
                <!-- <a href="{{url('admin/user-dashboard')}}" class="form-control btn btn-default" style="margin-top: 4px;">{{__('messages.back_button')}}</a> -->
              </div>
            </div>
          </form>
      </div>
      <!-- End prospect form -->

      <!-- Add prospect form Start -->
        <div class="box-body add-prospect-data " style="display: none;">
          <form name="myForm" class="" id="myForm" method="post" action="{{url('admin/save-prospact')}}" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
            <!-- <input type="hidden" name="admin_id" value="{{Auth::guard('admin')->user()->id}}"> -->

          <div class="row">
            @if(in_array('cust_name',$allowed_columns))
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Customer name')}}<span style="color:red">*</span></label>
                <input type="text" name="cust_name" class="form-control" style="width: 100%;" required>
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
                <input type="text" name="company_name" class="form-control" style="width: 100%;" required>
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
                <input type="email" name="cust_email" class="form-control" style="width: 100%;" required>
                @if($errors->has('email'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
              </div>
            </div>
            @endif
            <div class="clearfix"></div>
            @if(in_array('cust_phone',$allowed_columns))
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.phone')}}<span style="color:red">*</span></label>
                <input type="text" name="cust_phone" class="form-control numbersOnly" style="width: 100%;" minlength="10" maxlength="10" required>
                @if($errors->has('phone'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('phone') }}</span>
                  @endif
              </div>
            </div>
            @endif
            @if(in_array('date_of_contact',$allowed_columns))
            <div class="col-md-4">
              <?php $date = date("Y-m-d"); ?>
              <div class="form-group">
                <label>{{__('messages.Date')}}<span style="color:red">*</span></label>
                <input type="text" name="date_of_contact" value="{{$date}}" class="form-control" style="width: 100%;" required>
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
                <input type="text" name="street_name" class="form-control" style="width: 100%;" maxlength="500" required>
                @if($errors->has('street_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('street_name') }}</span>
                  @endif
              </div>
            </div>
            @endif
            <div class="clearfix"></div>
            @if(in_array('post_code',$allowed_columns))
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Place Code')}}</label>
                <input type="text" name="post_code" class="form-control numbersOnly" style="width: 100%;" minlength="6" maxlength="6" required>
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
                <input type="text" name="place_name" class="form-control" style="width: 100%;" maxlength="500" required>
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
                <select name="wants_offer" class="form-control" required>
                  <option value="">----- Select -----</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
                </select>
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
                <input type="text" name="no_employee" class="form-control" style="width: 100%;" maxlength="500" required>
                @if($errors->has('no_employee'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('no_employee') }}</span>
                  @endif
              </div>
            </div>
            @endif
            <div class="clearfix"></div>
            @if(in_array('no_device',$allowed_columns))
            <div class="col-md-3">
              <div class="form-group">
                <label>Number of Devices</label>
                <input type="text" name="no_device" class="form-control" style="width: 100%;" maxlength="500" required>
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
                <select name="device_type" class="form-control" required>
                  <option value="">----- Select -----</option>
                  <option value="RFID">RFID</option>
                  <option value="BIO">BIO</option>
                </select>
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
                <select name="callback" class="form-control" required>
                  <option value="">----- Select -----</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
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
                <select name="status" class="form-control" required>
                <option value="">----- Select -----</option>
                  @foreach($StatusMaster as $status)
                  <option value="{{$status->status}}">{{$status->status}}</option>
                  @endforeach
                </select>
                @if($errors->has('status'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('status') }}</span>
                  @endif
              </div>
            </div>
            @endif
            <div class="clearfix"></div>
            @if(in_array('news',$allowed_columns))
            <div class="col-md-6">
              <div class="form-group">
                <label>Customer message</label>
                <textarea type="text" name="news" class="form-control" style="width: 100%;" maxlength="500" required></textarea>
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
                <textarea type="text" name="protocol" class="form-control" style="width: 100%;" maxlength="500" required></textarea>
                @if($errors->has('protocol'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('protocol') }}</span>
                  @endif
                  <input type="hidden" name="cust_source" value="user" class="cust_source_class">

              </div>
            </div>
            @endif
            <div class="clearfix"></div>
            <div class="col-md-2">
              <div class="form-group">
                <label></label>
                <button type="submit" class="form-control btn btn-primary" style="margin-top: 4px;">{{__('messages.submit_button')}}</button>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label></label>
                <a href="{{url('admin/user-dashboard')}}" class="form-control btn btn-default" style="margin-top: 4px;">{{__('messages.Reset')}}</a>
              </div>
            </div>
          </div>
          </form>
          <div class="clearfix"></div>
          <!-- /.row -->
        </div>
      <!-- End add prospect form -->

        <div class="">
        <hr class="show-on-tab" style="display: none;">
        <hr class="edit-show-on-tab" style="display: none;">
        <br/>
          <button class="btn btn-primary" onclick="openCity(event, 'Prospect')">Prospect</button>
          <button class="btn btn-primary" onclick="openCity(event, 'Quotations')">Quotations</button>
          <br/>
          <br/>
        </div>

        <!-- <form method="get" id="filter_data">
        <div class="box-body">
        <div class="col-md-4">
					<span style="color: black;">Filter:</span>
					<select data-live-search="true" name="status_filter" id="status_filter" style="border-color: #c0c0c0;" class="form-control js-example-basic-single " onChange="return $('#filter_data').submit();">
					    <option value="">--Choose Status--</option>
							@foreach($StatusMaster as $status)
                  <option value="{{$status->id}}">{{$status->status}}</option>
                  @endforeach
          </select>
          </div>
        </div>
        </form> -->
        <!-- <form>
        <div class="box-body">
        <div class="col-md-3">
					<span style="color: black;">From Date:</span>
					<input type="date" name="from_date" id="from_date" style="border-color: #c0c0c0;" class="form-control">
          </div>
        <div class="col-md-3">
					<span style="color: black;">To Date:</span>
          <input type="date" name="to_date" id="to_date" style="border-color: #c0c0c0;" class="form-control">
          </div>
          <div class="col-md-2">
              <div class="form-group">
                <label></label>
                <button class="form-control btn btn-primary" style="margin-top: 4px;">{{__('messages.submit_button')}}</button>
              </div>
            </div>
        </div>
      </form> -->
      <div class="prospect-container tabcontent" id="Prospect" style="display: block;">
      <br/>
      <br/>
      <select name="" onchange="setProspectColumn($(this))">
        @foreach($permissions as $permission)
        @if($permission->status=='no')
        @php $allowed_column = $permission->column; @endphp
        <option value="{{$allowed_column}}">{{$allowed_column}}</option>
        @endif
        @endforeach
      </select>
      <button class="btn btn-info" onclick="$('.add-prospect-data,.show-on-tab').toggle();$('.edit-prospect-data').hide()">Add new Prospect</button>
      <table class="table table-bordered border-success table-responsive yajra-datatable " style="display: block;" id="prospect-table" width="100%">
        <thead>
            <tr>
              <th>ID</th>
              @foreach($permissions as $permission)
              <th class="{{$permission->column}}_class" @if($permission->status=='no') style="display:none" @endif>{{$permission->column_name}}</th>
              @endforeach
              <th>{{__('messages.action')}}</th>
              </tr>
          </thead>
          <tbody>
            @foreach($prospacts as $prospact)
            <tr>
              <td class="prospact_id">{{$prospact->id}}</td>
              @foreach($permissions as $permission)
              @php $allowed_column = $permission->column; @endphp
              <th class="{{$allowed_column}}_class" @if($permission->status=='no') style="display:none" @endif>{{$prospact->$allowed_column}}</th>
              @endforeach
              <td>
                <button title="Edit" class="btn btn-primary" onclick="editProspectForm($(this));"><i class="fa fa-edit"></i></button>
                <a href="{{url('admin/delete-prospact')}}/{{$prospact->id}}" title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                <!-- <button type="button" class="btn btn-danger mybutton" title="Add Quotation" onClick="addNewOffer($(this))">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                </button> -->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
      <div class="tabcontent" id="Quotations">
                <!-- Quotation list -->
          <table class="table table-bordered border-success yajra-datatable " id="quotations-table" width="100%">
          <thead>
            <tr>
            <th>{{__('messages.sr_no')}}</th>
              <th>{{__('messages.Company Name')}}</th>
              <th>{{__('messages.Customer name')}}</th>
              <th>{{__('messages.Quotation Number')}}</th>
              <th>{{__('messages.Quotation Date')}}</th>
              <th>{{__('messages.action')}}</th>
              </tr>
          </thead>
          <tbody>
            @foreach($quotations as $quotation)
            <tr>
              <td class="prospact_id">{{$quotation->id}}</td>
              <td class="company_name">{{$quotation->company_name}}</td>
              <td>{{$quotation->cust_name}}</td>
              <td>{{$quotation->quotation->quotation_number}}</td>
              <td>{{$quotation->quotation->quotation_date}}</td>
              <td>
                <a href="{{url('admin/view-quotation')}}/{{$quotation->id}}" title="View" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a href="{{url('admin/edit-quotation')}}/{{$quotation->id}}" title="Edit" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                <a href="{{url('admin/delete-quotation')}}/{{$quotation->id}}" title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
      
      @include('admin.offer.add-new-quotation')

    </div>


    </section>
    @section('scripts')
    <script>
      $(document).ready( function () {
          $('.date_of_contact').datetimepicker({
            format: 'MM-DD-YYYY',
            locale: 'en'
          });
          $('#prospect-table').dataTable();
          $('#quotations-table').dataTable();
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

  // $('#saveOffers').validate();
$.validator.addMethod("cValidate", function(value, element, min) {
    var message = false;
    if(value==0){
      message = true;
    }
    if(value.length>4){
      message = true;
    }
    return message;
}, "Please provide atleast 5 characters or 0.");

$('#saveOffers').validate({
  rules: {
    comments: {
      required: true,
      cValidate: true
    },
  },
  errorPlacement: function (error, element) {
    var name = $(element).attr("name");
    error.appendTo($("#" + name + "_validate"));
},
});

  function saveOffersFunction(){
  $('#saveOffers').submit();
  }

  // function addNewOffer($this){
  //     var selectedTr = $this.closest('tr');
  //     var prospact_id = selectedTr.find('.prospact_id').text();
  //     $("#modal-default").modal('show');
  //     $.ajax({
  //       headers: {
  //         'X-CSRF-Token': $('meta[name=_token]').attr('content')
  //       },
  //       type: 'GET',
  //       url: "{{ url('admin/get-prospact-details') }}",
  //       data: {
  //           'prospact_id' : prospact_id,
  //       },
  //       success: function(data) {
  //         if(data){
  //           $(".prospact_id").val(data.id);
  //           $(".cus-name").html(data.cust_name);
  //           $(".company-name").html(data.company_name);
  //           $(".street_name").html(data.street_name);
  //           $(".post_code").html(data.post_code);
  //           $(".place_name").html(data.place_name);
  //           $(".quotation_number").html(data.id);
  //           // $(".cus-phone").html(data.cust_phone);
  //           // $(".cus-email").html(data.cust_email);
  //         }else{
  //           // alert(data.message);
  //         }
  //       },
  //     });
  // }

    $('#saveOffers').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        headers: {
          'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        type: 'POST',
        url: "{{ url('admin/save-quotation') }}",
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
          $('#saveOffers').trigger("reset");
          // $('#modal-default').modal('hide');
          // window.open("{{url('admin/view-quotation')}}");
          // $("#modal").modal('hide');
          }else{
            Swal.fire({
              position: 'top-middle',
              icon: 'error',
              title: data.message,
              showConfirmButton: false,
              timer: 3000
            });
            $('#saveOffers').trigger("reset");
            // $('#modal-default').modal('hide');
          }
        },
      });
    });


  //   function showQuotationModal(current_val){
  //     var current_tr = current_val.closest('tr');
  //     var company_name = current_tr.find('.company_name_class').text();
  //     $('.company-name').text(company_name);
  //     // $(".mybutton").show();
  // }

    // $('#myTable tbody').on( 'click', 'tr', function () {
    //     $(".mybutton").show();
    //     $('.mybutton').prop('disabled', false);
    //     $('#myTable tbody tr').removeClass('selected');
    //     $(this).toggleClass('selected');
    // });

  function calculateTotalPrice($this){
    var currentTr = $this.closest('tr');
    var prise_per_article = currentTr.find('.prise_per_article').val();
    var number_of_article  = currentTr.find('.number_of_article').val();
    var total_price = parseInt(prise_per_article) * parseInt(number_of_article);
    if(Number.isInteger(total_price)){
      currentTr.find('.price').val(total_price);
      currentTr.find('.price_text').html('$'+total_price);
    }
    calculateGrandTotalPrice(total_price);
  }
  function calculateGrandTotalPrice(total_price){
    var grandTotal = 0;
    $('.price').each(function(total_price) {
      var price = parseInt($(this).val());
      if(Number.isInteger(price)){
        grandTotal += price;
      }
    });
    if(Number.isInteger(grandTotal)){
      var gstNumber = parseFloat((grandTotal*'{{$settingDetails->ust_number}}')/100);
      $('.subtotal').html('$'+grandTotal);
      $('.gstNumber').html('$'+gstNumber);
      $('.grandTotal').html('$'+(grandTotal+gstNumber));
      $('.subtotal_val').val(grandTotal);
      $('.gstNumber_val').val(gstNumber);
      $('.grandTotal_val').val((grandTotal+gstNumber));
    }
  }

  function addTr(){
    var position_count = ($('.article_description').length);
    var content = $('.trRow').html();
    var positionDetails = '<td><span class="position_text">'+position_count+'</span></td>';
    position_count = position_count + 1;
    var content_text = '<tr>'+positionDetails+content+'</tr>';
    $('.offerTable tbody').append(content_text);
  }

  function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

function setProspectColumn($this){
  var column_name = $this.val();
  $('.'+column_name+'_class').toggle();

}



// Phone or Email Unique Validation


// $('#editForm').validate({
//     rules : {
//       cust_email : { 
//         required : true,
//         remote: {
//           url: "{{ url('admin/is-email-unique-edit') }}", // the URL of the PHP script that validates the email
//           type: 'GET'
//         }
//        },
//        cust_phone : {
//         required : true,
//         remote: {
//           url: "{{ url('admin/is-phone-unique-edit') }}", // the URL of the PHP script that validates the email
//           type: 'GET'
//         }
//        }
//     },
//     messages:{
//       cust_email: {
//         remote: 'This Email Id is already exists.'
//       },
//       cust_phone: {
//         remote: 'Phone number is already exists.'
//       }
//     }
// });


 $('#myForm').submit(function(e) {
      e.preventDefault();
      if($(this).valid()==false) {
            return false;
      }

      var formData = new FormData(this);
      $.ajax({
        headers: {
          'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        type: 'POST',
        url: "{{ url('admin/save-prospact') }}",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          if(data.status == true){
            Swal.fire({
              position: 'top-middle',
              icon: 'success',
              title: data.message,
              html: '<a class="btn btn-primary" href="{{url("admin/user-dashboard")}}">Ok</a> ',
              showConfirmButton: false,
              timer: 3000
            });
          $('#editForm').trigger("reset");
          $('#editForm').trigger("reset");
          $('.edit-prospect-data').hide();
          $('.add-prospect-data').hide();
          }
        },
      });
    });


    </script>
    
    @endsection

    @endsection

