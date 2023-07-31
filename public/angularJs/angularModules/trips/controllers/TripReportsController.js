'use strict';

/*****************************************************/
  // TripReportsController Controller             
  // Function name : TripReportsController
  // Functionality: Report for trips
  // Author : Sanchari Ghosh                                 
  // Created Date : 18/03/2019                                        
  // Purpose:  Developing the functionalities of trip reports
/*****************************************************/

function TripReportsController($rootScope, $scope, $http, $window, $q, $location, $timeout, TripsService, fileUploadService) {

  $scope.titleChange = '<h1>Trip Report</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.viewPdf     =  0;


  /*****************************************************/
    // Function name : getTripReport
    // Functionality: to get the trip report
    // Author : Sanchari Ghosh                               
    // Created Date : 18/03/2019                                          
    // Purpose:  Developing the functionality of getting the trip report with the help of TripsService
  /*****************************************************/
  $scope.getTripReport = function(currentPage,orderby,ordertype,tripStatus,timePeriod,company,datefilter,dateRangeValue) {  

    window.scrollTo(0, 0);
    
    $scope.changedOrderType = (ordertype == 'asc')?'desc':'asc';     

    if(orderby){
      $rootScope.paginationControl.orderby = orderby; 
    }

    if(ordertype){
      $rootScope.paginationControl.ordertype = ordertype; 
    }

    if(currentPage){
      $rootScope.paginationControl.currentPage = currentPage; 
    }


    /*it will work in case of editing page*/
    if(localStorage.getItem('currentPageNo') !== null) {
      $rootScope.paginationControl.currentPage = localStorage.getItem('currentPageNo');
    }
    
    var tripData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&tripStatus="+tripStatus+"&timePeriod="+timePeriod+"&company="+company+"&dateRangeValue="+dateRangeValue; 


    TripsService.makeAsyncCall(TripsService.getTripReport(tripData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.tripReportRecords                  = response.data.tripReportList;
        $scope.total                              = response.data.totalTripReports;
        $rootScope.paginationControl.currentPage  = response.data.currentPage;  
      } else {  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    }); 
  }

  /*****************************************************/
    // Function name : clearData
    // Functionality: clear data from input field
    // Author : Sanchari Ghosh                               
    // Created Date : 02/04/2019                                          
    // Purpose:  Developing the functionality of clearing data from input field
  /*****************************************************/
  $scope.clearData = function(){
    angular.element("select").val('');
    angular.element("input").val('');
    
    $timeout(function () { 
     $('#company').find('option:eq(0)').prop('selected', true);
     $scope.dateRangeValue = '';
     $('.daterangepicker').find('.cancelBtn').click();
    }, 500);
  }



  
  /*****************************************************/
    // Function name : getTripVendorList
    // Functionality: Getting vendor list 
    // Author : Sanchari Ghosh                               
    // Created Date : 19/03/2019                                          
    // Purpose:  Developing the functionality of getting lists of vendors  with the help of TripsService
  /*****************************************************/
  $scope.getTripVendorList = function(){
    TripsService.makeAsyncCall(TripsService.getTripVendorList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.vendorRecords = response.data.vendorList;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
    }
}