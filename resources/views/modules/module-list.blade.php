@extends('layouts.afterlogintemplate') 
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>App Module List</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">App Module List</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">App Module List</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Functionality</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(config('app_module.module') as $module)
                                    <tr>
                                        <td style="width: 5%">{{isset($index) ? ++$index : $index=1}}</td>
                                        <td style="width: 20%"><strong>{{$module['title']}}</strong></td>
                                        <td style="width: 50%"><strong>{{implode(', ',$module['permission'])}}</strong></td>
                                    </tr>
                                @endforeach
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