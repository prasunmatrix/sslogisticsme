'use strict';

/*****************************************************/
  // Cities Controller             
  // Function name : CitiesController
  // Functionality: city list , city add, city edit, city delete
  // Author : Sanchari Ghosh                                 
  // Created Date : 07/08/2018                                        
  // Purpose:  Developing the functionalities of cities
/*****************************************************/

function CitiesController($rootScope, $scope, $http, $window, $q, $location, $timeout, CitiesService) {

  $scope.titleChange = '<h1>City</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';

   /*****************************************************/
    // Function name : cityList
    // Functionality: City List
    // Author : Sanchari Ghosh                               
    // Created Date : 07/08/2018                                          
    // Purpose:  Developing the functionality of listing cities with the help of CitiesService
  /*****************************************************/
  $scope.cityList = function(currentPage,orderby,ordertype,searchKeyword) {  

    $scope.orderby = orderby;
    $scope.ordertype = ordertype; 
    $scope.searchKeyword = searchKeyword; 
    $scope.changedOrderType = (ordertype == 'asc')?'desc':'asc';

    var cityData = "currentPage=" + currentPage + "&perPageRecord=" + $scope.perPageRecord+"&orderby="+orderby+"&ordertype="+ordertype+"&searchKeyword="+searchKeyword; 
    CitiesService.makeAsyncCall(CitiesService.cityList(cityData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.cityList;
        $scope.total = response.data.totalCities;
        $scope.currentPage  = currentPage;
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }



  /*****************************************************/
    // Function name : cityEdit
    // Functionality: View City Edit page
    // Author : Sanchari Ghosh                               
    // Created Date : 07/08/2018                                          
    // Purpose:  Developing the functionality of view city edit page with the help of CitiesService
  /*****************************************************/ 
  $scope.cityEdit = function(formObj) {  
    var cityData = $location.absUrl();
    var cityDataSplit = cityData.split('/');
    var cityId = 'cityId='+cityDataSplit[cityDataSplit.length - 1]; 

    CitiesService.makeAsyncCall(CitiesService.cityEdit(cityId))
    .then(function(response){
      if(response.data.success == "true"){

        /*get country lists from Common Controller*/
        $rootScope.$emit("callCountryList", {}); 

        /*get state lists from Common Controller*/
        $rootScope.$emit("callStateList", response.data.cityDetails.country_id); 

        $scope.cityId         = response.data.cityDetails.id;
        $scope.selectCountry  = response.data.cityDetails.country_id;
        $scope.selectState    = response.data.cityDetails.state_id;
        $scope.cityName       = response.data.cityDetails.city_name;
        $scope.cityCode       = response.data.cityDetails.city_code;
        $scope.status         = response.data.cityDetails.status;
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : saveCity
    // Functionality: Save city after add or edit
    // Author : Sanchari Ghosh                               
    // Created Date : 07/08/2018                                          
    // Purpose:  Developing the functionality of saving cities with the help of CitiesService
  /*****************************************************/
  $scope.saveCity = function(formObj) {

    var cityData = "country_id=" + $scope.selectCountry +"&state_id=" + $scope.selectState + "&city_name=" + $scope.cityName + "&city_code=" + $scope.cityCode + "&status=" + $scope.status; 
    
    /*for Edit and Save city*/
    if($scope.cityId) {
      cityData += '&cityId='+$scope.cityId;
    }

    CitiesService.makeAsyncCall(CitiesService.saveCity(cityData))
    .then(function(response){
      if(response.data.success == "true"){
        window.location.href =  baseUrl + "/cities";
      }else{  
        var msg = '';
        if(response.data.namecount > 0 && response.data.codecount > 0){
          var msg = 'City name and code already exists'; 
        }
        if(response.data.namecount > 0 && response.data.codecount == 0){
          var msg = 'City name already exists'; 
        }
        if(response.data.codecount > 0 && response.data.namecount == 0){
          var msg = 'City code already exists'; 
        }
        $rootScope.danger = msg; 
        $rootScope.msgShow();    
      }
        },function(reason){}).finally(function(data){

        });
  }




  /*****************************************************/
    // Function name : deleteCity
    // Functionality: Delete city
    // Author : Sanchari Ghosh                               
    // Created Date : 07/08/2018                                          
    // Purpose:  Developing the functionality of deleting city with the help of CitiesService
  /*****************************************************/
  $scope.deleteCity = function(formObj,currentPage,orderby,ordertype,searchKeyword) {

    if (confirm('Do You really want to delete the data? ')) {
      var cityData = "cityId=" + formObj; 
      
      /*for Edit and Save city*/
      CitiesService.makeAsyncCall(CitiesService.deleteCity(cityData))
      .then(function(response){
        if(response.data.success == "true"){
          $scope.cityList(currentPage,orderby,ordertype,searchKeyword); /*get city list*/
          $rootScope.success = 'Deleted Succesfully';
          $rootScope.msgShow();
        }else{  
          var msg = 'There are dependencies under this City'; 
          $rootScope.danger = msg;  
          $rootScope.msgShow();      
        }
          },function(reason){}).finally(function(data){

          });
    }   
  }



}
