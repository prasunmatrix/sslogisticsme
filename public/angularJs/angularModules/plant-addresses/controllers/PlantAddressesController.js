'use strict';

/*****************************************************/
  // PlantAddresses Controller             
  // Function name : PlantAddressesController
  // Functionality: plantAddress list , plantAddress add, plantAddress edit, plantAddress delete, import plantAddress
  // Author : Sanchari Ghosh                                 
  // Created Date : 16/08/2018                                        
  // Purpose:  Developing the functionalities of plantAddresses
/*****************************************************/

function PlantAddressesController($rootScope, $scope, $http, $window, $q, $location, $timeout, PlantAddressesService) {

  $scope.titleChange = '<h1>PlantAddress</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';

   /*****************************************************/
    // Function name : plantAddressList
    // Functionality: PlantAddress List
    // Author : Sanchari Ghosh                               
    // Created Date : 16/08/2018                                          
    // Purpose:  Developing the functionality of listing plantAddresses with the help of PlantAddressesService
  /*****************************************************/
  $scope.plantAddressList = function(currentPage,orderby,ordertype,searchKeyword) {

    $scope.orderby = orderby;
    $scope.ordertype = ordertype; 
    $scope.searchKeyword = searchKeyword; 
    $scope.changedOrderType = (ordertype == 'asc')?'desc':'asc';
    
    var planAddressData = "currentPage=" + currentPage + "&perPageRecord=" + $scope.perPageRecord+"&orderby="+orderby+"&ordertype="+ordertype+"&searchKeyword="+searchKeyword; 
    PlantAddressesService.makeAsyncCall(PlantAddressesService.plantAddressList(planAddressData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.plantAddressList;
        $scope.total = response.data.total;
        $scope.currentPage  = currentPage;
         
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : getPlantList
    // Functionality: Getting Plant List
    // Author : Sanchari Ghosh                               
    // Created Date : 16/08/2018                                          
    // Purpose:  Developing the functionality of listing plants with the help of PlantAddressesService
  /*****************************************************/
  $scope.getPlantList = function(formObj) {  

    PlantAddressesService.makeAsyncCall(PlantAddressesService.getPlantList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.plantRecords = response.data.plantList;
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : plantAddressEdit
    // Functionality: View PlantAddress Edit page
    // Author : Sanchari Ghosh                               
    // Created Date : 16/08/2018                                          
    // Purpose:  Developing the functionality of view plantAddress edit page with the help of PlantAddressesService
  /*****************************************************/ 
  $scope.plantAddressEdit = function(formObj) {  
    var plantAddressData = $location.absUrl();
    var plantAddressDataSplit = plantAddressData.split('/');
    var plantAddressId = 'plantAddressId='+plantAddressDataSplit[plantAddressDataSplit.length - 1]; 

    PlantAddressesService.makeAsyncCall(PlantAddressesService.plantAddressEdit(plantAddressId))
    .then(function(response){
      if(response.data.success == "true"){

        /*get party lists*/
        $scope.getPlantList();

        /*get country lists from Common Controller*/
        $rootScope.$emit("callCountryList", {}); 

        /*get state lists from Common Controller*/
        $rootScope.$emit("callStateList", response.data.plantAddressDetails.country_id); 


        /*get city lists from Common Controller*/
        $rootScope.$emit("callCityList", response.data.plantAddressDetails.state_id); 

        $scope.plantAddressId       = response.data.plantAddressDetails.id;
        $scope.selectPlant          = response.data.plantAddressDetails.plant_id;
        $scope.selectCity           = response.data.plantAddressDetails.city_id;
        $scope.selectCountry        = response.data.plantAddressDetails.country_id;
        $scope.selectState          = response.data.plantAddressDetails.state_id;
        $scope.chosenPlace          = response.data.plantAddressDetails.address;
        $scope.lat                  = response.data.plantAddressDetails.lat;
        $scope.lng                  = response.data.plantAddressDetails.lng;
        $scope.status               = response.data.plantAddressDetails.status;
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : savePlantAddress
    // Functionality: Save plantAddress after add or edit
    // Author : Sanchari Ghosh                               
    // Created Date : 16/08/2018                                          
    // Purpose:  Developing the functionality of saving plantAddresses with the help of PlantAddressesService
  /*****************************************************/
  $scope.savePlantAddress = function(formObj) {  

    var addressData = $("#selectState option:selected").html() + '+' + $("#selectCity option:selected").html() + '+' + $("#selectCountry option:selected").html() + '+' + $scope.chosenPlace;
    

    /*get latitide longitude from given address from Common Controller*/
    new Promise((resolve, reject)=>{
        $rootScope.getLatLong(addressData).then(()=>{
          resolve();
        });
        
      }).then(()=>{
        /*if latitude longitude is not found from given address*/
        if ($scope.lat === undefined) {
          $scope.lat = '';
          $scope.lng = '';
        }
        var plantAddressData = "plant_id=" + $scope.selectPlant + "&country_id=" + $scope.selectCountry +"&state_id=" + $scope.selectState + "&city_id=" + $scope.selectCity + "&address=" + $scope.chosenPlace + "&lat=" + $scope.lat + "&lng=" + $scope.lng + "&status=" + $scope.status; 

        /*for Edit and Save plantAddress*/
        if($scope.plantAddressId) {
          plantAddressData += '&plantAddressId='+$scope.plantAddressId;
        }

        PlantAddressesService.makeAsyncCall(PlantAddressesService.savePlantAddress(plantAddressData))
        .then(function(response){
          if(response.data.success == "true"){
            window.location.href =  baseUrl + "/plantAddresses";
          }else{  
            var msg = 'Address for this Plant already exists'; 
            $rootScope.danger = msg;
            $rootScope.msgShow();        
          }
            },function(reason){}).finally(function(data){

            });
      })

  }





  /*****************************************************/
    // Function name : deletePlantAddress
    // Functionality: Delete plantAddress
    // Author : Sanchari Ghosh                               
    // Created Date : 16/08/2018                                          
    // Purpose:  Developing the functionality of deleting plantAddress with the help of PlantAddressesService
  /*****************************************************/
  $scope.deletePlantAddress = function(formObj,currentPage,orderby,ordertype,searchKeyword) {

    if (confirm('Do You really want to delete the data? ')) {
      var plantAddressData = "plantAddressId=" + formObj; 
      
      /*for Edit and Save plantAddress*/
      PlantAddressesService.makeAsyncCall(PlantAddressesService.deletePlantAddress(plantAddressData))
      .then(function(response){
        if(response.data.success == "true"){
          $scope.plantAddressList(currentPage,orderby,ordertype,searchKeyword); /*get plantAddress list*/
          $rootScope.success = 'Deleted Succesfully';
          $rootScope.msgShow();
        }else{  
          var msg = 'Error'; 
          $rootScope.danger = msg; 
          $rootScope.msgShow();       
        }
          },function(reason){}).finally(function(data){

          });
    }   
  }






  /*****************************************************/
    // Function name : savePlantAddressCSV
    // Functionality: Save imported CSV file
    // Author : Sanchari Ghosh                               
    // Created Date : 16/08/2018                                          
    // Purpose:  Developing the functionality of saving imported csv file with the help of PlantAddressesService
  /*****************************************************/
  $scope.savePlantAddressCSV = function(formObj) {
     if ($scope.contentData === undefined) {
      $rootScope.danger = 'Wrong File Type. Please upload CSV file.'; 
      $rootScope.msgShow();  
    } else {
      var dataLength = $scope.contentData[0].split(',');
      if (dataLength.length == 14) {
        var contentdata = $scope.contentData;
        var plantAddressData =  'plantAddressDetailsData='+ JSON.stringify($scope.contentData); 
     
        PlantAddressesService.makeAsyncCall(PlantAddressesService.saveCSVPlantAddress(plantAddressData))
          .then(function(response){
            if(response.data.success == "true"){
              window.location.href =  baseUrl + "/plantAddresses";
            } else{  
              var msg = 'Error'; 
              //$rootScope.danger = msg;        
            }
        },function(reason){}).finally(function(data){

        }); 
      } else {
        $rootScope.danger = 'Wrong File Format. Please download Sample File to know the correct format'; 
        $rootScope.msgShow();  
      }

    }

  }



}
