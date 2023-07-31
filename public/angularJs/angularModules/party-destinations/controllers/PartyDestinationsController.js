'use strict';

/*****************************************************/
  // PartyDestinations Controller             
  // Function name : PartyDestinationsController
  // Functionality: partyDestination list , partyDestination add, partyDestination edit, partyDestination delete, import partyDestination
  // Author : Sanchari Ghosh                                 
  // Created Date : 13/08/2018                                        
  // Purpose:  Developing the functionalities of partyDestinations
/*****************************************************/

function PartyDestinationsController($rootScope, $scope, $http, $window, $q, $location, $timeout, PartyDestinationsService) {

  $scope.titleChange = '<h1>PartyDestination</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';

   /*****************************************************/
    // Function name : partyDestinationList
    // Functionality: PartyDestination List
    // Author : Sanchari Ghosh                               
    // Created Date : 13/08/2018                                          
    // Purpose:  Developing the functionality of listing partyDestinations with the help of PartyDestinationsService
  /*****************************************************/
  $scope.partyDestinationList = function(currentPage,orderby,ordertype,searchKeyword) { 

    $scope.orderby = orderby;
    $scope.ordertype = ordertype; 
    $scope.searchKeyword = searchKeyword; 
    $scope.changedOrderType = (ordertype == 'asc')?'desc':'asc';
    
    var partyDestinationData = "currentPage=" + currentPage + "&perPageRecord=" + $scope.perPageRecord+"&orderby="+orderby+"&ordertype="+ordertype+"&searchKeyword="+searchKeyword; 
    PartyDestinationsService.makeAsyncCall(PartyDestinationsService.partyDestinationList(partyDestinationData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.partyDestinationList;
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
    // Function name : getPartyList
    // Functionality: Getting Party List
    // Author : Sanchari Ghosh                               
    // Created Date : 13/08/2018                                          
    // Purpose:  Developing the functionality of listing parties with the help of PartyDestinationsService
  /*****************************************************/
  $scope.getPartyList = function(formObj) {  

    PartyDestinationsService.makeAsyncCall(PartyDestinationsService.getPartyList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.partyRecords = response.data.partyList;
         
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : partyDestinationEdit
    // Functionality: View PartyDestination Edit page
    // Author : Sanchari Ghosh                               
    // Created Date : 13/08/2018                                          
    // Purpose:  Developing the functionality of view partyDestination edit page with the help of PartyDestinationsService
  /*****************************************************/ 
  $scope.partyDestinationEdit = function(formObj) {  
    var partyDestinationData = $location.absUrl();
    var partyDestinationDataSplit = partyDestinationData.split('/');
    var partyDestinationId = 'partyDestinationId='+partyDestinationDataSplit[partyDestinationDataSplit.length - 1]; 

    PartyDestinationsService.makeAsyncCall(PartyDestinationsService.partyDestinationEdit(partyDestinationId))
    .then(function(response){
      if(response.data.success == "true"){

        /*get party lists*/
        $scope.getPartyList();

        /*get country lists from Common Controller*/
        $rootScope.$emit("callCountryList", {}); 

        /*get state lists from Common Controller*/
        $rootScope.$emit("callStateList", response.data.partyDestinationDetails.country_id); 


        /*get city lists from Common Controller*/
        $rootScope.$emit("callCityList", response.data.partyDestinationDetails.state_id); 

        $scope.partyDestinationId   = response.data.partyDestinationDetails.id;
        $scope.selectParty          = response.data.partyDestinationDetails.party_id;
        $scope.selectCity           = response.data.partyDestinationDetails.city_id;
        $scope.selectCountry        = response.data.partyDestinationDetails.country_id;
        $scope.selectState          = response.data.partyDestinationDetails.state_id;
        $scope.address              = response.data.partyDestinationDetails.address;
        $scope.contactNumber        = response.data.partyDestinationDetails.contact_number;
        $scope.contactEmail         = response.data.partyDestinationDetails.contact_email;
        $scope.contactPerson        = response.data.partyDestinationDetails.contact_person;
        $scope.lat                  = response.data.partyDestinationDetails.lat;
        $scope.lng                  = response.data.partyDestinationDetails.lng;
        $scope.status               = response.data.partyDestinationDetails.status;
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : savePartyDestination
    // Functionality: Save partyDestination after add or edit
    // Author : Sanchari Ghosh                               
    // Created Date : 13/08/2018                                          
    // Purpose:  Developing the functionality of saving partyDestinations with the help of PartyDestinationsService
  /*****************************************************/
  $scope.savePartyDestination = function(formObj) {

    var addressData = $("#selectState option:selected").html() + '+' + $("#selectCity option:selected").html() + '+' + $("#selectCountry option:selected").html() + '+' + $scope.address;
    

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
        var partyDestinationData = "party_id=" + $scope.selectParty + "&country_id=" + $scope.selectCountry +"&state_id=" + $scope.selectState + "&city_id=" + $scope.selectCity + "&contact_number=" + $scope.contactNumber + "&contact_email=" + $scope.contactEmail +  "&contact_person=" + $scope.contactPerson + "&lat=" + $scope.lat + "&lng=" + $scope.lng + "&status=" + $scope.status + "&address=" + $scope.address; 
        /*for Edit and Save partyDestination*/
        if($scope.partyDestinationId) {
          partyDestinationData += '&partyDestinationId='+$scope.partyDestinationId;
        }

        PartyDestinationsService.makeAsyncCall(PartyDestinationsService.savePartyDestination(partyDestinationData))
        .then(function(response){
          if(response.data.success == "true"){
             
            window.location.href =  baseUrl + "/partyDestinations";
          }else{  
            var msg = 'Destination for this Party already exists';  
            $rootScope.danger = msg; 
            $rootScope.msgShow();       
          }
            },function(reason){}).finally(function(data){

            });
      })
  }




  /*****************************************************/
    // Function name : deletePartyDestination
    // Functionality: Delete partyDestination
    // Author : Sanchari Ghosh                               
    // Created Date : 13/08/2018                                          
    // Purpose:  Developing the functionality of deleting partyDestination with the help of PartyDestinationsService
  /*****************************************************/
  $scope.deletePartyDestination = function(formObj,currentPage,orderby,ordertype,searchKeyword) {

    if (confirm('Do You really want to delete the data? ')) {
      var partyDestinationData = "partyDestinationId=" + formObj; 
      
      /*for Edit and Save partyDestination*/
      PartyDestinationsService.makeAsyncCall(PartyDestinationsService.deletePartyDestination(partyDestinationData))
      .then(function(response){
        if(response.data.success == "true"){
          $scope.partyDestinationList(currentPage,orderby,ordertype,searchKeyword); /*get partyDestination list*/
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
    // Function name : savePartyDestinationCSV
    // Functionality: Save imported CSV file
    // Author : Sanchari Ghosh                               
    // Created Date : 13/08/2018                                          
    // Purpose:  Developing the functionality of saving imported csv file with the help of PartyDestinationsService
  /*****************************************************/
  $scope.savePartyDestinationCSV = function(formObj) { 

     if ($scope.contentData === undefined) {
      $rootScope.danger = 'Wrong File Type. Please upload CSV file.'; 
      $rootScope.msgShow();  
    } else {

      var dataLength = $scope.contentData[0].split(',');
      if (dataLength.length == 14) {
        var contentdata = $scope.contentData;

        var partyDestinationData =  'partyDestinationDetailsData='+ JSON.stringify($scope.contentData); 
        
        PartyDestinationsService.makeAsyncCall(PartyDestinationsService.saveCSVPartyDestination(partyDestinationData))
          .then(function(response){ console.log(response);
            if(response.data.success == "true"){
              window.location.href =  baseUrl + "/partyDestinations";
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
