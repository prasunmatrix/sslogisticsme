'use strict';

/*****************************************************/
	// Dashboards Controller             
	// Function name : DashboardsController
	// Functionality: counter of different module
	// Author : Sanchari Ghosh                                
	// Created Date : 27/07/2018                                        
	// Purpose:  Developing the functionality of dashboard 
/*****************************************************/
function DashboardsController($rootScope, $scope, $http, $window, $timeout, $q, $location, DashboardsService) {
  $scope.dashboardTitle = 'Dashboard Controller Testing';  

  /*****************************************************/
    // Function name : dashboardList
    // Functionality: Dashboard List
    // Author : Sanchari Ghosh                               
    // Created Date : 17/04/2018                                          
    // Purpose:  Developing the functionality of listing with the help of DashboardsService
  /*****************************************************/
  $scope.dashboardList = function() {  

   DashboardsService.makeAsyncCall(DashboardsService.dashboardList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data;
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }
}


