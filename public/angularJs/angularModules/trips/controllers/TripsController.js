'use strict';

/*****************************************************/
  // Trips Controller             
  // Function name : TripsController
  // Functionality: Trip list , Trip add, Trip edit, trip details, trip close, uploading POD for trip, edit request for ADV & DSL amount, generating trip reports
  // Author : Sanchari Ghosh                                 
  // Created Date : 31/08/2018                                        
  // Purpose:  Developing the functionalities of Trips
/*****************************************************/

function TripsController($rootScope, $scope, $http, $window, $q, $location, $timeout, TripsService, fileUploadService) {

  $scope.titleChange      = '<h1>Trip</h1>';
  $rootScope.successMesg  = '';
  $scope.status           = 'I';
  $scope.moduleName       = 'trip';
  $scope.availableTags    = [];

 
  $scope.selectedSubCat = [];
  $scope.selected_baseline_settings = {
    template: '<b>{{option.name}}</b>',
    searchField: 'name',
    enableSearch: true,
    selectedToTop: true 
  };
      
  $scope.selected_baselines_customTexts = {buttonDefaultText: 'Select Subcategory'};



  /*****************************************************/
    // Function name : tripList
    // Functionality: Trip List
    // Author : Sanchari Ghosh                               
    // Created Date : 31/08/2018                                          
    // Purpose:  Developing the functionality of listing Trips with the help of TripsService
  /*****************************************************/
  $scope.tripList = function(currentPage,orderby,ordertype,searchKeyword) { 

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
    
    var tripData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 

    TripsService.makeAsyncCall(TripsService.tripList(tripData))
    .then(function(response){
      if(response.data.success == "true"){           
        $scope.records      = response.data.tripList;
        $scope.total        = response.data.totalTrips;
        $scope.totalQty     = response.data.tripList[0].totalQty;
        $rootScope.paginationControl.currentPage  = response.data.currentPage;  
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }




  /*****************************************************/
    // Function name : getTripDetail
    // Functionality: to view Trip Details
    // Author : Sanchari Ghosh                               
    // Created Date : 31/08/2018                                          
    // Purpose:  Developing the functionality of viewing Trip Details with the help of TripsService
  /*****************************************************/
  $scope.getTripDetail = function(formObj) {  
    var tripData = $location.absUrl();
    var tripDataSplit = tripData.split('/');
    var tripId = 'tripId='+tripDataSplit[tripDataSplit.length - 2]; 
    var currentPageNo = tripDataSplit[tripDataSplit.length - 1];

    localStorage.setItem('currentPageNo', currentPageNo);
    localStorage.setItem('currentModule', $scope.moduleName);
    
    TripsService.makeAsyncCall(TripsService.getTripDetail(tripId))
    .then(function(response){
      if(response.data.success == "true"){  
        $scope.record      = response.data.tripDetails;
        $scope.subcatName  = response.data.subCatDetails; 
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }




  /*****************************************************/
    // Function name : tripEdit
    // Functionality: View Trip Edit page
    // Author : Sanchari Ghosh                               
    // Created Date : 05/09/2018                                          
    // Purpose:  Developing the functionality of view Trip edit page with the help of TripsService
  /*****************************************************/ 
  $scope.tripEdit = function(formObj) {  
    var tripData = $location.absUrl();
    var tripDataSplit = tripData.split('/');
    var tripId = 'tripId='+tripDataSplit[tripDataSplit.length - 2]; 
    var currentPageNo = tripDataSplit[tripDataSplit.length - 1];
    var subCategoryIds = [];

    TripsService.makeAsyncCall(TripsService.tripEdit(tripId))
    .then(function(response){
      if(response.data.success == "true"){

        /*get plant lists*/
        $scope.getTripPlantList();


        /*get selected  party's address zone*/
        $scope.viewTripPartyAddressZone(response.data.tripDetails.party_id);


        /*get petrol pump lists*/
        $scope.getTripPetrolPumpList();


        /*get category lists*/
        $scope.getTripCategoryList();


        /*get subcategory lists*/
        $scope.viewTripSubcatList(response.data.tripDetails.category_id);

        /*get vendor list*/
        $scope.getTripVendorList();

        /*get truck lists*/
        $scope.getEditTripTruckList(response.data.vendorList,response.data.tripDetails.truck_id);

        /*get address zone list*/
        $scope.getAddressZoneDetail();

        /*get all bank list*/
        $scope.getBankList(); 
        
        $timeout(function () { 
          $scope.getAddressWisePartyDetails($scope.selectAddress); /*reload the parties*/
        }, 3000);
        


        $scope.tripId              = response.data.tripDetails.id;
        $scope.disableTripType     = response.data.tripDetails.trip_type;
        $scope.tripType            = response.data.tripDetails.trip_type;
        $scope.tripDate            = Date.parse(response.data.tripDetails.trip_date,"dd-mm-yyyy").toString("dd-MM-yyyy");
        $scope.lrNo                = response.data.tripDetails.lr_no;
        $scope.selectCategory      = response.data.tripDetails.category_id;
        $scope.selectSubCategory   = parseInt(response.data.tripDetails.subcategory_id);
        $scope.selectPlant         = response.data.tripDetails.plant_id;
        $scope.tripInvoiceNo       = response.data.tripDetails.invoice_challan_no;
        $scope.shipmentNo          = response.data.tripDetails.do_shipment_no;
        $scope.selectParty         = response.data.tripDetails.party_id;
        $scope.company             = response.data.vendorList;
        $scope.selectTruck         = response.data.tripDetails.truck_id;
        $scope.quantity            = response.data.tripDetails.quantity;
        $scope.truckOwner          = response.data.tripDetails.truck_owner;
        $scope.truckDriverName     = response.data.tripDetails.truck_driver_name;
        $scope.truckDriverPhoneNo  = response.data.tripDetails.truck_driver_phone_number;

        if (response.data.tripDetails.truck_driver_email == 'null') {
          $scope.truckDriverEmail    = '';
        } else {
          $scope.truckDriverEmail    = response.data.tripDetails.truck_driver_email;
        }
        
        $scope.selectPetrolPump    = response.data.tripDetails.petrol_pump_id;
        $scope.advanceAmount       = response.data.tripDetails.advance_amount;
        $scope.dieselAmount        = response.data.tripDetails.diesel_amount;
        $scope.tripStatus          = response.data.tripDetails.trip_status;
        $scope.GPStripStatus       = response.data.tripDetails.GPS_trip_status;
        $scope.status              = response.data.tripDetails.status;
        $scope.description         = response.data.tripDetails.description;
        $scope.additional1         = response.data.tripDetails.additional1;
        $scope.additional2         = response.data.tripDetails.additional2;
        $scope.additional3         = response.data.tripDetails.additional3;
        $scope.ADVeditReqCount     = response.data.ADVeditReqCount;
        $scope.DSLeditReqCount     = response.data.DSLeditReqCount;
        $scope.currentPageNo       = currentPageNo;
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
    // Function name : uploadPODFile
    // Functionality: Uploading POD
    // Author : Sanchari Ghosh                               
    // Created Date : 04/09/2018                                          
    // Purpose:  Developing the functionality of uploading POD
  /*****************************************************/
  $scope.uploadPODFile = function (file) { 
        var file = file;
        var uploadingUrl = baseUrl + '/upload-pod-file';

        var uploadUrl = uploadingUrl, 
            promise = fileUploadService.uploadFileToUrl(file, uploadUrl);

        return promise.then(function (response) {
            var fileName = response.data; 
            $scope.podFileName = fileName;
            return response.data;
        }, function () {
            $scope.serverResponse = 'An error has occurred';
        }) 
    };


  /*****************************************************/
    // Function name : saveTrip
    // Functionality: Save Trip after add or edit
    // Author : Sanchari Ghosh                               
    // Created Date : 04/09/2018                                          
    // Purpose:  Developing the functionality of saving Trips with the help of TripsService
  /*****************************************************/
  $scope.saveTrip = function(formObj) {
    var selectedSubCatArray = [];
    var uniqueSubCat  = [];
    var commaSeperatedSubcat = '';
    var tripData = "trip_date=" + $scope.tripDate + '&tripType=' + $scope.tripType + "&lr_no=" + $scope.lrNo + "&category_id=" + $scope.selectCategory + "&subcategory_id=" + $scope.selectSubCategory + "&plant_id=" + $scope.selectPlant + "&invoice_challan_no=" + $scope.tripInvoiceNo + "&do_shipment_no=" + $scope.shipmentNo + "&party_id=" + $scope.selectParty + "&company=" + $scope.company + "&truck_id=" + $scope.selectTruck + "&quantity=" + $scope.quantity + "&truck_owner=" + $scope.truckOwner + "&petrol_pump_id=" + $scope.selectPetrolPump + "&advance_amount=" + $scope.advanceAmount + "&diesel_amount=" + $scope.dieselAmount + "&trip_status=" + $scope.tripStatus + "&status=" + $scope.status + "&description=" + $scope.description + "&currentPageNo=" + $scope.currentPageNo; ; 

    if ($scope.truckDriverPhoneNo === undefined) {
      tripData += "&truck_driver_phone_number=";
    } else {
      tripData += "&truck_driver_phone_number=" + $scope.truckDriverPhoneNo;
    }


    if ($scope.truckDriverEmail === undefined) {
      tripData += "&truck_driver_email=";
    } else {
      tripData += "&truck_driver_email=" + $scope.truckDriverEmail;
    }

    if ($scope.additional1 === undefined) {
      tripData += "&additional1=";
    } else {
      tripData += "&additional1=" + $scope.additional1;
    }

    if ($scope.additional2 === undefined) {
      tripData += "&additional2=";
    } else {
      tripData += "&additional2=" + $scope.additional2;
    }
    
    if ($scope.additional3 === undefined) {
      tripData += "&additional3=";
    } else {
      tripData += "&additional3=" + $scope.additional3;
    }

    if ($scope.truckDriverName === undefined) {
      tripData += "&truck_driver_name=";
    } else {
      tripData += "&truck_driver_name=" + $scope.truckDriverName;
    }


    /*for Edit and Save Trip*/
    if($scope.tripId) {
      tripData += '&tripId='+$scope.tripId;
    }
    
    TripsService.makeAsyncCall(TripsService.saveTrip(tripData))
      .then(function(response){
        if(response.data.success == "true"){
          $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
          if($scope.tripId) {
            if($scope.currentPageNo) {
              $rootScope.paginationControl.currentPage = $scope.currentPageNo; 
            }
            
            /*for redirecting to same page after editing is done*/
            localStorage.setItem('currentPageNo', $scope.currentPageNo);
            localStorage.setItem('currentModule', $scope.moduleName);
          }
          window.location.href =  baseUrl + "/trips";
        }else{  
          var msg = '';
          $rootScope.danger = msg;  
          $rootScope.msgShow();      
        }
          },function(reason){}).finally(function(data){

          });
  }



  /*****************************************************/
    // Function name : getTripPlantList
    // Functionality: Getting Plant List
    // Author : Sanchari Ghosh                               
    // Created Date : 03/09/2018                                          
    // Purpose:  Developing the functionality of listing plants with the help of TripsService
  /*****************************************************/
  $scope.getTripPlantList = function() {  

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
    // Function name : getTripPartyList
    // Functionality: Getting Trip Party List
    // Author : Sanchari Ghosh                               
    // Created Date : 03/09/2018                                          
    // Purpose:  Developing the functionality of listing parties with the help of TripsService
  /*****************************************************/
  $scope.getTripPartyList = function(formObj) {  

    TripsService.makeAsyncCall(TripsService.getTripPartyList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.partyRecords = response.data.partyList;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }




  /*****************************************************/
    // Function name : getTripPetrolPumpList
    // Functionality: Getting Petrol Pump List
    // Author : Sanchari Ghosh                               
    // Created Date : 03/09/2018                                          
    // Purpose:  Developing the functionality of listing petrol pumps with the help of TripsService
  /*****************************************************/
  $scope.getTripPetrolPumpList = function(formObj) {  

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
    // Function name : getEditTripTruckList
    // Functionality: Getting Truck List
    // Author : Sanchari Ghosh                               
    // Created Date : 05/09/2018                                          
    // Purpose:  Developing the functionality of getting lists of trucks with the help of TripsService
  /*****************************************************/
  $scope.getEditTripTruckList= function(vendor,truck) { 
    var truckData = "vendor=" + vendor + "&truck=" + truck + "&tripType=" + $scope.tripType;
    TripsService.makeAsyncCall(TripsService.getEditTripTruckList(truckData))
    .then(function(response){ console.log(response);
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
  // Function name : viewTruckOwnerList
  // Functionality: get lists of truck owners
  // Author : Sanchari Ghosh                               
  // Created Date : 04/09/2018                                        
  // Purpose:  Developing the functionality of get the lists of truck owners with the help of TripsService
  /*****************************************************/
  $scope.viewTruckOwner = function(keyname){
        var truckData = "vendorId=" + keyname;
         TripsService.makeAsyncCall(TripsService.getTruckOwner(truckData))
        .then(function(response){
          if(response.data.success == "true"){
            $scope.truckOwner      = response.data.ownerName;
          }else{  
            var msg = 'Error'; 
            //$rootScope.danger = msg;        
          }
            },function(reason){}).finally(function(data){

        });
    }


  /*****************************************************/
  // Function name : podPopup
  // Functionality: assign record id in pop up and getting trip wise POD
  // Author : Sanchari Ghosh                               
  // Created Date : 04/09/2018                                        
  // Purpose:  Developing the functionality of assigning record id and current page in pop up and getting trip wise POD
  /*****************************************************/
  $scope.podPopup = function(keyname,currentPageNo){
    $scope.dataId = keyname; 
    $scope.uploadPODCurrentPage = currentPageNo;
    $scope.deletePODCurrentPage = currentPageNo;

    var tripData = 'tripId='+keyname;
    TripsService.makeAsyncCall(TripsService.tripWisePOD(tripData))
        .then(function(response){
          if(response.data.success == "true"){
            $scope.podRecords      = response.data.podRecords;
            $scope.latestPODStatus =  response.data.latestPODStatus;
          }else{  
            var msg = 'Error'; 
            //$rootScope.danger = msg;        
          }
            },function(reason){}).finally(function(data){

        });
  }


  /*****************************************************/
  // Function name : tripLatestPOD
  // Functionality: get latest POD file of a trip
  // Author : Sanchari Ghosh                               
  // Created Date : 14/03/2019                                        
  // Purpose:  Developing the functionality of getting latest POD file of a trip and assigning current page
  /*****************************************************/
  $scope.podApprovePopup = function(keyname,currentPageNo){
    $scope.dataId = keyname;
    $scope.approvalModalCurrentPage = currentPageNo;

    var tripData = 'tripId='+keyname;
    TripsService.makeAsyncCall(TripsService.tripLatestPOD(tripData))
        .then(function(response){
          if(response.data.success == "true"){
            $scope.podFile      = response.data.podFile;
          }else{  
            var msg = 'Error'; 
            //$rootScope.danger = msg;        
          }
            },function(reason){}).finally(function(data){

        });
  }




  /*****************************************************/
  // Function name : tripPopup
  // Functionality: assign record id in pop up
  // Author : Sanchari Ghosh                               
  // Created Date : 27/02/2019                                        
  // Purpose:  Developing the functionality of assigning record id and current page in pop up
  /*****************************************************/
  $scope.tripPopup = function(keyname,currentPageNo){
    $scope.tripDataId = keyname;
    $scope.closeTripCurrentPage = currentPageNo;
  }


  /*****************************************************/
  // Function name : advEditRequestPopup
  // Functionality: assign record id in pop up
  // Author : Sanchari Ghosh                               
  // Created Date : 28/02/2019                                        
  // Purpose:  Developing the functionality of assigning record id and current page in pop up
  /*****************************************************/
  $scope.advEditRequestPopup = function(keyname,currentPageNo){
    $scope.advEditRequestDataId = keyname;
    $scope.advEditRequestCurrentPage = currentPageNo;
  }


  /*****************************************************/
  // Function name : dslEditRequestPopup
  // Functionality: assign record id in pop up
  // Author : Sanchari Ghosh                               
  // Created Date : 28/02/2019                                        
  // Purpose:  Developing the functionality of assigning record id and current page in pop up
  /*****************************************************/
  $scope.dslEditRequestPopup = function(keyname,currentPageNo){
    $scope.dslEditRequestDataId = keyname;
    $scope.dslEditRequestCurrentPage = currentPageNo;
  }




  /*****************************************************/
  // Function name : savePOD
  // Functionality: save POD for a trip
  // Author : Sanchari Ghosh                               
  // Created Date : 04/09/2018                                        
  // Purpose:  Developing the functionality of saving POD for a trip
  /*****************************************************/
  $scope.savePOD = function(formObj) {

    var PODInfo  = '';
      var tripData = "";
      var podFile  = $scope.podFile;

      /*for Edit and Save Trip*/
      if($scope.dataId) {
        tripData += '&tripId='+$scope.dataId;
      }

      var allPromises = [];

      /*uploading POD files*/
      if ($scope.podFile !== undefined) {
          allPromises.push(new Promise((resolve, reject)=>{
            $scope.uploadPODFile(podFile).then((data)=>{
              PODInfo  +=  "&pod_file=" + data;
              tripData +=  PODInfo;
              resolve(PODInfo);
            })
          }))
      } else if ($scope.podFileName !== undefined) {
        PODInfo  +=  "&pod_file=" + $scope.registrationFileName;
        tripData +=  PODInfo;
      } else {
        PODInfo  +=  "&pod_file=" + '';
        tripData +=  PODInfo;
      }


      Promise.all(allPromises).then((resolveData)=>{
        TripsService.makeAsyncCall(TripsService.savePOD(tripData))
        .then(function(response){
          if(response.data.success == "true"){
            localStorage.setItem('currentPageNo', $scope.uploadPODCurrentPage);
            localStorage.setItem('currentModule', $scope.moduleName);
            $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
            window.location.href =  baseUrl + "/trips";
          }else{  
            var msg = '';
            $rootScope.danger = msg;  
            $rootScope.msgShow();      
          }
            },function(reason){}).finally(function(data){

            });
      })
   }




  /*****************************************************/
  // Function name : ADVeditRequest
  // Functionality: Edit Request for Advance Amount
  // Author : Sanchari Ghosh                               
  // Created Date : 04/09/2018                                        
  // Purpose:  Developing the functionality of Edit Request for Advance Amount
  /*****************************************************/
  $scope.ADVeditRequest = function(){
      var tripData = '&tripId='+$scope.advEditRequestDataId+'&advanceAmount='+$scope.advAmountPopUp;
      TripsService.makeAsyncCall(TripsService.ADVeditRequest(tripData))
       .then(function(response){
        if(response.data.success == "true"){
          localStorage.setItem('currentPageNo', $scope.advEditRequestCurrentPage);
          localStorage.setItem('currentModule', $scope.moduleName);
          $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
          $scope.truckRecords = response.data.truckList;
          window.location.href =  baseUrl + "/trips";
        }else{  
          var msg = 'Error'; 
          //$rootScope.danger = msg;        
        }
          },function(reason){}).finally(function(data){

          });

  }




  /*****************************************************/
  // Function name : DSLeditRequest
  // Functionality: Edit Request for Diesel Amount
  // Author : Sanchari Ghosh                               
  // Created Date : 04/09/2018                                        
  // Purpose:  Developing the functionality of Edit Request for Diesel Amount
  /*****************************************************/
  $scope.DSLeditRequest = function(keyname){
    var tripData = '&tripId='+$scope.dslEditRequestDataId+'&dslAmount='+$scope.dslAmountPopUp;
      TripsService.makeAsyncCall(TripsService.DSLeditRequest(tripData))
       .then(function(response){
        if(response.data.success == "true"){
          localStorage.setItem('currentPageNo', $scope.dslEditRequestCurrentPage);
          localStorage.setItem('currentModule', $scope.moduleName);
          $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
          $scope.truckRecords = response.data.truckList;
          window.location.href =  baseUrl + "/trips";
        }else{  
          var msg = 'Error'; 
          //$rootScope.danger = msg;        
        }
          },function(reason){}).finally(function(data){

          });
    
  }



  /*****************************************************/
    // Function name : closeTrip
    // Functionality: Close Trip
    // Author : Sanchari Ghosh                               
    // Created Date : 12/09/2018                                          
    // Purpose:  Developing the functionality of closing Trip
  /*****************************************************/
  $scope.closeTrip = function() {
    //if (confirm('Do you really want to close the Trip?')) {
      //var tripData = "tripId=" + tripId ; 

      
      var tripData = '&tripId='+$scope.tripDataId+'&closingReason='+$scope.closingReason;
      

      TripsService.makeAsyncCall(TripsService.closeTrip(tripData))
      .then(function(response){
        if(response.data.success == "true"){
          localStorage.setItem('currentPageNo', $scope.closeTripCurrentPage);
          localStorage.setItem('currentModule', $scope.moduleName);
          $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
          window.location.href =  baseUrl + "/trips";  
          var msg = 'Trip Closed succesfully'; 
          $rootScope.success = msg;  
          $rootScope.msgShow();
          
        }else{  
          var msg = 'Something went wrong';
          $rootScope.tripCloseDanger = msg;  
          $rootScope.msgShow();        
        }
          },function(reason){}).finally(function(data){

          });
    //}
  } 


  /*****************************************************/
    // Function name : getCurrentDate
    // Functionality: set current date as default in the datepicker
    // Author : Sanchari Ghosh                               
    // Created Date : 13/09/2018                                          
    // Purpose:  Developing the functionality of setting current date as default in the datepicker
  /*****************************************************/
  $scope.getCurrentDate = function(){
    var date        = new Date();
    var today       = date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate();
    $scope.tripDate = Date.parse(today,"dd-mm-yyyy").toString("dd-MM-yyyy");;
  }





  /*****************************************************/
    // Function name : getTripCategoryList
    // Functionality: Getting Category list
    // Author : Sanchari Ghosh                               
    // Created Date : 03/10/2018                                          
    // Purpose:  Developing the functionality of getting lists of category  with the help of TripsService
  /*****************************************************/
  $scope.getTripCategoryList= function() { 
    TripsService.makeAsyncCall(TripsService.getTripCategoryList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.categoryRecords = response.data.categoryList;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }






  /*****************************************************/
    // Function name : viewTripSubcatList
    // Functionality: Getting SubCategory list with respect to Category
    // Author : Sanchari Ghosh                               
    // Created Date : 03/10/2018                                          
    // Purpose:  Developing the functionality of getting lists of subcategory  with the help of TripsService
  /*****************************************************/
  $scope.viewTripSubcatList = function(keyname){
        var catData = "catId=" + keyname;
         TripsService.makeAsyncCall(TripsService.viewTripSubcatList(catData))
        .then(function(response){
          if(response.data.success == "true"){
            $scope.resultsWithInfo      = response.data.subcategoryList;
            $scope.subcategoryRecords   = response.data.subcategoryList;
          }else{  
            var msg = 'Error'; 
            //$rootScope.danger = msg;        
          }
            },function(reason){}).finally(function(data){

        });
    }


  
  /*****************************************************/
    // Function name : getSelectedSubCatDetails
    // Functionality: Getting details of selected Subcategories
    // Author : Sanchari Ghosh                               
    // Created Date : 08/10/2018                                          
    // Purpose:  Developing the functionality of getting details of selected subcategories  with the help of TripsService
  /*****************************************************/  
  $scope.getSelectedSubCatDetails = function(keyname)  {
      var subcatData = "subCatId=" + keyname;
      TripsService.makeAsyncCall(TripsService.getSelectedSubCatDetails(subcatData))
        .then(function(response){
          if(response.data.success == "true"){
            $scope.selected_baseline_settings = {};
            var selectedDataIndex = [];

            /*get the selected index value of main subcategory listing*/
            for (var i = 0; i < $scope.resultsWithInfo.length; i++) {
              for (var j=0; j < response.data.subcategoryList.length; j++) {
                if ($scope.resultsWithInfo[i].id == response.data.subcategoryList[j].id) {
                  selectedDataIndex.push($scope.resultsWithInfo[i]);
                }
              }
            }

            /*assigning selected index*/
            $scope.selectedSubCat = selectedDataIndex;

          }else{  
            var msg = 'Error'; 
            //$rootScope.danger = msg;        
          }
            },function(reason){}).finally(function(data){

        });
  }





/*****************************************************/
  // Function name : savePlantEditRequest
  // Functionality: save Plant Edit Request
  // Author : Sanchari Ghosh                               
  // Created Date : 10/10/2018                                          
  // Purpose:  Developing the functionality of saving Plant Edit Request
/*****************************************************/
  $scope.savePlantEditRequest = function(tripId,advanceAmount,plantId){
        var tripData = "tripId=" + tripId + "&advance_amount=" + advanceAmount + "&plantId=" + plantId ;
         TripsService.makeAsyncCall(TripsService.savePlantEditRequest(tripData))
        .then(function(response){
          if(response.data.success == "true"){
            $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
            window.location.href =  baseUrl + "/trips";
          }else{  
            var msg = 'Error'; 
            //$rootScope.danger = msg;        
          }
            },function(reason){}).finally(function(data){

        });
    }





/*****************************************************/
  // Function name : savePetrolPumpEditRequest
  // Functionality: save Petrol Pump Edit Request
  // Author : Sanchari Ghosh                               
  // Created Date : 10/10/2018                                          
  // Purpose:  Developing the functionality of saving Petrol Pump Edit Request
/*****************************************************/
  $scope.savePetrolPumpEditRequest = function(tripId,dieselAmount){
       var tripData = "tripId=" + tripId + "&diesel_amount=" + dieselAmount;
         TripsService.makeAsyncCall(TripsService.savePetrolPumpEditRequest(tripData))
        .then(function(response){
          if(response.data.success == "true"){
            $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
            window.location.href =  baseUrl + "/trips";
          }else{  
            var msg = 'Error'; 
            //$rootScope.danger = msg;        
          }
            },function(reason){}).finally(function(data){

        }); 
  }




  /*****************************************************/
    // Function name : getGPSTripList
    // Functionality: get trip list for gps tracking
    // Author : Sanchari Ghosh                               
    // Created Date : 29/10/2018                                          
    // Purpose:  Developing the functionality of get trip list for gps tracking
  /*****************************************************/
  $scope.getGPSTripList = function(){
    TripsService.makeAsyncCall(TripsService.getGPSTripList())
    .then(function(response){
      if(response.data.success == "true"){   
        $scope.tripRecords      = response.data.tripList;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }



  
  /*****************************************************/
    // Function name : trackTrip
    // Functionality: gps tracking of trip
    // Author : Sanchari Ghosh                               
    // Created Date : 29/10/2018                                          
    // Purpose:  Developing the functionality of gps tracking of trip
  /*****************************************************/
  $scope.trackTrip = function(trip){
    $scope.track = 1; 
    $scope.encodedTrip = window.btoa(trip);
    $scope.iFrameURL = tripGPSURL+$scope.encodedTrip;
  }




  /*****************************************************/
    // Function name : saveTripCategory
    // Functionality: Save category after add from trip page
    // Author : Sanchari Ghosh                               
    // Created Date : 23/01/2019                                          
    // Purpose:  Developing the functionality of saving categories with the help of TripsService
  /*****************************************************/
  $scope.saveTripCategory = function(formObj) {

    var categoryData = "categoryName=" + $scope.categoryName +"&categoryDesc=" + $scope.categoryDesc + "&status=A" + "&currentPageNo=" + $scope.currentPageNo; ; 
    
    TripsService.makeAsyncCall(TripsService.saveTripCategory(categoryData))
    .then(function(response){
      if(response.data.success == "true"){
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        $scope.selectCategory = response.data.category;
        $scope.viewTripSubcatList($scope.selectCategory); /*reload subcategory*/
        var msg = 'Category added succesfully'; 
        $rootScope.catSuccess = msg;  
        $rootScope.msgShow();
        $timeout(function () { 
          $('.closeModal').click(); /*close modal*/
          $scope.getTripCategoryList(); /*reload the categories*/
          $scope.categoryName = '';
          $scope.categoryDesc = '';
          
        }, 3000);
      }else{  
        var msg = 'Category already exists'; 
        $rootScope.catDanger = msg;  
        $rootScope.msgShow();
      }
        },function(reason){}).finally(function(data){

        });
  }





   /*****************************************************/
    // Function name : saveTripPlant
    // Functionality: Save plant after add from trip page
    // Author : Sanchari Ghosh                               
    // Created Date : 23/01/2019                                          
    // Purpose:  Developing the functionality of saving plants with the help of TripsService
  /*****************************************************/
  $scope.saveTripPlant = function(formObj) {

    var plantData = "address_zone_id=" + $scope.selectAddressZonePlant + "&type=" + $scope.selectType +"&name=" + $scope.name + "&description=" + $scope.description + "&balance_amount=" + $scope.balanceAmount + "&status=A" + "&currentPageNo=" + $scope.currentPageNo; 


    TripsService.makeAsyncCall(TripsService.saveTripPlant(plantData))
    .then(function(response){
      if(response.data.success == "true"){
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        $scope.selectPlant = response.data.plant;
        var msg = 'Plant added succesfully'; 
        $rootScope.plantSuccess = msg;  
        $rootScope.msgShow();
        $timeout(function () { 
          $('.closeModal').click(); /*close modal*/
          $scope.getTripPlantList(); /*reload the plants*/
          $scope.selectAddressZonePlant = '';
          $scope.selectType = '';
          $scope.name = '';
          $scope.description = '';
          $scope.balanceAmount = '';
        }, 3000);
      }else{  
        var msg = response.data.msg; 
        $rootScope.plantDanger = msg;    
        $rootScope.msgShow();    
      }
        },function(reason){}).finally(function(data){

        });
  }




  /*****************************************************/
    // Function name : saveTripParty
    // Functionality: Save party after add from trip page
    // Author : Sanchari Ghosh                               
    // Created Date : 24/01/2019                                          
    // Purpose:  Developing the functionality of saving parties with the help of TripsService
  /*****************************************************/
  $scope.saveTripParty = function(formObj) {

    var partyData = "party_name=" + $scope.partyName + "&address_zone_id=" + $scope.selectAddressZoneParty + "&party_description=" + $scope.partyDesc + "&phone_number=" + $scope.phoneNumber + "&email=" + $scope.email + "&status=A" + "&currentPageNo=" + $scope.currentPageNo; 


    TripsService.makeAsyncCall(TripsService.saveTripParty(partyData))
    .then(function(response){
      if(response.data.success == "true"){
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        $scope.selectParty = response.data.party;
        $scope.selectAddress = response.data.partyAddress; /*reload address zone*/
        //$scope.getAddressZoneDetail(); /*reload address zone*/
        var msg = 'Party added succesfully'; 
        $rootScope.partySuccess = msg;  
        $rootScope.msgShow();
        $timeout(function () { console.log(response);
          $('.closeModal').click(); /*close modal*/
          //$scope.getTripPartyList(); /*reload the parties*/

          $scope.getAddressWisePartyDetails($scope.selectAddressZoneParty); /*reload the parties*/

          $scope.selectAddress = response.data.partyAddress; /*reload address zone*/
          //$scope.selectAddress = 
          $scope.selectAddressZoneParty = '';
          $scope.partyName = '';
          $scope.partyDesc = '';
          $scope.phoneNumber = '';
          $scope.email = '';
        }, 3000);
        
      }else{  
        var msg = response.data.msg; 
        $rootScope.partyDanger = msg;
        $rootScope.msgShow();        
      }
        },function(reason){}).finally(function(data){

        });
  }




  /*****************************************************/
    // Function name : saveTripPetrolPump
    // Functionality: Save petrolPump after add from trip page
    // Author : Sanchari Ghosh                               
    // Created Date : 24/01/2019                                          
    // Purpose:  Developing the functionality of saving petrolPumps with the help of TripsService
  /*****************************************************/
  $scope.saveTripPetrolPump = function(formObj) {

    var petrolPumpData = "address_zone_id=" + $scope.selectAddressZonePetrolPump + "&petrol_pump_name=" + $scope.petrolPumpName + "&contact_number=" + $scope.contactNumber + "&contact_email=" + $scope.contactEmail +  "&contact_person=" + $scope.contactPerson + "&status=A" + "&currentPageNo=" + $scope.currentPageNo; 
    

    TripsService.makeAsyncCall(TripsService.saveTripPetrolPump(petrolPumpData))
    .then(function(response){
      if(response.data.success == "true"){
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        $scope.selectPetrolPump = response.data.petrolPump;
        var msg = 'Petrol Pump added succesfully'; 
        $rootScope.petrolPumpSuccess = msg;  
        $rootScope.msgShow();
        $timeout(function () { 
          $('.closeModal').click(); /*close modal*/
          $scope.getTripPetrolPumpList(); /*reload the petrol pumps*/
          $scope.selectAddressZonePetrolPump = '';
          $scope.petrolPumpName = '';
          $scope.contactNumber = '';
          $scope.contactEmail = '';
          $scope.contactPerson = '';
        }, 3000);
      } else{  
        var msg = response.data.msg; 
        $rootScope.petrolPumpDanger = msg;
        $rootScope.msgShow();        
      }
        },function(reason){}).finally(function(data){

        });
  }






   /*****************************************************/
    // Function name : saveTripSubCategory
    // Functionality: Save subcategory after add from trip page
    // Author : Sanchari Ghosh                               
    // Created Date : 24/01/2019                                          
    // Purpose:  Developing the functionality of saving subcategories with the help of TripsService
  /*****************************************************/
  $scope.saveTripSubcategory = function(formObj) {

    var subcategoryData = "categoryId="+ $scope.selectCategory +"&subcategoryName=" + $scope.subcategoryName +"&subcategoryDesc=" + $scope.subcategoryDesc + "&status=A" + "&currentPageNo=" + $scope.currentPageNo; ; 
    

    TripsService.makeAsyncCall(TripsService.saveTripSubCategory(subcategoryData))
    .then(function(response){
      if(response.data.success == "true"){
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        var msg = 'Sub Category added succesfully'; 
        $rootScope.subCatSuccess = msg;  
        $rootScope.msgShow();
        $scope.selectSubCategory = response.data.subcategory;
        $timeout(function () { 
          $('.closeModal').click(); /*close modal*/
          $scope.viewTripSubcatList($scope.selectCategory);/*reload the sub categories*/
          $scope.subcategoryName = '';
          $scope.subcategoryDesc = '';
        }, 3000);
      }else{  
        var msg = 'Subcategory already exists'; 
        $rootScope.subCatDanger = msg;   
        $rootScope.msgShow();    
      }
        },function(reason){}).finally(function(data){

        });
  }




  /*****************************************************/
    // Function name : getTripVendorList
    // Functionality: Getting vendor list 
    // Author : Sanchari Ghosh                               
    // Created Date : 24/01/2019                                          
    // Purpose:  Developing the functionality of getting lists of vendors  with the help of TripsService
  /*****************************************************/
  $scope.getTripVendorList = function(){
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
    // Function name : saveTripVendor
    // Functionality: Save vendor after add from trip
    // Author : Sanchari Ghosh                               
    // Created Date : 24/1/2019                                          
    // Purpose:  Developing the functionality of saving vendors with the help of TripsService
  /*****************************************************/
  $scope.saveTripVendor = function(formObj) {
    var contactEmailData = '';

    if ($scope.contactEmail === null) {
      contactEmailData = '';
    } else {
      contactEmailData = $scope.contactEmail;
    }

    var vendorData = "vendorName=" + $scope.vendorName +"&contactNumber=" + $scope.contactNumber +"&contactEmail=" + contactEmailData + "&status=A" +  "&contact_person=" + $scope.contactPerson + "&pan_number=" + $scope.panNumber + "&bank_name=" + $scope.selectBank + "&ifsc_code=" + $scope.ifsc + "&account_no=" + $scope.accountNo + "&account_holder_name=" + $scope.accountHolderName + "&currentPageNo=" + $scope.currentPageNo; ; 


    TripsService.makeAsyncCall(TripsService.saveTripVendor(vendorData))
    .then(function(response){
      if(response.data.success == "true"){
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        $scope.company = response.data.vendor;
        $scope.viewTripTruckList($scope.company); /*reload truck*/
        $scope.viewTruckOwner($scope.company); /*get truck owner*/
        var msg = 'Vendor added succesfully'; 
        $rootScope.vendorSuccess = msg;  
        $rootScope.msgShow();
        $timeout(function () { 
          $('.closeModal').click(); /*close modal*/
          $scope.getTripVendorList(); /*reload the companies*/
          $scope.vendorName = '';
          $scope.contactNumber = '';
          $scope.contactEmailData = '';
          $scope.contactPerson = '';
          $scope.panNumber = '';
          $scope.bankName = '';
          $scope.ifsc = '';
          $scope.accountNo = '';
          $scope.accountHolderName = '';
        }, 3000);
        
      }else{  
        //var msg = 'Vendor already exists'; 
        var msg = response.data.msg; 
        $rootScope.vendorDanger = msg;  
        $rootScope.msgShow();
      }
        },function(reason){}).finally(function(data){

        });
  }





  /*****************************************************/
    // Function name : viewTripTruckList
    // Functionality: Getting Vehicle list with respect to Vendor
    // Author : Sanchari Ghosh                               
    // Created Date : 25/01/2019                                          
    // Purpose:  Developing the functionality of getting lists of vehicles  with the help of TripsService
  /*****************************************************/
  $scope.viewTripTruckList = function(keyname){
        var vendorData = "vendorName=" + keyname + "&tripType=" + $scope.tripType;
         TripsService.makeAsyncCall(TripsService.viewTripTruckList(vendorData))
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
    // Function name : uploadTripFile
    // Functionality: Uploading trucks documents(registration certificate, permits, tax, insurance) from trip form
    // Author : Sanchari Ghosh                               
    // Created Date : 25/01/2019                                          
    // Purpose:  Developing the functionality of uploading trucks documents(registration certificate, permits, tax, insurance)
  /*****************************************************/
  $scope.uploadTripFile = function (file,type) { 
              var file = file;

              /*setting upload Url on the basis of file type*/
              if (type == 'registration') {
                var uploadingUrl = baseUrl + '/upload-registration-file';
              }
              if (type == 'insurance') {
                var uploadingUrl = baseUrl + '/upload-insurance-file';
              }
              if (type == 'permit') {
                var uploadingUrl = baseUrl + '/upload-permit-file';
              }
              if (type == 'tax') {
                var uploadingUrl = baseUrl + '/upload-tax-file';
              }
              if (type == 'pollution') {
                var uploadingUrl = baseUrl + '/upload-pollution-file';
              }

              var uploadUrl = uploadingUrl, 
                  promise = fileUploadService.uploadFileToUrl(file, uploadUrl);

              return promise.then(function (response) {
                  var fileName = response.data.fileName;
                  if (type == 'registration') {
                    $scope.registrationFileName = fileName;
                  }
                  if (type == 'insurance') {
                    $scope.insuranceFileName = fileName;
                  }
                  if (type == 'permit') {
                    $scope.permitFileName = fileName;
                  }
                  if (type == 'tax') {
                    $scope.taxFileName = fileName;
                  }
                  if (type == 'pollution') {
                    $scope.pollutionFileName = fileName;
                  }
                  return response.data;
                  
              }, function () {
                  $scope.serverResponse = 'An error has occurred';
              }) 
    };




  /*****************************************************/
    // Function name : saveTripTruck
    // Functionality: Save truck after add from trip page
    // Author : Sanchari Ghosh                               
    // Created Date : 25/01/2019                                          
    // Purpose:  Developing the functionality of saving trucks with the help of TripsService
  /*****************************************************/
  $scope.saveTripTruck = function(formObj) {

    var insuranceInfo     = '';
    var permitInfo        = '';
    var taxInfo           = '';  
    var registrationInfo  = '';
    var pollutionInfo     = '';
    var fileError         = 0;
    var fileErrorMsg      = '';

    /*get the uploaded file*/
    var registrationFile = $scope.registrationFile;
    var insuranceFile    = $scope.insuranceFile;
    var permitFile       = $scope.permitFile;
    var taxFile          = $scope.taxFile;
    var pollutionFile    = $scope.pollutionFile;

   registrationInfo     += "&registered_on=" + $scope.registeredOn + "&registration_end=" + $scope.registrationEnd ; 
   
   if ($scope.company == 'SSLogistics') { /*for company type truck*/
      insuranceInfo       += "&policy_no=" + $scope.policyNo + "&policy_on=" + $scope.policyOn + "&policy_end=" + $scope.policyEnd; 
      permitInfo          += "&permit_no=" + $scope.permitNo + "&permit_on=" + $scope.permitOn + "&permit_end=" + $scope.permitEnd; 
      taxInfo             += "&invoice_no=" + $scope.invoiceNo + "&tax_paid_date=" + $scope.taxPaidDate + "&tax_period_end=" + $scope.taxEnd; 
      pollutionInfo       += "&pollution_no=" + $scope.pollutionNo + "&pollution_on=" + $scope.pollutionOn + "&pollution_end=" + $scope.pollutionEnd; 
    }


    var truckData         = "company=" + $scope.company +"&truck_no=" + $scope.truckNo + "&status=A" + "&currentPageNo=" + $scope.currentPageNo; ;  
    var truckDetailsData  = truckData + registrationInfo + insuranceInfo + permitInfo + taxInfo + pollutionInfo;
    
    /*for Edit and Save truck*/
    if($scope.truckId) {
      truckDetailsData += '&truckId='+$scope.truckId;
    }

    var allPromises = [];

    /*uploading files to respective folder*/
    if ($scope.registrationFile !== undefined) {
        allPromises.push(new Promise((resolve, reject)=>{
          $scope.uploadTripFile(registrationFile,'registration').then((data)=>{ 
            if (data.success == 'true') {
              registrationInfo +=  "&registration_file=" + data.fileName;
              truckDetailsData +=  registrationInfo;
            } else {
              fileError = 1;
              fileErrorMsg = data.msg; 
              $rootScope.truckDanger = fileErrorMsg;     
              $rootScope.msgShow();  
            }
            resolve(registrationInfo);

          })
        }))
    } else if ($scope.registrationFileName !== undefined) {
      registrationInfo +=  "&registration_file=" + $scope.registrationFileName;
      truckDetailsData +=  registrationInfo;
    } else {
      registrationInfo +=  "&registration_file="+'';
      truckDetailsData +=  registrationInfo;
    }



    if ($scope.insuranceFile !== undefined) {
      allPromises.push(new Promise((resolve, reject)=>{
        $scope.uploadTripFile(insuranceFile,'insurance').then((data)=>{
            if (data.success == 'true') {
               insuranceInfo     +=  "&policy_file=" + data.fileName;
               truckDetailsData  +=  insuranceInfo;
            } else {
              fileError = 1;
              fileErrorMsg = data.msg;  
              $rootScope.truckDanger = fileErrorMsg;     
              $rootScope.msgShow();  
            }
          resolve(insuranceInfo);
        })
      }));
    } else if ($scope.insuranceFileName !== undefined) {
      insuranceInfo    +=  "&policy_file=" + $scope.insuranceFileName;
      truckDetailsData +=  insuranceInfo;
    } else {
      insuranceInfo    +=  "&policy_file="+'';
      truckDetailsData +=  insuranceInfo;
    }

    if ($scope.permitFile !== undefined) {
      allPromises.push(new Promise((resolve, reject)=>{
        $scope.uploadTripFile(permitFile,'permit').then((data)=>{
          if (data.success == 'true') {
            permitInfo       +=  "&permit_file=" + data.fileName;
            truckDetailsData +=  permitInfo;
          } else {
            fileError = 1;
            fileErrorMsg = data.msg;  
            $rootScope.truckDanger = fileErrorMsg;     
            $rootScope.msgShow();  
          }
          resolve(permitInfo);
        })
      }));
    } else if ($scope.permitFileName !== undefined) {
      permitInfo       +=  "&permit_file=" + $scope.permitFileName;
      truckDetailsData +=  permitInfo;
    } else {
      permitInfo       +=  "&permit_file="+'';
      truckDetailsData +=  permitInfo;
    }



    if ($scope.taxFile !== undefined) {
      allPromises.push(new Promise((resolve, reject)=>{
        $scope.uploadTripFile(taxFile,'tax').then((data)=>{
          if (data.success == 'true') {
            taxInfo          +=  "&tax_file=" + data.fileName;
            truckDetailsData +=  taxInfo;
          } else {
            fileError = 1;
            fileErrorMsg = data.msg;  
            $rootScope.truckDanger = fileErrorMsg;     
            $rootScope.msgShow();  
          }
          resolve(taxInfo);
        })
      }));
    } else if ($scope.taxFileName !== undefined) {
      taxInfo          +=  "&tax_file=" + $scope.taxFileName;
      truckDetailsData +=  taxInfo;
    } else {
      taxInfo          +=  "&tax_file="+'';
      truckDetailsData +=  taxInfo;
    }



    if ($scope.pollutionFile !== undefined) {
      allPromises.push(new Promise((resolve, reject)=>{
        $scope.uploadTripFile(pollutionFile,'pollution').then((data)=>{
          
          if (data.success == 'true') {
            pollutionInfo          +=  "&pollution_file=" + data.fileName;
            truckDetailsData       +=  pollutionInfo;
          } else {
            fileError = 1;
            fileErrorMsg = data.msg;  
            $rootScope.truckDanger = fileErrorMsg;     
            $rootScope.msgShow();  
          }
          resolve(pollutionInfo);
        })
      }));
    } else if ($scope.pollutionFileName !== undefined) {
      pollutionInfo          +=  "&pollution_file=" + $scope.pollutionFileName;
      truckDetailsData       +=  pollutionInfo;
    } else {
      pollutionInfo          +=  "&pollution_file="+'';
      truckDetailsData       +=  pollutionInfo;
    }    
   Promise.all(allPromises).then((resolveData)=>{
      if (fileError == 0) {
        TripsService.makeAsyncCall(TripsService.saveTripTruck(truckDetailsData))
        .then(function(response){
          if(response.data.success == "true"){
            $rootScope.disableSubmitButton(); /*disable submit button after form submission*/ 
            $scope.selectTruck = response.data.truck;
            var msg = 'Truck added succesfully'; 
            $rootScope.truckSuccess = msg;  
            $rootScope.msgShow();

            $timeout(function () { 
              $('.closeModal').click(); /*close modal*/
              $scope.viewTripTruckList($scope.company); /*reload the trucks*/
              $scope.registeredOn   = '';
              $scope.registrationEnd  = '';
              $scope.policyNo = '';
              $scope.policyOn = '';
              $scope.policyEnd = '';
              $scope.permitNo = '';
              $scope.permitOn = '';
              $scope.permitEnd = '';
              $scope.invoiceNo = '';
              $scope.taxPaidDate = '';
              $scope.taxEnd = '';
              $scope.pollutionNo = '';
              $scope.pollutionOn = '';
              $scope.pollutionEnd = '';
              $scope.truckNo = '';
              $scope.registrationFile = null;
              $scope.registrationFileName = '';
              $scope.insuranceFile = '';
              $scope.insuranceFileName = '';
              $scope.taxFile = '';
              $scope.taxFileName = '';
              $scope.pollutionFile = '';
              $scope.pollutionFileName = '';
              $scope.permitFile = '';
              $scope.permitFileName = '';
              $scope.clear(); /*clear the file elements*/
            }, 3000);
          }else{
            var msg = response.data.msg;
            $rootScope.truckDanger = msg;     
            $rootScope.msgShow();   
          }
            },function(reason){}).finally(function(data){

            });
      } else {
         
      }    
   })
    
  }



  /*****************************************************/
    // Function name : clear
    // Functionality: clear the file element after form is being submitted
    // Author : Sanchari Ghosh                               
    // Created Date : 18/02/2019                                          
    // Purpose:  Developing the functionality of clearing the file element after form is being submitted
  /*****************************************************/
  $scope.clear = function () {
     angular.element("input[type='file']").val(null);
  };




  /*****************************************************/
    // Function name : getAddressZoneDetail
    // Functionality: to view address zone Details
    // Author : Sanchari Ghosh                               
    // Created Date : 13/02/2019                                          
    // Purpose:  Developing the functionality of viewing Address Zone Details with the help of TripsService
  /*****************************************************/
  $scope.getAddressZoneDetail = function() {  

    TripsService.makeAsyncCall(TripsService.getAddressZoneDetail())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.addressZoneRecords      = response.data.addressZoneList;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }



  /*****************************************************/
    // Function name : getAddressZoneDetail
    // Functionality: to view address zone Details
    // Author : Sanchari Ghosh                               
    // Created Date : 13/02/2019                                          
    // Purpose:  Developing the functionality of viewing Address Zone Details with the help of TripsService
  /*****************************************************/
  $scope.getAddressWisePartyDetails = function(keyname) {  
    var addressData = "addressZoneId=" + keyname;
    TripsService.makeAsyncCall(TripsService.getAddressWisePartyDetails(addressData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.partyRecords      = response.data.partyList;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }



  /*****************************************************/
    // Function name : viewTripPartyAddressZone
    // Functionality: to view address zone Details of selected party
    // Author : Sanchari Ghosh                               
    // Created Date : 14/02/2019                                          
    // Purpose:  Developing the functionality of viewing Address Zone Details of selected party with the help of TripsService
  /*****************************************************/
  $scope.viewTripPartyAddressZone = function(keyname) {  
    var partyData = "partyId=" + keyname;
    TripsService.makeAsyncCall(TripsService.viewTripPartyAddressZone(partyData))
    .then(function(response){
      if(response.data.success == "true"){ console.log(response);
        $scope.selectAddress      = response.data.addressList;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }


   /*****************************************************/
    // Function name : saveTripPOD
    // Functionality: to save pod status from pop up
    // Author : Sanchari Ghosh                               
    // Created Date : 13/03/2019                                          
    // Purpose:  Developing the functionality of saving pod status from pop up with the help of TripsService
  /*****************************************************/
  $scope.saveTripPOD = function(keyname) {  
    var tripData = '&tripId='+$scope.dataId+'&status='+$scope.status+"&bags="+$scope.bags;

    if ($scope.reason === undefined) {
      tripData += "&reason=";
    } else {
      tripData += "&reason=" + $scope.reason;
    }

    if ($scope.remarks === undefined) {
      tripData += "&remarks=";
    } else {
      tripData += "&remarks=" + $scope.remarks;
    }

    TripsService.makeAsyncCall(TripsService.saveTripPOD(tripData))
    .then(function(response){ console.log(response);
      if(response.data.success == "true"){ 
        localStorage.setItem('currentPageNo', $scope.approvalModalCurrentPage);
        localStorage.setItem('currentModule', $scope.moduleName);
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        window.location.href =  baseUrl + "/trips";
      }else{  
        var msg = 'Error'; 
        $rootScope.podDanger = msg;     
        $rootScope.msgShow();        
      }
    },function(reason){}).finally(function(data){

    });
  }


   /*****************************************************/
    // Function name : saveTripAddress
    // Functionality: to save trip address from pop up
    // Author : Sanchari Ghosh                               
    // Created Date : 24/04/2019                                          
    // Purpose:  Developing the functionality of saving trip address from pop up with the help of TripsService
  /*****************************************************/
  $scope.saveTripAddress = function(keyname) {
    var tripData = '&title='+$scope.title+'&address='+$scope.addressZoneAddress;

    TripsService.makeAsyncCall(TripsService.saveTripAddress(tripData))
    .then(function(response){
      if(response.data.success == "true"){ 
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        var msg = response.data.msg; 
        $rootScope.addressZoneSuccess = msg;  
        $rootScope.msgShow();
        
        $scope.selectAddressZoneParty = response.data.lastInsertedId;
        $scope.selectAddress = response.data.lastInsertedId;

        $timeout(function () { 
          $scope.getAddressWisePartyDetails(response.data.lastInsertedId); /*reload the parties*/
          $('.addressCloseModal').click(); /*close modal*/
          $scope.getAddressZoneDetail();
          $scope.title = '';
          $scope.addressZoneAddress = '';
        }, 3000);
      }else{  
        var msg = response.data.msg;
        $rootScope.addressZoneDanger = msg;     
        $rootScope.msgShow();           
      }
    },function(reason){}).finally(function(data){

    });
  }




  /*****************************************************/
    // Function name : getBankList
    // Functionality: to view bank List
    // Author : Sanchari Ghosh                               
    // Created Date : 25/04/2019                                         
    // Purpose:  Developing the functionality of viewing Bank Details with the help of TripsService
  /*****************************************************/
  $scope.getBankList = function(formObj) {  
        
    TripsService.makeAsyncCall(TripsService.getBankList())
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
    // Purpose:  Developing the functionality of viewing ifsc Details with respect to bank with the help of TripsService
  /*****************************************************/
  $scope.getBankifscDetails = function(bankId) {  

    var bankData = "bankId=" + bankId;
    if ($scope.bankNameChange == 1) {
      $scope.ifsc = ''; /*initially making the ifsc code container text field blank when the bank name dropdown is clicked and changed*/
    }
    
    TripsService.makeAsyncCall(TripsService.getBankifscDetails(bankData))
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


  /*****************************************************/
    // Function name : deletePOD
    // Functionality: for deleting POD
    // Author : Sanchari Ghosh                               
    // Created Date : 14/05/2019                                          
    // Purpose:  Developing the functionality for deleting POD with the help of TripsService
  /*****************************************************/
  $scope.deletePOD = function(dataId){
    if (confirm('Do You really want to delete the data? ')) {
      var dataId = "podId=" + dataId;
     
      TripsService.makeAsyncCall(TripsService.deletePOD(dataId))
      .then(function(response){
        if(response.data.success == "true"){  
          localStorage.setItem('currentPageNo', $scope.deletePODCurrentPage);
          localStorage.setItem('currentModule', $scope.moduleName);
          window.location.href =  baseUrl + "/trips";
        }else{  
          var msg = 'Error'; 
          $rootScope.podDanger = msg;     
          $rootScope.msgShow();   
          //$rootScope.danger = msg;        
        }
      },function(reason){}).finally(function(data){

      });
    }
  }


  /*****************************************************/
    // Function name : deleteTrip
    // Functionality: Delete trip
    // Author : Sanchari Ghosh                               
    // Created Date : 15/05/2019                                          
    // Purpose:  Developing the functionality of deleting trip with the help of TripsService
  /*****************************************************/
  $scope.deleteTrip = function(formObj,currentPage,orderby,ordertype,searchKeyword) {

    if (confirm('Do You really want to delete the data? ')) {
      var tripData = "tripId=" + formObj; 
      
      /*for Edit and Save truck*/
      TripsService.makeAsyncCall(TripsService.deleteTrip(tripData))
      .then(function(response){
        if(response.data.success == "true"){
          $scope.tripList(currentPage,orderby,ordertype,searchKeyword); /*get trip list*/
          $rootScope.success = 'Deleted Succesfully';
          $rootScope.msgShow();
        }else{  
           if(response.data.success == "not_numeric") {
            var msg = 'The id must contain numeric value'; 
          } else {
            var msg = 'Trip could not be deleted as it may be 3 days older trip or may be the POD has already been uploaded or may be the trip is not in "Running" state'; 
          }
          $rootScope.danger = msg;
          $rootScope.msgShow();        
        }
          },function(reason){}).finally(function(data){

          });
    }   
  }

}
