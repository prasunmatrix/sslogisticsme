'use strict';

/*****************************************************/
  // CustomerReports Controller             
  // Function name : CustomerReportsController
  // Functionality: customer report list
  // Author : Sanchari Ghosh                                 
  // Created Date : 01/04/2019                                        
  // Purpose:  Developing the functionalities of customerReports
/*****************************************************/

function CustomerReportsController($rootScope, $scope, $http, $window, $q, $location, $timeout, VendorsService) {

  $scope.titleChange = '<h1>Customer Report</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.moduleName  = 'customerReport';

   /*****************************************************/
    // Function name : getCustomerReport
    // Functionality: to get the customer report
    // Author : Sanchari Ghosh                               
    // Created Date : 01/04/2019                                          
    // Purpose:  Developing the functionality of listing customerReports with the help of VendorsService
  /*****************************************************/
  $scope.getCustomerReport = function(currentPage,orderby,ordertype,challanStatus,pendingPeriod,company,datefilter,dateRangeValue) {  

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
    
    var vendorData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&challanStatus="+challanStatus+"&pendingPeriod="+pendingPeriod+"&company="+company+"&dateRangeValue="+dateRangeValue; 
    VendorsService.makeAsyncCall(VendorsService.getCustomerReport(vendorData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.customerReportList;
        $scope.total = response.data.totalCustomerReports;
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
     $('#company').find('option:eq(0)').prop('selected', true);
     $scope.dateRangeValue = '';
     $('.daterangepicker').find('.cancelBtn').click();
    }, 100);
  }


  
  /*****************************************************/
    // Function name : getCustomerVendorList
    // Functionality: Getting vendor list 
    // Author : Sanchari Ghosh                               
    // Created Date : 02/04/2019                                          
    // Purpose:  Developing the functionality of getting lists of vendors  with the help of VendorsService
  /*****************************************************/
  $scope.getCustomerVendorList = function(){
    VendorsService.makeAsyncCall(VendorsService.activeVendorList())
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
