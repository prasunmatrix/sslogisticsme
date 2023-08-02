@extends('layouts.afterlogintemplate')
@section('content')


      <!-- Content Header (Page header) -->
      
      <section class="content-header">
        <h1>
          Add AddressZone   
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Add AddressZone</li>
        </ol>
      </section>
      <!-- Main content -->
      
    <div data-ng-controller="addressZonesController">  
      
      <section class="content">
        <!-- Default box -->
        <div class="box">
         <div class="flash-message" ng-hide="msgDisplay">
            @include('common.flash_message') 
            <span ng-view='danger' ng-cloak ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
         </div>
          
          <div class="box-header with-border">
            <h3 class="box-title">Add AddressZone</h3>
            
          </div>
          <div class="box-body">
            <form action="{{ asset('save-addressZone') }}" method="post" id="addressZoneForm" name="addressZoneForm">
               {{csrf_field()}}

              <div class="form-group has-feedback">
                <label>Title</label>
                <input type="text" class="form-control" placeholder="Title" name="title" ng-model="title" ng-maxlength="255" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="addressZoneForm.title.$touched && addressZoneForm.title.$error.required">The Title is required.</span>
              </div> 
              
              <div class="form-group has-feedback">
                <label>Address</label>
                <input type="text" class="form-control" placeholder="Address" name="addressZoneAddress" ng-model="addressZoneAddress" id="addressZoneAddress" ng-maxlength="255" value="{{isset($addressZoneDetails) && !empty($addressZoneDetails) ? $addressZoneDetails :''}}" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="addressZoneForm.addressZoneAddress.$touched && addressZoneForm.addressZoneAddress.$error.required">The Address is required.</span>
              </div>

              <input type="hidden" name="latitude" id="latitude" ng-model="latitude">
              <input type="hidden" name="longitude" id="longitude" ng-model="longitude">          


              <div class="row submit-button-holder">
                <div class="col-xs-10">    
                                        
                </div><!-- /.col -->
                <div class="col-xs-2">
                 <a class="btn btn-default btn-flat" href=<?php echo url(''); ?>/addressZones>Back</a>
                  <button type="submit" ng-disabled="addressZoneForm.$invalid" class="btn btn-primary">Submit</button>
                </div><!-- /.col -->
              </div>
            </form> 
          </div><!-- /.box-body -->
          <div class="box-footer">
             
          </div><!-- /.box-footer-->
        </div><!-- /.box -->

      </section><!-- /.content -->
    </div>

      <!-- /.content -->

@endsection



@section('scripts')
  <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdrU0RpAT5Y2hYKkf6TJUmmknh1YoV0bg&libraries=places&callback=initialize" async defer></script> -->

  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhqY51q4Gl7RSxbwMa_6xfmSGGNdDqRSs&libraries=places&callback=initialize" async defer></script>

  <script>
    /*for auto suggest location*/
    function initialize() {
        var input = document.getElementById('addressZoneAddress'); 
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
          var place = autocomplete.getPlace();
          var lat = place.geometry.location.lat(); /*get latitude*/
          var lng = place.geometry.location.lng(); /*get longitude*/
          $('#latitude').val(lat);
          $('#longitude').val(lng);
        });
    }
  </script>

  <script src="{{ asset('/angularJs/angularModules/addressZones/addressZoneApp.js') }}"></script>
@endsection

