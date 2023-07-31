@extends('layouts.afterlogintemplate')
@section('content')

 
      <!-- Content Header (Page header) -->
      
      <section class="content-header">
        <h1>
          Add Party Destination   
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Add Party Destination</li>
        </ol>
      </section>
      <!-- Main content -->
      
    <div data-ng-controller="partyDestinationsController" data-ng-init="viewCountryList();getPartyList();">  <div class="flash-message" ng-hide="msgDisplay">
          @include('common.flash_message') 
          <span ng-view='danger' ng-cloak ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
      </div>
      <section class="content">
        <!-- Default box -->
        <div class="box">
          
          <div class="box-header with-border">
            <h3 class="box-title">Add PartyDestination</h3>
            
          </div>
          <div class="box-body">
            <form ng-submit="savePartyDestination();" id="partyDestinationForm" name="partyDestinationForm">
               {{csrf_field()}}

              <div class="form-group has-feedback">
                <select ng-model="selectParty" name="selectParty" ng-options="partyRecord.id as partyRecord.party_name for partyRecord in partyRecords" class="form-control" required">
                  <option value="" selected="selected">Select Party</option>
                </select>
                 <span ng-show="partyDestinationForm.selectParty.$touched && partyDestinationForm.selectParty.$error.required">Please select the Party</span>
              </div>  


              <div class="form-group has-feedback">
                <select ng-model="selectCountry" id="selectCountry" name="selectCountry" ng-options="record.id as record.country_name for record in records" class="form-control" required ng-change="viewStateList(selectCountry);">
                  <option value="" selected="selected">Select Country</option>
                </select>
                 <span ng-show="partyDestinationForm.selectCountry.$touched && partyDestinationForm.selectCountry.$error.required">Please select the Country</span>
              </div>

              <div class="form-group has-feedback">
                <select ng-model="selectState"  id="selectState"  name="selectState" ng-options="stateRecord.id as stateRecord.state_name for stateRecord in stateRecords" class="form-control" required ng-change="viewCityList(selectState);">
                  <option value="" selected="selected">Select State</option>
                </select>
                 <span ng-show="partyDestinationForm.selectState.$touched && partyDestinationForm.selectState.$error.required">Please select the State</span>
              </div>

              <div class="form-group has-feedback">
                <select ng-model="selectCity" id="selectCity" name="selectCity" ng-options="cityRecord.id as cityRecord.city_name for cityRecord in cityRecords" class="form-control" required">
                  <option value="" selected="selected">Select City</option>
                </select>
                 <span ng-show="partyDestinationForm.selectCity.$touched && partyDestinationForm.selectCity.$error.required">Please select the City</span>
              </div>

              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Address" name="address" ng-model="address" id="address" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="partyDestinationForm.address.$touched && partyDestinationForm.address.$error.required">The Address is required.</span>
              </div>

              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Contact Number" name="contactNumber" ng-model="contactNumber" maxlength="10" ng-pattern="phoneNumberPattern" required onkeypress="return keyRestrict(event,'1234567890')" />
                <span class="invalidInputErrorClass" ng-cloak ng-show="partyDestinationForm.contactNumber.$touched && partyDestinationForm.contactNumber.$error.required">The Contact Number is required.</span>
                <span class="invalidInputErrorClass" ng-cloak ng-show="partyDestinationForm.contactNumber.$touched && partyDestinationForm.contactNumber.$error.pattern">The Contact Number is invalid.</span>
              </div>

              <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Contact Email" name="contactEmail" ng-model="contactEmail" ng-maxlength="255" ng-pattern="emailPattern" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="partyDestinationForm.contactEmail.$touched && partyDestinationForm.contactEmail.$error.required">The Contact Email is required.</span>
                <span class="invalidInputErrorClass" ng-cloak ng-show="partyDestinationForm.contactEmail.$touched && partyDestinationForm.contactEmail.$invalid">The Contact Email is invalid.</span>
              </div>

              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Contact Person" name="contactPerson" ng-model="contactPerson" ng-maxlength="255" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="partyDestinationForm.contactPerson.$touched && partyDestinationForm.contactPerson.$error.required">The Contact Person is required.</span>
              </div>

              <div class="form-group has-feedback">
                <input type="hidden" class="form-control" placeholder="latitude" name="lat" ng-model="lat" ng-maxlength="100"/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="partyDestinationForm.lat.$touched && partyDestinationForm.lat.$error.required">The Latitude is required.</span>
              </div>

              <div class="form-group has-feedback">
                <input type="hidden" class="form-control" placeholder="longitude" name="lng" ng-model="lng" ng-maxlength="100"/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="partyDestinationForm.lng.$touched && partyDestinationForm.lng.$error.required">The Longitude is required.</span>
              </div>

              <div class="form-group has-feedback">
                <div class="active_checkbox">
                  <label>Active:- </label>
                  <input type="checkbox" name="status" ng-model="status" ng-checked="status == '1'" ng-true-value="'A'" ng-false-value="'I'" >
                </div>
              </div>

            


              <div class="row submit-button-holder">
                <div class="col-xs-8">    
                                        
                </div><!-- /.col -->
                <div class="col-xs-4">
                 <a class="btn btn-default btn-flat" href=<?php echo url(''); ?>/partyDestinations>Back</a>
                  <button type="submit" ng-disabled="partyDestinationForm.$invalid" class="btn btn-primary">Submit</button>
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
  <script src="{{ asset('/angularJs/angularModules/party-destinations/partyDestinationApp.js') }}"></script>
@endsection

