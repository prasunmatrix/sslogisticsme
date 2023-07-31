@extends('layouts.afterlogintemplate')
@section('content')
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>User Details</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">User Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            
            <div class="box-header with-border">
                <h3 class="box-title">User Details</h3>

            </div>
            <div class="box-body">
                <div class="col-md-6 col-xs-12">
                    <div class="form-group has-feedback">
                        <label for="fullname">Full Name : </label>
                        {{$user->full_name or ''}}                         
                    </div>
                    <div class="form-group has-feedback">
                        <label for="phonenumber">Phone Number : </label>
                        {{$user->phone_number or ''}}                        
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="form-group has-feedback">
                        <label for="username">Email : </label>
                        {{$user->username or ''}}
                    </div>
                    <div class="form-group has-feedback">
                        <label for="username">User Role : </label>
                        {{$user->role_name or ''}} 
                    </div>
                </div>
                
                @if($user->user_role_id == \Config::get('constants.supervisorRoleId'))
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label for="username">Assigned Plant : </label>
                            {{$user->plant_name or ''}}
                        </div>
                    </div>
                @endif
                <div class="row">
                        <div class="col-md-12 col-xs-12" style="text-align: center;">
                            <hr>
                            <a href="<?php echo URL('');?>/user/user-list" class="btn btn-default btn-flat">Back</a>
                        </div>
                        <!-- /.col -->
                </div>
            </div>
            <div class="box-footer"></div>
        </div>
    </section>
    <!-- /.content -->
@endsection


@section('scripts')
    <script src="{{ asset('/angularJs/angularModules/users-mange/usersApp.js') }}"></script>
@endsection

