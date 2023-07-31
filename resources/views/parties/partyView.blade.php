@extends('layouts.afterlogintemplate')
@section('content')
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Party Details</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Party Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content" data-ng-controller="partiesController" data-ng-init="getPartyDetail();">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Party Details</h3>
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
                            <label>Party Name  : </label>  
                            @{{record.party_name}}
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
                            <label>Description  : </label>
                            @{{record.party_description == NULL ? 'N/A' : record.party_description}}  
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Phone Number  : </label> 
                            @{{record.phone_number == NULL ? 'N/A' : record.phone_number}} 
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group has-feedback">
                            <label>Email  : </label>
                            @{{record.email == NULL ? 'N/A' : record.email}} 
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
                            <a href="<?php echo URL('');?>/parties" class="btn btn-default btn-flat">Back</a>
                        </div>
                        <!-- /.col -->
                </div>
            
            <div class="box-footer"></div>
        </div>
    </section>
    <!-- /.content -->
@endsection


@section('scripts')
    <script src="{{ asset('/angularJs/angularModules/parties/partyApp.js') }}"></script>
@endsection

