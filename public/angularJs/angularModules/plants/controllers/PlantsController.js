'use strict';

/*****************************************************/
  // Plants Controller             
  // Function name : PlantsController
  // Functionality: plant list , plant add, plant edit, plant delete, import plant
  // Author : Sanchari Ghosh                                 
  // Created Date : 08/08/2018                                        
  // Purpose:  Developing the functionalities of plants
/*****************************************************/

function PlantsController($rootScope, $scope, $http, $window, $q, $location, $timeout, PlantsService) {

  $scope.titleChange = '<h1>Plant</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.moduleName  = 'plant';


   /*****************************************************/
    // Function name : plantList
    // Functionality: Plant List
    // Author : Sanchari Ghosh                               
    // Created Date : 08/08/2018                                          
    // Purpose:  Developing the functionality of listing plants with the help of PlantsService
  /*****************************************************/
  $scope.plantList = function(currentPage,orderby,ordertype,searchKeyword) {

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
    
    
    var planData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 
    PlantsService.makeAsyncCall(PlantsService.plantList(planData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.plantList;
        $scope.total = response.data.total;
        $rootScope.paginationControl.currentPage  = response.data.currentPage;  
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }



  /*****************************************************/
    // Function name : plantEdit
    // Functionality: View Plant Edit page
    // Author : Sanchari Ghosh                               
    // Created Date : 08/08/2018                                          
    // Purpose:  Developing the functionality of view plant edit page with the help of PlantsService
  /*****************************************************/ 
  $scope.plantEdit = function(formObj) {  
    var plantData = $location.absUrl();
    var plantDataSplit = plantData.split('/');
    var plantId = 'plantId='+plantDataSplit[plantDataSplit.length - 2]; 
    var currentPageNo = plantDataSplit[plantDataSplit.length - 1];

    PlantsService.makeAsyncCall(PlantsService.plantEdit(plantId))
    .then(function(response){ console.log(response);
      if(response.data.success == "true"){

        /*get supervisors lists from Common Controller*/
        //$rootScope.$emit("callGetSupervisor", response.data.plantDetails.supervisor_id); 

        $scope.plantId            = response.data.plantDetails.id;
        $scope.selectAddressZone  = response.data.plantDetails.address_zone_id;
        //$scope.selectAddressZone = response.data.addressDetails.address;
        $scope.selectType         = response.data.plantDetails.type;
        $scope.name               = response.data.plantDetails.name;
        $scope.description        = response.data.plantDetails.description;
        $scope.balanceAmount      = response.data.plantDetails.balance_amount  ;
        $scope.status             = response.data.plantDetails.status;
        $scope.currentPageNo      = currentPageNo;
        localStorage.setItem('currentPageNo', currentPageNo);
        localStorage.setItem('currentModule', $scope.moduleName);
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : savePlant
    // Functionality: Save plant after add or edit
    // Author : Sanchari Ghosh                               
    // Created Date : 08/08/2018                                          
    // Purpose:  Developing the functionality of saving plants with the help of PlantsService
  /*****************************************************/
  $scope.savePlant = function(formObj) {

    var plantData = "address_zone_id=" + $scope.selectAddressZone + "&type=" + $scope.selectType +"&name=" + $scope.name + "&description=" + $scope.description + "&balance_amount=" + $scope.balanceAmount + "&status=" + $scope.status + "&currentPageNo=" + $scope.currentPageNo; 

    /*for Edit and Save plant*/
    if($scope.plantId) {
      plantData += '&plantId='+$scope.plantId;
    }

    PlantsService.makeAsyncCall(PlantsService.savePlant(plantData))
    .then(function(response){
      if(response.data.success == "true"){
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        if($scope.plantId) {
          if($scope.currentPageNo) {
            $rootScope.paginationControl.currentPage = $scope.currentPageNo; 
          }
          
          /*for redirecting to same page after editing is done*/
          localStorage.setItem('currentPageNo', $scope.currentPageNo);
          localStorage.setItem('currentModule', $scope.moduleName);
        }
        window.location.href =  baseUrl + "/plants";
       
      }else{  
        var msg = response.data.msg; 
        $rootScope.danger = msg;    
        $rootScope.msgShow();    
      }
        },function(reason){}).finally(function(data){

        });
  }




  /*****************************************************/
    // Function name : deletePlant
    // Functionality: Delete plant
    // Author : Sanchari Ghosh                               
    // Created Date : 08/08/2018                                          
    // Purpose:  Developing the functionality of deleting plant with the help of PlantsService
  /*****************************************************/
  $scope.deletePlant = function(formObj,currentPage,orderby,ordertype,searchKeyword) {

    if (confirm('Do You really want to delete the data? ')) {
      var plantData = "plantId=" + formObj; 
      
      /*for Edit and Save plant*/
      PlantsService.makeAsyncCall(PlantsService.deletePlant(plantData))
      .then(function(response){
        if(response.data.success == "true"){
          $scope.plantList(currentPage,orderby,ordertype,searchKeyword); /*get plant list*/
          $rootScope.success = 'Deleted Succesfully';
          $rootScope.msgShow();
        }else{  
          if(response.data.success == "not_numeric") {
            var msg = 'The id must contain numeric value'; 
          } else {
            var msg = 'There are dependencies under this Plant'; 
          }
          $rootScope.danger = msg;  
          $rootScope.msgShow();      
        }
          },function(reason){}).finally(function(data){

          });
    }   
  }






  /*****************************************************/
    // Function name : savePlantCSV
    // Functionality: Save imported CSV file
    // Author : Sanchari Ghosh                               
    // Created Date : 10/08/2018                                          
    // Purpose:  Developing the functionality of saving imported csv file with the help of PlantsService
  /*****************************************************/
  $scope.savePlantCSV = function(formObj) {

     if ($scope.contentData === undefined) {
      $rootScope.danger = 'Wrong File Type. Please upload CSV file.'; 
      $rootScope.msgShow();  
    } else {
      var dataLength = $scope.contentData[0].split(',');
      if (dataLength.length == 6) {
        var plantdata =  'plantDetailsData='+ JSON.stringify($scope.contentData); 
     
        PlantsService.makeAsyncCall(PlantsService.saveCSVPlant(plantdata))
          .then(function(response){
            if(response.data.success == "true"){
              $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
              window.location.href =  baseUrl + "/plants";
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
    // Function name : getPlantDetail
    // Functionality: to view Plant Details
    // Author : Sanchari Ghosh                               
    // Created Date : 31/12/2018                                          
    // Purpose:  Developing the functionality of viewing Plant Details with the help of PlantsService
  /*****************************************************/
  $scope.getPlantDetail = function(formObj) {
    var plantData = $location.absUrl();
    var plantDataSplit = plantData.split('/');
    var plantId = 'plantId='+plantDataSplit[plantDataSplit.length - 2]; 
    var currentPageNo = plantDataSplit[plantDataSplit.length - 1];

    localStorage.setItem('currentPageNo', currentPageNo);
    localStorage.setItem('currentModule', $scope.moduleName);
    
    PlantsService.makeAsyncCall(PlantsService.getPlantDetail(plantId))
    .then(function(response){
      if(response.data.success == "true"){   console.log(response);
        $scope.record         = response.data.plantDetails.plantDetails;
        $scope.addressDetails = response.data.plantDetails.addressDetails;
        $scope.usersDetails   = response.data.userDetails;
        $scope.actualBalance  = response.data.actualBalance;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }



}
