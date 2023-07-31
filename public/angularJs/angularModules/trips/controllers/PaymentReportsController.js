'use strict';

/*****************************************************/
  // PaymentReports Controller             
  // Function name : PaymentReportsController
  // Functionality: payment report list
  // Author : Sanchari Ghosh                                 
  // Created Date : 03/04/2019                                        
  // Purpose:  Developing the functionalities of paymentReports
/*****************************************************/

function PaymentReportsController($rootScope, $scope, $http, $window, $q, $location, $timeout, TripsService) {

  $scope.titleChange = '<h1>Payment Report</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';

   /*****************************************************/
    // Function name : getPaymentReport
    // Functionality: to get the payment report
    // Author : Sanchari Ghosh                               
    // Created Date : 03/04/2019                                          
    // Purpose:  Developing the functionality of listing paymentReports with the help of TripsService
  /*****************************************************/
  $scope.getPaymentReport = function(currentPage,orderby,ordertype,company,hiddenReport,challanExps,tds) {  
    
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

    
    var paymentData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&company="+company; 
    TripsService.makeAsyncCall(TripsService.getPaymentReport(paymentData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.paymentReportList;
        $scope.total = response.data.totalPaymentReports;
        $rootScope.paginationControl.currentPage  = response.data.currentPage;  

        $timeout(function () { 
          if ((tds === '') || (tds === undefined || tds === '0')) {
            $('#tds').find('option[value="0"]').prop('selected', true);
          }
          $scope.calculatePaymentReportBalance(challanExps,tds,response.data.totalBalance);
        }, 100);
        
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
    // Created Date : 03/04/2019                                          
    // Purpose:  Developing the functionality of clearing data from input field
  /*****************************************************/
  $scope.clearData = function(){
    angular.element("select").val('');
    angular.element("input").val('');
    
    $scope.challanExps = '';
    
    $timeout(function () { 
     $('#company').find('option:eq(0)').prop('selected', true);
     $('#tds').find('option[value="0"]').prop('selected', true);
     $scope.tds = '';
    }, 100);
  }


  

  /*****************************************************/
    // Function name : getPaymentVendorList
    // Functionality: Getting vendor list 
    // Author : Sanchari Ghosh                               
    // Created Date : 03/04/2019                                          
    // Purpose:  Developing the functionality of getting lists of vendors  with the help of TripsService
  /*****************************************************/
  $scope.getPaymentVendorList = function(){
    TripsService.makeAsyncCall(TripsService.getTripVendorList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.vendorRecords = response.data.customizedVendorList;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
    }

  

  /*****************************************************/
    // Function name : calculatePaymentReportBalance
    // Functionality: calculate PaymentReportBalance on the basis of challan and tds
    // Author : Sanchari Ghosh                               
    // Created Date : 15/05/2019                                          
    // Purpose:  Developing the functionality of calculating PaymentReportBalance on the basis of challan and tds
  /*****************************************************/
  $scope.calculatePaymentReportBalance  = function(challanExps,tds,totalBalance){
    var newChallanExps = 0;
    var newTDS = 0;

    if ((challanExps === '') || (challanExps === undefined)) {
      newChallanExps = 0;
    } else {
      newChallanExps = challanExps;
    }

    if ((tds === '') || (tds === undefined)) {
      newTDS = 0;
    } else {
      newTDS = tds;
    }

    /*calculating the new balance after deduction of challan and tds*/
    var balanceAfterDeduction = parseInt(totalBalance) - (parseInt(newChallanExps) + ((parseInt(totalBalance)*parseInt(newTDS))/100));
    $scope.balanceAfterDeduction = balanceAfterDeduction;
  }


}
