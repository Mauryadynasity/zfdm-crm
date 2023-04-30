 <!-- Add prospect form Start -->
 <div class="panel panel-info  action_prospect_panel_2" style="display: none;">
          <div class="panel-heading">Edit Prospect</div>
          <div class="panel-body">
            
          
          <div class="box-body edit-prospect-data">
          <form name="editForm" id="editForm" method="post" enctype="multipart/form-data">
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
                <input type="email" name="cust_email" id="edit_cust_email" class="form-control cust_email" style="width: 100%;" onchange="checkEditEmailorPhone()">
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
                <input type="phone" name="cust_phone" id="edit_cust_phone" class="form-control cust_phone numbersOnly" style="width: 100%;" maxlength="10" onchange="checkEditEmailorPhone()">
            <div class="text-danger error_application"></div>
                @if($errors->has('phone'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('phone') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Date')}}<span style="color:red">*</span></label>
                <input type="date" name="date_of_contact" class="form-control date_of_contact" style="width: 100%;" required>
                <div class="text-danger error_application"></div>
                @if($errors->has('date_of_contact'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('date_of_contact') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Street Name')}}</label>
                <input type="text" name="street_name" class="form-control street_name" style="width: 100%;" maxlength="500" required>
                @if($errors->has('street_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('street_name') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="clearfix"></div>
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Place Code')}}</label>
                <input type="text" name="post_code" class="form-control post_code numbersOnly" style="width: 100%;" minlength="6" maxlength="6" required>
                @if($errors->has('post_code'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('post_code') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="col-md-4">
              <div class="form-group">
                <label>{{__('messages.Place Name')}}</label>
                <input type="text" name="place_name" class="form-control place_name" style="width: 100%;" maxlength="500" required>
                @if($errors->has('place_name'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('place_name') }}</span>
                  @endif
              </div>
            </div>
            
            
            <!-- <div class="col-md-2">
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
            </div> -->
            
            
            <div class="col-md-4">
              <div class="form-group">
                <label>Number of Employees</label>
                <input type="text" name="no_employee" class="form-control no_employee" style="width: 100%;" maxlength="500" required>
                @if($errors->has('no_employee'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('no_employee') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="clearfix"></div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Number of Devices</label>
                <input type="text" name="no_device" class="form-control no_device" style="width: 100%;" maxlength="500" required>
                @if($errors->has('no_device'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('no_device') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="col-md-4">
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
            
            
            <!-- <div class="col-md-3">
              <div class="form-group">
                <label>Choose Callback</label>
                <select name="callback" class="form-control callback" required>
                  <option value="">----- Select -----</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
                </select>
                  @if($errors->has('callback'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('callback') }}</span>
                  @endif
              </div>
            </div> -->
            
            
            <div class="col-md-4">
              <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control status" required>
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
                <textarea type="text" name="news" class="form-control news" style="width: 100%;" maxlength="500" required></textarea>
                @if($errors->has('news'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('news') }}</span>
                  @endif
              </div>
            </div>
            
            
            <div class="col-md-6">
              <div class="form-group">
                <label>Protocal</label>
                <textarea type="text" name="protocol" class="form-control protocol" style="width: 100%;" maxlength="500" required></textarea>
                @if($errors->has('protocol'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('protocol') }}</span>
                  @endif
              </div>
            </div>
            <div class="clearfix"></div>
            <hr>

            <div class="col-md-4">
              <div class="form-group">
                <label>Invoice Address<br><br></label>
                <input type="text" name="invoice_address" class="form-control invoice_address" style="width: 100%;" maxlength="500" required>
                @if($errors->has('status'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('status') }}</span>
                  @endif
              </div>
            </div>

            <div class="col-md-4">
            <div class="form-check">
              <label class="form-check-label" for="exampleCheckbox" style="display: block;">
              Uncheck if you want to provide defferent suppy address
              </label>
              <input class="form-check-input exampleCheckbox supply_address_checked" type="checkbox" id="exampleCheckbox" name="supply_address_checked" checked value="1">
            </div>
                @if($errors->has('supply_add_check'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('status') }}</span>
                  @endif
            </div>
            
            <div class="col-md-4 supply_address">
              <div class="form-group">
                <label>Supply Address<br><br></label>
                <input type="text" name="supply_address" class="form-control supply_address_remove supply_add" style="width: 100%;" maxlength="500" required>
                @if($errors->has('status'))
                    <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('status') }}</span>
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
          

  </div>
</div>
