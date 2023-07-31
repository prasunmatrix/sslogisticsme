'use strict';

/*****************************************************/
  // Parties Controller             
  // Function name : PartiesController
  // Functionality: party list , party add, party edit, party delete, import party
  // Author : Sanchari Ghosh                                 
  // Created Date : 10/08/2018                                        
  // Purpose:  Developing the functionalities of parties
/*****************************************************/

function PartiesController($rootScope, $scope, $http, $window, $q, $location, $timeout, PartiesService) {

  $scope.titleChange = '<h1>Party</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.moduleName = 'party';

   /*****************************************************/
    // Function name : partyList
    // Functionality: Party List
    // Author : Sanchari Ghosh                               
    // Created Date : 10/08/2018                                          
    // Purpose:  Developing the functionality of listing parties with the help of PartiesService
  /*****************************************************/
  $scope.partyList = function(currentPage,orderby,ordertype,searchKeyword) {  

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
    
    var partyData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 
    PartiesService.makeAsyncCall(PartiesService.partyList(partyData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.partyList;
        $scope.total = response.data.totalParties;
        $rootScope.paginationControl.currentPage  = response.data.currentPage;
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }



  /*****************************************************/
    // Function name : partyEdit
    // Functionality: View Party Edit page
    // Author : Sanchari Ghosh                               
    // Created Date : 10/08/2018                                          
    // Purpose:  Developing the functionality of view party edit page with the help of PartiesService
  /*****************************************************/ 
  $scope.partyEdit = function(formObj) {  
    var partyData = $location.absUrl();
    var partyDataSplit = partyData.split('/');
    var partyId = 'partyId='+partyDataSplit[partyDataSplit.length - 2]; 
    var currentPageNo = partyDataSplit[partyDataSplit.length - 1];

    PartiesService.makeAsyncCall(PartiesService.partyEdit(partyId))
    .then(function(response){
      if(response.data.success == "true"){

        $scope.partyId            = response.data.partyDetails.id;
        $scope.selectAddressZone  = response.data.partyDetails.address_zone_id;
        //$scope.addressZoneAddress = response.data.addressDetails.address;
        $scope.partyName          = response.data.partyDetails.party_name;
        $scope.partyDesc          = response.data.partyDetails.party_description;
        $scope.phoneNumber        = response.data.partyDetails.phone_number;
        $scope.email              = response.data.partyDetails.email;
        $scope.status             = response.data.partyDetails.status;
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
    // Function name : saveParty
    // Functionality: Save party after add or edit
    // Author : Sanchari Ghosh                               
    // Created Date : 10/08/2018                                          
    // Purpose:  Developing the functionality of saving parties with the help of PartiesService
  /*****************************************************/
  $scope.saveParty = function(formObj) {

    //var partyData = "party_name=" + $scope.partyName + "&address_zone_id=" + $scope.selectAddressZone + "&party_description=" + $scope.partyDesc + "&phone_number=" + $scope.phoneNumber + "&email=" + $scope.email + "&status=" + $scope.status; 
    var partyData = "party_name=" + $scope.partyName + "&address_zone_id=" + $scope.selectAddressZone + "&party_description=" + $scope.partyDesc + "&phone_number=" + $scope.phoneNumber + "&email=" + $scope.email + "&status=" + $scope.status + "&currentPageNo=" + $scope.currentPageNo; 


    /*for Edit and Save party*/
    if($scope.partyId) {
      partyData += '&partyId='+$scope.partyId;
    }

    PartiesService.makeAsyncCall(PartiesService.saveParty(partyData))
    .then(function(response){
      if(response.data.success == "true"){
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        window.location.href =  baseUrl + "/parties";
        if($scope.partyId) {
          if($scope.currentPageNo) {
            $rootScope.paginationControl.currentPage = $scope.currentPageNo; 
          }
          
          /*for redirecting to same page after editing is done*/
          localStorage.setItem('currentPageNo', $scope.currentPageNo);
          localStorage.setItem('currentModule', $scope.moduleName);
        }
        window.location.href =  baseUrl + "/parties";
        
      }else{  
        var msg = response.data.msg; 
        $rootScope.danger = msg;
        $rootScope.msgShow();        
      }
        },function(reason){}).finally(function(data){

        });
  }




  /*****************************************************/
    // Function name : deleteParty
    // Functionality: Delete party
    // Author : Sanchari Ghosh                               
    // Created Date : 10/08/2018                                          
    // Purpose:  Developing the functionality of deleting party with the help of PartiesService
  /*****************************************************/
  $scope.deleteParty = function(formObj,currentPage,orderby,ordertype,searchKeyword) {

    if (confirm('Do You really want to delete the data? ')) {
      var partyData = "partyId=" + formObj; 
      
      /*for Edit and Save party*/
      PartiesService.makeAsyncCall(PartiesService.deleteParty(partyData))
      .then(function(response){
        if(response.data.success == "true"){
          $scope.partyList(currentPage,orderby,ordertype,searchKeyword); /*get party list*/
          $rootScope.success = 'Deleted Succesfully';
          $rootScope.msgShow();
        }else{  
           if(response.data.success == "not_numeric") {
            var msg = 'The id must contain numeric value'; 
          } else {
            var msg = 'There are dependencies under this Party'; 
          }
          $rootScope.danger = msg;
          $rootScope.msgShow();        
        }
          },function(reason){}).finally(function(data){

          });
    }   
  }



  /*****************************************************/
    // Function name : savePartyCSV
    // Functionality: Save imported CSV file
    // Author : Sanchari Ghosh                               
    // Created Date : 10/08/2018                                          
    // Purpose:  Developing the functionality of saving imported csv file with the help of PartiesService
  /*****************************************************/
  $scope.savePartyCSV = function(formObj) {
     if ($scope.contentData === undefined) {
      $rootScope.danger = 'Wrong File Type. Please upload CSV file.'; 
      $rootScope.msgShow();  
    } else {
      var dataLength = $scope.contentData[0].split(',');
      if (dataLength.length == 6) {
        var partyData =  'partyDetailsData='+ JSON.stringify($scope.contentData); 
     
        PartiesService.makeAsyncCall(PartiesService.saveCSVParty(partyData))
          .then(function(response){
            if(response.data.success == "true"){
              $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
              window.location.href =  baseUrl + "/parties";
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
    // Function name : getPartyDetail
    // Functionality: to view Party Details
    // Author : Sanchari Ghosh                               
    // Created Date : 03/01/2019                                          
    // Purpose:  Developing the functionality of viewing Party Details with the help of PartiesService
  /*****************************************************/
  $scope.getPartyDetail = function(formObj) {
    var partyData = $location.absUrl();
    var partyDataSplit = partyData.split('/');
    var partyId = 'partyId='+partyDataSplit[partyDataSplit.length - 2]; 
    var currentPageNo = partyDataSplit[partyDataSplit.length - 1];

    localStorage.setItem('currentPageNo', currentPageNo);
    localStorage.setItem('currentModule', $scope.moduleName);
    
    
    PartiesService.makeAsyncCall(PartiesService.getPartyDetail(partyId))
    .then(function(response){ console.log(response);
      if(response.data.success == "true"){        
        $scope.record         = response.data.partyDetails.partyDetails;
        $scope.addressDetails = response.data.partyDetails.addressDetails;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }



}
