'use strict';

/*****************************************************/
  // VendorReports Controller             
  // Function name : VendorReportsController
  // Functionality: vendor report list
  // Author : Sanchari Ghosh                                 
  // Created Date : 02/04/2019                                        
  // Purpose:  Developing the functionalities of vendorReports
/*****************************************************/

function VendorReportsController($rootScope, $scope, $http, $window, $q, $location, $timeout, VendorsService) {

  $scope.titleChange = '<h1>Vendor Report</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.moduleName  = 'vendorReport';

   /*****************************************************/
    // Function name : getVendorReport
    // Functionality: to get the customer report
    // Author : Sanchari Ghosh                               
    // Created Date : 02/04/2019                                          
    // Purpose:  Developing the functionality of listing vendorReports with the help of VendorsService
  /*****************************************************/
  $scope.getVendorReport = function(currentPage,orderby,ordertype,challanStatus,pendingPeriod,plant,datefilter,dateRangeValue) {  

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


    if(localStorage.getItem('currentPageNo') !== null) {
      if(localStorage.getItem('currentModule') == $scope.moduleName) {
        $rootScope.paginationControl.currentPage = localStorage.getItem('currentPageNo');
      }
    }

    
    var vendorData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&challanStatus="+challanStatus+"&pendingPeriod="+pendingPeriod+"&plant="+plant+"&dateRangeValue="+dateRangeValue; 
    VendorsService.makeAsyncCall(VendorsService.getVendorReport(vendorData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.vendorReportList;
        $scope.total = response.data.totalVendorReports;
        $rootScope.paginationControl.currentPage  = response.data.currentPage;  
      } else {  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
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
     $('#plant').find('option:eq(0)').prop('selected', true);
     $scope.dateRangeValue = '';
     $('.daterangepicker').find('.cancelBtn').click();
    }, 100);
  }


  

  /*****************************************************/
    // Function name : getVendorReportPlantList
    // Functionality: Getting plant list 
    // Author : Sanchari Ghosh                               
    // Created Date : 02/04/2019                                          
    // Purpose:  Developing the functionality of getting lists of plants  with the help of VendorsService
  /*****************************************************/
  $scope.getVendorReportPlantList = function(){
    VendorsService.makeAsyncCall(VendorsService.activePlantList())
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
 



}
