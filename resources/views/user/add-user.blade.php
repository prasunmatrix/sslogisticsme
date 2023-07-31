@extends('layouts.afterlogintemplate')
@section('content')
  
    <!-- Content Header (Page header) -->
    <section class="content-header"> 
        <h1>@if(isset($user->id)) Edit User @else Add User @endif</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">@if(isset($user->id)) Edit User @else Add User @endif</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            @include('common.flash_message') 
            <div class="box-header with-border">
                <h3 class="box-title">@if(isset($user->id)) Edit User @else Add User @endif</h3>
            </div>
            <div class="box-body">
                <form id="frmadduser" name="frmadduser" method="post" action="{{route('user.add')}}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="user_id" id="user_id" value="{{isset($user->enc_id) ? $user->enc_id : ''}}">
                    <input type="hidden" name="page" id="page" value="{{isset($user->page) ? $user->page : ''}}">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>User Full Name</label>
                            <input type="text" class="form-control required" placeholder="User full name" name="userFullname" id="userFullname" ng-maxlength="255" @if(Session::has('userFullName')) value="{!! Session::get('userFullName') !!}" @else value="{{isset($user->full_name) ? $user->full_name : ''}}" @endif/> 
                        </div>
                        <div class="form-group has-feedback">
                            <label>Phone number</label>
                            <input type="text" class="form-control required" placeholder="Phone number" name="phoneNumber" maxlength="10" id="phoneNumber" @if(Session::has('userPhoneNumber')) value="{!! Session::get('userPhoneNumber') !!}" @else value="{{isset($user->phone_number) ? $user->phone_number : ''}}" @endif  onkeypress="return keyRestrict(event,'1234567890')"/>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Role</label>
                            <select class="form-control required" name="role" id="role" >
                                <option value="">Please select role</option>
                                @foreach($roles as $role)
                                     <option value="{{$role->id}}"  @if((Session::has('userRole')) && ($role->id == Session::get('userRole'))) selected @else @if((isset($user->role_name)) && ($role->name == $user->role_name)) selected @endif @endif> {{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>User Email Address</label>
                            <input type="text" id="emailAddress" class="form-control required" placeholder="User email address" name="email" ng-maxlength="255" @if(Session::has('userEmail')) value="{!! Session::get('userEmail') !!}" @else value="{{isset($user->username) ? $user->username : ''}}" @endif  />
                        </div>
                        <div class="form-group has-feedback">
                            <label>Password</label>
                            <input type="password" id="password" class="form-control {{isset($user->id) ? '' : 'required'}}" placeholder="Password" name="pwd" {{isset($user->id) ? 'disabled' : ''}} />
                        </div>
                        <div class="form-group has-feedback plantListContainer" style="display: none;">
                            <label>Plant</label>
                            <select class="form-control" name="plant" id="plant" >
                                
                            </select>
                            <input type="hidden" name="selectedPlant" id="selectedPlant">
                        </div>
                    </div>
   
                    <div class="row">
                        <div class="col-md-12 col-xs-12" style="text-align: center;">
                            <hr>
                            @if(isset($user->id)) 
                                <a href="<?php echo URL('');?>/user/user-list" class="btn btn-default btn-flat">Back</a>
                            @endif
                            <button type="submit" class="btn btn-primary btn-flat">@if(isset($user->id)) Save @else Add User @endif</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <div class="box-footer"></div>
        </div>
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {

    /*check whether supervisor or not for showing plant list*/
    if ($('#role option:selected').attr('value') == <?php echo \Config::get('constants.supervisorRoleId') ?>) {
        getPlantList(); /*get total plant list*/
        getUserPlant($('#user_id').val()); /*get currently assigned plant*/
    }

    /*validating email address*/
    $('#frmadduser').submit(function(){

        /*required field validation*/
        var FieldTab1elements = $("#frmadduser .required");
        var flag = 0;

        for (i = 0; i < FieldTab1elements.length; i++) {
            var fieldId = $(FieldTab1elements[i]).attr('id');
            var msg = 'This field is required';

            if ($.trim($('#'+fieldId).val()) == "") {
                $('#'+fieldId).next('.errorMessage').remove();
                $('#'+fieldId).addClass('errorClass');
                $('#'+fieldId).after('<div class="errorMessage invalidInputErrorClass">' + msg + '</div>');
                $('#'+fieldId).focus();
                flag = 1;
                return false;
            } else {
                $('#'+fieldId).next('.errorMessage').remove();
                $('#'+fieldId).removeClass('errorClass');
                flag = 0;      
            }


            /*email validation*/
            if (fieldId == 'emailAddress') {
                if(emailCheck($.trim($('#'+fieldId).val()))==false) {
                  $('#'+fieldId).next('.errorMessage').remove();
                  $('#'+fieldId).addClass('errorClass');
                  $('#'+fieldId).after('<div class="errorMessage invalidInputErrorClass">The Email Address is Invalid</div>');
                  $('#'+fieldId).focus();
                  flag = 1;
                  return false;
                } else {
                  $('#'+fieldId).next('.errorMessage').remove();
                  $('#'+fieldId).removeClass('errorClass');
                  flag = 0;   
                }
            }


            /*length checking of field*/
            if (fieldId == 'phoneNumber' || fieldId == 'password') { 
                if($.trim($('#'+fieldId).val()).length < 8) {
                  $('#'+fieldId).next('.errorMessage').remove();
                  $('#'+fieldId).addClass('errorClass');
                  $('#'+fieldId).after('<div class="errorMessage invalidInputErrorClass">This field must be atleast 8 characters long</div>');
                  $('#'+fieldId).focus();
                  flag = 1;
                  return false;
                } else {
                  $('#'+fieldId).next('.errorMessage').remove();
                  $('#'+fieldId).removeClass('errorClass');
                  flag = 0;   
                }
            }
        }
        if (flag == 0) {
            return true;
        }
    });

    /*prevent copy paste in phone number field*/
    $('#phoneNumber').bind('copy paste', function(e) {
        e.preventDefault();
    });

    /*get plant list for supervisor*/
    $('#role').change(function(){
        getPlantList();
    });
 });

  /*get plant list for supervisor*/ 
 function getPlantList()  {
    var roleId  = $('#role option:selected').attr('value'); /*Get id of selected role*/
    var token   = $("input[name='_token']").val();
    if (roleId == <?php echo \Config::get('constants.supervisorRoleId') ?>) { /*if supervisor*/
       $.ajax({
         type:"post",
         url:"{{\URL::route('viewPlantListHavingPlantAddress')}}",
         data: {_token:token},
         success: function(data){
          var response = data; 
          var plantDetails = response.plantList;
          var plantHtml = '';
          $.each(plantDetails, function(j, item) {
                plantHtml = plantHtml +'<option value="'+plantDetails[j].id+'">'+plantDetails[j].name+'</option>';
          });

          /*Appending  plant dropdown*/  
          $('#plant').html('<option value="">'+'Please select Plant'+'</option>'+plantHtml); 
          $('#plant').addClass('required'); /*Making the plant dropdown mandatory*/

          /*check whether any plant selected or not*/
          setTimeout(function(){ 
              if ($('#selectedPlant').val() != '') {
                $('#plant').val($('#selectedPlant').val());
              }
          }, 300);

          $('.plantListContainer').show();
        }
      });
    } else {
        $('#plant').removeClass('required');
        $('.plantListContainer').hide();
    }
 }

 /*get particular user's plant*/
 function getUserPlant(userId) {
    var token   = $("input[name='_token']").val();
    $.ajax({
         type:"post",
         url:"{{\URL::route('getUserPlant')}}",
         data: {_token:token,user_id:userId},
         success: function(data){
          var response = data; 
          $('#selectedPlant').val(response);
        }
      });
 }

</script>
<script src="{{ asset('/angularJs/angularModules/common/commonApp.js') }}"></script> 
@endsection
<!-- @push('js')
<script src="{{ asset('/angularJs/angularModules/users-mange/usersApp.js') }}"></script>
@endpush -->