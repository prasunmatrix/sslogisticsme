'use strict';

/*****************************************************/
  // AddressZones Controller             
  // Function name : AddressZonesController
  // Functionality: addressZone list , addressZone add, addressZone edit, addressZone delete
  // Author : Sanchari Ghosh                                 
  // Created Date : 21/12/2018                                        
  // Purpose:  Developing the functionalities of addressZones
/*****************************************************/

function AddressZonesController($rootScope, $scope, $http, $window, $q, $location, $timeout, AddressZonesService) {

  $scope.titleChange = '<h1>AddressZone</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';

   /*****************************************************/
    // Function name : addressZoneList
    // Functionality: AddressZone List
    // Author : Sanchari Ghosh                               
    // Created Date : 21/12/2018                                          
    // Purpose:  Developing the functionality of listing addressZones with the help of AddressZonesService
  /*****************************************************/
  $scope.addressZoneList = function(currentPage,orderby,ordertype,searchKeyword) {  

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
      //$rootScope.paginationControl.currentPage = localStorage.getItem('currentPageNo');
    }
    

    
    var addressZoneData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 
    
    AddressZonesService.makeAsyncCall(AddressZonesService.addressZoneList(addressZoneData))
    .then(function(response){ console.log(response);
      if(response.data.success == "true"){
        $scope.records = response.data.addressZoneList;
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
    // Function name : deleteAddressZone
    // Functionality: Delete addressZone
    // Author : Sanchari Ghosh                               
    // Created Date : 21/12/2018                                          
    // Purpose:  Developing the functionality of deleting addressZone with the help of CitieService
  /*****************************************************/
  $scope.deleteAddressZone = function(formObj,currentPage,orderby,ordertype,searchKeyword) {

    if (confirm('Do You really want to delete the data? ')) {
      var addressZoneData = "addressZoneId=" + formObj; 
      
      /*for Edit and Save addressZone*/
      AddressZonesService.makeAsyncCall(AddressZonesService.deleteAddressZone(addressZoneData))
      .then(function(response){
        if(response.data.success == "true"){
          $scope.addressZoneList(currentPage,orderby,ordertype,searchKeyword); /*get addressZone list*/
          $rootScope.success = 'Deleted Succesfully';
          $rootScope.msgShow();         
        }else{  
          if(response.data.success == "not_numeric") {
            var msg = 'The id must contain numeric value'; 
          } else {
            var msg = 'There are dependencies under this AddressZone'; 
          }
          $rootScope.danger = msg; 
          $rootScope.msgShow();       
        }
          },function(reason){}).finally(function(data){

          });
    }   
  }



}
