'use strict';

/*****************************************************/
  // ConsolidatedTripsController Controller             
  // Function name : ConsolidatedTripsController
  // Functionality: Consolidated view of Trip
  // Author : Sanchari Ghosh                                 
  // Created Date : 10/09/2018                                        
  // Purpose:  Developing the functionalities of Consolidated view of Trip
/*****************************************************/

function ConsolidatedTripsController($rootScope, $scope, $http, $window, $q, $location, $timeout, TripsService, fileUploadService) {

  $scope.titleChange = '<h1>Consolidated Trip</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.availableTags    = [];


  /*****************************************************/
    // Function name : getConsolidatedTripPlantList
    // Functionality: Getting Plant List
    // Author : Sanchari Ghosh                               
    // Created Date : 10/09/2018                                          
    // Purpose:  Developing the functionality of listing plants with the help of TripsService
  /*****************************************************/
  $scope.getConsolidatedTripPlantList = function() {  
    TripsService.makeAsyncCall(TripsService.getTripPlantList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.plantRecords = response.data.plantList;
        $scope.years = response.data.yearList
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }





  /*****************************************************/
    // Function name : searchTrip
    // Functionality: Search Trip List on the basis of condition
    // Author : Sanchari Ghosh                               
    // Created Date : 10/09/2018                                          
    // Purpose:  Developing the functionality of listing trips with the help of TripsService
  /*****************************************************/
  $scope.searchTrip = function() {
    var startDate = '';
    var endDate = '';

    if($scope.startDate != 'undefined') {
      startDate = $scope.startDate;
    }
    if($scope.endDate != 'undefined') {
      endDate = $scope.endDate;
    }

    //var tripData = "truck_id=" + $scope.selectTruck + "&year=" + $scope.selectYear + "&currentPage=" + currentPage + "&perPageRecord=" + $scope.perPageRecord+"&orderby="+$scope.orderby+"&ordertype="+ordertype; 
    var tripData = "vendor_id=" + $scope.selectCompany + "&start_date=" + startDate + "&end_date=" + endDate; 

    TripsService.makeAsyncCall(TripsService.searchTrip(tripData))
    .then(function(response){
      if(response.data.success == "true"){
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        $scope.plantName    = response.data.plantName;
        $scope.records      = response.data.tripDetails;
        $scope.recordCount  = 1;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }


   /*****************************************************/
    // Function name : saveTripPayment
    // Functionality: Save Trip Payemnts (Freight, Toll, Unloading, Tare)
    // Author : Sanchari Ghosh                               
    // Created Date : 11/09/2018                                          
    // Purpose:  Developing the functionality of saving Trip Payemnts
  /*****************************************************/
  $scope.saveTripPayment = function(tripId,freightCharge,toll,unloadingCharge,tareCharge,quantity,rate, advance, diesel,shortBagAmount,indexValue) {
   var shortbg = 0;
   if (shortBagAmount == null) {
      shortbg = 0;
   } else {
      shortbg = shortBagAmount;
   }

    var tripData = "trip_id=" + tripId + "&freight_charge=" + freightCharge + "&toll=" + toll + '&unloading_charge=' + unloadingCharge + '&tare_charge=' + tareCharge + '&qty=' + quantity + '&adv=' + advance + '&dsl=' + diesel + '&rate=' + rate + '&short_bag_amount=' + shortbg;
    
    TripsService.makeAsyncCall(TripsService.saveTripPayment(tripData))
    .then(function(response){
      if(response.data.success == "true"){
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        
        /*showing value of balance and freight in listing page*/
        document.getElementById('balance_'+indexValue).innerHTML = response.data.balance;
        document.getElementById('freight_'+indexValue).innerHTML = response.data.freight_charge;
       
        if (response.data.countData > 0) {
          $rootScope.success = 'Trip Payment Edited Succesfully';
        } else {
          $rootScope.success = 'Trip Payment Added Succesfully';
        }
        $scope.searchTrip(); /*retrieve the data again*/
        $rootScope.msgShow();
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }




  /*****************************************************/
    // Function name : getConsolidatedTripTruckList
    // Functionality: Getting Truck List
    // Author : Sanchari Ghosh                               
    // Created Date : 10/10/2018                                          
    // Purpose:  Developing the functionality of listing trucks with the help of TripsService
  /*****************************************************/
  $scope.getConsolidatedTripTruckList = function() {  
    TripsService.makeAsyncCall(TripsService.getTripTruckList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.truckRecords = response.data.truckList;
        $scope.years = response.data.yearList
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : getConsolidatedTripVendorList
    // Functionality: Getting Vendor List
    // Author : Sanchari Ghosh                               
    // Created Date : 12/03/2019                                          
    // Purpose:  Developing the functionality of listing vendors with the help of TripsService
  /*****************************************************/
  $scope.getConsolidatedTripVendorList = function() {  
    TripsService.makeAsyncCall(TripsService.getTripVendorList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.vendorRecords = response.data.vendorList;

        /*storing data in array for developing auto suggestion*/
        angular.forEach($scope.vendorRecords,function(vendor){
            $scope.availableTags.push(vendor.name); 
        });
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
      // Function name : complete
      // Functionality: for auto suggested list
      // Author : Sanchari Ghosh                               
      // Created Date : 10/09/2019                                          
      // Purpose:  Developing the functionality of getting auto suggested list
  /*****************************************************/
  $scope.complete=function(string){
    var output=[];

    if (string.length >=1) {
      angular.forEach($scope.availableTags,function(vendor){
        if(vendor.toLowerCase().indexOf(string.toLowerCase())>=0){
          output.push(vendor);
        } else {
          if (output.includes('No Records')){

          } else {
            output.push('No Records');
          }
        }
      });
      var index = output.indexOf('No Records');
      if (index > -1 && output.length > 1) {
        output.splice(index, 1);
      }
      $scope.filterVENDOR = output;
    } else {
      $scope.filterVENDOR = '';
    }
    
  }


  /*****************************************************/
    // Function name : fillTextbox
    // Functionality: for filling textbox with auto suggested list
    // Author : Sanchari Ghosh                               
    // Created Date : 10/09/2019                                          
    // Purpose:  Developing the functionality for filling textbox with auto suggested list
  /*****************************************************/
  $scope.fillTextbox  = function(string){
      $scope.selectCompany = string;
      $scope.filterVENDOR  = null;
  }



  /*****************************************************/
    // Function name : clearAutoFillContainer
    // Functionality: for clearing with auto suggested list
    // Author : Sanchari Ghosh                               
    // Created Date : 12/09/2019                                          
    // Purpose:  Developing the functionality for clearing auto suggested list
  /*****************************************************/
  $scope.clearAutoFillContainer = function(){
    $scope.filterVENDOR  = null;
  }

  /*****************************************************/
    // Function name : generateBill
    // Functionality: save trip's bill details in database
    // Author : Sanchari Ghosh                               
    // Created Date : 12/03/2019                                          
    // Purpose:  Developing the functionality of saving trip's bill details in database with the help of TripsService
  /*****************************************************/
  $scope.generateBill = function() { 
    $scope.msgDisplay = false;  
    var tds = '';
    /*count the number of trips for generating bill*/
    var tripCount = $("#tripChckBoxContainer input[name='tripChckBox[]']:checked").length;

    if ($scope.billNo === '' || $scope.billNo === undefined){
      $rootScope.danger = 'Please provide Bill Number';  
      $rootScope.msgShow();    
    } else if(tripCount == 0){
      $rootScope.danger = 'Please select a trip';  
      $rootScope.msgShow(); 
    } else {
      var tripIds = [];
      $.each($("input[name='tripChckBox[]']:checked"), function(){            
          tripIds.push($(this).val());
      });

      if ($scope.challanExps === '' || $scope.challanExps === undefined){
        $scope.challanExps = '';    
      } 

      if ($scope.tds === '' || $scope.tds === undefined || $scope.tds === 'undefined'){
        tds = '';  
      } else {
        tds = $scope.tds;
      }
     
      var tripData = "tripIds=" + tripIds + "&bill_no=" + $scope.billNo + "&challan_exps=" + $scope.challanExps + '&tds=' + tds + '&vendor=' + $scope.selectCompany ;
      
      TripsService.makeAsyncCall(TripsService.generateBill(tripData))
        .then(function(response){
          if(response.data.success == "true"){
           $rootScope.success = 'Bill Number  "'+response.data.billNo+'"  generated Successfully';  
           $scope.searchTrip(); /*retrieve the data list again*/
           $scope.clear();
 
            $timeout(function () { 
              $rootScope.success = '';
              $rootScope.danger = '';
              $scope.msgDisplay = true;  
            }, 5000);

          }else{  
            var msg = response.data.msg; 
            $rootScope.danger = msg;    
            $rootScope.msgShow();    
          }
            },function(reason){}).finally(function(data){

        });
    }
  }



  /*****************************************************/
    // Function name : clear
    // Functionality: clear the element after form is being submitted
    // Author : Sanchari Ghosh                               
    // Created Date : 18/06/2019                                          
    // Purpose:  Developing the functionality of clearing the element after form is being submitted
  /*****************************************************/
  $scope.clear = function () {
     $scope.billNo = '';
     $scope.challanExps = '';
     $scope.tds = '';
  };

}