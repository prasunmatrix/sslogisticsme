'use strict';

/*****************************************************/
  // CashReports Controller             
  // Function name : CashReportsController
  // Functionality: cash report list
  // Author : Sanchari Ghosh                                 
  // Created Date : 03/04/2019                                        
  // Purpose:  Developing the functionalities of cashReports
/*****************************************************/

function CashReportsController($rootScope, $scope, $http, $window, $q, $location, $timeout, PlantsService) {

  $scope.titleChange = '<h1>Cash Report</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.moduleName  = 'cashReport';

   /*****************************************************/
    // Function name : getCashReport
    // Functionality: to get the cash report
    // Author : Sanchari Ghosh                               
    // Created Date : 03/04/2019                                          
    // Purpose:  Developing the functionality of listing cashReports with the help of PlantsService
  /*****************************************************/
  $scope.getCashReport = function(currentPage,orderby,ordertype,plant,datefilter,dateRangeValue,searchKeyword,hiddenReport) {  
    
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

    
    var cashData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&plant="+plant+"&dateRangeValue="+dateRangeValue+"&searchKeyword="+searchKeyword; 
    PlantsService.makeAsyncCall(PlantsService.getCashReport(cashData))
    .then(function(response){ console.log(response);
      if(response.data.success == "true"){
        $scope.records = response.data.cashReportList;
        $scope.total = response.data.totalCashReports;
        $scope.openingBalance = response.data.openingBalance;
        $scope.closingBalance = response.data.closingBalance;
        $scope.carryForwardBalance = response.data.carryForwardBalance;
        $scope.plantName = response.data.plantName;

        if ($scope.openingBalance == '' && $scope.closingBalance == '') {
          $scope.viewBalance = false;
        } else {
          $scope.viewBalance = true;
        }

        $rootScope.paginationControl.currentPage  = response.data.currentPage;  
        
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

    $timeout(function () { 
     $('#plant').find('option:eq(0)').prop('selected', true);
     $scope.dateRangeValue = '';
     $('.daterangepicker').find('.cancelBtn').click();
    }, 100);
  }


  

  /*****************************************************/
    // Function name : getCashReportPlantList
    // Functionality: Getting plant list 
    // Author : Sanchari Ghosh                               
    // Created Date : 03/04/2019                                          
    // Purpose:  Developing the functionality of getting lists of plants  with the help of PlantsService
  /*****************************************************/
  $scope.getCashReportPlantList = function(){
    PlantsService.makeAsyncCall(PlantsService.activePlantList())
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
