@extends('layouts.afterlogintemplate')
@section('content')
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Plant Details</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Plant Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content" data-ng-controller="plantsController" data-ng-init="getPlantDetail();">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Plant Details</h3>
            </div>
            <div class="box-body">
            	<div class="list_view">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>ID : </label> SSLP000@{{record.id}}  
                        </div>
                        
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Plant Name  : </label>  
                            @{{record.name}}
                        </div>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Type : </label> @{{record.type === 'P' ? 'Party' : 'Warehouse'}}   
                        </div>
                        
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Address : </label> @{{addressDetails.address}}  
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Description  : </label>
                            @{{record.description == NULL ? 'N/A' : record.description}}  
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Balance Amount   : </label> @{{actualBalance}}  
                        </div>
                    </div>
                 </div>   

                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Supervisor(s)  : </label>
                            @{{usersDetails}} 
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Last Updated  : </label>
                            @{{formatDate(record.updated_at) |  date:'dd-MM-yyyy'}} 
                        </div>
                    </div>
                </div>
                    
                </div>
                
                <div class="row">
                        <div class="col-md-12 col-xs-12" style="text-align: center; padding-bottom:15px;">
                            <hr>
                            <a href="<?php echo URL('');?>/plants" class="btn btn-default btn-flat">Back</a>
                        </div>
                        <!-- /.col -->
                </div>
            
            <div class="box-footer"></div>
        </div>
    </section>
    <!-- /.content -->
@endsection


@section('scripts')
    <script src="{{ asset('/angularJs/angularModules/plants/plantApp.js') }}"></script>
@endsection

