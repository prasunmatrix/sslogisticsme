'use strict';

/*****************************************************/
  // PetrolPumps Controller             
  // Function name : PetrolPumpsController
  // Functionality: petrolPump list , petrolPump add, petrolPump edit, petrolPump delete, import petrolPump
  // Author : Sanchari Ghosh                                 
  // Created Date : 09/08/2018                                        
  // Purpose:  Developing the functionalities of petrolPumps
/*****************************************************/

function PetrolPumpsController($rootScope, $scope, $http, $window, $q, $location, $timeout, PetrolPumpsService) {

  $scope.titleChange = '<h1>PetrolPump</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.moduleName = 'petrolPump';

   /*****************************************************/
    // Function name : petrolPumpList
    // Functionality: PetrolPump List
    // Author : Sanchari Ghosh                               
    // Created Date : 09/08/2018                                          
    // Purpose:  Developing the functionality of listing petrolPumps with the help of PetrolPumpsService
  /*****************************************************/
  $scope.petrolPumpList = function(currentPage,orderby,ordertype,searchKeyword) {  

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

    $rootScope.paginationControl.searchKeyword = searchKeyword; 

    /*it will work in case of editing page*/
    if(localStorage.getItem('currentPageNo') !== null) {
      if(localStorage.getItem('currentModule') == $scope.moduleName) {
        $rootScope.paginationControl.currentPage = localStorage.getItem('currentPageNo');
      }
    }
    
    
    var petrolPumpData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 
    PetrolPumpsService.makeAsyncCall(PetrolPumpsService.petrolPumpList(petrolPumpData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.petrolPumpList;
        $scope.total = response.data.total;
        $rootScope.paginationControl.currentPage  = response.data.currentPage;  
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : petrolPumpEdit
    // Functionality: View PetrolPump Edit page
    // Author : Sanchari Ghosh                               
    // Created Date : 09/08/2018                                          
    // Purpose:  Developing the functionality of view petrolPump edit page with the help of PetrolPumpsService
  /*****************************************************/ 
  $scope.petrolPumpEdit = function(formObj) {  
    var petrolPumpData = $location.absUrl();
    var petrolPumpDataSplit = petrolPumpData.split('/');
    var petrolPumpId = 'petrolPumpId='+petrolPumpDataSplit[petrolPumpDataSplit.length - 2]; 
    var currentPageNo = petrolPumpDataSplit[petrolPumpDataSplit.length - 1];

    PetrolPumpsService.makeAsyncCall(PetrolPumpsService.petrolPumpEdit(petrolPumpId))
    .then(function(response){
      if(response.data.success == "true"){

        /*get country lists from Common Controller*/
        //$rootScope.$emit("callCountryList", {}); 

        /*get state lists from Common Controller*/
        //$rootScope.$emit("callStateList", response.data.petrolPumpDetails.country_id); 


        /*get city lists from Common Controller*/
        //$rootScope.$emit("callCityList", response.data.petrolPumpDetails.state_id); 

        $scope.petrolPumpId         = response.data.petrolPumpDetails.id;
        $scope.petrolPumpName       = response.data.petrolPumpDetails.petrol_pump_name;
        //$scope.addressZoneAddress   = response.data.addressDetails.address;
        $scope.selectAddressZone    = response.data.petrolPumpDetails.address_zone_id;
        $scope.contactNumber        = response.data.petrolPumpDetails.contact_number;
        $scope.contactEmail         = response.data.petrolPumpDetails.contact_email;
        $scope.contactPerson        = response.data.petrolPumpDetails.contact_person;
        $scope.status               = response.data.petrolPumpDetails.status;
        $scope.currentPageNo        = currentPageNo;
        localStorage.setItem('currentPageNo', currentPageNo);
        localStorage.setItem('currentModule', $scope.moduleName);
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : savePetrolPump
    // Functionality: Save petrolPump after add or edit
    // Author : Sanchari Ghosh                               
    // Created Date : 09/08/2018                                          
    // Purpose:  Developing the functionality of saving petrolPumps with the help of PetrolPumpsService
  /*****************************************************/
  $scope.savePetrolPump = function(formObj) {

    var petrolPumpData = "address_zone_id=" + $scope.selectAddressZone + "&petrol_pump_name=" + $scope.petrolPumpName + "&address=" + $scope.address + "&contact_number=" + $scope.contactNumber + "&contact_email=" + $scope.contactEmail +  "&contact_person=" + $scope.contactPerson + "&status=" + $scope.status + "&currentPageNo=" + $scope.currentPageNo;; 
    
    /*for Edit and Save petrolPump*/
    if($scope.petrolPumpId) {
      petrolPumpData += '&petrolPumpId='+$scope.petrolPumpId;
    }

    PetrolPumpsService.makeAsyncCall(PetrolPumpsService.savePetrolPump(petrolPumpData))
    .then(function(response){
      if(response.data.success == "true"){
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        if($scope.petrolPumpId) {
          if($scope.currentPageNo) {
            $rootScope.paginationControl.currentPage = $scope.currentPageNo; 
          }
          
          /*for redirecting to same page after editing is done*/
          localStorage.setItem('currentPageNo', $scope.currentPageNo);
          localStorage.setItem('currentModule', $scope.moduleName);
        }
        window.location.href =  baseUrl + "/petrolPumps";
      } else{  
        var msg = response.data.msg; 
        $rootScope.danger = msg;
        $rootScope.msgShow();        
      }
        },function(reason){}).finally(function(data){

        });
  }




  /*****************************************************/
    // Function name : deletePetrolPump
    // Functionality: Delete petrolPump
    // Author : Sanchari Ghosh                               
    // Created Date : 09/08/2018                                          
    // Purpose:  Developing the functionality of deleting petrolPump with the help of PetrolPumpsService
  /*****************************************************/
  $scope.deletePetrolPump = function(formObj,currentPage,orderby,ordertype,searchKeyword) {

    if (confirm('Do You really want to delete the data? ')) {
      var petrolPumpData = "petrolPumpId=" + formObj; 
      
      /*for Edit and Save petrolPump*/
      PetrolPumpsService.makeAsyncCall(PetrolPumpsService.deletePetrolPump(petrolPumpData))
      .then(function(response){
        if(response.data.success == "true"){
          $scope.petrolPumpList(currentPage,orderby,ordertype,searchKeyword); /*get petrolPump list*/
          $rootScope.success = 'Deleted Succesfully';
          $rootScope.msgShow();
        }else{  
          if(response.data.success == "not_numeric") {
            var msg = 'The id must contain numeric value'; 
          } else {
            var msg = 'There are dependencied under this Petrol Pump.'; 
          }
          $rootScope.danger = msg;  
          $rootScope.msgShow();      
        }
          },function(reason){}).finally(function(data){

          });
    }   
  }




  /*****************************************************/
    // Function name : savePetrolPumpCSV
    // Functionality: Save imported CSV file
    // Author : Sanchari Ghosh                               
    // Created Date : 10/08/2018                                          
    // Purpose:  Developing the functionality of saving imported csv file with the help of PetrolPumpsService
  /*****************************************************/
  $scope.savePetrolPumpCSV = function(formObj) {
    if ($scope.contentData === undefined) {
      $rootScope.danger = 'Wrong File Type. Please upload CSV file.'; 
      $rootScope.msgShow();  
    } else {

      var dataLength = $scope.contentData[0].split(',');
      if (dataLength.length == 6) {
        var petrolPumpData =  'petrolPumpDetailsData='+ JSON.stringify($scope.contentData); 
     
        PetrolPumpsService.makeAsyncCall(PetrolPumpsService.saveCSVPetrolPump(petrolPumpData))
          .then(function(response){ 
            if(response.data.success == "true"){
              $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
              window.location.href =  baseUrl + "/petrolPumps";
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



  /*****************************************************/
    // Function name : getPetrolPumpDetail
    // Functionality: to view Petrol Pump Details
    // Author : Sanchari Ghosh                               
    // Created Date : 04/01/2019                                          
    // Purpose:  Developing the functionality of viewing Petrol Pump Details with the help of PetrolPumpsService
  /*****************************************************/
  $scope.getPetrolPumpDetail = function(formObj) {
    var petrolPumpData = $location.absUrl();
    var petrolPumpDataSplit = petrolPumpData.split('/');
    var petrolPumpId = 'petrolPumpId='+petrolPumpDataSplit[petrolPumpDataSplit.length - 2]; 
    var currentPageNo = petrolPumpDataSplit[petrolPumpDataSplit.length - 1];

    localStorage.setItem('currentPageNo', currentPageNo);
    localStorage.setItem('currentModule', $scope.moduleName);
    
    PetrolPumpsService.makeAsyncCall(PetrolPumpsService.getPetrolPumpDetail(petrolPumpId))
    .then(function(response){
      if(response.data.success == "true"){        
        $scope.record         = response.data.petrolPumpDetails.petrolPumpDetails;
        $scope.addressDetails = response.data.petrolPumpDetails.addressDetails;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }

}
