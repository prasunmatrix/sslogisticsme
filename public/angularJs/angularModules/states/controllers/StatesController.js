'use strict';

/*****************************************************/
  // States Controller             
  // Function name : StatesController
  // Functionality: state list , state add, state edit, state delete
  // Author : Sanchari Ghosh                                 
  // Created Date : 03/08/2018                                        
  // Purpose:  Developing the functionalities of states
/*****************************************************/

function StatesController($rootScope, $scope, $http, $window, $q, $location, $timeout, StatesService) {

  $scope.titleChange = '<h1>State</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';

   /*****************************************************/
    // Function name : stateList
    // Functionality: State List
    // Author : Sanchari Ghosh                               
    // Created Date : 03/08/2018                                          
    // Purpose:  Developing the functionality of listing states with the help of StatesService
  /*****************************************************/
  $scope.stateList = function(currentPage,orderby,ordertype,searchKeyword) { 

    $scope.orderby = orderby;
    $scope.ordertype = ordertype; 
    $scope.searchKeyword = searchKeyword; 
    $scope.changedOrderType = (ordertype == 'asc')?'desc':'asc';

    var stateData = "currentPage=" + currentPage + "&perPageRecord=" + $scope.perPageRecord+"&orderby="+orderby+"&ordertype="+ordertype+"&searchKeyword="+searchKeyword; 

    StatesService.makeAsyncCall(StatesService.stateList(stateData))
    .then(function(response){
      if(response.data.success == "true"){        
        $scope.records = response.data.stateList;
        $scope.total = response.data.totalStates;
        $scope.currentPage  = currentPage;
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }



  /*****************************************************/
    // Function name : stateEdit
    // Functionality: View State Edit page
    // Author : Sanchari Ghosh                               
    // Created Date : 06/08/2018                                          
    // Purpose:  Developing the functionality of view state edit page with the help of StatesService
  /*****************************************************/ 
  $scope.stateEdit = function(formObj) {  
    var stateData = $location.absUrl();
    var stateDataSplit = stateData.split('/');
    var stateId = 'stateId='+stateDataSplit[stateDataSplit.length - 1]; 

    StatesService.makeAsyncCall(StatesService.stateEdit(stateId))
    .then(function(response){
      if(response.data.success == "true"){

        /*get country lists from Common Controller*/
        $rootScope.$emit("callCountryList", {}); 

        $scope.stateId        = response.data.stateDetails.id;
        $scope.selectCountry  = response.data.stateDetails.country_id;
        $scope.stateName      = response.data.stateDetails.state_name;
        $scope.stateCode      = response.data.stateDetails.state_code;
        $scope.status         = response.data.stateDetails.status;
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : saveState
    // Functionality: Save state after add or edit
    // Author : Sanchari Ghosh                               
    // Created Date : 06/08/2018                                          
    // Purpose:  Developing the functionality of saving states with the help of StatesService
  /*****************************************************/
  $scope.saveState = function(formObj) {

    var stateData = "country_id=" + $scope.selectCountry + "&state_name=" + $scope.stateName + "&state_code=" + $scope.stateCode + "&status=" + $scope.status; 

    /*for Edit and Save state*/
    if($scope.stateId) {
      stateData += '&stateId='+$scope.stateId;
    }

    StatesService.makeAsyncCall(StatesService.saveState(stateData))
    .then(function(response){
      if(response.data.success == "true"){
        //$rootScope.success = 'Succesfully added/edited';
        window.location.href =  baseUrl + "/states";
      }else{  
        var msg = '';
        if(response.data.namecount > 0 && response.data.codecount > 0){
          var msg = 'State name and code already exists'; 
        }
        if(response.data.namecount > 0 && response.data.codecount == 0){
          var msg = 'State name already exists'; 
        }
        if(response.data.codecount > 0 && response.data.namecount == 0){
          var msg = 'State code already exists'; 
        }
        $rootScope.danger = msg;  
        $rootScope.msgShow();      
      }
        },function(reason){}).finally(function(data){

        });
  }




  /*****************************************************/
    // Function name : deleteState
    // Functionality: Delete state
    // Author : Sanchari Ghosh                               
    // Created Date : 06/08/2018                                          
    // Purpose:  Developing the functionality of deleting state with the help of StatesService
  /*****************************************************/
  $scope.deleteState = function(formObj,currentPage,orderby,ordertype,searchKeyword) {

    if (confirm('Do You really want to delete the data? ')) {
      var stateData = "stateId=" + formObj; 
      
      /*for Edit and Save state*/
      StatesService.makeAsyncCall(StatesService.deleteState(stateData))
      .then(function(response){
        if(response.data.success == "true"){
          $scope.stateList(currentPage,orderby,ordertype,searchKeyword); /*get state list*/
          $rootScope.success = 'Deleted Succesfully';
          $rootScope.msgShow();
        }else{  
          var msg = 'There are dependencies under this State'; 
          $rootScope.danger = msg;        
          $rootScope.msgShow();
        }
          },function(reason){}).finally(function(data){

          });
    }   
  }



}
