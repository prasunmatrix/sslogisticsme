'use strict';

/*****************************************************/
  // PetrolpumpLaserController           
  // Function name : PetrolpumpLaserController
  // Functionality: Petrolpump list
  // Author : Debamala Dey                                 
  // Created Date : 05/09/2018                                        
  // Purpose:  Developing the functionalities of Petrolpump
/*****************************************************/

function PetrolpumpLaserController($rootScope, $scope, $http, $window, $q, $location, $timeout, PetrolPumpsService) {

  $scope.titleChange = '<h1>Petrolpump Laser</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';

   /*****************************************************/
    // Function name : viewPetrolpumpList
    // Functionality: View Petrolpump List
    // Author : Debamala Dey                                 
    // Created Date : 05/09/2018                                          
    // Purpose : Developing the functionality of listing Petrolpump with the help of PetrolPumpsService
  /*****************************************************/
  $scope.viewPetrolpumpList = function() {

    PetrolPumpsService.makeAsyncCall(PetrolPumpsService.allPetrolPumpList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.petrolpumpList;
         
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }

   /*****************************************************/
    // Function name : searchPetrolpumpLaser
    // Functionality: search Petrolpump Laser
    // Author : Debamala Dey                                 
    // Created Date : 05/09/2018                                          
    // Purpose : search Petrolpump Laser with the help of PetrolPumpsService
    // Parameters : plan_id,year
  /*****************************************************/
  $scope.searchPetrolpumpLaser = function(year='',petrolpump='') {
    
    if($scope.selectYear != undefined){
      year = $scope.selectYear;
    } else {
      year = year;
    }
    if($scope.selectPetrolpump != undefined){
      petrolpump = $scope.selectPetrolpump;
    } else {
      petrolpump = petrolpump;
    }   
    $window.location.href = baseUrl + '/view-selected-petrolpump-laser/'+petrolpump+'/'+year;
  }

  

  
  /*****************************************************/
    // Function name : viewSelectedPetrolpumpLaser
    // Functionality: view Petrolpump Laser
    // Author : Debamala Dey                                 
    // Created Date : 05/09/2018                                          
    // Purpose : search Petrolpump Laser with the help of PetrolPumpsService
    // Parameters : plan_id,year
  /*****************************************************/
  $scope.viewSelectedPetrolpumpLaser = function(petrolpump_id,year) {  console.log(year);
    $scope.selectYear = year;
    var petrolPumpData = "petrolpump_id=" + petrolpump_id + "&year=" + year;
    PetrolPumpsService.makeAsyncCall(PetrolPumpsService.searchLaserPetrolPump(petrolPumpData))
    .then(function(response){ 
      if(response.data.success == "true"){
        $scope.years  = response.data.laserYear;
        $scope.records = response.data.petrolpumpLaserList;         
        $scope.petrolPumpName = response.data.petrolPumpName;
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
