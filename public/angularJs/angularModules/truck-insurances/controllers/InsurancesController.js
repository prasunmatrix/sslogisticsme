'use strict';

/*****************************************************/
  // Insurances Controller             
  // Function name : InsurancesController
  // Functionality: insurance list , insurance add, insurance edit, insurance delete
  // Author : Sanchari Ghosh                                 
  // Created Date : 13/08/2018                                        
  // Purpose:  Developing the functionalities of insurances
/*****************************************************/

function InsurancesController($rootScope, $scope, $http, $window, $q, $location, $timeout, InsurancesService) {

  $scope.titleChange = '<h1>Insurance</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';

   /*****************************************************/
    // Function name : insuranceList
    // Functionality: Insurance List
    // Author : Sanchari Ghosh                               
    // Created Date : 13/08/2018                                          
    // Purpose:  Developing the functionality of listing insurances with the help of InsurancesService
  /*****************************************************/
  $scope.insuranceList = function(formObj) {  

    InsurancesService.makeAsyncCall(InsurancesService.insuranceList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.truckInsuranceList;
         
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : getTruckList
    // Functionality: Getting Truck List
    // Author : Sanchari Ghosh                               
    // Created Date : 16/08/2018                                          
    // Purpose:  Developing the functionality of listing trucks with the help of InsurancesService
  /*****************************************************/
  $scope.getTruckList = function(formObj) {  

    InsurancesService.makeAsyncCall(InsurancesService.getTruckList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.truckRecords = response.data.truckList;
         
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : insuranceEdit
    // Functionality: View Insurance Edit page
    // Author : Sanchari Ghosh                               
    // Created Date : 13/08/2018                                          
    // Purpose:  Developing the functionality of view insurance edit page with the help of InsurancesService
  /*****************************************************/ 
  $scope.insuranceEdit = function(formObj) {  
    var insuranceData = $location.absUrl();
    var insuranceDataSplit = insuranceData.split('/');
    var insuranceId = 'insuranceId='+insuranceDataSplit[insuranceDataSplit.length - 1]; 

    InsurancesService.makeAsyncCall(InsurancesService.insuranceEdit(insuranceId))
    .then(function(response){
      if(response.data.success == "true"){

        $scope.insuranceId      = response.data.insuranceDetails.id;
        $scope.selectTruck      = response.data.insuranceDetails.truck_id;
        $scope.policyNo         = response.data.insuranceDetails.policy_no;
        $scope.name             = response.data.insuranceDetails.name;
        $scope.policyOn         = response.data.insuranceDetails.policy_on;
        $scope.policyStart      = response.data.insuranceDetails.policy_start;
        $scope.policyEnd        = response.data.insuranceDetails.policy_end;
        $scope.policyFile       = response.data.insuranceDetails.policy_file;
        $scope.status           = response.data.insuranceDetails.status;
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : saveInsurance
    // Functionality: Save insurance after add or edit
    // Author : Sanchari Ghosh                               
    // Created Date : 13/08/2018                                          
    // Purpose:  Developing the functionality of saving insurances with the help of InsurancesService
  /*****************************************************/
  $scope.saveInsurance = function(formObj) {
    $scope.submitted = true;
    var insuranceData = "truck_id=" + $scope.selectTruck +"&policy_no=" + $scope.policyNo + "&name=" + $scope.name + "&policy_on=" + $scope.policyOn + "&policy_start=" + $scope.policyStart +  "&policy_end=" + $scope.policyEnd + "&policy_file=" + $scope.policyFile + "&status=" + $scope.status; 
    console.log(insuranceData);
    
    /*for Edit and Save insurance*/
    if($scope.insuranceId) {
      insuranceData += '&insuranceId='+$scope.insuranceId;
    }

    InsurancesService.makeAsyncCall(InsurancesService.saveInsurance(insuranceData))
    .then(function(response){
      if(response.data.success == "true"){
         
        window.location.href =  baseUrl + "/insurances";
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }




  /*****************************************************/
    // Function name : deleteInsurance
    // Functionality: Delete insurance
    // Author : Sanchari Ghosh                               
    // Created Date : 13/08/2018                                          
    // Purpose:  Developing the functionality of deleting insurance with the help of InsurancesService
  /*****************************************************/
  $scope.deleteInsurance = function(formObj) {

    if (confirm('Do You really want to delete the data? ')) {
      var insuranceData = "insuranceId=" + formObj; 
      
      /*for Edit and Save insurance*/
      InsurancesService.makeAsyncCall(InsurancesService.deleteInsurance(insuranceData))
      .then(function(response){
        if(response.data.success == "true"){
           
          $scope.insuranceList(); /*get insurance list*/
          $rootScope.success = 'Deleted Succesfully';
          
        }else{  
          var msg = 'Error'; 
          $rootScope.danger = msg;        
        }
          },function(reason){}).finally(function(data){

          });
    }   
  }
}
