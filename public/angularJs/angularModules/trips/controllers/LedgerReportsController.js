'use strict';

/*****************************************************/
  // LedgerReports Controller             
  // Function name : LedgerReportsController
  // Functionality: ledger report list
  // Author : Sanchari Ghosh                                 
  // Created Date : 04/07/2019                                        
  // Purpose:  Developing the functionalities of ledgerReports
/*****************************************************/

function LedgerReportsController($rootScope, $scope, $http, $window, $q, $location, $timeout, TripsService) {

  $scope.titleChange = '<h1>Ledger Report</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.moduleName  = 'ledger';
  $scope.availableTags    = [];

   /*****************************************************/
    // Function name : getLedgerReport
    // Functionality: to get the ledger report
    // Author : Sanchari Ghosh                               
    // Created Date : 04/07/2019                                          
    // Purpose:  Developing the functionality of listing ledgerReports with the help of TripsService
  /*****************************************************/
  $scope.getLedgerReport = function(currentPage,orderby,ordertype,company,hiddenReport) {  
    
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

    
    var ledgerData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&company="+company; 
    TripsService.makeAsyncCall(TripsService.getLedgerReport(ledgerData))
    .then(function(response){ console.log(response);
      if(response.data.success == "true"){
        $scope.records = response.data.ledgerReportList;
        $scope.total = response.data.totalLedgerReports;
        $rootScope.paginationControl.currentPage  = response.data.currentPage; 

        if(response.data.ledgerReportList.length > 0){
          $scope.carryForwardBalance = response.data.ledgerReportList[0].carryForwardBalance;
        } else {
          $scope.carryForwardBalance = 0;
        }
        

        /*show / hide container */
        if (hiddenReport == '' || hiddenReport == undefined) {
          $scope.recordCount = 0; /*hiding main container*/
        } else {
          $scope.recordCount = 1; /*showing main container when plant filter is selected*/
        } 
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
    // Created Date : 04/07/2019                                          
    // Purpose:  Developing the functionality of clearing data from input field
  /*****************************************************/
  $scope.clearData = function(){
    angular.element("select").val('');
    angular.element("input").val('');
    
    
    $timeout(function () { 
     $('#company').find('option:eq(0)').prop('selected', true);
     $scope.tds = '';
    }, 100);
  }


  

  /*****************************************************/
    // Function name : getVendorList
    // Functionality: Getting vendor list 
    // Author : Sanchari Ghosh                               
    // Created Date : 04/07/2019                                          
    // Purpose:  Developing the functionality of getting lists of vendors  with the help of TripsService
  /*****************************************************/
  $scope.getVendorList = function(){
    TripsService.makeAsyncCall(TripsService.getTripVendorList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.vendorRecords = response.data.customizedVendorList;

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
    // Function name : billDetailsPopup
    // Functionality: Get Bill Details
    // Author : Sanchari Ghosh                               
    // Created Date : 09/09/2019                                          
    // Purpose:  Developing the functionality of getting bill details with the help of TripsService
  /*****************************************************/
  $scope.billDetailsPopup = function(keyname){
    var billData = 'billNo='+keyname;
     TripsService.makeAsyncCall(TripsService.getBillDetails(billData))
    .then(function(response){ 
          if(response.data.success == "true"){
            $scope.recordBill = response.data.billList.trip_bill_records[0];
            $scope.recordPay  = response.data.billList.trip_pay_records;
            console.log($scope.recordBill);
            console.log($scope.recordPay);
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
      // Created Date : 11/09/2019                                          
      // Purpose:  Developing the functionality of getting auto suggested list
  /*****************************************************/
  $scope.complete=function(string){
    var output=[];

    if (string.length >= 1) {
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
    // Created Date : 11/09/2019                                          
    // Purpose:  Developing the functionality for filling textbox with auto suggested list
  /*****************************************************/
  $scope.fillTextbox  = function(string){
      $scope.company = string;
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
}
