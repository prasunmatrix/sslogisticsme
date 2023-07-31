'use strict';

/*****************************************************/
  // Trucks Controller             
  // Function name : TrucksController
  // Functionality: truck list , truck add, truck edit, truck delete, truck detail
  // Author : Sanchari Ghosh                                 
  // Created Date : 10/08/2018                                        
  // Purpose:  Developing the functionalities of trucks
/*****************************************************/

function TrucksController($rootScope, $scope, $http, $window, $q, $location, $timeout, TrucksService, fileUploadService) {

  $scope.titleChange = '<h1>Truck</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.moduleName  = 'truck';
  $scope.availableTags = [];


   /*****************************************************/
    // Function name : truckList
    // Functionality: Truck List
    // Author : Sanchari Ghosh                               
    // Created Date : 10/08/2018                                          
    // Purpose:  Developing the functionality of listing trucks with the help of TrucksService
  /*****************************************************/
  $scope.truckList = function(currentPage,orderby,ordertype,searchKeyword) {

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
    
      
    var truckData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 
    TrucksService.makeAsyncCall(TrucksService.truckList(truckData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.truckList;
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
    // Function name : truckEdit
    // Functionality: View Truck Edit page
    // Author : Sanchari Ghosh                               
    // Created Date : 10/08/2018                                          
    // Purpose:  Developing the functionality of view truck edit page with the help of TrucksService
  /*****************************************************/ 
  $scope.truckEdit = function(formObj) {  
    var truckData = $location.absUrl();
    var truckDataSplit = truckData.split('/');
    var truckId = 'truckId='+truckDataSplit[truckDataSplit.length - 2]; 
    var currentPageNo = truckDataSplit[truckDataSplit.length - 1];

    TrucksService.makeAsyncCall(TrucksService.truckEdit(truckId))
    .then(function(response){ console.log(response);
      if(response.data.success == "true"){
        localStorage.setItem('currentPageNo', currentPageNo);
        localStorage.setItem('currentModule', $scope.moduleName);
        $scope.currentPageNo        = currentPageNo;
        $scope.truckId              = response.data.truckDetails.id;
        $scope.company              = response.data.vendorName;
        if (response.data.truckDetails.truck_no == null) {
          $scope.truckNo            = '';
        } else {
          $scope.truckNo            = response.data.truckDetails.truck_no;
        }
        $scope.status               = response.data.truckDetails.status;
        
        /*Registration Details*/
        //$scope.regNo                = response.data.truckRegDetails.registration_no;
       
        if (response.data.truckRegDetails.registration_file == 'null') {
          $scope.registrationFileName = '';
        } else {
          $scope.registrationFileName = response.data.truckRegDetails.registration_file;
        }
        if (response.data.truckDetails.type == 'C') {

          /*Registration Details*/
          $scope.registeredOn         = Date.parse(response.data.truckRegDetails.registered_on, "dd-mm-yyyy").toString("dd-MM-yyyy");
          $scope.registrationEnd      = Date.parse(response.data.truckRegDetails.registration_end, "dd-mm-yyyy").toString("dd-MM-yyyy");
        

          /*Insurance Details*/
          $scope.policyNo             = response.data.truckInsuranceDetails.policy_no;
          $scope.policyOn             = Date.parse(response.data.truckInsuranceDetails.policy_on, "dd-mm-yyyy").toString("dd-MM-yyyy");
          $scope.policyEnd            = Date.parse(response.data.truckInsuranceDetails.policy_end, "dd-mm-yyyy").toString("dd-MM-yyyy");

          if (response.data.truckInsuranceDetails.policy_file == 'null') {
            $scope.insuranceFileName = '';
          } else {
            $scope.insuranceFileName = response.data.truckInsuranceDetails.policy_file;
          }



          /*Permit Details*/
          $scope.permitNo             = response.data.truckPermitDetails.permit_no;
          $scope.permitOn             = Date.parse(response.data.truckPermitDetails.permit_on, "dd-mm-yyyy").toString("dd-MM-yyyy");
          $scope.permitEnd            = Date.parse(response.data.truckPermitDetails.permit_end, "dd-mm-yyyy").toString("dd-MM-yyyy");

          if (response.data.truckPermitDetails.permit_file == 'null') {
            $scope.permitFileName = '';
          } else {
            $scope.permitFileName = response.data.truckPermitDetails.permit_file;
          }


          /*Tax Details*/
          $scope.invoiceNo            = response.data.truckTaxDetails.invoice_no;
          $scope.taxPaidDate          = Date.parse(response.data.truckTaxDetails.tax_paid_date, "dd-mm-yyyy").toString("dd-MM-yyyy");
          $scope.taxEnd               = Date.parse(response.data.truckTaxDetails.tax_period_end, "dd-mm-yyyy").toString("dd-MM-yyyy");

          if (response.data.truckTaxDetails.tax_file == 'null') {
            $scope.taxFileName = '';
          } else {
            $scope.taxFileName = response.data.truckTaxDetails.tax_file;
          }



          /*Pollution Details*/
          $scope.pollutionNo          = response.data.truckPollutionDetails.pollution_no;
          $scope.pollutionOn          = Date.parse(response.data.truckPollutionDetails.pollution_on, "dd-mm-yyyy").toString("dd-MM-yyyy");
          $scope.pollutionEnd         = Date.parse(response.data.truckPollutionDetails.pollution_end, "dd-mm-yyyy").toString("dd-MM-yyyy");
          $scope.pollutionFileName    = (response.data.truckPollutionDetails.pollution_file == 'null')?'':response.data.truckRegDetails.pollution_file;;

          if (response.data.truckPollutionDetails.pollution_file == 'null') {
            $scope.pollutionFileName = '';
          } else {
            $scope.pollutionFileName = response.data.truckPollutionDetails.pollution_file;
          }
        }
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }






  /*****************************************************/
    // Function name : uploadFile
    // Functionality: Uploading trucks documents(registration certificate, permits, tax, insurance)
    // Author : Sanchari Ghosh                               
    // Created Date : 20/08/2018                                          
    // Purpose:  Developing the functionality of uploading trucks documents(registration certificate, permits, tax, insurance)
  /*****************************************************/
  $scope.uploadFile = function (file,type) { 
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
    // Function name : saveTruck
    // Functionality: Save truck after add or edit
    // Author : Sanchari Ghosh                               
    // Created Date : 10/08/2018                                          
    // Purpose:  Developing the functionality of saving trucks with the help of TrucksService
  /*****************************************************/
  $scope.saveTruck = function(formObj) {

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


    var truckData         = "company=" + $scope.company +"&truck_no=" + $scope.truckNo + "&status=" + $scope.status + "&currentPageNo=" + $scope.currentPageNo; ;  
    var truckDetailsData  = truckData + registrationInfo + insuranceInfo + permitInfo + taxInfo + pollutionInfo;
    
    /*for Edit and Save truck*/
    if($scope.truckId) {
      truckDetailsData += '&truckId='+$scope.truckId;
    }

    var allPromises = [];

    /*uploading files to respective folder*/
    if ($scope.registrationFile !== undefined) {
        allPromises.push(new Promise((resolve, reject)=>{
          $scope.uploadFile(registrationFile,'registration').then((data)=>{
            if (data.success == 'true') {
              registrationInfo +=  "&registration_file=" + data.fileName;
              truckDetailsData +=  registrationInfo;
            } else {
              fileError = 1;
              fileErrorMsg = data.msg; 
              $rootScope.danger = fileErrorMsg;     
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
        $scope.uploadFile(insuranceFile,'insurance').then((data)=>{
            if (data.success == 'true') {
               insuranceInfo     +=  "&policy_file=" + data.fileName;
               truckDetailsData  +=  insuranceInfo;
            } else {
              fileError = 1;
              fileErrorMsg = data.msg;  
              $rootScope.danger = fileErrorMsg;     
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
        $scope.uploadFile(permitFile,'permit').then((data)=>{
          if (data.success == 'true') {
            permitInfo       +=  "&permit_file=" + data.fileName;
            truckDetailsData +=  permitInfo;
          } else {
            fileError = 1;
            fileErrorMsg = data.msg;  
            $rootScope.danger = fileErrorMsg;     
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
        $scope.uploadFile(taxFile,'tax').then((data)=>{
          if (data.success == 'true') {
            taxInfo          +=  "&tax_file=" + data.fileName;
            truckDetailsData +=  taxInfo;
          } else {
            fileError = 1;
            fileErrorMsg = data.msg;  
            $rootScope.danger = fileErrorMsg;     
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
        $scope.uploadFile(pollutionFile,'pollution').then((data)=>{
          
          if (data.success == 'true') {
            pollutionInfo          +=  "&pollution_file=" + data.fileName;
            truckDetailsData       +=  pollutionInfo;
          } else {
            fileError = 1;
            fileErrorMsg = data.msg;  
            $rootScope.danger = fileErrorMsg;     
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
        TrucksService.makeAsyncCall(TrucksService.saveTruck(truckDetailsData))
        .then(function(response){
          if(response.data.success == "true"){
            $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
            if($scope.truckId) {
              if($scope.currentPageNo) {
                $rootScope.paginationControl.currentPage = $scope.currentPageNo; 
              }
              
              /*for redirecting to same page after editing is done*/
              localStorage.setItem('currentPageNo', $scope.currentPageNo);
              localStorage.setItem('currentModule', $scope.moduleName);
            }
            window.location.href =  baseUrl + "/trucks";
          }else{
            var msg = response.data.msg;
            $rootScope.danger = msg;     
            $rootScope.msgShow();   
          }
            },function(reason){}).finally(function(data){

            });
      } else {
         
      }    


   })
    
  }




  /*****************************************************/
    // Function name : deleteTruck
    // Functionality: Delete truck
    // Author : Sanchari Ghosh                               
    // Created Date : 10/08/2018                                          
    // Purpose:  Developing the functionality of deleting truck with the help of TrucksService
  /*****************************************************/
  $scope.deleteTruck = function(formObj,currentPage,orderby,ordertype,searchKeyword) {

    if (confirm('Do You really want to delete the data? ')) {
      var truckData = "truckId=" + formObj; 
      
      /*for Edit and Save truck*/
      TrucksService.makeAsyncCall(TrucksService.deleteTruck(truckData))
      .then(function(response){
        if(response.data.success == "true"){
          $scope.truckList(currentPage,orderby,ordertype,searchKeyword); /*get truck list*/
          $rootScope.success = 'Deleted Succesfully';
          $rootScope.msgShow();
        }else{  
           if(response.data.success == "not_numeric") {
            var msg = 'The id must contain numeric value'; 
          } else {
            var msg = 'Truck could not be deleted, since it is associated with a Trip'; 
          }
          $rootScope.danger = msg;
          $rootScope.msgShow();        
        }
          },function(reason){}).finally(function(data){

          });
    }   
  }


  /*****************************************************/
    // Function name : getTruckDetail
    // Functionality: to view Truck Details
    // Author : Sanchari Ghosh                               
    // Created Date : 03/09/2018                                          
    // Purpose:  Developing the functionality of viewing Truck Details with the help of TrucksService
  /*****************************************************/
  $scope.getTruckDetail = function(formObj) {  
    var truckData = $location.absUrl();
    var truckDataSplit = truckData.split('/');
    var truckId = 'truckId='+truckDataSplit[truckDataSplit.length - 2]; 
    var currentPageNo = truckDataSplit[truckDataSplit.length - 1];

    localStorage.setItem('currentPageNo', currentPageNo);
    localStorage.setItem('currentModule', $scope.moduleName);
    
    TrucksService.makeAsyncCall(TrucksService.getTruckDetail(truckId))
    .then(function(response){
      if(response.data.success == "true"){        
        $scope.record      = response.data;
        $scope.selectType  = response.data.truckDetails.type;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
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

    $scope.registeredOn       = Date.parse(today,"dd-mm-yyyy").toString("dd-MM-yyyy");
    $scope.registrationEnd    = Date.parse(today,"dd-mm-yyyy").toString("dd-MM-yyyy");
    $scope.policyOn           = Date.parse(today,"dd-mm-yyyy").toString("dd-MM-yyyy");
    $scope.policyEnd          = Date.parse(today,"dd-mm-yyyy").toString("dd-MM-yyyy");
    $scope.permitOn           = Date.parse(today,"dd-mm-yyyy").toString("dd-MM-yyyy");
    $scope.permitEnd          = Date.parse(today,"dd-mm-yyyy").toString("dd-MM-yyyy");
    $scope.taxPaidDate        = Date.parse(today,"dd-mm-yyyy").toString("dd-MM-yyyy");
    $scope.taxEnd             = Date.parse(today,"dd-mm-yyyy").toString("dd-MM-yyyy");
    $scope.pollutionEnd       = Date.parse(today,"dd-mm-yyyy").toString("dd-MM-yyyy");
    $scope.pollutionOn        = Date.parse(today,"dd-mm-yyyy").toString("dd-MM-yyyy");
  }


   /*****************************************************/
    // Function name : getGPSTruckList
    // Functionality: get truck list for gps tracking
    // Author : Sanchari Ghosh                               
    // Created Date : 29/10/2018                                          
    // Purpose:  Developing the functionality of get truck list for gps tracking
  /*****************************************************/
  $scope.getGPSTruckList = function(){
    TrucksService.makeAsyncCall(TrucksService.getGPSTruckList())
    .then(function(response){
      if(response.data.success == "true"){   
        $scope.truckRecords      = response.data.truckList;
      }else{  
        var msg = 'Error'; 
        //$rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }



  
  /*****************************************************/
    // Function name : trackTruck
    // Functionality: gps tracking of truck
    // Author : Sanchari Ghosh                               
    // Created Date : 29/10/2018                                          
    // Purpose:  Developing the functionality of gps tracking of truck
  /*****************************************************/
  $scope.trackTruck = function(truck){
    $scope.track = 1;
    $scope.encodedTruck = window.btoa(truck);
    $scope.iFrameURL = truckGPSURL+$scope.encodedTruck;
  }



  /*****************************************************/
    // Function name : getAllVendorList
    // Functionality: Getting all Vendor List
    // Author : Sanchari Ghosh                               
    // Created Date : 27/12/2018                                          
    // Purpose:  Developing the functionality of getting all Vendor List with the help of TrucksService
  /*****************************************************/
  $scope.getAllVendorList = function(formObj) {  

    TrucksService.makeAsyncCall(TrucksService.getAllVendorList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.vendorRecords = response.data.vendorList;

        /*storing data in array for developing auto suggestion*/
        angular.forEach($scope.vendorRecords,function(company){
            $scope.availableTags.push(company.name); 
        });

      }else{  
        var msg = 'Error'; 
      }
        },function(reason){}).finally(function(data){

        });
  }

  /*****************************************************/
    // Function name : selectVendor
    // Functionality: Show selected vendor if provided
    // Author : Sanchari Ghosh                               
    // Created Date : 28/12/2018                                          
    // Purpose:  Developing the functionality of Show selected vendor if provided with the help of TrucksService
  /*****************************************************/
  $scope.selectVendor = function() {
    var vendorData = $location.absUrl();
    var vendorDataSplit = vendorData.split('?');
    

    if (vendorDataSplit.length > 1) {
      var vendorDetails = vendorDataSplit[1].split('=');
      if (vendorDetails[0] == 'vendor') {
        var vendorName = 'vendor='+vendorDetails[1]; 

        TrucksService.makeAsyncCall(TrucksService.checkVendorNameDetails(vendorName))
          .then(function(response){ console.log(response);
            if(response.data.success == "true"){        
              $scope.company   = response.data.vendorName;
            }else{  
              var msg = 'There is no vendor named like this.'; 
              $rootScope.danger = msg;
              $rootScope.msgShow();     
            }
          },function(reason){}).finally(function(data){

          });
      }
      
    }
  }

    /*****************************************************/
      // Function name : complete
      // Functionality: for auto suggested vendor list
      // Author : Sanchari Ghosh                               
      // Created Date : 27/12/2018                                          
      // Purpose:  Developing the functionality of getting auto suggested vendor list
    /*****************************************************/
    $scope.complete=function(string){
      var output=[];
      angular.forEach($scope.availableTags,function(company){
        if(company.toLowerCase().indexOf(string.toLowerCase())>=0){
          output.push(company);
        }
      });
      $scope.filterCompany = output;
    }


  /*****************************************************/
    // Function name : fillTextbox
    // Functionality: for filling textbox with auto suggested vendor list
    // Author : Sanchari Ghosh                               
    // Created Date : 27/12/2018                                          
    // Purpose:  Developing the functionality for filling textbox with auto suggested vendor list
  /*****************************************************/
  $scope.fillTextbox  = function(string){
      $scope.company        = string;
      $scope.filterCompany  = null;
  }
}
