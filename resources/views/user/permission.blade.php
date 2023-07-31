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
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">User Permission</h3>

            </div>
            <div class="box-body">
                <form id="frmRole" name="frmRole" method="post" action="{{route('user.add.permission')}}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="uid" id="uid" value="0">
                    <div class="col-md-12 col-xs-12">
                        <div class="form-group has-feedback">
                            <label for="Role">Role</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" name="role">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-info btn-flat" type="button"><strong>Add User Permission</strong></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12 col-xs-12" style="text-align: center;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Permission</th>
                                    <th>Created On</th>
                                    <th>Created By</th>
                                    <th style="width: 100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @if(isset($permissions) && count($permissions) > 0)
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{isset($index) ? ++$index : $index=1}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->created_at->format('d-M-Y')}}</td>
                                        <td>{{$permission->user->full_name}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-xs">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </button>
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
@section('scripts')
    <script src="{{ asset('/angularJs/angularModules/common/commonApp.js') }}"></script> 
@endsection