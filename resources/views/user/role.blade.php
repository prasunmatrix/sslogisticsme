@extends('layouts.afterlogintemplate') 
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>User Role</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">User Role</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="flash-message" ng-hide="msgDisplay">
          @include('common.flash_message')
          <span ng-cloak ng-view='success' ng-bind='success' class="alert alert-success" ng-show="success"></span>
          <span ng-cloak ng-view='danger' ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
        </div>


        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">User Role</h3>

            </div>
            <div class="box-body">
                <!-- @can('user_manage_add_role')
                    <form id="frmRole" name="frmRole" method="post" action="{{route('user.add.role')}}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="uid" id="uid" value="0">
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group has-feedback">
                                <label for="Role">Role</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="role" id="role" required="required">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-info btn-flat" type="button"><strong>Add User Role</strong></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                @endcan -->
                <div class="row">
                    <div class="col-md-12 col-xs-12" style="text-align: center;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 50px">Role</th>
                                    <th style="width: 50px">Created On</th>
                                    <th style="width: 50px">Created By</th>
                                    <th style="width: 100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @if(isset($roles) && count($roles) > 0)
                                @foreach($roles as $role)
                                    <tr style="text-align: left">
                                        <td>{{isset($index) ? ++$index : $index=1}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->created_at->format('d-m-Y')}}</td>
                                        <td>{{$role->created_by()->first()->full_name}}</td>
                                        <td>
                                            <!-- @if($role->name != 'Admin')
                                                @can('user_manage_edit_role')
                                                    <a onclick="edit('{{$role->id}}','{{$role->name}}',{{$role->getPermissionByIdString()}})" type="button" class="" data-toggle="tooltip" title="Edit Role">
                                                        <i class="{{\Config::get('constants.editIcon')}}" aria-hidden="true"></i>
                                                    </a>
                                                @endcan
                                            @endif 
                                            &nbsp;  
                                             @if((\Auth::user()->user_role_id == \Config::get('constants.adminRoleId')) && ($role->id != \Config::get('constants.adminRoleId')))   
                                                @can('user_manage_delete_role')
                                                    <a onclick="removeRole('{{route('user.remove.role',['role_id'=>$role->enc_id])}}')" class="" data-toggle="tooltip" title="Remove Role">
                                                    <i class="{{\Config::get('constants.deleteIcon')}}" aria-hidden="true"></i>
                                                    </a>
                                                @endcan
                                            @endif
                                            &nbsp; -->
                                            @can('user_manage_view_role')
                                                <a href="{{route('user.role.permission',['role_id'=>$role->enc_id])}}" class="" data-toggle="tooltip" title="Permissions">
                                                    <i class="{{\Config::get('constants.userIcon')}}" aria-hidden="true"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                               @else
                                    <tr>
                                        <td colspan="5">No Record Found</td>
                                    </tr>
                               @endif 
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <div class="box-footer"></div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@push('css')
    <link href="{{asset('resources/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
@endpush
@push('js')
    <script src="{{asset('resources/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
@endpush
@section('scripts')
    <script type="text/javascript">

        /*edit role*/
        function edit(id,name,permision) {
            $("#uid").val(id);
            $("#role").val(name);
            $("#role").focus();
            $(".chk").each(function(index, el) {
                var self = this;
                $.each(permision,function(index, el) {
                    if($(self).val() == el){
                        $(self).attr('checked',true);
                    }
                });
            });
        }


        /*remove role*/
        function removeRole(url) {
            swal({
                title: 'Remove Role',
                text: 'Are you sure you want to delete this role',
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-warning",
                confirmButtonText: "Remove",
                showLoaderOnConfirm: true,
                closeOnConfirm: false
                },
                function(willDelete) {
                    if(!willDelete)
                        return true;

                     window.location.href = url;
                });
        }
    </script>
    <script src="{{ asset('/angularJs/angularModules/common/commonApp.js') }}"></script>   
@endsection