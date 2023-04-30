 <!-- Add prospect form Start -->
 <div class="panel panel-info action_prospect_panel_1" style="display: none;">
          <div class="panel-heading">Add Prospect</div>
          <div class="panel-body">
            
          
          
          <div class="box-body add-prospect-data">
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
                <input type="email" name="cust_email" id="add_cust_email" class="form-control" style="width: 100%;" onchange="checkEmailorPhone()">
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
                <input type="text" name="cust_phone" id="add_cust_phone" class="form-control numbersOnly" style="width: 100%;" minlength="10" maxlength="10" onchange="checkEmailorPhone()">
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
                <input type="date" name="date_of_contact" class="form-control" style="width: 100%;" required>
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
            <div class="col-md-4">
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
            <div class="col-md-4">
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
            <div class="col-md-4">
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
            <div class="col-md-4">
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
            <div class="col-md-4">
              <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" required>
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
            <div class="clearfix"></div>
            <hr>
            @endif
            @if(in_array('status',$allowed_columns))
            <div class="col-md-4">
              <div class="form-group">
                <label>Invoice Address<br><br></label>
                <input type="text" name="invoice_address" class="form-control" style="width: 100%;" maxlength="500" required>
                @if($errors->has('status'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('status') }}</span>
                  @endif
              </div>
            </div>
            @endif
            @if(in_array('status',$allowed_columns))
            <div class="col-md-4">
            <div class="form-check">
              <label class="form-check-label" for="exampleCheckbox" style="display: block;">
              Uncheck if you want to provide defferent suppy address
              </label>
              <input class="form-check-input exampleCheckbox" type="checkbox" id="exampleCheckbox" name="supply_address_checked" checked value="1">
            </div>
                @if($errors->has('supply_add_check'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('status') }}</span>
                  @endif
            </div>
            @endif
            @if(in_array('status',$allowed_columns))
            <div class="col-md-4 supply_address">
              <div class="form-group">
                <label>Supply Address<br><br></label>
                <input type="text" name="supply_address" class="form-control supply_address_remove" style="width: 100%;" maxlength="500" required>
                @if($errors->has('status'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('status') }}</span>
                  @endif
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

  </div>
</div>

