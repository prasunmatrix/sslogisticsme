'use strict';

/*****************************************************/
  // Countries Controller             
  // Function name : CountriesController
  // Functionality: country list 
  // Author : Sanchari Ghosh                                 
  // Created Date : 13/08/2018                                        
  // Purpose:  Developing the functionalities of countries
/*****************************************************/

function CountriesController($rootScope, $scope, $http, $window, $q, $location, $timeout, CountriesService) {

  $scope.titleChange = '<h1>Country</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';

   /*****************************************************/
    // Function name : countryList
    // Functionality: Country List
    // Author : Sanchari Ghosh                               
    // Created Date : 13/08/2018                                          
    // Purpose:  Developing the functionality of listing countries with the help of CountriesService
  /*****************************************************/
  $scope.countryList = function(formObj) {  

    CountriesService.makeAsyncCall(CountriesService.countryList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.countryList;
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }
}
