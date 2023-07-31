'use strict';

/*****************************************************/
  // VendorPayment Controller             
  // Function name : VendorPaymentController
  // Functionality: Vendor Pay & Diesel list , Vendor Pay & Diesel add, Vendor Pay & Diesel edit, Vendor Pay & Diesel delete
  // Author : Sanchari Ghosh                                 
  // Created Date : 03/07/2019                                        
  // Purpose:  Developing the functionalities of Vendor Pay & Diesel
/*****************************************************/

function VendorPaymentController($rootScope, $scope, $http, $window, $q, $location, $timeout, VendorsService) {

  $scope.titleChange = '<h1>VendorPayment</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.moduleName = 'vendorPayment';



  /*****************************************************/
    // Function name : saveVendorPay
    // Functionality: Save vendorPay after add or edit
    // Author : Sanchari Ghosh                               
    // Created Date : 03/07/2019                                          
    // Purpose:  Developing the functionality of saving vendorPay with the help of VendorsService
  /*****************************************************/
  $scope.saveVendorPay = function(formObj) {

    var vendorPayData = "bill_date="+$scope.billDate +"&vendor_id=" + $scope.company +"&amount=" + $scope.amount+"&narration=" + $scope.remarks+"&currentPageNo=" + $scope.currentPageNo; 
    
    /*for Edit and Save vendorPay*/
    if($scope.vendorPayId) {
      vendorPayData += '&vendorPayId='+$scope.vendorPayId;
    }

    VendorsService.makeAsyncCall(VendorsService.saveVendorPay(vendorPayData))
    .then(function(response){
      if(response.data.success == "true"){ 
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        if($scope.vendorPayId) {
          if($scope.currentPageNo) {
            $rootScope.paginationControl.currentPage = $scope.currentPageNo; 
          }
          
          /*for redirecting to same page after editing is done*/
          localStorage.setItem('currentPageNo', $scope.currentPageNo);
          localStorage.setItem('currentModule', $scope.moduleName);
        } 
        window.location.href =  baseUrl + "/pay-to-vendor";
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;  
        $rootScope.msgShow();
      }
        },function(reason){}).finally(function(data){

        });
  }

  

  /*****************************************************/
    // Function name : getVendorList
    // Functionality: Getting vendor list 
    // Author : Sanchari Ghosh                               
    // Created Date : 03/07/2019                                          
    // Purpose:  Developing the functionality of getting lists of vendors  with the help of VendorsService
  /*****************************************************/
  $scope.getVendorList = function(){
    VendorsService.makeAsyncCall(VendorsService.getVendorList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.vendorRecords = response.data.vendorList;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
    }  

}
