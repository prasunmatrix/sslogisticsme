'use strict';

/*****************************************************/
  // Notification Controller             
  // Function name : NotificationController
  // Functionality: list
  // Author : Debamala Dey                                 
  // Created Date :  31/08/2018                                       
  // Purpose:  Developing the functionalities of countries
/*****************************************************/

function NotificationController($rootScope, $scope, $http, $window, $q, $location, $timeout, NotificationService) {

  $scope.titleChange = '<h1>Notification</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.moduleName  = 'notification';

   /*****************************************************/
    // Function name : insuranceList
    // Functionality: insurance List
    // Author : Debamala Dey                                 
    // Created Date :  03/09/2018                                          
    // Purpose:  Developing the functionality of listing insurance with the help of NotificationService
  /*****************************************************/
  $scope.insuranceList = function(currentPage,orderby,ordertype,searchKeyword) {  

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



    if(localStorage.getItem('currentPageNo') !== null) {
      if(localStorage.getItem('currentModule') == $scope.moduleName) {
        $rootScope.paginationControl.currentPage = localStorage.getItem('currentPageNo');
      }
    }
    

    var insuranceData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 

    NotificationService.makeAsyncCall(NotificationService.insuranceList(insuranceData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.insuranceList;
        $scope.total = response.data.totalInsuranceList;
        $rootScope.paginationControl.currentPage  = response.data.currentPage;  
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }

   /*****************************************************/
    // Function name : permitList
    // Functionality: permit List
    // Author : Debamala Dey                                 
    // Created Date :  03/09/2018                                          
    // Purpose:  Developing the functionality of listing permit with the help of NotificationService
  /*****************************************************/
  $scope.permitList = function(currentPage,orderby,ordertype,searchKeyword) { 

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


   if(localStorage.getItem('currentPageNo') !== null) {
      if(localStorage.getItem('currentModule') == $scope.moduleName) {
        $rootScope.paginationControl.currentPage = localStorage.getItem('currentPageNo');
      }
    }
    

    var permitData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 

    NotificationService.makeAsyncCall(NotificationService.permitList(permitData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.permitList;
        $scope.total = response.data.totalPermitList;
        $rootScope.paginationControl.currentPage  = response.data.currentPage;  
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }

   /*****************************************************/
    // Function name : taxList
    // Functionality: tax List
    // Author : Debamala Dey                                 
    // Created Date :  03/09/2018                                          
    // Purpose:  Developing the functionality of listing tax with the help of NotificationService
  /*****************************************************/
  $scope.taxList = function(currentPage,orderby,ordertype,searchKeyword) {  

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


    if(localStorage.getItem('currentPageNo') !== null) {
      if(localStorage.getItem('currentModule') == $scope.moduleName) {
        $rootScope.paginationControl.currentPage = localStorage.getItem('currentPageNo');
      }
    }

    var taxData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 

    NotificationService.makeAsyncCall(NotificationService.taxList(taxData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.taxList;
        $scope.total = response.data.totalTaxList;
        $rootScope.paginationControl.currentPage  = response.data.currentPage;  
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }

   /*****************************************************/
    // Function name : pollutionList
    // Functionality: pollution List
    // Author : Debamala Dey                                 
    // Created Date :  03/09/2018                                          
    // Purpose:  Developing the functionality of listing pollution with the help of NotificationService
  /*****************************************************/
  $scope.pollutionList = function(currentPage,orderby,ordertype,searchKeyword) {  

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


   if(localStorage.getItem('currentPageNo') !== null) {
      if(localStorage.getItem('currentModule') == $scope.moduleName) {
        $rootScope.paginationControl.currentPage = localStorage.getItem('currentPageNo');
      }
    }
    

    var pollutionData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 

    NotificationService.makeAsyncCall(NotificationService.pollutionList(pollutionData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.pollutionList;
        $scope.total = response.data.totalPollutionList;
        $rootScope.paginationControl.currentPage  = response.data.currentPage;  
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }

   /*****************************************************/
    // Function name : registrationList
    // Functionality: registration List
    // Author : Debamala Dey                                 
    // Created Date :  03/09/2018                                          
    // Purpose:  Developing the functionality of listing registration with the help of NotificationService
  /*****************************************************/
  $scope.registrationList = function(currentPage,orderby,ordertype,searchKeyword) {

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


   if(localStorage.getItem('currentPageNo') !== null) {
      if(localStorage.getItem('currentModule') == $scope.moduleName) {
        $rootScope.paginationControl.currentPage = localStorage.getItem('currentPageNo');
      }
    }
    

    var regData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 

    NotificationService.makeAsyncCall(NotificationService.registrationList(regData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.registrationList;
        $scope.total = response.data.totalRegistrationList;
        $rootScope.paginationControl.currentPage  = response.data.currentPage;  
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }
}
