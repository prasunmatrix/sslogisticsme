@extends('layouts.afterlogintemplate') 
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>User Role</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Role</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        @if (session('alert-success'))
            <div class="alert alert-success showMessage">
              <button class="close" type="button" data-dismiss="alert">×</button>
            {{ session('alert-success') }} </div>
        @endif
        @if (session('alert-danger'))
            <div class="alert alert-danger showMessage">
              <button class="close" type="button" data-dismiss="alert">×</button>
            {{ session('alert-danger') }} </div>
        @endif
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Assign {{ucwords($role->name)}} Role Permission </h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
             <form id="frmRole" name="frmRole" method="post" action="{{route('user.add.role.permission')}}">
                {!! csrf_field() !!}
                <input type="hidden" name="role_id" value="{{$role->enc_id}}">
                <div class="box-body">
                    @foreach(config('app_module.module') as $module)
                        <div class="col-md-4">
                            <div class="box-group" id="accordion-{{str_slug($module['title'])}}">
                                <div class="panel box box-primary">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#{{str_slug($module['title'])}}">
                                            {{$module['title']}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="{{str_slug($module['title'])}}" class="panel-collapse collapse in">
                                        <div class="box-body">
                                            @foreach($module['permission'] as $key => $value)
                                                @php 
                                                    $is_checked = $permissions->where('name', $key)->count() ? true : false
                                                @endphp
                                                <input type="checkbox" class="chk-permission" name="permission[]" value="{{$key}}" style="margin-left: 5px; margin-right: 10px; cursor: pointer;" {{ $is_checked ? 'checked' : ''}}>
                                                <strong {{$is_checked ? 'style=color:red' : ''}}>{{$value}}</strong><br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="box-footer">
                    @can('user_manage_assign_role')
                        @if($role_id1 != 1)
                        <button class="btn btn-primary">Assign Role</button>
                        <button type="button" id="select-all" class="btn btn-primary">Select All</button>
                        <button type="button" id="de-select-all" class="btn btn-primary">De-Select All</button>
                        @endif
                     @endcan
                    <a href="{{route('user.role')}}" class="btn btn-primary">Back</a>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function($) {

            /*select all functionality*/
            $(document).on('click','#select-all',function(event){
                $('.chk-permission').each(function(){
                    $(this).prop('checked', true);
                    $(this).next().css('color','red');
                });
            });

            /*de-select all functionality*/
            $(document).on('click','#de-select-all',function(event){
                $('.chk-permission').each(function(){
                    $(this).prop('checked', false);
                    $(this).next().css('color','#333');
                });
            });

            /*color change after select and de-select*/
            $(".chk-permission").click(function(event) {
                if($(this).is(":checked")){
                    $(this).next().css('color','red');
                }else{
                    $(this).next().css('color','#333');
                }
            });
        });
    </script>
    <script src="{{ asset('/angularJs/angularModules/common/commonApp.js') }}"></script> 
@endsection