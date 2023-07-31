@extends('layouts.afterlogintemplate') 
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>User List</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">User List</li>
        </ol>
    </section>
    <!-- Main content -->  
    <section class="content">
        @if (session('alert-success'))
            <div class="alert alert-success showMessage" ng-hide="msgDisplay">
              <button class="close" type="button" data-dismiss="alert">×</button>
             {{ session('alert-success') }} </div>
        @endif
        <div class="box">
            <div class="box-body">
                <div class="table-responsive no-paddin">
                    <div class="col-md-12 col-xs-12" style="text-align: center;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <!--<th>Created By</th>-->
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created On</th>                                   
                                    <th>Last Login</th>
                                    @if(Gate::check('user_manage_edit') || Gate::check('user_manage_delete'))
                                        <th>Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($users as $user)
                                    <tr>
                                        <td>{{isset($index) ? ++$index : $index=1}}</td>
                                        <td>
                                            @if($user->profile_picture == '' || $user->profile_picture == 'NULL')
                                            <img src="{{asset("uploads/user_profile_picture/common_customer_image.jpg")}}" alt="{{$user->full_name}}" width="50" height="50" />
                                            @else
                                             <img src="{{asset(\Config::get('constants.profileImagePath'))}}/{{ $user->profile_picture }}" alt="{{$user->full_name}}" width="50" height="50" />
                                            @endif 
                                        </td>
                                        <td>{{$user->full_name}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->phone_number}}</td>
                                        <!--@if(isset($user->Created_User->full_name))
                                            <td>{{$user->Created_User->full_name}}</td>
                                        @else
                                            <td>{{$user->full_name}}</td>
                                        @endif -->
                                        <!--<td>{!!implode('<br>',$user->getRoleNames()->toArray())!!}</td>-->
                                        <td>{{$user->role_name}}</td>
                                        <td>@if($user->status == 'A') Active @elseif($user->status == 'I') Inactive @else Deleted @endif</td>
                                        <td>{{$user->created_at->format('d-m-Y')}}</td>
                                        <td>{{!empty($user->last_login_datetime) ? $user->last_login_datetime->format('d-m-Y') : ''}}
                                        </td>
                                        
                                        <td>
                                            @can('user_manage_edit')
                                                <a href="{{route('user.create',['user_id'=>$user->enc_id,'page'=>$user->page])}}" class="btn-xs" data-toggle="tooltip" title="Edit User">
                                                <i class="{{\Config::get('constants.editIcon')}}" aria-hidden="true"></i>
                                                </a>
                                            @endcan
                                            &nbsp;
                                            @if($user->user_role_id != 1)
                                            @can('user_manage_delete')
                                                <a style="cursor:pointer;" onclick="removeRole('{{route('user.remove',['user_id'=>$user->enc_id])}}')" class="btn-xs" data-toggle="tooltip" title="Remove User">
                                                    <i class="{{\Config::get('constants.deleteIcon')}}" aria-hidden="true"></i>
                                                </a>
                                            @endcan
                                            @endif
                                            &nbsp;
                                            @can('user_details')
                                                <a href="{{route('user.details',['user_id'=>$user->enc_id])}}" class="btn-xs" data-toggle="tooltip" title="User Details">
                                                    <i class="{{\Config::get('constants.viewIcon')}}" aria-hidden="true"></i>
                                                </a>
                                            @endcan
                                            &nbsp;
                                            @if($user->user_role_id != 1)
                                            @can('user_status')
                                                <a href="{{route('user.status',['user_id'=>$user->enc_id])}}" class="btn-xs" data-toggle="tooltip" title="User Status" onclick="return confirm('Are you sure want to change status?')">
                                                    @if($user->status == 'A') <i class="{{\Config::get('constants.rightIcon')}}"></i>  @elseif($user->status == 'I') <i class="{{\Config::get('constants.inactiveIcon')}}"></i> @endif
                                                </a>
                                            @endcan
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$users->links()}}
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
        function removeRole(url) {
            swal({
                title: 'Remove User',
                text: 'Are you sure you want to delete this user',
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
