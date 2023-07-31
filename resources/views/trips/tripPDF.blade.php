@extends('layouts.afterlogintemplate')
@section('content')
 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Download Trip PDF</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Download Trip PDF</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" data-ng-controller="pdfTripsController" data-ng-init="getPDFPlantList();">
      <form id="plantForm" name="plantForm">
        <div class="box box-default">
          <div class="box-body">
          <div class="select_plant pdftrip">
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label>Select Plant</label>
                  <select ng-model="selectPlant" name="selectPlant" ng-options="plantRecord.id as plantRecord.name for plantRecord in plantRecords" class="form-control" required ng-change="getPlantWiseActiveTruckList(selectPlant);">
                    <option value="" selected="selected">Select Plant</option>
                  </select>
                   <span class="invalidInputErrorClass" ng-show="plantForm.selectPlant.$touched && plantForm.selectPlant.$error.required">Please select the Plant</span>
                </div>

                <div class="form-group">
                    <label>Select Truck</label>
                    <select ng-model="selectTruck" name="selectTruck" ng-options="truckRecord.id as truckRecord.truck_no for truckRecord in truckRecords" class="form-control" required ng-change="getTruckWiseTripList(selectTruck);">
                      <option value="" selected="selected">Select Truck</option>
                    </select>
                     <span class="invalidInputErrorClass" ng-show="plantForm.selectTruck.$touched && plantForm.selectTruck.$error.required">Please select the Truck</span>
                </div>


                <div class="form-group">
                  <div class="row">
                  <div class="col-md-6">
                    <div class="form-group has-feedback">
                      <div class="date taxEnd">
                          
                          <label>Start Date</label>
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control" placeholder="Start Date" name="startDate" ng-model="startDate" ng-maxlength="255" ng-change="getTruckWiseTripList(selectTruck);"/>
                      </div>
                      <span class="invalidInputErrorClass" ng-cloak ng-show="plantForm.startDate.$touched && plantForm.startDate.$error.required">The Start Date is required.</span>
                    </div>
                  </div>  
                  <div class="col-md-6">
                    <div class="form-group has-feedback">
                      <div class="date taxEnd">
                         
                          <label>End Date</label>
                           <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control" placeholder="End Date" name="endDate" ng-model="endDate" ng-maxlength="255" start-date="@{{startDate}}" compare-with-start-date ng-change="getTruckWiseTripList(selectTruck);"/>
                      </div>
                      <span class="invalidInputErrorClass" ng-cloak ng-show="plantForm.endDate.$touched && plantForm.endDate.$error.required">The  End Date is required.</span>
                      <span class="invalidInputErrorClass" ng-cloak ng-show="(plantForm.startDate.$touched || plantForm.endDate.$touched) && plantForm.endDate.$invalid">The End date must be greater than or equals to Start Date.</span>
                    </div>
                  </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Select Trip</label>
                  <select ng-model="selectTrip" name="selectTrip" ng-options="tripRecord.id as tripRecord.name for tripRecord in tripRecords" class="form-control" required ng-change="setTripData(selectTrip);">
                    <option value="" selected="selected">Select Trip</option>
                  </select>
                  
                   <span class="invalidInputErrorClass" ng-show="plantForm.selectTrip.$touched && plantForm.selectTrip.$error.required">Please select the Trip</span>
                </div>


                <div class="form-group">
                  <button type="button" ng-disabled="plantForm.$invalid" class="btn btn-primary" ng-click="viewPDF();">View PDF</button>
                </div>
              </div>
              
              </div>
            </div>
          </div>
        </div> 
      </form>

      <div class="box box-default" ng-show="viewPdf === 1" style="padding: 20px 20px 20px 20px;">
          <div class="align_right">
            <!--<button type="button" class="btn btn-primary" ng-disabled="plantForm.$invalid" ng-click="getPDF()">Download as PDF</button>
            <button type="button" class="btn btn-primary" ng-disabled="plantForm.$invalid" ng-click="downloadPDF()">jsPDF</button>
            <button type="button" class="btn btn-primary" ng-disabled="plantForm.$invalid" ng-click="domPDF(selectPlant)">DomPDF</button> -->
            <button type="button" class="btn btn-primary" ng-disabled="plantForm.$invalid" ng-click="tcpdf(selectTrip)">Download as PDF</button>
          </div>
          <div id="pdfDataHolder">
              <div id="originalPDF"> @include('trips.pdfViewOriginal') </div> <br><br>

              <div id="duplicatePDF"> @include('trips.pdfViewDuplicate') </div>
          </div>
      </div>


      <!-- result -->
      
  </section>
  <!-- /.content -->


@endsection


@section('scripts')
  <script type="text/javascript">
    var date      = new Date();
    var today     = new Date(date.getFullYear(), date.getMonth(), date.getDate()); /*get today*/
    $.fn.datepicker.defaults.format = "dd-mm-yyyy";

    /*setting trip date 1 day prior to current date*/
    $.fn.datepicker.defaults.startDate  = "-19y";
    $.fn.datepicker.defaults.endDate    = "+19y";


    /*set today as default date in datepicker*/
    $('.date').datepicker();
    $('.date').datepicker('setDate', today);
  </script>
  <script src="{{ asset('/angularJs/angularModules/trips/tripApp.js') }}"></script>
@endsection
