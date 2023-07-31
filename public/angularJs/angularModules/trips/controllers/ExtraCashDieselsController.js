'use strict';

/*****************************************************/
  // ExtraCashDiesels Controller             
  // Function name : ExtraCashDieselsController
  // Functionality: extra Cash & Diesel list , extra Cash & Diesel add, extra Cash & Diesel edit, extra Cash & Diesel delete
  // Author : Sanchari Ghosh                                 
  // Created Date : 02/07/2019                                        
  // Purpose:  Developing the functionalities of extra Cash & Diesel
/*****************************************************/

function ExtraCashDieselsController($rootScope, $scope, $http, $window, $q, $location, $timeout, TripsService) {

  $scope.titleChange = '<h1>ExtraCashDiesel</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.moduleName = 'extraCashDiesel';

  /*****************************************************/
    // Function name : extraCashList
    // Functionality: Extra Cash List
    // Author : Sanchari Ghosh                               
    // Created Date : 02/07/2019                                          
    // Purpose:  Developing the functionality of listing extra Cash with the help of TripsService
  /*****************************************************/
  $scope.extraCashList = function(currentPage,orderby,ordertype,searchKeyword) {  

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
    

    
    var extraCashData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 
    
    TripsService.makeAsyncCall(TripsService.extraCashList(extraCashData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.extraCashList;
        $scope.total = response.data.totalExtraCashList;
        $rootScope.paginationControl.currentPage  = response.data.currentPage;  
      }else{
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : extraCashEdit
    // Functionality: View Extra Cash Edit page
    // Author : Sanchari Ghosh                               
    // Created Date : 03/07/2019                                          
    // Purpose:  Developing the functionality of view extra Cash edit page with the help of TripsService
  /*****************************************************/ 
  $scope.extraCashEdit = function(formObj) {  
    var extraCashData = $location.absUrl();
    var extraCashDataSplit = extraCashData.split('/');
    var extraCashId = 'extraCashId='+extraCashDataSplit[extraCashDataSplit.length - 2]; 
    var currentPageNo = extraCashDataSplit[extraCashDataSplit.length - 1];

    TripsService.makeAsyncCall(TripsService.extraCashEdit(extraCashId))
    .then(function(response){ console.log(response.data.extraCashDetails[0]);
      if(response.data.success == "true"){

        $scope.getCashPlantList();
        $scope.getCashVendorList();
        $scope.getEditTruckList(response.data.extraCashDetails[0].vendor_id,response.data.extraCashDetails[0].truck_id);

        $scope.extraCashId    = response.data.extraCashDetails[0].id;
        $scope.billDate       = Date.parse(response.data.extraCashDetails[0].bill_date,"dd-mm-yyyy").toString("dd-MM-yyyy");
        $scope.selectPlant    = response.data.extraCashDetails[0].plant_id;
        $scope.company        = response.data.extraCashDetails[0].vendor_id;
        $scope.selectTruck    = response.data.extraCashDetails[0].truck_id;
        $scope.amount         = response.data.extraCashDetails[0].extra_cash;
        $scope.remarks        = response.data.extraCashDetails[0].narration;
        $scope.currentPageNo  = currentPageNo;
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
    // Function name : saveExtraCash
    // Functionality: Save extraCash after add or edit
    // Author : Sanchari Ghosh                               
    // Created Date : 03/07/2019                                          
    // Purpose:  Developing the functionality of saving extraCash with the help of TripsService
  /*****************************************************/
  $scope.saveExtraCash = function(formObj) {

    var extraCashData = "bill_date="+$scope.billDate+"&plant_id=" + $scope.selectPlant+"&vendor_id=" + $scope.company+"&truck_id=" + $scope.selectTruck+"&amount=" + $scope.amount+"&narration=" + $scope.remarks+"&currentPageNo=" + $scope.currentPageNo; 
    
    /*for Edit and Save extraCash*/
    if($scope.extraCashId) {
      extraCashData += '&extraCashId='+$scope.extraCashId;
    }

    TripsService.makeAsyncCall(TripsService.saveExtraCash(extraCashData))
    .then(function(response){
      if(response.data.success == "true"){ 
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        if($scope.extraCashId) {
          if($scope.currentPageNo) {
            $rootScope.paginationControl.currentPage = $scope.currentPageNo; 
          }
          
          /*for redirecting to same page after editing is done*/
          localStorage.setItem('currentPageNo', $scope.currentPageNo);
          localStorage.setItem('currentModule', $scope.moduleName);
        } 
        window.location.href =  baseUrl + "/extra-cash-list";
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;  
        $rootScope.msgShow();
      }
        },function(reason){}).finally(function(data){

        });
  }




  /*****************************************************/
    // Function name : deleteExtraCash
    // Functionality: Delete extra Cash
    // Author : Sanchari Ghosh                               
    // Created Date : 02/07/2019                                          
    // Purpose:  Developing the functionality of deleting extra Cash with the help of TripsService
  /*****************************************************/
  $scope.deleteExtraCash = function(formObj,currentPage,orderby,ordertype,searchKeyword) {

    if (confirm('Do You really want to delete the data? ')) {
      var extraCashData = "extraCashId=" + formObj; 
      
      TripsService.makeAsyncCall(TripsService.deleteExtraCash(extraCashData))
      .then(function(response){
        if(response.data.success == "true"){
          $scope.extraCashList(currentPage,orderby,ordertype,searchKeyword); /*get extraCash list*/
          $rootScope.success = 'Deleted Succesfully';
          $rootScope.msgShow();         
        }else{  
          if(response.data.success == "not_numeric") {
            var msg = 'The id must contain numeric value'; 
          }
          
          $rootScope.danger = msg; 
          $rootScope.msgShow();       
        }
          },function(reason){}).finally(function(data){

          });
    }   
  }


  /*****************************************************/
    // Function name : extraDieselList
    // Functionality: Extra Diesel List
    // Author : Sanchari Ghosh                               
    // Created Date : 02/07/2019                                          
    // Purpose:  Developing the functionality of listing extra Diesel with the help of TripsService
  /*****************************************************/
  $scope.extraDieselList = function(currentPage,orderby,ordertype,searchKeyword) {  

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
    

    
    var extraDieselData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 
    
    TripsService.makeAsyncCall(TripsService.extraDieselList(extraDieselData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.extraDieselList;
        $scope.total = response.data.totalExtraDieselList;
        $rootScope.paginationControl.currentPage  = response.data.currentPage;  
      }else{
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : extraDieselEdit
    // Functionality: View Extra Diesel Edit page
    // Author : Sanchari Ghosh                               
    // Created Date : 02/07/2019                                          
    // Purpose:  Developing the functionality of view extra Diesel edit page with the help of TripsService
  /*****************************************************/ 
  $scope.extraDieselEdit = function(formObj) {  
    var extraDieselData = $location.absUrl();
    var extraDieselDataSplit = extraDieselData.split('/');
    var extraDieselId = 'extraDieselId='+extraDieselDataSplit[extraDieselDataSplit.length - 2]; 
    var currentPageNo = extraDieselDataSplit[extraDieselDataSplit.length - 1];

    TripsService.makeAsyncCall(TripsService.extraDieselEdit(extraDieselId))
    .then(function(response){
      if(response.data.success == "true"){

        $scope.getCashPlantList();
        $scope.getCashVendorList();
        $scope.getDieselPetrolPumpList();
        $scope.getEditTruckList(response.data.extraDieselDetails[0].vendor_id,response.data.extraDieselDetails[0].truck_id);

        $scope.extraDieselId      = response.data.extraDieselDetails[0].id;
        $scope.billDate           = Date.parse(response.data.extraDieselDetails[0].bill_date,"dd-mm-yyyy").toString("dd-MM-yyyy");
        $scope.selectPlant        = response.data.extraDieselDetails[0].plant_id;
        $scope.company            = response.data.extraDieselDetails[0].vendor_id;
        $scope.selectTruck        = response.data.extraDieselDetails[0].truck_id;
        $scope.selectPetrolPump   = response.data.extraDieselDetails[0].petrol_pump_id;
        $scope.amount             = response.data.extraDieselDetails[0].extra_diesel;
        $scope.remarks            = response.data.extraDieselDetails[0].narration;
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
    // Function name : saveExtraDiesel
    // Functionality: Save extraDiesel after add or edit
    // Author : Sanchari Ghosh                               
    // Created Date : 03/07/2019                                          
    // Purpose:  Developing the functionality of saving extraDiesel with the help of TripsService
  /*****************************************************/
  $scope.saveExtraDiesel = function(formObj) {

    var extraDieselData = "bill_date="+$scope.billDate+"&plant_id=" + $scope.selectPlant+"&vendor_id=" + $scope.company+"&petrol_pump_id="+$scope.selectPetrolPump+"&truck_id=" + $scope.selectTruck+"&amount=" + $scope.amount+"&narration=" + $scope.remarks+"&currentPageNo=" + $scope.currentPageNo; 
    
    /*for Edit and Save extraCash*/
    if($scope.extraDieselId) {
      extraDieselData += '&extraDieselId='+$scope.extraDieselId;
    }

    TripsService.makeAsyncCall(TripsService.saveExtraDiesel(extraDieselData))
    .then(function(response){
      if(response.data.success == "true"){ 
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        if($scope.extraDieselId) {
          if($scope.currentPageNo) {
            $rootScope.paginationControl.currentPage = $scope.currentPageNo; 
          }
          
          /*for redirecting to same page after editing is done*/
          localStorage.setItem('currentPageNo', $scope.currentPageNo);
          localStorage.setItem('currentModule', $scope.moduleName);
        } 
        window.location.href =  baseUrl + "/extra-diesel-list";
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;  
        $rootScope.msgShow();
      }
        },function(reason){}).finally(function(data){

      });
  }




  /*****************************************************/
    // Function name : deleteExtraDiesel
    // Functionality: Delete extra Diesel
    // Author : Sanchari Ghosh                               
    // Created Date : 02/07/2019                                          
    // Purpose:  Developing the functionality of deleting extra Diesel with the help of TripsService
  /*****************************************************/
  $scope.deleteExtraDiesel = function(formObj,currentPage,orderby,ordertype,searchKeyword) {

    if (confirm('Do You really want to delete the data? ')) {
      var extraDieselData = "extraDieselId=" + formObj; 
      
      TripsService.makeAsyncCall(TripsService.deleteExtraDiesel(extraDieselData))
      .then(function(response){
        if(response.data.success == "true"){
          $scope.extraDieselList(currentPage,orderby,ordertype,searchKeyword); /*get extraDiesel list*/
          $rootScope.success = 'Deleted Succesfully';
          $rootScope.msgShow();         
        }else{  
          if(response.data.success == "not_numeric") {
            var msg = 'The id must contain numeric value'; 
          }
          
          $rootScope.danger = msg; 
          $rootScope.msgShow();       
        }
          },function(reason){}).finally(function(data){

          });
    }   
  }



  /*****************************************************/
    // Function name : getTripPlantList
    // Functionality: Getting Plant List
    // Author : Sanchari Ghosh                               
    // Created Date : 02/07/2019                                          
    // Purpose:  Developing the functionality of listing plants with the help of TripsService
  /*****************************************************/
  $scope.getCashPlantList = function() {  

    TripsService.makeAsyncCall(TripsService.getTripPlantList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.plantRecords = response.data.plantList;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



 /*****************************************************/
    // Function name : viewCashTruckList
    // Functionality: Getting Vehicle list with respect to Vendor
    // Author : Sanchari Ghosh                               
    // Created Date : 02/07/2019                                          
    // Purpose:  Developing the functionality of getting lists of vehicles  with the help of TripsService
  /*****************************************************/
  $scope.viewCashTruckList = function(keyname){
        var vendorData = "vendorId=" + keyname ;
         TripsService.makeAsyncCall(TripsService.viewCashTruckList(vendorData))
        .then(function(response){
          if(response.data.success == "true"){
            $scope.truckRecords = response.data.truckList;
          }else{  
            var msg = 'Error'; 
            //$rootScope.danger = msg;        
          }
            },function(reason){}).finally(function(data){

        });
    }


  /*****************************************************/
    // Function name : getCashVendorList
    // Functionality: Getting vendor list 
    // Author : Sanchari Ghosh                               
    // Created Date : 02/07/2019                                          
    // Purpose:  Developing the functionality of getting lists of vendors  with the help of TripsService
  /*****************************************************/
  $scope.getCashVendorList = function(){
    TripsService.makeAsyncCall(TripsService.getTripVendorList())
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




  /*****************************************************/
    // Function name : getDieselPetrolPumpList
    // Functionality: Getting Petrol Pump List
    // Author : Sanchari Ghosh                               
    // Created Date : 03/07/2019                                          
    // Purpose:  Developing the functionality of listing petrol pumps with the help of TripsService
  /*****************************************************/
  $scope.getDieselPetrolPumpList = function(formObj) {  

    TripsService.makeAsyncCall(TripsService.getTripPetrolPumpList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.petrolPumpRecords = response.data.petrolPumpList;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



   /*****************************************************/
    // Function name : getEditTruckList
    // Functionality: Getting Truck List
    // Author : Sanchari Ghosh                               
    // Created Date : 03/07/2019                                          
    // Purpose:  Developing the functionality of getting lists of trucks with the help of TripsService
  /*****************************************************/
  $scope.getEditTruckList= function(vendor,truck) { 
    var truckData = "vendor=" + vendor + "&truck=" + truck;
    TripsService.makeAsyncCall(TripsService.getEditTruckList(truckData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.truckRecords = response.data.truckList;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



}
