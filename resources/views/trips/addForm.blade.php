@extends('layouts.afterlogintemplate')
@section('content')

 
      <!-- Content Header (Page header) -->
      
      <section class="content-header">
        <h1>
          Add Trip   
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Add Trip</li>
        </ol>
      </section>

      <!-- Main content -->
     <div data-ng-controller="tripsController" data-ng-init="getTripPlantList();getTripPetrolPumpList();getTripCategoryList();getTripVendorList();getAddressZoneDetail();getAddressZoneListing();getBankList();">
      <div class="flash-message" ng-hide="msgDisplay">
          @include('common.flash_message') 
          <span ng-view='danger' ng-cloak ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
       </div>
      <section class="content">
        <!-- Default box -->
        <div class="box" >
        
          
          <div class="box-header with-border">
            <h3 class="box-title">Add Trip</h3>
            
          </div>
          <div class="box-body tripfrm">
            <form ng-submit="saveTrip();" id="tripForm" name="tripForm">
               {{csrf_field()}}

              <input type="hidden" name="currentUserRole" id="currentUserRole" value="<?php echo Auth::user()->user_role_id?>"> 
              <input type="hidden" name="supervisorRoleId" id="supervisorRoleId" value="<?php echo Config::get('constants.supervisorRoleId'); ?>"> 

              <!-- Trip Information -->
              <div class="row">
                <div class="col-md-12 col-xs-12">
                  <div class="trip_form">
                    <div class="row">
                        <div class="col-md-12 section-heading"><label><h4>Basic Trip Information</h4></label></div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group has-feedback">
                          <label>Consignment Type</label>&nbsp;<span class="redAsterisk">*</span>
                          <select ng-model="tripType" name="tripType" class="form-control" required ng-change="viewTripTruckList(company);">
                            <option value="" selected="selected">Select Consignment Type</option>
                            <option value="Single">Single Consignment Trip </option>
                            <option value="Multiple">Multi Consignment Trip</option>
                          </select>
                          <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.tripType.$touched && tripForm.tripType.$error.required">The Trip Type is required.</span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group has-feedback">
                          <label>Trip Date</label>&nbsp;<span class="redAsterisk">*</span>
                          <div class="date taxEnd tripDates">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="Trip Date" name="tripDate" ng-model="tripDate" id="tripDate" ng-maxlength="255" required readonly/>
                          </div>
                          <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.tripDate.$touched && tripForm.tripDate.$error.required">The Trip Date is required.</span>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group has-feedback">
                          <label>LR No</label>&nbsp;<span class="redAsterisk">*</span>
                            <input type="text" class="form-control" placeholder="LR No" name="lrNo" ng-model="lrNo" ng-maxlength="255" required/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.lrNo.$touched && tripForm.lrNo.$error.required">The LR No is required.</span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group has-feedback">
                            <label>Shipment No</label>&nbsp;<span class="redAsterisk">*</span>
                            <input type="text" class="form-control" placeholder="Shipment No" name="shipmentNo" ng-model="shipmentNo" ng-maxlength="255" required/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.shipmentNo.$touched && tripForm.shipmentNo.$error.required">The Shipment No is required.</span>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group has-feedback">
                           <label>Invoice/Challan No</label>&nbsp;<span class="redAsterisk">*</span>
                            <input type="text" class="form-control" placeholder="Invoice/Challan No" name="tripInvoiceNo" ng-model="tripInvoiceNo" ng-maxlength="255" required/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.tripInvoiceNo.$touched && tripForm.tripInvoiceNo.$error.required">The Invoice/Challan No is required.</span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group has-feedback">
                          <label>Category</label>&nbsp;<span class="redAsterisk">*</span>
                          &nbsp;&nbsp;
                          <a href="#" class="marker_icon" title="Add New Category" data-toggle="modal" data-target="#catModal"><i class="{{\Config::get('constants.addIcon')}}" aria-hidden="true"></i></a>
                          <select ng-model="selectCategory" name="selectCategory" ng-options="categoryRecord.id as categoryRecord.category_name for categoryRecord in categoryRecords" class="form-control" required ng-change="viewTripSubcatList(selectCategory);">
                            <option value="" selected="selected">Select Category</option>
                          </select>
                          <span class="invalidInputErrorClass" ng-show="tripForm.selectCategory.$touched && tripForm.selectCategory.$error.required">Please select the Category</span>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group has-feedback">
                          <label>Subcategory</label>&nbsp;<span class="redAsterisk">*</span>
                          &nbsp;&nbsp;
                          <a href="#" class="marker_icon" title="Add New SubCategory" data-toggle="modal" data-target="#subCatModal"><i class="{{\Config::get('constants.addIcon')}}" aria-hidden="true"></i></a> 
                          <select ng-model="selectSubCategory" name="selectSubCategory" ng-options="subcategoryRecord.id as subcategoryRecord.name for subcategoryRecord in subcategoryRecords" class="form-control" required>
                            <option value="">Select SubCategory</option>
                          </select>
                          <span class="invalidInputErrorClass" ng-show="tripForm.selectSubCategory.$touched && tripForm.selectSubCategory.$error.required">Please select the SubCategory</span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group has-feedback">
                            <label>Quantity(in Metric Ton)</label>&nbsp;<span class="redAsterisk">*</span>
                            <input type="text" class="form-control" placeholder="Quantity(in Metric Ton)" name="quantity" ng-model="quantity" maxlength="10" onkeypress="return keyRestrict(event,'1234567890')" ng-pattern="numberPattern" required/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.quantity.$touched && tripForm.quantity.$error.required">The Quantity is required.</span>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.quantity.$touched && tripForm.quantity.$error.pattern">The Quantity is invalid.</span>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group has-feedback">
                            <label>Additional 1 / W </label>&nbsp;
                            <input type="text" class="form-control" placeholder="Additional 1" name="additional1" ng-model="additional1"/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.additional1.$touched && tripForm.additional1.$error.required">The Additional 1 is required.</span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group has-feedback">
                            <label>Additional 2 / LT</label>&nbsp;
                            <input type="text" class="form-control" placeholder="Additional 2" name="additional2" ng-model="additional2"/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.additional2.$touched && tripForm.additional2.$error.required">The Additional 2 is required.</span>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group has-feedback">
                            <label>Additional 3</label>&nbsp;
                            <input type="text" class="form-control" placeholder="Additional 3" name="additional3" ng-model="additional3"/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.additional3.$touched && tripForm.additional3.$error.required">The Additional 3 is required.</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Trip Information -->


              <!-- Vendor & Truck Information -->
              <div class="row">
                <div class="col-md-12 col-xs-12">
                  <div class="trip_form">
                    <div class="row">
                        <div class="col-md-12 section-heading"><label><h4>Vendor & Truck Information</h4></label></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group has-feedback">
                            <label>Select Vendor</label>&nbsp;<span class="redAsterisk">*</span>
                            &nbsp;&nbsp;
                            <a href="#" class="marker_icon" title="Add New Vendor" data-toggle="modal" data-target="#companyModal"><i class="{{\Config::get('constants.addIcon')}}" aria-hidden="true"></i></a>
                            <select ng-model="company" name="company" ng-options="vendorRecord.name as vendorRecord.name for vendorRecord in vendorRecords" class="form-control" required ng-change="viewTripTruckList(company);viewTruckOwner(company);">
                              <option value="" selected="selected">Select Vendor</option>
                            </select>
                             <span class="invalidInputErrorClass" ng-show="tripForm.company.$touched && tripForm.company.$error.required">Please select the Vendor</span>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group has-feedback">
                            <label>Select Truck</label>&nbsp;<span class="redAsterisk">*</span>
                            &nbsp;&nbsp;
                            <a href="#" class="marker_icon" title="Add New Truck" data-toggle="modal" data-target="#truckModal"><i class="{{\Config::get('constants.addIcon')}}" aria-hidden="true"></i></a>
                            <select ng-model="selectTruck" name="selectTruck" ng-options="truckRecord.id as truckRecord.truck_no for truckRecord in truckRecords" class="form-control" required>
                              <option value="" selected="selected">Select Truck</option>
                            </select>
                             <span class="invalidInputErrorClass" ng-show="tripForm.selectTruck.$touched && tripForm.selectTruck.$error.required">Please select the Truck</span>
                          </div>
                        </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group has-feedback">
                          <label>Truck Owner</label>&nbsp;
                            <input type="text" class="form-control" placeholder="Truck Owner" name="truckOwner" ng-model="truckOwner" ng-maxlength="255" disabled/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.truckOwner.$touched && tripForm.truckOwner.$error.required">The Truck Owner is required.</span>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group has-feedback">
                          <label>Truck Driver Name</label>&nbsp;
                            <input type="text" class="form-control" placeholder="Truck Driver Name" name="truckDriverName" ng-model="truckDriverName" ng-maxlength="255"/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.truckDriverName.$touched && tripForm.truckDriverName.$error.required">The Truck Driver Name is required.</span>
                        </div>
                      </div>
                      
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group has-feedback">
                            <label>Truck Driver Phone Number</label>
                            <input type="text" class="form-control" placeholder="Truck Driver Phone Number" name="truckDriverPhoneNo" ng-model="truckDriverPhoneNo" onkeypress="return keyRestrict(event,'1234567890')" maxlength="10" ng-pattern="phoneNumberPattern"/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.truckDriverPhoneNo.$touched && tripForm.truckDriverPhoneNo.$error.pattern">The Truck Driver Phone Number is invalid.</span>
                        </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group has-feedback">
                            <label>Truck Driver Email</label>
                            <input type="text" class="form-control" placeholder="Truck Driver Email" name="truckDriverEmail" ng-model="truckDriverEmail" ng-maxlength="255" ng-pattern="emailPattern"/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.truckDriverEmail.$touched && tripForm.truckDriverEmail.$error.pattern">The Truck Driver Email is invalid.</span>
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      
                      <div class="col-sm-12">
                        <div class="form-group has-feedback">
                           <label>Advance Amount</label>&nbsp;<span class="redAsterisk">*</span>
                            <input type="text" class="form-control" placeholder="Advance Amount" name="advanceAmount" ng-model="advanceAmount" maxlength="10" onkeypress="return keyRestrict(event,'1234567890.')" ng-pattern="numberPattern" required/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.advanceAmount.$touched && tripForm.advanceAmount.$error.required">The Advance Amount is required.</span>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.advanceAmount.$touched && tripForm.advanceAmount.$error.pattern">The Advance Amount is invalid.</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>  
              <!-- Vendor & Truck Information -->


              <!-- Plant & Party Information -->
              <div class="row">
                <div class="col-md-12 col-xs-12">
                  <div class="trip_form">
                      <div class="row">
                        <div class="col-md-12 section-heading"><label><h4>Plant & Party Information</h4></label></div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group has-feedback">
                            <label>Select Plant</label>&nbsp;<span class="redAsterisk">*</span>
                            &nbsp;&nbsp;
                             <a href="#" class="marker_icon" title="Add New Plant" data-toggle="modal" data-target="#plantModal"><i class="{{\Config::get('constants.addIcon')}}" aria-hidden="true"></i></a>
                            <select ng-model="selectPlant" name="selectPlant" ng-options="plantRecord.id as plantRecord.name for plantRecord in plantRecords" class="form-control" required>
                              <option value="" selected="selected">Select Plant</option>
                            </select>
                             <span class="invalidInputErrorClass" ng-show="tripForm.selectPlant.$touched && tripForm.selectPlant.$error.required">Please select the Plant</span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group has-feedback">
                            <label>Address Zone</label>&nbsp;<span class="redAsterisk">*</span>
                            <select ng-model="selectAddress" name="selectAddress" ng-options="addressZoneRecord.id as addressZoneRecord.title for addressZoneRecord in addressZoneRecords" class="form-control" required ng-change="getAddressWisePartyDetails(selectAddress);">
                              <option value="" selected="selected">Select Address Zone</option>
                            </select>
                            <span class="invalidInputErrorClass" ng-show="tripForm.selectAddress.$touched && tripForm.selectAddress.$error.required">Please select the Address</span>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group has-feedback">
                            <label>Select Party</label>&nbsp;<span class="redAsterisk">*</span>
                            &nbsp;&nbsp;
                            <a href="#" class="marker_icon" title="Add New Party" data-toggle="modal" data-target="#partyModal"><i class="{{\Config::get('constants.addIcon')}}" aria-hidden="true"></i></a>
                            <select ng-model="selectParty" name="selectParty" ng-options="partyRecord.id as partyRecord.party_name for partyRecord in partyRecords" class="form-control" required>
                              <option value="" selected="selected">Select Party</option>
                            </select>
                            <span class="invalidInputErrorClass" ng-show="tripForm.selectParty.$touched && tripForm.selectParty.$error.required">Please select the Party</span>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>    
              <!-- Plant & Party Information -->



              <!-- Petrol Pump Information -->
              <div class="row">
                <div class="col-md-12 col-xs-12">
                  <div class="trip_form">
                      <div class="row">
                        <div class="col-md-12 section-heading"><label><h4>Petrol Pump Information</h4></label></div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group has-feedback">
                            <label>Select Petrol Pump</label>&nbsp;<span class="redAsterisk">*</span>
                            &nbsp;&nbsp;
                            <a href="#" class="marker_icon" title="Add New Petrol Pump" data-toggle="modal" data-target="#petrolPumpModal"><i class="{{\Config::get('constants.addIcon')}}" aria-hidden="true"></i></a>
                            <select ng-model="selectPetrolPump" name="selectPetrolPump" ng-options="petrolPumpRecord.id as petrolPumpRecord.petrol_pump_name for petrolPumpRecord in petrolPumpRecords" class="form-control" required>
                              <option value="" selected="selected">Select Petrol Pump</option>
                            </select>
                            <span class="invalidInputErrorClass" ng-show="tripForm.selectPetrolPump.$touched && tripForm.selectPetrolPump.$error.required">Please select the Petrol Pump</span>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group has-feedback">
                          <label>Diesel Amount</label>&nbsp;<span class="redAsterisk">*</span>
                              <input type="text" class="form-control" placeholder="Diesel Amount" name="dieselAmount" ng-model="dieselAmount" onkeypress="return keyRestrict(event,'1234567890.')" ng-pattern="numberPattern" maxlength="10" required/>
                              <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.dieselAmount.$touched && tripForm.dieselAmount.$error.required">The Diesel Amount is required.</span>
                              <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.dieselAmount.$touched && tripForm.dieselAmount.$error.pattern">The Diesel Amount is invalid.</span>

                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group has-feedback">
                             <label>Description</label>&nbsp;<span class="redAsterisk">*</span>
                              <textarea class="form-control" rows="4" cols="50" placeholder="Description" name="description" ng-model="description" required></textarea>
                              <span class="invalidInputErrorClass" ng-cloak ng-show="tripForm.description.$touched && tripForm.description.$error.required">The Description is required.</span>
                          </div>
                        </div>
                      </div>
                  </div>    
                </div>  
              </div>  
              <!-- Petrol Pump Information -->

              <div class="row submit-button-holder">
                <div class="col-xs-12">
                 <a class="btn btn-default btn-flat" href=<?php echo url(''); ?>/trips>Back</a>
                  <button type="submit" ng-disabled="tripForm.$invalid" class="btn btn-primary">Submit</button>
                </div><!-- /.col -->
              </div>


            </form> 
          </div><!-- /.box-body -->
          <div class="box-footer">
             
          </div><!-- /.box-footer-->
        </div><!-- /.box -->

      </section><!-- /.content -->

        <!-- modal for category add-->  
        <div class="modal fade" id="catModal" tabindex="-1" role="dialog" aria-labelledby="catModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <label>Add Category</label>
                <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><img src="{{asset('images/blue_cross.png')}}" alt="Close"/></button>
              </div>
              <div class="modal-body" style="padding-top:0;">
                <div class="modal_select">
                  
                    <section class="content">
                      <!-- Default box -->
                      
                       <div class="flash-message" ng-hide="msgDisplay">
                          @include('common.flash_message') 
                          <span ng-view='catSuccess' ng-cloak ng-bind='catSuccess' class="alert alert-success" ng-show="catSuccess"></span>
                          <span ng-view='catDanger' ng-cloak ng-bind='catDanger' class="alert alert-danger" ng-show="catDanger"></span>
                       </div>
                        
                        <div class="box-header with-border">
                          <h3 class="box-title">Add Category</h3>
                          
                        </div>
                        <div class="box-body">
                          <form ng-submit="saveTripCategory();" id="categoryForm" name="categoryForm">
                             {{csrf_field()}}
                            
                            <div class="form-group has-feedback">
                              <label>Category Name</label>&nbsp;<span class="redAsterisk">*</span>
                              <input type="text" class="form-control" placeholder="Category Name" name="categoryName" ng-model="categoryName" ng-maxlength="255" required/>
                              <span class="invalidInputErrorClass" ng-cloak ng-show="categoryForm.categoryName.$touched && categoryForm.categoryName.$error.required">The Category Name is required.</span>
                            </div>

                            <div class="form-group has-feedback">
                              <label>Category Description</label>
                              <input type="text" class="form-control" placeholder="Category Description" name="categoryDesc" ng-model="categoryDesc" ng-maxlength="255"/>
                              <span class="invalidInputErrorClass" ng-cloak ng-show="categoryForm.categoryDesc.$touched && categoryForm.categoryDesc.$error.required">The Category Description is required.</span>
                            </div>

                            <div class="row submit-button-holder">
                              <div class="col-xs-8">    
                                                      
                              </div><!-- /.col -->
                              <div class="col-xs-12">
                                <button type="submit" ng-disabled="categoryForm.$invalid" class="btn btn-primary">Submit</button>
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
        <!-- modal for category add-->  


        <!-- modal for sub-category add-->  
        <div class="modal fade" id="subCatModal" tabindex="-1" role="dialog" aria-labelledby="subCatModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <label>Add Sub Category</label>
                <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><img src="{{asset('images/blue_cross.png')}}" alt="Close"/></button>
              </div>
              <div class="modal-body" style="padding-top:0;">
                <div class="modal_select">
                  
                    <section class="content">
                      <!-- Default box -->
                      
                       <div class="flash-message" ng-hide="msgDisplay">
                          @include('common.flash_message') 
                          <span ng-view='subCatSuccess' ng-cloak ng-bind='subCatSuccess' class="alert alert-success" ng-show="subCatSuccess"></span>
                          <span ng-view='subCatDanger' ng-cloak ng-bind='subCatDanger' class="alert alert-danger" ng-show="subCatDanger"></span>
                       </div>
                        
                        <div class="box-header with-border">
                          <h3 class="box-title">Add Sub Category</h3>
                          
                        </div>
                       <div class="box-body">
                          <form ng-submit="saveTripSubcategory();" id="subcategoryForm" name="subcategoryForm">
                             {{csrf_field()}}

                            <div class="form-group has-feedback">
                              <!--<select ng-model="selectCategory" name="selectCategory" ng-options="record.id as record.category_name for record in records" class="form-control" required>
                                <option value="" selected="selected">Select Category</option>
                              </select>-->
                              <label>Select Category</label>&nbsp;<span class="redAsterisk">*</span>
                              <select ng-model="selectCategory" name="selectCategory" ng-options="categoryRecord.id as categoryRecord.category_name for categoryRecord in categoryRecords" class="form-control" ng-change="viewTripSubcatList(selectCategory);" required>
                                <option value="" selected="selected">Select Category</option>
                              </select>

                               <span class="invalidInputErrorClass" ng-show="subcategoryForm.selectCategory.$touched && subcategoryForm.selectCategory.$error.required">Please select the Category</span>
                            </div>
                            
                            <div class="form-group has-feedback">
                              <label>Subcategory Name</label>&nbsp;<span class="redAsterisk">*</span>
                              <input type="text" class="form-control" placeholder="Item Name" name="subcategoryName" ng-model="subcategoryName" ng-maxlength="255" required/>
                              <span class="invalidInputErrorClass" ng-cloak ng-show="subcategoryForm.subcategoryName.$touched && subcategoryForm.subcategoryName.$error.required">The Subcategory Name is required.</span>
                            </div>

                            <div class="form-group has-feedback">
                              <label>Subcategory Description</label>
                              <input type="text" class="form-control" placeholder="Item Description" name="subcategoryDesc" ng-model="subcategoryDesc" ng-maxlength="255"/>
                              <span class="invalidInputErrorClass" ng-cloak ng-show="subcategoryForm.subcategoryDesc.$touched && subcategoryForm.subcategoryDesc.$error.required">The Subcategory Description is required.</span>
                            </div>

                          
                            <div class="row submit-button-holder">
                              <div class="col-xs-8">    
                                                      
                              </div><!-- /.col -->
                              <div class="col-xs-12">
                                <button type="submit" ng-disabled="subcategoryForm.$invalid" class="btn btn-primary">Submit</button>
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
        <!-- modal for sub-category add-->  


        <!-- modal for plant add-->  
        <div class="modal fade" id="plantModal" tabindex="-1" role="dialog" aria-labelledby="plantModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <label>Add Plant</label>
                <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><img src="{{asset('images/blue_cross.png')}}" alt="Close"/></button>
              </div>
              <div class="modal-body" style="padding-top:0;">
                <div class="modal_select">
                  
                  <section class="content">
                      <!-- Default box -->
                        <div class="flash-message" ng-hide="msgDisplay">
                          @include('common.flash_message') 
                          <span ng-view='plantSuccess' ng-cloak ng-bind='plantSuccess' class="alert alert-success" ng-show="plantSuccess"></span>
                          <span ng-view='plantDanger' ng-cloak ng-bind='plantDanger' class="alert alert-danger" ng-show="plantDanger"></span>
                       </div>
                        <div class="box-header with-border">
                          <h3 class="box-title">Add Plant</h3>
                        </div>
                        <div class="box-body">
                          <form ng-submit="saveTripPlant();" id="plantForm" name="plantForm">
                             {{csrf_field()}}
                            <div class="form-group has-feedback">
                              <label>Type</label>&nbsp;<span class="redAsterisk">*</span>
                              <select ng-model="selectType" name="selectType" class="form-control" required>
                                <option value="" selected="selected">Select Type</option>
                                <option value="P">Plant</option>
                                <option value="W">Warehouse</option>
                              </select>
                               <span class="invalidInputErrorClass" ng-show="plantForm.selectType.$touched && plantForm.selectType.$error.required">Please select the Type</span>
                            </div>
                            <div class="form-group has-feedback">
                              <label>Address Zone</label>&nbsp;<span class="redAsterisk">*</span>
                              <select ng-model="selectAddressZonePlant" name="selectAddressZonePlant" ng-options="addressZoneRecord.id as addressZoneRecord.title for addressZoneRecord in addressZoneRecords" class="form-control" required >
                                <option value="" selected="selected">Select Address Zone</option>
                              </select>
                              <span class="invalidInputErrorClass" ng-show="plantForm.selectAddressZonePlant.$touched && plantForm.selectAddressZonePlant.$error.required">Please select the Address Zone</span>
                           </div>

                            <!--<div class="form-group has-feedback">
                              <label>Address</label>
                              <input type="text" class="form-control" placeholder="Address" name="addressZoneAddressPlant" ng-model="addressZoneAddressPlant" id="addressZoneAddressPlant" ng-maxlength="255" value="{{isset($addressZoneDetails) && !empty($addressZoneDetails) ? $addressZoneDetails :''}}" required/>
                              <span class="invalidInputErrorClass" ng-cloak ng-show="plantForm.addressZoneAddress.$touched && plantForm.addressZoneAddress.$error.required">The Address is required.</span>
                            </div>  -->


                            <div class="form-group has-feedback">
                              <label>Plant Name</label>&nbsp;<span class="redAsterisk">*</span>
                              <input type="text" class="form-control upperCaseTransform" placeholder="Plant Name" name="name" ng-model="name" ng-maxlength="255" required/>
                              <span class="invalidInputErrorClass" ng-cloak ng-show="plantForm.name.$touched && plantForm.name.$error.required">The Plant Name is required.</span>
                            </div>

                            <div class="form-group has-feedback">
                              <label>Plant Description</label>
                              <input type="text" class="form-control upperCaseTransform" placeholder="Plant Description" name="description" ng-model="description" ng-maxlength="255"/>
                              <span class="invalidInputErrorClass" ng-cloak ng-show="plantForm.description.$touched && plantForm.description.$error.required">The Plant Description is required.</span>
                            </div>


                            <div class="form-group has-feedback">
                              <label>Balance Amount</label>&nbsp;<span class="redAsterisk">*</span>
                              <input type="text" class="form-control" placeholder="Balance Amount" name="balanceAmount" ng-model="balanceAmount" maxlength="10" ng-pattern="numberPattern" onkeypress="return keyRestrict(event,'1234567890.')" required/>
                              <span class="invalidInputErrorClass" ng-cloak ng-show="plantForm.balanceAmount.$touched && plantForm.balanceAmount.$error.required">The Balance Amount is required.</span>
                              <span class="invalidInputErrorClass" ng-cloak ng-show="plantForm.balanceAmount.$touched && plantForm.balanceAmount.$error.pattern">The Balance Amount is invalid.</span>
                               <span class="invalidInputErrorClass" ng-cloak ng-show="plantForm.balanceAmount.$error.pattern">The Balance Amount is invalid.</span>
                            </div>

                            <div class="row submit-button-holder">
                              <div class="col-xs-8">    
                                                      
                              </div><!-- /.col -->
                              <div class="col-xs-12">
                                <button type="submit" ng-disabled="plantForm.$invalid" class="btn btn-primary">Submit</button>
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
        <!-- modal for plant add-->


        <!-- modal for party add-->  
        <div class="modal fade" id="partyModal" tabindex="-1" role="dialog" aria-labelledby="partyModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <label>Add Party</label>
                <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><img src="{{asset('images/blue_cross.png')}}" alt="Close"/></button>
              </div>
              <div class="modal-body" style="padding-top:0;">
                <div class="modal_select">
                  
                  <section class="content">
                    <!-- Default box -->
                      <div class="flash-message" ng-hide="msgDisplay">
                          @include('common.flash_message') 
                          <span ng-view='partySuccess' ng-cloak ng-bind='partySuccess' class="alert alert-success" ng-show="partySuccess"></span>
                          <span ng-view='partyDanger' ng-cloak ng-bind='partyDanger' class="alert alert-danger" ng-show="partyDanger"></span>
                       </div>
                      <div class="box-header with-border">
                        <h3 class="box-title">Add Party</h3>
                      </div>
                      <div class="box-body">
                        <form ng-submit="saveTripParty();" id="partyForm" name="partyForm">
                           {{csrf_field()}}

                          <div class="form-group has-feedback">
                            <label>Party Name</label>&nbsp;<span class="redAsterisk">*</span>
                            <input type="text" class="form-control upperCaseTransform" placeholder="Party Name" name="partyName" ng-model="partyName" ng-maxlength="255" required/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="partyForm.partyName.$touched && partyForm.partyName.$error.required">The Party Name is required.</span>
                          </div>

                          <!--<div class="form-group has-feedback">
                            <label>Address</label>
                            <input type="text" class="form-control" placeholder="Address" name="addressZoneAddressParty" ng-model="addressZoneAddressParty" id="addressZoneAddressParty" ng-maxlength="255" value="{{isset($addressZoneDetails) && !empty($addressZoneDetails) ? $addressZoneDetails :''}}" required/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="partyForm.addressZoneAddress.$touched && partyForm.addressZoneAddress.$error.required">The Address is required.</span>
                          </div> -->

                          <div class="form-group has-feedback">
                              <label>Address Zone</label>&nbsp;<span class="redAsterisk">*</span>
                              &nbsp;&nbsp;
                              <a href="#" class="marker_icon" title="Add New Address" data-toggle="modal" data-target="#addressModal"><i class="{{\Config::get('constants.addIcon')}}" aria-hidden="true"></i></a>
                              <select ng-model="selectAddressZoneParty" name="selectAddressZoneParty" ng-options="addressZoneRecord.id as addressZoneRecord.title for addressZoneRecord in addressZoneRecords" class="form-control" required >
                                  <option value="" selected="selected">Select Address Zone</option>
                                </select>
                              <span class="invalidInputErrorClass" ng-show="partyForm.selectAddressZoneParty.$touched && partyForm.selectAddressZoneParty.$error.required">Please select the Address Zone</span> 
                          </div>

                          <div class="form-group has-feedback">
                            <label>Party Description</label>
                            <input type="text" class="form-control upperCaseTransform" placeholder="Party Description" name="partyDesc" ng-model="partyDesc" ng-maxlength="255"/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="partyForm.partyDesc.$touched && partyForm.partyDesc.$error.required">The Party Description is required.</span>
                          </div>

                          <div class="form-group has-feedback">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" placeholder="Phone Number" name="phoneNumber" ng-model="phoneNumber" ng-pattern="phoneNumberPattern" maxlength="10" onkeypress="return keyRestrict(event,'1234567890')"/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="partyForm.phoneNumber.$touched && partyForm.phoneNumber.$error.required">The Phone Number is required.</span>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="partyForm.phoneNumber.$touched && partyForm.phoneNumber.$error.pattern">The Phone Number is invalid.</span>
                          </div>

                          <div class="form-group has-feedback">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" ng-model="email" ng-maxlength="255" ng-pattern="emailPattern"/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="partyForm.email.$touched && partyForm.email.$error.required">The Email is required.</span>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="partyForm.email.$touched && partyForm.email.$invalid">The Email is invalid.</span>
                          </div>

                          <div class="row submit-button-holder">
                            <div class="col-xs-8">    
                                                    
                            </div><!-- /.col -->
                            <div class="col-xs-12">
                              <button type="submit" ng-disabled="partyForm.$invalid" class="btn btn-primary">Submit</button>
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
        <!-- modal for party add-->


        <!-- modal for petrol pump add-->  
        <div class="modal fade" id="petrolPumpModal" tabindex="-1" role="dialog" aria-labelledby="petrolPumpModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <label>Add Petrol Pump</label>
                <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><img src="{{asset('images/blue_cross.png')}}" alt="Close"/></button>
              </div>
              <div class="modal-body" style="padding-top:0;">
                <div class="modal_select">
                  
                  <section class="content">
                    <!-- Default box -->
                      <div class="flash-message" ng-hide="msgDisplay">
                          @include('common.flash_message') 
                          <span ng-view='petrolPumpSuccess' ng-cloak ng-bind='petrolPumpSuccess' class="alert alert-success" ng-show="petrolPumpSuccess"></span>
                          <span ng-view='petrolPumpDanger' ng-cloak ng-bind='petrolPumpDanger' class="alert alert-danger" ng-show="petrolPumpDanger"></span>
                       </div>
                      <div class="box-header with-border">
                        <h3 class="box-title">Add Petrol Pump</h3>
                      </div>
                     <div class="box-body">
                      <form ng-submit="saveTripPetrolPump();" id="petrolPumpForm" name="petrolPumpForm">
                         {{csrf_field()}}

                        <div class="form-group has-feedback">
                          <label>Petrol Pump Name</label>&nbsp;<span class="redAsterisk">*</span>
                          <input type="text" class="form-control upperCaseTransform" placeholder="Petrol Pump Name" name="petrolPumpName" ng-model="petrolPumpName" ng-maxlength="255" required/>
                          <span class="invalidInputErrorClass" ng-cloak ng-show="petrolPumpForm.petrolPumpName.$touched && petrolPumpForm.petrolPumpName.$error.required">The PetrolPump Name is required.</span>
                        </div>

             
                        <!--<div class="form-group has-feedback">
                            <label>Address</label>
                            <input type="text" class="form-control" placeholder="Address" name="addressZoneAddressPetrolPump" ng-model="addressZoneAddressPetrolPump" id="addressZoneAddressPetrolPump" ng-maxlength="255" value="{{isset($addressZoneDetails) && !empty($addressZoneDetails) ? $addressZoneDetails :''}}" required/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="petrolPumpForm.addressZoneAddress.$touched && petrolPumpForm.addressZoneAddress.$error.required">The Address is required.</span>
                        </div>  -->

                        <div class="form-group has-feedback">
                            <label>Address Zone</label>&nbsp;<span class="redAsterisk">*</span>
                            <select ng-model="selectAddressZonePetrolPump" name="selectAddressZonePetrolPump" ng-options="addressZoneRecord.id as addressZoneRecord.title for addressZoneRecord in addressZoneRecords" class="form-control" required >
                                  <option value="" selected="selected">Select Address Zone</option>
                                </select>
                            <span class="invalidInputErrorClass" ng-show="petrolPumpForm.selectAddressZonePetrolPump.$touched && petrolPumpForm.selectAddressZonePetrolPump.$error.required">Please select the Address Zone</span>
                        </div> 

                        <div class="form-group has-feedback">
                          <label>Contact Number</label>
                          <input type="text" class="form-control" placeholder="Contact Number" name="contactNumber" ng-model="contactNumber" maxlength="10" onkeypress="return keyRestrict(event,'1234567890')" ng-pattern="phoneNumberPattern"/>
                          <span class="invalidInputErrorClass" ng-cloak ng-show="petrolPumpForm.contactNumber.$touched && petrolPumpForm.contactNumber.$error.required">The Contact Number is required.</span>
                          <span class="invalidInputErrorClass" ng-cloak ng-show="petrolPumpForm.contactNumber.$touched && petrolPumpForm.contactNumber.$error.pattern">The Contact Number is invalid.</span>
                        </div>

                        <div class="form-group has-feedback">
                          <label>Contact Email</label>
                          <input type="email" class="form-control" placeholder="Contact Email" name="contactEmail" ng-model="contactEmail" ng-maxlength="255" ng-pattern="emailPattern"/>
                          <span class="invalidInputErrorClass" ng-cloak ng-show="petrolPumpForm.contactEmail.$touched && petrolPumpForm.contactEmail.$error.required">The Contact Email is required.</span>
                          <span class="invalidInputErrorClass" ng-cloak ng-show="petrolPumpForm.contactEmail.$touched && petrolPumpForm.contactEmail.$invalid">The Contact Email is invalid.</span>
                        </div>

                        <div class="form-group has-feedback">
                          <label>Contact Person</label>
                          <input type="text" class="form-control upperCaseTransform" placeholder="Contact Person" name="contactPerson" ng-model="contactPerson" ng-maxlength="255"/>
                          <span class="invalidInputErrorClass" ng-cloak ng-show="petrolPumpForm.contactPerson.$touched && petrolPumpForm.contactPerson.$error.required">The Contact Person is required.</span>
                        </div>

                     
                        <div class="row submit-button-holder">
                          <div class="col-xs-8">    
                                                  
                          </div><!-- /.col -->
                          <div class="col-xs-12">
                            <button type="submit" ng-disabled="petrolPumpForm.$invalid" class="btn btn-primary">Submit</button>
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
        <!-- modal for petrol pump add-->


        <!-- modal for vendor add-->  
        <div class="modal fade" id="companyModal" tabindex="-1" role="dialog" aria-labelledby="companyModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <label>Add Vendor</label>
                <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><img src="{{asset('images/blue_cross.png')}}" alt="Close"/></button>
              </div>
              <div class="modal-body" style="padding-top:0;">
                <div class="modal_select">
                  
                  <section class="content">
                    <!-- Default box -->
                      <div class="flash-message" ng-hide="msgDisplay">
                          @include('common.flash_message') 
                          <span ng-view='vendorSuccess' ng-cloak ng-bind='vendorSuccess' class="alert alert-success" ng-show="vendorSuccess"></span>
                          <span ng-view='vendorDanger' ng-cloak ng-bind='vendorDanger' class="alert alert-danger" ng-show="vendorDanger"></span>
                       </div>
                      <div class="box-header with-border">
                        <h3 class="box-title">Add Vendor</h3>
                      </div>
                     <div class="box-body">
                        <form ng-submit="saveTripVendor();" id="vendorForm" name="vendorForm">
                           {{csrf_field()}}
                          
                          <div class="form-group has-feedback">
                            <label>Vendor Name</label>&nbsp;<span class="redAsterisk">*</span>
                            <input type="text" class="form-control upperCaseTransform" placeholder="Vendor Name" name="vendorName" ng-model="vendorName" ng-maxlength="255" required/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.vendorName.$touched && vendorForm.vendorName.$error.required">The Vendor Name is required.</span>
                          </div>

                          <div class="form-group has-feedback">
                            <label>Contact Person</label>
                            <input type="text" class="form-control upperCaseTransform" placeholder="Contact Person" name="contactPerson" ng-model="contactPerson" ng-maxlength="255"/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.contactPerson.$touched && vendorForm.contactPerson.$error.required">The Contact Person is required.</span>
                          </div>

                          <div class="form-group has-feedback">
                            <label>Contact Number</label>
                            <input type="text" class="form-control" placeholder="Contact Number" name="contactNumber" ng-model="contactNumber" maxlength="10" ng-pattern="phoneNumberPattern" onkeypress="return keyRestrict(event,'1234567890')"/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.contactNumber.$touched && vendorForm.contactNumber.$error.required">The Contact Number is required.</span>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.contactNumber.$touched && vendorForm.contactNumber.$error.pattern">The Contact Number is invalid.</span>
                          </div>

                          <div class="form-group has-feedback">
                            <label>Contact Email</label>
                            <input type="email" class="form-control" placeholder="Contact Email" name="contactEmail" ng-model="contactEmail" ng-maxlength="255" ng-pattern="emailPattern"/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.contactEmail.$touched && vendorForm.contactEmail.$invalid">The Contact Email is invalid.</span>
                          </div>


                          <div class="form-group has-feedback">
                            <label>Pan Number</label>&nbsp;<span class="redAsterisk">*</span>
                            <input type="text" class="form-control upperCaseTransform" placeholder="Pan Number" name="panNumber" ng-model="panNumber" ng-maxlength="255" ng-pattern="panNumberPattern" required/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.panNumber.$touched && vendorForm.panNumber.$error.required">The Pan Number is required.</span>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.panNumber.$touched && vendorForm.panNumber.$invalid">The Pan Number is invalid.</span>
                          </div>

                          <div class="form-group has-feedback">
                            <label>Bank Name</label>&nbsp;<span class="redAsterisk">*</span>
                            <!--<input type="text" class="form-control upperCaseTransform" placeholder="Bank Name" name="bankName" ng-model="bankName" ng-maxlength="255" required/>-->
                            <select ng-model="selectBank" name="selectBank" ng-options="bankRecord.id as bankRecord.name for bankRecord in bankRecords" class="form-control" required>
                              <option value="" selected="selected">Select Bank</option>
                            </select>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.bankName.$touched && vendorForm.bankName.$error.required">The Bank Name is required.</span>
                          </div>

                          <div class="form-group has-feedback">
                            <label>IFSC Code</label>&nbsp;<span class="redAsterisk">*</span>
                           
                            <input type="text" class="form-control upperCaseTransform" placeholder="IFSC Code" name="ifsc" ng-model="ifsc" ng-maxlength="255" required/>

                            <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.ifsc.$touched && vendorForm.ifsc.$error.required">The IFSC Code is required.</span>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.ifsc.$touched && vendorForm.ifsc.$invalid">The IFSC Code is invalid.</span>
                          </div>

                          <div class="form-group has-feedback">
                            <label>Account Number</label>&nbsp;<span class="redAsterisk">*</span>
                            <input type="text" class="form-control" placeholder="Account Number" name="accountNo" ng-model="accountNo" ng-maxlength="255" ng-pattern="bankAccNoPattern" onkeypress="return keyRestrict(event,'1234567890')" required/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.accountNo.$touched && vendorForm.accountNo.$error.required">The Account Number is required.</span>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.accountNo.$touched && vendorForm.accountNo.$error.pattern">The Account Number is invalid.</span>
                          </div>

                          <div class="form-group has-feedback">
                            <label>Account Holder Name</label>&nbsp;<span class="redAsterisk">*</span>
                            <input type="text" class="form-control upperCaseTransform" placeholder="Account Holder Name" name="accountHolderName" ng-model="accountHolderName" ng-maxlength="255" required/>
                            <span class="invalidInputErrorClass" ng-cloak ng-show="vendorForm.accountHolderName.$touched && vendorForm.accountHolderName.$error.required">The Account Holder Name is required.</span>
                          </div>

                          <div class="row submit-button-holder">
                            <div class="col-xs-8">    
                                                    
                            </div><!-- /.col -->
                            <div class="col-xs-12">
                              <button type="submit" ng-disabled="vendorForm.$invalid" class="btn btn-primary">Submit</button>
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
        <!-- modal for vendor add-->


        <!-- modal for truck add-->  
        <div class="modal fade" id="truckModal" tabindex="-1" role="dialog" aria-labelledby="truckModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <label>Add Truck</label>
                <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><img src="{{asset('images/blue_cross.png')}}" alt="Close"/></button>
              </div>
              <div class="modal-body" style="padding-top:0;">
                <div class="modal_select">
                  
                  <section class="content">
                    <!-- Default box -->
                      <div class="flash-message" ng-hide="msgDisplay">
                          @include('common.flash_message') 
                          <span ng-view='truckSuccess' ng-cloak ng-bind='truckSuccess' class="alert alert-success" ng-show="truckSuccess"></span>
                          <span ng-view='truckDanger' ng-cloak ng-bind='truckDanger' class="alert alert-danger" ng-show="truckDanger"></span>
                       </div>
                      <div class="box-header with-border">
                        <h3 class="box-title">Add Truck</h3>
                      </div>
                     <div class="box-body popuptruckfrm">
                      <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li class="active"><a rel="#ownerInfo">Owner's Info</a></li>
                          <li><a rel="#truckInfo">Truck Info</a></li>
                          <li ng-show="company==='SSLogistics'"><a rel="#permits">Permits</a></li>
                          <li ng-show="company==='SSLogistics'"><a rel="#insurance">Insurance</a></li>
                          <li ng-show="company==='SSLogistics'"><a rel="#tax">Tax</a></li>
                          <li ng-show="company==='SSLogistics'"><a rel="#pollution">Pollution</a></li>
                        </ul>
                        <form ng-submit="saveTripTruck();" id="truckForm" name="truckForm">
                          <div class="tab-content">
                            
                            <!-- Owner's Info -->
                            <div class="tab-pane active" id="ownerInfo">
                                {{csrf_field()}}
                                <div class="form-group has-feedback">
                                    <label>Select Vendor</label>&nbsp;<span class="redAsterisk">*</span>
                                    <select ng-model="company" name="company" ng-options="vendorRecord.name as vendorRecord.name for vendorRecord in vendorRecords" class="form-control" required ng-change="viewTripTruckList(company);viewTruckOwner(company);">
                                      <option value="" selected="selected">Select Vendor</option>
                                    </select>
                                     <span class="invalidInputErrorClass" ng-show="tripForm.company.$touched && tripForm.company.$error.required">Please select the Vendor</span>
                                </div>
                                <input type="hidden" ng-model="selectType" name="selectType" id="selectType">
  
                                
                                <div class="row submit-button-holder">
                                  <div class="col-xs-8"> </div>   
                                  <div class="col-xs-12">
                                   <a class="btn btn-primary nxtTab" ng-disabled="truckForm.company.$invalid" href="">Next</a>
                                  </div>
                                </div>
                              
                            </div><!-- /.tab-pane -->

                            <!-- Truck Info -->
                            <div class="tab-pane" id="truckInfo">
                                <div class="form-group has-feedback">
                                  <label>Truck Number</label>&nbsp;<span class="redAsterisk">*</span>
                                  <input type="text" class="form-control upperCaseTransform" placeholder="Truck Number" name="truckNo" ng-model="truckNo" ng-maxlength="150" ng-pattern="truckNumberPattern" required/>
                                  <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.truckNo.$touched && truckForm.truckNo.$error.required">The Truck Number is required.</span>
                                  <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.truckNo.$touched && truckForm.truckNo.$error.pattern">The Truck Number is invalid. It must be in the format like "WB-12E-1234" OR "WB-12-1234".</span>
                                </div>

                                
                                <div class="row" ng-show="company==='SSLogistics'">
                                <div class="form-group has-feedback col-sm-6">
                                  <div class="date truckDate taxEnd">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <label>Registered On</label>&nbsp;<span class="redAsterisk">*</span>
                                    <input type="text" class="form-control" placeholder="Registered On" name="registeredOn" ng-model="registeredOn" ng-maxlength="255" ng-required="company==='SSLogistics'"/>
                                  </div>
                                  <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.registeredOn.$touched && truckForm.registeredOn.$error.required">The Registered On is required.</span>
                                </div>

                                
                                <div class="form-group has-feedback col-sm-6">
                                  <div class="date truckDate taxEnd">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <label>Registered End</label>&nbsp;<span class="redAsterisk">*</span>
                                    <input type="text" class="form-control" placeholder="Registration End" name="registrationEnd" ng-model="registrationEnd" ng-maxlength="255" start-date="@{{registeredOn}}" compare-with-start-date ng-required="company==='SSLogistics'"/>
                                  </div>
                                  <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.registrationEnd.$touched && truckForm.registrationEnd.$error.required">The Registration End is required.</span>
                                  <span class="invalidInputErrorClass" ng-cloak ng-show="(truckForm.registrationEnd.$touched || truckForm.registrationOn.$touched) && truckForm.registrationEnd.$invalid">The End date must be greater than or equals to Start Date.</span>
                                </div>                      

                                </div>

                                <div class="form-group has-feedback">
                                   <label>Registration File</label>
                                   <input type="file" class="form-control" id ="registrationFile" ng-model="registrationFile" file-model="registrationFile"/>
                                   <span ng-view='registrationFileName' ng-cloak ng-bind='registrationFileName'></span>
                                   <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.registrationFile.$touched && truckForm.registrationFile.$error.required">The Registration File is required.</span>
                                </div>

                                <div class="row submit-button-holder">
                                  <div class="col-xs-8"> </div>   
                                  <div class="col-xs-12">
                                   <a class="btn btn-default btn-flat prvTab" href="">Previous</a>
                                   <a class="btn btn-primary nxtTab" ng-disabled="truckForm.truckNo.$invalid ||  truckForm.registeredOn.$invalid || truckForm.registrationEnd.$invalid" ng-show="company==='SSLogistics'" href="">Next</a>
                                   <button type="submit" ng-disabled="truckForm.$invalid" ng-hide="company==='SSLogistics'" class="btn btn-primary">Submit</button>
                                  </div>
                                </div>
                            </div><!-- /.tab-pane -->

                            <!-- Permit Info -->
                            <div class="tab-pane" id="permits" ng-show="company==='SSLogistics'">
                              <div class="form-group has-feedback">
                                <label>Permit Number</label>&nbsp;<span class="redAsterisk">*</span>
                                <input type="text" class="form-control upperCaseTransform" placeholder="Permit Number" name="permitNo" ng-model="permitNo" ng-maxlength="150" ng-required="company==='SSLogistics'"/>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.permitNo.$touched && truckForm.permitNo.$error.required">The Permit Number is required.</span>
                              </div>

                              <div class="row">
                              <div class="form-group has-feedback col-sm-6">
                                <div class="date truckDate taxEnd">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <label>Permit On</label>&nbsp;<span class="redAsterisk">*</span>
                                    <input type="text" class="form-control" placeholder="Permit On" name="permitOn" ng-model="permitOn" ng-maxlength="255" ng-required="company==='SSLogistics'"/>
                                </div>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.permitOn.$touched && truckForm.permitOn.$error.required">The Permit On is required.</span>
                              </div>

                              <div class="form-group has-feedback col-sm-6">
                                <div class="date truckDate taxEnd">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <label>Permit End</label>&nbsp;<span class="redAsterisk">*</span>
                                    <input type="text" class="form-control" placeholder="Permit End" name="permitEnd" ng-model="permitEnd" ng-maxlength="255" start-date="@{{permitOn}}" compare-with-start-date ng-required="company==='SSLogistics'"/>
                                </div>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.permitEnd.$touched && truckForm.permitEnd.$error.required">The Permit End is required.</span>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="(truckForm.permitOn.$touched || truckForm.permitEnd.$touched) && truckForm.permitEnd.$invalid">The End date must be greater than or equals to Start Date.</span>
                              </div>
                              
                              </div>

                              <div class="form-group has-feedback">
                                <label>Permit File</label>
                                <input type="file" class="form-control" id ="permitFile" ng-model="permitFile" file-model="permitFile"/>
                                <span ng-view='permitFileName' ng-cloak ng-bind='permitFileName'></span>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.permitFile.$touched && truckForm.permitFile.$error.required">The Permit File is required.</span>
                              </div>

                              <div class="row submit-button-holder">
                                <div class="col-xs-8"> </div>   
                                <div class="col-xs-12">
                                 <a class="btn btn-default btn-flat prvTab" href="">Previous</a>
                                 <a class="btn btn-primary nxtTab" ng-disabled="truckForm.permitNo.$invalid ||  truckForm.permitOn.$invalid || truckForm.permitEnd.$invalid" href="">Next</a>
                                </div>
                              </div>
                            </div>

                            <!-- Insurance Info -->
                            <div class="tab-pane" id="insurance" ng-show="company==='SSLogistics'">
                              <div class="form-group has-feedback">
                                <label>Policy Number</label>&nbsp;<span class="redAsterisk">*</span>
                                <input type="text" class="form-control upperCaseTransform" placeholder="Policy Number" name="policyNo" ng-model="policyNo" ng-maxlength="150" ng-required="company==='SSLogistics'"/>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.policyNo.$touched && truckForm.policyNo.$error.required">The Policy Number is required.</span>
                              </div>

                              <div class="row">
                              <div class="form-group has-feedback col-sm-6">
                                <div class="date truckDate taxEnd">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <label>Policy On</label>&nbsp;<span class="redAsterisk">*</span>
                                    <input type="text" class="form-control" placeholder="Policy On" name="policyOn" ng-model="policyOn" ng-maxlength="255" ng-required="company==='SSLogistics'"/>
                                </div>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.policyOn.$touched && truckForm.policyOn.$error.required">The Policy On is required.</span>
                              </div>

                              <div class="form-group has-feedback col-sm-6">
                                <div class="date truckDate taxEnd">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <label>Policy End</label>&nbsp;<span class="redAsterisk">*</span>
                                    <input type="text" class="form-control" placeholder="Policy End" name="policyEnd" ng-model="policyEnd" ng-maxlength="255" start-date="@{{policyOn}}" compare-with-start-date ng-required="company==='SSLogistics'"/>
                                </div>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.policyEnd.$touched && truckForm.policyEnd.$error.required">The Policy End is required.</span>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="(truckForm.policyOn.$touched || truckForm.policyEnd.$touched) && truckForm.policyEnd.$invalid">The End date must be greater than or equals to Start Date.</span>
                              </div>
                              </div>

                              <div class="form-group has-feedback">
                                <label>Policy File</label>
                                <input type="file" class="form-control" id ="insuranceFile" ng-model="insuranceFile" file-model="insuranceFile"/>
                                <span ng-view='insuranceFileName' ng-cloak ng-bind='insuranceFileName'></span>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.policyFile.$touched && truckForm.policyFile.$error.required">The Policy File is required.</span>
                              </div>

                              <div class="row submit-button-holder">
                                <div class="col-xs-8"> </div>   
                                <div class="col-xs-12">
                                 <a class="btn btn-default btn-flat prvTab" href="">Previous</a>
                                 <a class="btn btn-primary nxtTab" href="" ng-disabled="truckForm.policyNo.$invalid ||  truckForm.policyOn.$invalid || truckForm.policyEnd.$invalid">Next</a>
                                </div>
                              </div>
                            </div>

                            <!-- Tax Info -->
                            <div class="tab-pane" id="tax" ng-show="company==='SSLogistics'">
                              <div class="form-group has-feedback">
                                <label>Invoice Number</label>&nbsp;<span class="redAsterisk">*</span>
                                <input type="text" class="form-control upperCaseTransform" placeholder="Invoice Number" name="invoiceNo" ng-model="invoiceNo" ng-maxlength="150" ng-required="company==='SSLogistics'"/>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.invoiceNo.$touched && truckForm.invoiceNo.$error.required">The Invoice Number is required.</span>
                              </div>

                              <div class="row">
                              <div class="form-group has-feedback col-sm-6">
                                <div class="date truckDate taxEnd">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <label>Tax Paid Date</label>&nbsp;<span class="redAsterisk">*</span>
                                    <input type="text" class="form-control" placeholder="Tax Paid Date" name="taxPaidDate" ng-model="taxPaidDate" ng-maxlength="255" ng-required="company==='SSLogistics'"/>
                                </div>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.taxPaidDate.$touched && truckForm.taxPaidDate.$error.required">The Tax On is required.</span>
                              </div>

                              <div class="form-group has-feedback col-sm-6">
                                  <div class="date truckDate taxEnd">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <label>Tax Period End</label>&nbsp;<span class="redAsterisk">*</span>
                                    <input type="text" class="form-control" placeholder="Tax Period End" name="taxEnd" ng-model="taxEnd" ng-maxlength="255" start-date="@{{taxStart}}" compare-with-start-date ng-required="company==='SSLogistics'"/>
                                  </div>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.taxEnd.$touched && truckForm.taxEnd.$error.required">The Tax Period End is required.</span>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="(truckForm.taxPaidDate.$touched || truckForm.taxEnd.$touched) && truckForm.taxEnd.$invalid">The End date must be greater than or equals to Start Date.</span>
                              </div>
                              </div>

                              <div class="form-group has-feedback">
                                <label>Tax File</label>
                                <input type="file" class="form-control" id ="taxFile" ng-model="taxFile" file-model="taxFile"/>
                                <span ng-view='taxFileName' ng-cloak ng-bind='taxFileName'></span>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.taxFile.$touched && truckForm.taxFile.$error.required">The Tax File is required.</span>
                              </div>

                              <div class="row submit-button-holder">
                                <div class="col-xs-8"> </div>   
                                <div class="col-xs-12">
                                 <a class="btn btn-default btn-flat prvTab" href="" >Previous</a>
                                 <a class="btn btn-primary nxtTab" href="" ng-disabled="truckForm.invoiceNo.$invalid ||  truckForm.taxPaidDate.$invalid || truckForm.taxEnd.$invalid">Next</a>
                                </div>
                              </div>
                            </div>

                            <!-- Pollution Info -->
                            <div class="tab-pane" id="pollution" ng-show="company==='SSLogistics'">
                              <div class="form-group has-feedback">
                                <label>Pollution Number</label>&nbsp;<span class="redAsterisk">*</span>
                                <input type="text" class="form-control upperCaseTransform" placeholder="Pollution Number" name="pollutionNo" ng-model="pollutionNo" ng-maxlength="150" ng-required="company==='SSLogistics'"/>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.pollutionNo.$touched && truckForm.pollutionNo.$error.required">The Pollution Number is required.</span>
                              </div>

                              <div class="row">
                              <div class="form-group has-feedback col-sm-6">
                                <div class="date truckDate taxEnd">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <label>Pollution On</label>&nbsp;<span class="redAsterisk">*</span>
                                    <input type="text" class="form-control" placeholder="Pollution On" name="pollutionOn" ng-model="pollutionOn" ng-maxlength="255" ng-required="company==='SSLogistics'"/>
                                </div>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.pollutionOn.$touched && truckForm.pollutionOn.$error.required">The Pollution On is required.</span>
                              </div>

                              <div class="form-group has-feedback col-sm-6">
                                  <div class="date truckDate pollutionEnd">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <label>Pollution End</label>&nbsp;<span class="redAsterisk">*</span>
                                    <input type="text" class="form-control" placeholder="Pollution End" name="pollutionEnd" ng-model="pollutionEnd" ng-maxlength="255" start-date="@{{pollutionOn}}" compare-with-start-date ng-required="company==='SSLogistics'"/>
                                  </div>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.pollutionEnd.$touched && truckForm.pollutionEnd.$error.required">The Pollution End is required.</span>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="(truckForm.pollutionOn.$touched || truckForm.pollutionEnd.$touched) && truckForm.pollutionEnd.$invalid">The End date must be greater than or equals to Start Date.</span>
                              </div>
                              </div>

                              <div class="form-group has-feedback">
                                <label>Pollution File</label>
                                <input type="file" class="form-control" id ="pollutionFile" ng-model="pollutionFile" file-model="pollutionFile"/>
                                <span ng-view='pollutionFileName' ng-cloak ng-bind='pollutionFileName'></span>
                                <span class="invalidInputErrorClass" ng-cloak ng-show="truckForm.pollutionFile.$touched && truckForm.pollutionFile.$error.required">The Pollution File is required.</span>
                              </div>


                              <div class="row submit-button-holder">
                                <div class="col-xs-8"> </div>   
                                <div class="col-xs-12">
                                 <a class="btn btn-default btn-flat prvTab" href="">Previous</a>
                                 <button type="submit" ng-disabled="truckForm.$invalid" class="btn btn-primary">Submit</button>
                                </div>
                              </div>
                            </div>
                            <!-- /.tab-pane -->
                            <hr/>
                            
                          
                        </form> 
                      </div> 
                    </div><!-- /.box-body -->

                  </section><!-- /.content -->
                  
                </div>
              </div>
              <div class="modal-footer align_center">

              </div>
            </div>
          </div>
        </div>
        <!-- modal for truck add-->



        <!-- modal for address zone add-->  
        <div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <label>Add Address</label>
                <button type="button" class="close closeModal addressCloseModal" data-dismiss="modal" aria-label="Close"><img src="{{asset('images/blue_cross.png')}}" alt="Close"/></button>
              </div>
              <div class="modal-body" style="padding-top:0;">
                <div class="modal_select">
                  
                    <section class="content">
                      <!-- Default box -->
                      
                       <div class="flash-message" ng-hide="msgDisplay">
                          @include('common.flash_message') 
                          <span ng-view='addressZoneSuccess' ng-cloak ng-bind='addressZoneSuccess' class="alert alert-success" ng-show="addressZoneSuccess"></span>
                          <span ng-view='addressZoneDanger' ng-cloak ng-bind='addressZoneDanger' class="alert alert-danger" ng-show="addressZoneDanger"></span>
                       </div>
                        
                        <div class="box-header with-border">
                          <h3 class="box-title">Add address</h3>
                          
                        </div>
                        <div class="box-body">
                          <form ng-submit="saveTripAddress();" id="addressZoneForm" name="addressZoneForm">
                             {{csrf_field()}}
                            
                            <div class="form-group has-feedback">
                              <label>Title</label>
                              <input type="text" class="form-control" placeholder="Title" name="title" ng-model="title" ng-maxlength="255" required/>
                              <span class="invalidInputErrorClass" ng-cloak ng-show="addressZoneForm.title.$touched && addressZoneForm.title.$error.required">The Title is required.</span>
                            </div> 
                            
                            <div class="form-group has-feedback">
                              <label>Address</label>
                              <input type="text" class="form-control" placeholder="Address" name="addressZoneAddress" ng-model="addressZoneAddress" id="addressZoneAddress" ng-maxlength="255" required/>
                              <span class="invalidInputErrorClass" ng-cloak ng-show="addressZoneForm.addressZoneAddress.$touched && addressZoneForm.addressZoneAddress.$error.required">The Address is required.</span>
                            </div>

                            <input type="hidden" name="latitude" id="latitude" ng-model="latitude">
                            <input type="hidden" name="longitude" id="longitude" ng-model="longitude">     

                            <div class="row submit-button-holder">
                              <div class="col-xs-8">    
                                                      
                              </div><!-- /.col -->
                              <div class="col-xs-12">
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


    </div>


      <!-- /.content -->

