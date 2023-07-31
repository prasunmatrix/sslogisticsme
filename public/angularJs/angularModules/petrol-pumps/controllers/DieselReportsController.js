'use strict';

/*****************************************************/
  // DieselReports Controller             
  // Function name : DieselReportsController
  // Functionality: diesel report list
  // Author : Sanchari Ghosh                                 
  // Created Date : 04/04/2019                                        
  // Purpose:  Developing the functionalities of dieselReports
/*****************************************************/

function DieselReportsController($rootScope, $scope, $http, $window, $q, $location, $timeout, PetrolPumpsService) {

  $scope.titleChange = '<h1>Diesel Report</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.moduleName  = 'dieselReport';

   /*****************************************************/
    // Function name : getDieselReport
    // Functionality: to get the diesel report
    // Author : Sanchari Ghosh                               
    // Created Date : 04/04/2019                                          
    // Purpose:  Developing the functionality of listing dieselReports with the help of PetrolPumpsService
  /*****************************************************/
  $scope.getDieselReport = function(currentPage,orderby,ordertype,petrolPump,datefilter,dateRangeValue,hiddenReport) {  

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

    
    var dieselData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&petrolPump="+petrolPump+"&dateRangeValue="+dateRangeValue; 
    PetrolPumpsService.makeAsyncCall(PetrolPumpsService.getDieselReport(dieselData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.dieselReportList;
        $scope.total = response.data.totalDieselReports;
        $scope.todaysPayment = response.data.todaysPayment;
        $scope.todaysPurchase = response.data.todaysPurchase;
        $scope.balanceLastDay = response.data.balanceLastDay;
        $scope.carryForwardBalance = response.data.carryForwardBalance;
        $scope.pumpName = response.data.pumpName;
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
    // Created Date : 04/04/2019                                          
    // Purpose:  Developing the functionality of clearing data from input field
  /*****************************************************/
  $scope.clearData = function(){
    angular.element("select").val('');
    angular.element("input").val('');

    $timeout(function () { 
     $('#petrolPump').find('option:eq(0)').prop('selected', true);
     $scope.dateRangeValue = '';
     $('.daterangepicker').find('.cancelBtn').click();
    }, 100);
  }


  

  /*****************************************************/
    // Function name : getDieselReportPetrolPumpList
    // Functionality: Getting petrol pump list 
    // Author : Sanchari Ghosh                               
    // Created Date : 04/04/2019                                          
    // Purpose:  Developing the functionality of getting lists of petrol pumps  with the help of PetrolPumpsService
  /*****************************************************/
  $scope.getDieselReportPetrolPumpList = function(){
    PetrolPumpsService.makeAsyncCall(PetrolPumpsService.activePetrolPumpList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.petrolPumpRecords = response.data.petrolPumpList;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
    }
}
