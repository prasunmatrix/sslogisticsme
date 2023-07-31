'use strict';

/*****************************************************/
  // Vendors Controller             
  // Function name : VendorsController
  // Functionality: vendor list , vendor add, vendor edit, vendor delete
  // Author : Sanchari Ghosh                                 
  // Created Date : 24/12/2018                                        
  // Purpose:  Developing the functionalities of vendors
/*****************************************************/

function VendorsController($rootScope, $scope, $http, $window, $q, $location, $timeout, VendorsService) {

  $scope.titleChange      = '<h1>Vendor</h1>';
  $rootScope.successMesg  = '';
  $scope.status           = 'I';
  $scope.moduleName       = 'vendor';
  $scope.availableTags    = [];

   /*****************************************************/
    // Function name : vendorList
    // Functionality: Vendor List
    // Author : Sanchari Ghosh                               
    // Created Date : 24/12/2018                                          
    // Purpose:  Developing the functionality of listing vendors with the help of VendorsService
  /*****************************************************/
  $scope.vendorList = function(currentPage,orderby,ordertype,searchKeyword) {  

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

    
    var vendorData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 
    VendorsService.makeAsyncCall(VendorsService.vendorList(vendorData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.vendorList;
        $scope.total = response.data.totalVendors;
         $rootScope.paginationControl.currentPage  = response.data.currentPage;  
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : getQueryString
    // Functionality: get the query string for form
    // Author : Sanchari Ghosh                               
    // Created Date : 27/12/2018                                          
    // Purpose:  Developing the functionality get the query string for form
  /*****************************************************/
  $scope.getQueryString = function() {
    var vendorData = $location.absUrl();
    var vendorDataSplit = vendorData.split('?');
    if (vendorDataSplit.length > 1) {
      $scope.addNew = 1;
    } else {
      $scope.addNew = 0;
    }
  }


  /*****************************************************/
    // Function name : getVendorDetail
    // Functionality: to view Vendor Details
    // Author : Sanchari Ghosh                               
    // Created Date : 26/12/2018                                          
    // Purpose:  Developing the functionality of viewing Vendor Details with the help of VendorsService
  /*****************************************************/
  $scope.getVendorDetail = function(formObj) {  
    var vendorData = $location.absUrl();
    var vendorDataSplit = vendorData.split('/');
    var vendorId = 'vendorId='+vendorDataSplit[vendorDataSplit.length - 2]; 
    var currentPageNo = vendorDataSplit[vendorDataSplit.length - 1];

    localStorage.setItem('currentPageNo', currentPageNo);
    localStorage.setItem('currentModule', $scope.moduleName);
    
    VendorsService.makeAsyncCall(VendorsService.getVendorDetail(vendorId))
    .then(function(response){
      if(response.data.success == "true"){  
        $scope.record      = response.data.vendorDetails;
        $scope.subcatName  = response.data.subCatDetails; 
        $scope.ifsc        = response.data.ifsc_display;  
        $scope.bank        = response.data.bank_name; 
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }


  /*****************************************************/
    // Function name : vendorEdit
    // Functionality: View Vendor Edit page
    // Author : Sanchari Ghosh                               
    // Created Date : 24/12/2018                                          
    // Purpose:  Developing the functionality of view vendor edit page with the help of VendorsService
  /*****************************************************/ 
  $scope.vendorEdit = function(formObj) {  
    var vendorData = $location.absUrl();
    var vendorDataSplit = vendorData.split('/');
    var vendorId = 'vendorId='+vendorDataSplit[vendorDataSplit.length - 2]; 
    var currentPageNo = vendorDataSplit[vendorDataSplit.length - 1];

    VendorsService.makeAsyncCall(VendorsService.vendorEdit(vendorId))
    .then(function(response){
      if(response.data.success == "true"){ 
        $scope.bankNameChange = 0;
        $scope.getBankList(); /*get all bank list*/
        //$scope.getBankifscDetails(response.data.vendorDetails.bank_name); /*get ifsc details of selected bank*/

        $timeout(function () { 
          $('#selectBank').find('option[value="number:'+response.data.vendorDetails.bank_name+'"]').prop('selected', true);
          //$scope.getBankifscDetails(response.data.vendorDetails.bank_name); /*get ifsc details of selected bank*/
          
        }, 500);
        

        $scope.vendorId             = response.data.vendorDetails.id;
        $scope.vendorName           = response.data.vendorDetails.name;
        $scope.contactNumber        = response.data.vendorDetails.contact_number;
        $scope.contactEmail         = response.data.vendorDetails.contact_email;
        $scope.contactPerson        = response.data.vendorDetails.contact_person;
        $scope.panNumber            = response.data.vendorDetails.pan_number  ;
        $scope.selectBank           = response.data.vendorDetails.bank_name  ;
        $scope.ifsc                 = response.data.vendorDetails.ifsc_code;
        $scope.accountNo            = response.data.vendorDetails.account_no  ;
        $scope.accountHolderName    = response.data.vendorDetails.account_holder_name  ;
        $scope.status               = response.data.vendorDetails.status;
        $scope.currentPageNo        = currentPageNo;
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
    // Function name : saveVendor
    // Functionality: Save vendor after add or edit
    // Author : Sanchari Ghosh                               
    // Created Date : 24/12/2018                                          
    // Purpose:  Developing the functionality of saving vendors with the help of VendorsService
  /*****************************************************/
  $scope.saveVendor = function(formObj) {
    var contactEmailData = '';

    if ($scope.contactEmail === null) {
      contactEmailData = '';
    } else {
      contactEmailData = $scope.contactEmail;
    }

    var vendorData = "vendorName=" + $scope.vendorName +"&contactNumber=" + $scope.contactNumber +"&contactEmail=" + contactEmailData + "&status=" + $scope.status +  "&contact_person=" + $scope.contactPerson + "&pan_number=" + $scope.panNumber + "&bank_name=" + $scope.selectBank + "&ifsc_code=" + $scope.ifsc + "&account_no=" + $scope.accountNo + "&account_holder_name=" + $scope.accountHolderName + "&addNew=" + $scope.addNew + "&currentPageNo=" + $scope.currentPageNo; ; 

    /*for Edit and Save vendor*/
    if($scope.vendorId) {
      vendorData += '&vendorId='+$scope.vendorId;
    }

    VendorsService.makeAsyncCall(VendorsService.saveVendor(vendorData))
    .then(function(response){ console.log(response);
      if(response.data.success == "true"){
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        if($scope.vendorId) {
          if($scope.currentPageNo) {
            $rootScope.paginationControl.currentPage = $scope.currentPageNo; 
          }
          
          /*for redirecting to same page after editing is done*/
          localStorage.setItem('currentPageNo', $scope.currentPageNo);
          localStorage.setItem('currentModule', $scope.moduleName);
        }

        if(response.data.addNew == 0) {
          window.location.href =  baseUrl + "/vendors";
        } else if(response.data.addNew == 1){
          window.location.href =  baseUrl + "/view-truck-add-form?vendor="+response.data.vendor;
        }
        
      }else{  
        var msg = response.data.msg; 
        $rootScope.danger = msg;  
        $rootScope.msgShow();
      }
        },function(reason){}).finally(function(data){

        });
  }




  /*****************************************************/
    // Function name : deleteVendor
    // Functionality: Delete vendor
    // Author : Sanchari Ghosh                               
    // Created Date : 24/12/2018                                          
    // Purpose:  Developing the functionality of deleting vendor with the help of CitieService
  /*****************************************************/
  $scope.deleteVendor = function(formObj,currentPage,orderby,ordertype,searchKeyword) {

    if (confirm('Do You really want to delete the data? ')) {
      var vendorData = "vendorId=" + formObj; 
      
      /*for Edit and Save vendor*/
      VendorsService.makeAsyncCall(VendorsService.deleteVendor(vendorData))
      .then(function(response){
        if(response.data.success == "true"){
          $scope.vendorList(currentPage,orderby,ordertype,searchKeyword); /*get vendor list*/
          $rootScope.success = 'Deleted Succesfully';
          $rootScope.msgShow();         
        }else{  
          if(response.data.success == "not_numeric") {
            var msg = 'The id must contain numeric value'; 
          } else {
            var msg = 'There are dependencies under this Vendor'; 
          }
          $rootScope.danger = msg; 
          $rootScope.msgShow();       
        }
          },function(reason){}).finally(function(data){

          });
    }   
  }



  /*****************************************************/
    // Function name : getBankList
    // Functionality: to view bank List
    // Author : Sanchari Ghosh                               
    // Created Date : 25/04/2019                                         
    // Purpose:  Developing the functionality of viewing Bank Details with the help of VendorsService
  /*****************************************************/
  $scope.getBankList = function(formObj) {  
        
    VendorsService.makeAsyncCall(VendorsService.getBankList())
    .then(function(response){
      if(response.data.success == "true"){  
        $scope.bankRecords = response.data.bankList;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }



  /*****************************************************/
    // Function name : getBankifscDetails
    // Functionality: to view ifsc List with respect to bank
    // Author : Sanchari Ghosh                               
    // Created Date : 25/04/2019                                         
    // Purpose:  Developing the functionality of viewing ifsc Details with respect to bank with the help of VendorsService
  /*****************************************************/
  $scope.getBankifscDetails = function(bankId) {  

    var bankData = "bankId=" + bankId;
    if ($scope.bankNameChange == 1) {
      $scope.ifsc = ''; /*initially making the ifsc code container text field blank when the bank name dropdown is clicked and changed*/
    }
    
    VendorsService.makeAsyncCall(VendorsService.getBankifscDetails(bankData))
    .then(function(response){
      if(response.data.success == "true"){  
        $scope.ifscRecords = response.data.ifscList;

        /*storing data in array for developing auto suggestion*/
        angular.forEach($scope.ifscRecords,function(ifsc){
            $scope.availableTags.push(ifsc.display_name); 
        });

      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }


  /*****************************************************/
      // Function name : complete
      // Functionality: for auto suggested ifsc list
      // Author : Sanchari Ghosh                               
      // Created Date : 25/04/2019                                          
      // Purpose:  Developing the functionality of getting auto suggested ifsc list
    /*****************************************************/
    $scope.complete=function(string){
      var output=[];

      if (string.length >=3) {
        angular.forEach($scope.availableTags,function(ifsc){
          if(ifsc.toLowerCase().indexOf(string.toLowerCase())>=0){
            output.push(ifsc);
          }
        });
        $scope.filterIFSC = output;
      } else {
        $scope.filterIFSC = '';
      }
      
    }


  /*****************************************************/
    // Function name : fillTextbox
    // Functionality: for filling textbox with auto suggested ifsc list
    // Author : Sanchari Ghosh                               
    // Created Date : 25/04/2019                                          
    // Purpose:  Developing the functionality for filling textbox with auto suggested ifsc list
  /*****************************************************/
  $scope.fillTextbox  = function(string){
      $scope.ifsc        = string;
      $scope.filterIFSC  = null;
  }



  /*****************************************************/
    // Function name : bankChanged
    // Functionality: for identify whether the bank select box is clicked and changed
    // Author : Sanchari Ghosh                               
    // Created Date : 25/04/2019                                          
    // Purpose:  Developing the functionality for identifying whether the bank select box is clicked and changed.
    //           It is used for making the ifsc code container text field blank when the bank name dropdown is clicked and changed 
  /*****************************************************/
  $scope.bankChanged = function(){
      $scope.bankNameChange = 1;
      $scope.filterIFSC = '';
      $scope.availableTags    = [];
  }


}
