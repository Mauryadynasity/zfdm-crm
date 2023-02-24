@extends('layouts.admin.adminDashboard')
@section('pageContent')
<style>
  .container-fluid .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 4px;
  }
  .container-fluid .select2-container .select2-selection--single {
      height: 37px;
  }
  .container-fluid .select2-container--default .select2-selection--single .select2-selection__arrow {
    top: 5px;
  }
  .select2-selection__choice{
    color: #000 !important;
  }
    form.cmxform label.error, label.error {
        color: red;
        font-style: italic;
        display: block;
    }
    .btn-warning{
        background-color: #ff9933!important;
    }
</style>
<div class="content-wrapper">
   <div class="container-fluid">
      <div class="card mb-3">
         <div class="card-header">
            <div class="row breadcrumb">
               <div class="col-md-9">Add User</div>
            </div>
         </div>
         <div class="card-body">
            <form action="{{route('user.store')}}" class="cmxform" id="form-data" method="POST" enctype="multipart/form-data">
               {{csrf_field()}}
               
               <div class="row">
                  <div class="col-md-3">
                     <strong>Name: <span style="color:red">*</span></strong>
                     <input type="text" name="name" class="form-control" placeholder="Enter Name" required value="{{old('name')}}" maxlength="15" >
                     @if($errors->has('name'))
                        <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('name') }}</span>
                     @endif
                  </div>
                  <div class="col-md-3">
                     <strong>Email: <span style="color:red">*</span></strong>
                     <input type="email" name="email" class="form-control" placeholder="Enter Email" required value="{{old('email')}}" maxlength="50" autocomplete="nope">
                     @if($errors->has('email'))
                         <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('email') }}</span>
                     @endif
                  </div>
                  <div class="col-md-3">
                     <strong>Phone: <span style="color:red">*</span></strong>
                     <input type="text" name="phone" class="form-control numbersOnly" placeholder="Enter Phone" required value="{{old('phone')}}" maxlength="15">
                     @if($errors->has('phone'))
                         <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('phone') }}</span>
                     @endif
                  </div>
                  <div class="col-md-3">
                     <strong>Admin Role: <span style="color:red">*</span></strong>
                     <select name="role_id" id="Role" class="form-control" required>
                        <option value="">--- Select Role ---</option>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                     </select>
                     @if($errors->has('role_id'))
                         <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('role_id') }}</span>
                     @endif
                  </div>
               <div class="col-md-3">
                  <strong>Password: <span style="color:red">*</span></strong>
                  <input type="password" name="password" class="form-control" placeholder="Enter Password" required value="{{old('password')}}" maxlength="15" autocomplete="new_password">
                  @if($errors->has('password'))
                      <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('password') }}</span>
                  @endif
               </div>
               <div class="col-md-1">
               <br>
                  <button class="text-decoration-none btn btn-primary" type="submit" >Submit
                  </button>
               </div>
               <div class="col-md-1">
               <br>
               <a class="text-decoration-none btn btn-primary" href="{{url('admin/user')}}"><b>Back</b> </a>
               </div>
             </div>
            </form>
         </div>
      </div>
   </div>
</div>


@section('scripts')

<script type="text/javascript" charset="utf-8" async defer>
   $("#form-data").validate();
    $('#Role').select2({
        allowClear: true,
        placeholder: 'Select Role',
    });
    $('.numbersOnly').keyup(function() {
            this.value = this.value.replace(/[^0-9\.]/g, '');
        });
</script>
@endsection


@endsection