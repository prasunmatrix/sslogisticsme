@extends('layouts.afterlogintemplate')
@section('content')
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Petrol Pump Details</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Petro lPump Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content" data-ng-controller="petrolPumpsController" data-ng-init="getPetrolPumpDetail();">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Petrol Pump Details</h3>
            </div>
            <div class="box-body">
            	<div class="list_view">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>ID : </label> @{{record.id}}  
                        </div>
                        
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Petrol Pump Name  : </label>  
                            @{{record.petrol_pump_name}}
                        </div>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Address : </label> @{{addressDetails.address}}  
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Contact Number  : </label>  
                             @{{record.contact_number == NULL ? 'N/A' : record.contact_number}}
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Contact Email  : </label>
                            @{{record.contact_email == NULL ? 'N/A' : record.contact_email}}
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Contact Person  : </label>
                            @{{(record.contact_person == NULL || record.contact_person == '') ? 'N/A' : record.contact_person}}
                        </div>
                    </div>
                 </div>   

                <div class="row">
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
                            <a href="<?php echo URL('');?>/petrolPumps" class="btn btn-default btn-flat">Back</a>
                        </div>
                        <!-- /.col -->
                </div>
            
            <div class="box-footer"></div>
        </div>
    </section>
    <!-- /.content -->
@endsection


@section('scripts')
    <script src="{{ asset('/angularJs/angularModules/petrol-pumps/petrolPumpApp.js') }}"></script>
@endsection

