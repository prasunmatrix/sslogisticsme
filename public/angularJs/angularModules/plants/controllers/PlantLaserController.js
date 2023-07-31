'use strict';

/*****************************************************/
  // PlantLaserController           
  // Function name : PlantLaserController
  // Functionality: plant list, search plant laser, view selected plant laser
  // Author : Debamala Dey                                 
  // Created Date : 03/09/2018                                        
  // Purpose:  Developing the functionalities of plants
/*****************************************************/

function PlantLaserController($rootScope, $scope, $http, $window, $q, $location, $timeout, PlantsService) {

  $scope.titleChange = '<h1>Plant Laser</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';

   /*****************************************************/
    // Function name : viewPlantList
    // Functionality: View Plant List
    // Author : Debamala Dey                                 
    // Created Date : 03/09/2018                                          
    // Purpose : Developing the functionality of listing plants with the help of PlantsService
  /*****************************************************/
  $scope.viewPlantList = function() {  

    PlantsService.makeAsyncCall(PlantsService.allPlantList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.plantList;
         
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }

   /*****************************************************/
    // Function name : searchPlantLaser
    // Functionality: search Plant Laser
    // Author : Debamala Dey                                 
    // Created Date : 04/09/2018                                          
    // Purpose : Developing the functionality of listing Plant Laser with the help of PlantsService
  /*****************************************************/
  $scope.searchPlantLaser = function(year='',plant='') { 
    
    if($scope.selectYear != undefined){
      year = $scope.selectYear;
    } else {
      year = year;
    }
    if($scope.selectPlant != undefined){
      plant = $scope.selectPlant;
    } else {
      plant = plant;
    }   
    $window.location.href = baseUrl + '/view-selected-plantlaser/'+plant+'/'+year;
  }
  


  /*****************************************************/
    // Function name : viewSelectedPlantLaser
    // Functionality: view Plant Laser
    // Author : Debamala Dey                                 
    // Created Date : 05/09/2018                                          
    // Purpose : search Plant Laser with the help of PlantsService
    // Parameters : plan_id,year
  /*****************************************************/
  $scope.viewSelectedPlantLaser = function(plan_id,year) {  
    $scope.selectYear = year; 
    var plantData = "plan_id=" + plan_id + "&year=" + year;
    PlantsService.makeAsyncCall(PlantsService.searchLaserPlant(plantData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.years  = response.data.laserYear;  
        $scope.records = response.data.plantLaserList;         
        $scope.plantName = response.data.plantName;
        $scope.balance = response.data.balance;
        $scope.totalDebit = response.data.totalDebit;
        $scope.totalCredit = response.data.totalCredit;
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }

}