@endsection



@section('scripts')
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdrU0RpAT5Y2hYKkf6TJUmmknh1YoV0bg&libraries=places&callback=initialize" async defer></script>

 
  <script type="text/javascript">

    /*for auto suggest location*/
    function initialize() {

        /*for plant*/
        // var inputPlant = document.getElementById('addressZoneAddressPlant');  
        // var autocompletePlant = new google.maps.places.Autocomplete(input);


        /*for party*/
        // var inputParty = document.getElementById('addressZoneAddressParty');  
        // var autocompleteParty = new google.maps.places.Autocomplete(inputParty);


        /*for petrol pump*/
        // var inputPetrolPump = document.getElementById('addressZoneAddressPetrolPump');  
        // var autocompletePetrolPump = new google.maps.places.Autocomplete(inputPetrolPump);

        /*for address zone*/
        var inputAddressZone = document.getElementById('addressZoneAddress');  
        var autocomplete     = new google.maps.places.Autocomplete(inputAddressZone);

        /*for plant*/
        // autocompletePlant.addListener('place_changed', function() {
        //   var place = autocompletePlant.getPlace(); 
        //   var placeValue = $('#addressZoneAddressPlant').val();  
        //   var scope = angular.element(document.getElementById("addressZoneAddressPlant")).scope();
        //   scope.addressZoneAddressPlant = placeValue;
        // });


        /*for party*/
        // autocompleteParty.addListener('place_changed', function() {
        //   var place = autocompleteParty.getPlace(); 
        //   var placeValue = $('#addressZoneAddressParty').val();  
        //   var scope = angular.element(document.getElementById("addressZoneAddressParty")).scope();
        //   scope.addressZoneAddressParty = placeValue;
        // });


        /*for petrol pump*/
        // autocompletePetrolPump.addListener('place_changed', function() {
        //   var place = autocompletePetrolPump.getPlace(); 
        //   var placeValue = $('#addressZoneAddressPetrolPump').val();  
        //   var scope = angular.element(document.getElementById("addressZoneAddressPetrolPump")).scope();
        //   scope.addressZoneAddressPetrolPump = placeValue;
        // });


        /*for address zone*/
        autocomplete.addListener('place_changed', function() {
          var place = autocomplete.getPlace(); 
          var placeValue = $('#addressZoneAddress').val();  
          var scope = angular.element(document.getElementById("addressZoneAddress")).scope();
          scope.addressZoneAddress = placeValue;
        });
    }


    $('.multiSelectDropdown .multiselect-parent').addClass('test');

    var date      = new Date();
    var today     = new Date(date.getFullYear(), date.getMonth(), date.getDate()); /*get today*/

    $.fn.datepicker.defaults.format     = "dd-mm-yyyy";


    /*setting trip date 1 day prior to current date*/
    //$.fn.datepicker.defaults.startDate  = "-1d";
    //$.fn.datepicker.defaults.endDate    = "+1d";


    /*set dates in trip datepicker*/
    $('.tripDates').datepicker();
    $('.tripDates').datepicker('setDate', today);
    
    $('.tripDates').datepicker('setEndDate', '+1d');

    /*changing the back date as per user role*/
    if ($('#currentUserRole').val() == $('#supervisorRoleId').val()) {
      $('.tripDates').datepicker('setStartDate', '-1d');
    } else {
      $('.tripDates').datepicker('setStartDate', '-7d');
    }

    /*set dates in truck datepicker*/
    $('.truckDate').datepicker();
    $('.truckDate').datepicker('setDate', today);
    $('.truckDate').datepicker('setStartDate', '-19y');
    $('.truckDate').datepicker('setEndDate', '+19y');
    

    /*next button functionality for truck modal*/
    $('.nxtTab').click(function(){
      var current = $('.nav-tabs li.active');
      current.next('li').click();
      current.removeClass('active');
      current.next('li').addClass('active');
      var target = $('.nav-tabs li.active a').attr('rel');
      $('.tab-pane').removeClass('active');
      $(target).addClass('active');
    });



    /*previous button functionality for truck modal*/
    $('.prvTab').click(function(){
      var current = $('.nav-tabs li.active');
      current.prev('li').click();
      current.removeClass('active');
      current.prev('li').addClass('active');
      var target = $('.nav-tabs li.active a').attr('rel');
      $('.tab-pane').removeClass('active');
      $(target).addClass('active');
    });


  </script>
  <script src="{{ asset('/angularJs/angularModules/trips/tripApp.js') }}"></script>
@endsection

