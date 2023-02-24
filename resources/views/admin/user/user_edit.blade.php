@extends('layouts.admin.adminDashboard') @section('pageContent') <style>
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

  .select2-selection__choice {
    color: #000;
  }
</style>
<div class="content-wrapper">
  <!-- /.container-fluid -->
  <div class="container-fluid">
    <div class="card mb-3">
      <div class="card-header">
        <div class="row breadcrumb">
          <div class="col-md-9">Edit User</div>
        </div>
      </div>
      <div class="card-body">
        <form action="{{route('user.update',$users->id)}}" method="POST" enctype="multipart/form-data">
           @csrf  
           @method('PATCH')
          <div class="row">
            <div class="col-md-3">
               <strong>Name: <span style="color:red">*</span></strong>
               <input type="text" name="name" class="form-control" placeholder="Enter Name" value='{{old("name",$users->name)}}' maxlength="15" >
               @if($errors->has('name'))
                  <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('name') }}</span>
               @endif
            </div>
            <div class="col-md-3">
               <strong>Email: <span style="color:red">*</span></strong>
               <input type="email" name="email" class="form-control" placeholder="Enter Email" value='{{old("email",$users->email)}}' maxlength="50" autocomplete="nope">
               @if($errors->has('email'))
                   <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('email') }}</span>
               @endif
            </div>
            <div class="col-md-3">
               <strong>Phone: <span style="color:red">*</span></strong>
               <input type="text" name="phone" class="form-control numbersOnly" placeholder="Enter Phone Number" value='{{old("phone",$users->phone)}}' maxlength="15">
               @if($errors->has('phone'))
                   <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('phone') }}</span>
               @endif
            </div>
            <div class="col-md-3">
               <strong>Admin Role: <span style="color:red">*</span></strong>
               <select name="role_id" id="Role" class="form-control">
                  <option value="">--- Select Role ---</option>
                  @foreach($roles as $role)
                  <option value="{{$role->id}}" @if($role->id == $users->role_id) selected @endif>{{$role->name}}</option>
                  @endforeach
               </select>
               @if($errors->has('role_id'))
                   <span style="font-size: initial;font-weight: 600;" class="text-danger">{{ $errors->first('role_id') }}</span>
               @endif
            </div>
             <div class="col-md-3">
                <strong>Password: <span style="color:red">*</span></strong>
                <input type="password" name="password" class="form-control" placeholder="Enter Password" value='{{old("password",$users->password)}}' maxlength="15" autocomplete="new_password" readonly disabled="disbled">
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
  <div class="modal fade" id="edit">
    <div class="modal-dialog">
      <span class="close">&times;</span>
      <img class="modal-content" id="img01">
    </div>
  </div>
  <script>
    $("document").ready(function(){
        // $(".districts").hide();
         var type = ($('option:selected', $(this)).text());
             if(type == 'RTO'){
              $(".districts").show();
            }
        $("#role").change(function() {
             var type = ($('option:selected', $(this)).text());
             if(type == 'RTO'){
              $(".districts").show();
             }else{
              $(".districts").hide();
             }
        });
        $("#districts").change(function() {
          var district = $(this).val();
          $('#email').val('RTO'+district+'@gmail.com');
        });
  });
  </script>
   @endsection