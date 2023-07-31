'use strict';

/*****************************************************/
  // PDFTripsController Controller             
  // Function name : PDFTripsController
  // Functionality: Download PDF for specific trips
  // Author : Sanchari Ghosh                                 
  // Created Date : 26/09/2018                                        
  // Purpose:  Developing the functionalities of downloading PDF for specific trips
/*****************************************************/

function PDFTripsController($rootScope, $scope, $http, $window, $q, $location, $timeout, TripsService, fileUploadService) {

  $scope.titleChange = '<h1>PDF Trip</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.viewPdf     =  0;


  /*****************************************************/
    // Function name : getPDFPlantList
    // Functionality: Getting Plant List
    // Author : Sanchari Ghosh                               
    // Created Date : 26/09/2018                                          
    // Purpose:  Developing the functionality of listing plants with the help of TripsService
  /*****************************************************/
  $scope.getPDFPlantList = function() {  
    TripsService.makeAsyncCall(TripsService.getTripPlantList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.plantRecords = response.data.plantList;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }





  /*****************************************************/
    // Function name : viewPlantTripList
    // Functionality: Getting Plant Trip List
    // Author : Sanchari Ghosh                               
    // Created Date : 26/09/2018                                          
    // Purpose:  Developing the functionality of listing trips with respect to plants with the help of TripsService
  /*****************************************************/
  $scope.viewPlantTripList = function(keyname) {  
    var data = "plantId=" + keyname;
    TripsService.makeAsyncCall(TripsService.getPlantTripList(data))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.tripRecords = response.data.tripList;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : setTripData
    // Functionality: Set pdf trip data
    // Author : Sanchari Ghosh                               
    // Created Date : 26/09/2018                                          
    // Purpose:  Developing the functionality of setting pdf trip data
  /*****************************************************/
  $scope.setTripData = function(tripId) {

    var tripData = "tripId=" + tripId;

    TripsService.makeAsyncCall(TripsService.getTripDetail(tripData))
    .then(function(response){
      if(response.data.success == "true"){

        $scope.trip_no        = 'SSLT000'+response.data.tripDetails.id;
        //$scope.no_of_bags     = response.data.tripDetails.bags;
        $scope.no_of_bags     = response.data.tripDetails.quantity*20;
        $scope.record         = response.data.tripDetails;
        $scope.advanceWords   = $rootScope.inWords(response.data.tripDetails.advance_amount);
        $scope.subCatName     = response.data.subCatDetails;
        $scope.tripPayment    = response.data.tripPayment;
      } else {  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }




  /*****************************************************/
    // Function name : viewPDF
    // Functionality: make pdf visible after the data is filled up
    // Author : Sanchari Ghosh                               
    // Created Date : 26/09/2018                                          
    // Purpose:  Developing the functionality of making pdf visible after the data is filled up
  /*****************************************************/
  $scope.viewPDF = function(tripId) {
    $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
    $scope.viewPdf      = 1;
  }



  /*****************************************************/
    // Function name : getPlantWiseActiveTruckList
    // Functionality: get plant wise active truck list
    // Author : Sanchari Ghosh                               
    // Created Date : 15/05/2019                                          
    // Purpose:  Developing the functionality of getting plant wise active truck list with the help of TripsService
  /*****************************************************/
  $scope.getPlantWiseActiveTruckList = function(plantId) {
    var plantData = "plantId=" + plantId;

    TripsService.makeAsyncCall(TripsService.getPlantWiseActiveTruckList(plantData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.truckRecords = response.data.truckList;
      } else {  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }


  /*****************************************************/
    // Function name : getTruckWiseTripList
    // Functionality: get truck wise trip list
    // Author : Sanchari Ghosh                               
    // Created Date : 15/05/2019                                          
    // Purpose:  Developing the functionality of getting truck wise trip list with the help of TripsService
  /*****************************************************/
  $scope.getTruckWiseTripList = function(truckId) {
    var startDate = '';
    var endDate = '';

    if($scope.startDate != 'undefined') {
      startDate = $scope.startDate;
    }
    if($scope.endDate != 'undefined') {
      endDate = $scope.endDate;
    }

    var truckData = "truckId=" + truckId + "&start_date=" + startDate + "&end_date=" + endDate;

    TripsService.makeAsyncCall(TripsService.getTruckWiseTripList(truckData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.tripRecords = response.data.tripList;
      } else {  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }


  
  /*****************************************************/
    // Function name : domPDF
    // Functionality: generate pdf using dom pdf
    // Author : Sanchari Ghosh                               
    // Created Date : 03/05/2019                                          
    // Purpose:  Developing the functionality of generating pdf using dom pdf
  /*****************************************************/
  $scope.domPDF = function(selectPlant) {
    var htmlData ='plantId='+selectPlant+'&originalHtmlData='+$('#originalPDF').html()+'&duplicateHtmlData='+$('#duplicatePDF').html();
    TripsService.makeAsyncCall(TripsService.domPDF(htmlData))
    .then(function(response){
      if(response.data.success == "true"){
        console.log(response);
      } else {  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }




  /*****************************************************/
    // Function name : tcpdf
    // Functionality: generate pdf using tcpdf
    // Author : Sanchari Ghosh                               
    // Created Date : 03/06/2019                                          
    // Purpose:  Developing the functionality of generating pdf using tcpdf
  /*****************************************************/
  $scope.tcpdf = function(tripId) {
    $("#loderMainDiv").show();
    var pdfName = Math.floor((Math.random() * 100000) + 1)+'.pdf';
    var tripData = "tripId=" + tripId + "&fileName=" + pdfName;    

    TripsService.makeAsyncCall(TripsService.tcpdf(tripData))
    .then(function(response){ 
      
      if(response.data.indexOf("TCPDF ERROR") == -1){ /*if no error found*/

        /*opening the pdf*/
        window.open("/pdftrip/"+pdfName,'popUpWindow','height=500,width=500,left=30,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes'); 
        $("#loderMainDiv").hide("slow");
      } else {  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }


}