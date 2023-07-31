@extends('layouts.afterlogintemplate')
@section('content')

 
      <!-- Content Header (Page header) -->
      
      <section class="content-header">
        <h1>
          Edit Plant   
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Edit Plant</li>
        </ol>
      </section>
      <!-- Main content -->
      
    <div data-ng-controller="plantsController" data-ng-init="getAddressZoneListing();plantEdit();">
      <div class="flash-message" ng-hide="msgDisplay">
          @include('common.flash_message') 
          <span ng-view='danger' ng-cloak ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
       </div>
      <section class="content">
        <!-- Default box -->
        <div class="box">
          
          <div class="box-header with-border">
            <h3 class="box-title">Edit Plant</h3>
            
          </div>
          <div class="box-body">
            <form ng-submit="savePlant();" id="plantForm" name="plantForm">
               {{csrf_field()}}
              <input type="hidden" name="plantId" ng-model="plantId"> 

              <div class="form-group has-feedback">
                <label>Type</label>
                <select ng-model="selectType" name="selectType" class="form-control" required>
                  <option value="" selected="selected">Select Type</option>
                  <option value="P">Plant</option>
                  <option value="W">Warehouse</option>
                </select>
                 <span class="invalidInputErrorClass" ng-show="plantForm.selectType.$touched && plantForm.selectType.$error.required">Please select the Type</span>
              </div>

              <div class="form-group has-feedback">
                &nbsp;&nbsp;
                <a href="#" class="marker_icon" title="Add New Address Zone" data-toggle="modal" data-target="#addressZoneModal"><i class="{{\Config::get('constants.addIcon')}}" aria-hidden="true"></i></a>

                <label>Address Title</label>
                <select ng-model="selectAddressZone" id="selectAddressZone" name="selectAddressZone" ng-options="addressZoneRecord.id as addressZoneRecord.title for addressZoneRecord in addressZoneRecords" class="form-control" required >
                  <option value="" selected="selected">Select Address Title</option>
                </select>
                 <span class="invalidInputErrorClass" ng-show="plantForm.selectAddressZone.$touched && plantForm.selectAddressZone.$error.required">Please select the Address Title</span>
              </div>


              <div class="form-group has-feedback">
                <label>Plant Name</label>
                <input type="text" class="form-control upperCaseTransform" placeholder="Plant Name" name="name" ng-model="name" ng-maxlength="255" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="plantForm.name.$touched && plantForm.name.$error.required">The Plant Name is required.</span>
              </div>

              <div class="form-group has-feedback">
                <label>Plant Description</label>
                <input type="text" class="form-control upperCaseTransform" placeholder="Plant Description" name="description" ng-model="description" ng-maxlength="255"/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="plantForm.description.$touched && plantForm.description.$error.required">The Plant Description is required.</span>
              </div>

               <div class="form-group has-feedback">
                <label>Initial Balance Amount</label>
                <input type="text" class="form-control" placeholder="Balance Amount" name="balanceAmount" ng-model="balanceAmount" maxlength="10" ng-pattern="numberPattern" onkeypress="return keyRestrict(event,'1234567890.')" required readonly="readonly" />
                <span class="invalidInputErrorClass" ng-cloak ng-show="plantForm.balanceAmount.$touched && plantForm.balanceAmount.$error.required">The Balance Amount is required.</span>
                <span class="invalidInputErrorClass" ng-cloak ng-show="plantForm.balanceAmount.$touched && plantForm.balanceAmount.$error.pattern">The Balance Amount is invalid.</span>
                <span class="invalidInputErrorClass" ng-cloak ng-show="plantForm.balanceAmount.$error.pattern">The Balance Amount is invalid.</span>
              </div>


              <div class="form-group has-feedback">
                <div class="active_checkbox">
                  <label>Active:- </label>
                  <input type="checkbox" name="status" ng-model="status" ng-checked="status == '1'" ng-true-value="'A'" ng-false-value="'I'" >
                </div>
              </div>
              <input type="hidden" name="currentPageNo" id="currentPageNo" ng-model="currentPageNo">

              <div class="row submit-button-holder">
                <div class="col-xs-8">    
                                        
                </div><!-- /.col -->
                <div class="col-xs-4">
                  <a href="<?php echo URL('');?>/plants" class="btn btn-default btn-flat">Back</a>
                  <button type="submit" ng-disabled="plantForm.$invalid" class="btn btn-primary">Submit</button>
                </div><!-- /.col -->
              </div>
            </form> 
          </div><!-- /.box-body -->
          <div class="box-footer">
             
          </div><!-- /.box-footer-->
        </div><!-- /.box -->

      </section><!-- /.content -->

      
    </div>


    <!-- modal for address zone add-->  
      <div class="modal fade" id="addressZoneModal" tabindex="-1" role="dialog" aria-labelledby="addressZoneModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <label>Add Address Zone</label>
                <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><img src="{{asset('images/blue_cross.png')}}" alt="Close"/></button>
              </div>
              <div class="modal-body" style="padding-top:0;">
                <div class="modal_select">
                  
                    <section class="content">
                      <!-- Default box -->
                      
                       <div class="flash-message" ng-hide="msgDisplay">
                          @include('common.flash_message') 
                          <span ng-view='catSuccess' ng-cloak ng-bind='addressZoneSuccess' class="alert alert-success" ng-show="addressZoneSuccess"></span>
                          <span ng-view='addressZoneDanger' ng-cloak ng-bind='addressZoneDanger' class="alert alert-danger" ng-show="addressZoneDanger"></span>
                       </div>
                        
                        <div class="box-header with-border">
                          <h3 class="box-title">Add Address Zone</h3>
                          
                        </div>
                        <div class="box-body">
                          <form ng-submit="saveModalAddressZone();" method="post" id="addressZoneForm" name="addressZoneForm">
                             {{csrf_field()}}

                            <div class="form-group has-feedback">
                              <label>Title</label>
                              <input type="text" class="form-control" placeholder="Title" name="adressTitle" ng-model="adressTitle" ng-maxlength="255" required/>
                              <span class="invalidInputErrorClass" ng-cloak ng-show="addressZoneForm.title.$touched && addressZoneForm.title.$error.required">The Title is required.</span>
                            </div> 
                            
                            <div class="form-group has-feedback">
                              <label>Address</label>
                              <input type="text" class="form-control" placeholder="Address" name="addressZoneAddress" ng-model="addressZoneAddress" id="addressZoneAddress" ng-maxlength="255" required/>
                              <span class="invalidInputErrorClass" ng-cloak ng-show="addressZoneForm.addressZoneAddress.$touched && addressZoneForm.addressZoneAddress.$error.required">The Address is required.</span>
                            </div>

                            <div class="row submit-button-holder">
                              <div class="col-xs-10">    
                                                      
                              </div><!-- /.col -->
                              <div class="col-xs-2">
                                <button type="submit" ng-disabled="addressZoneForm.$invalid" class="btn btn-primary">Submit</button>
                              </div><!-- /.col -->
                            </div>
                          </form> 
                        </div><!-- /.box-body -->


                    </section><!-- /.content -->
                  
                </div>
              </div>
              <div class="modal-footer align_center">

              </div>
            </div>
          </div>
        </div>
      <!-- modal for address zone add-->  

      <!-- /.content -->

@endsection



@section('scripts')

  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdrU0RpAT5Y2hYKkf6TJUmmknh1YoV0bg&libraries=places&callback=initialize" async defer></script>

  <script>
    /*for auto suggest location*/
    function initialize() {
        var input = document.getElementById('addressZoneAddress');  
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
          var place = autocomplete.getPlace(); 
          var placeValue = $('#addressZoneAddress').val();  
          var scope = angular.element(document.getElementById("addressZoneAddress")).scope();
          scope.addressZoneAddress = placeValue;
        });
    }
  </script>
  
  <script src="{{ asset('/angularJs/angularModules/plants/plantApp.js') }}"></script>
@endsection

