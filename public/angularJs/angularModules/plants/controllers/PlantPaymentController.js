'use strict';

/*****************************************************/
  // PlantPaymentController           
  // Function name : PlantPaymentController
  // Functionality: plant list, add plant payment
  // Author : Debamala Dey                                 
  // Created Date : 05/09/2018                                        
  // Purpose:  Developing the functionalities of plants
/*****************************************************/

function PlantPaymentController($rootScope, $scope, $http, $window, $q, $location, $timeout, PlantsService) {

  $scope.titleChange = '<h1>Plant Payment</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';

   /*****************************************************/
    // Function name : viewPlantList
    // Functionality: View Plant List
    // Author : Debamala Dey                                 
    // Created Date : 05/09/2018                                          
    // Purpose : Developing the functionality of listing plants with the help of PlantsService
  /*****************************************************/
  $scope.viewPlantList = function() {  
    var userData = JSON.parse(localStorage.getItem("userDataForLocal"));
    var userRole = userData.user_role;
    if(userRole == 3){
      $scope.entryType = [{"option":"M","value":"Miscellaneous Expenses"}];
    }else{
      $scope.entryType = [{"option":"M","value":"Miscellaneous Expenses"},{"option":"BG","value":"Balance Given"}];
    }
    
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
    // Function name : addPlantPayment
    // Functionality: Add Plant Payment
    // Author : Debamala Dey                                 
    // Created Date : 05/09/2018                                          
    // Purpose : Developing the functionality of add Plant payment with the help of PetrolPumpsService
  /*****************************************************/
  $scope.addPlantPayment = function() {  

    var plantData = "plant_id=" + $scope.selectPlant +"&amount=" + $scope.amount + "&description=" + $scope.description + "&entry_type=" + $scope.entry_type; 
    /*for Edit and Save petrolPump*/
    PlantsService.makeAsyncCall(PlantsService.savePlantPay(plantData))
    .then(function(response){
      if(response.data.success == "true"){
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        window.location.href =  baseUrl + "/pay-to-plant";
      } else{  
        var msg = 'Something Error Happened'; 
        $rootScope.danger = msg;
        $rootScope.msgShow();        
      }
    },function(reason){}).finally(function(data){

    });
  }
}
