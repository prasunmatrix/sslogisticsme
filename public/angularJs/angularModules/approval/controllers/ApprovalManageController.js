'use strict';

/*****************************************************/
  // ApprovalManageController           
  // Function name : ApprovalManageController
  // Author : Debamala Dey                                 
  // Created Date : 10/09/2018                                        
  // Purpose:  Developing the functionalities of Approval Manage
/*****************************************************/

function ApprovalManageController($rootScope, $scope, $http, $window, $q, $location, $timeout, ApprovalManageService) {

  $scope.titleChange = '<h1>Approval Manage</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.moduleName  = 'approval';

   /*****************************************************/
    // Function name : misclleneousList
    // Functionality: View misclleneous List
    // Author : Debamala Dey                                 
    // Created Date : 10/09/2018                                          
    // Purpose : Developing the functionality of listing misclleneous with the help of ApprovalManageService
  /*****************************************************/
  $scope.misclleneousList = function(currentPage,orderby,ordertype,searchKeyword) {  

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

    var misclleneousData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 

    ApprovalManageService.makeAsyncCall(ApprovalManageService.allMisclleneousList(misclleneousData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.misclleneousList;
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
    // Function name : approveMisclleneous
    // Functionality: approve misclleneous List
    // Author : Debamala Dey                                 
    // Created Date : 10/09/2018                                          
    // Purpose : Developing the functionality of approving misclleneous with the help of ApprovalManageService
  /*****************************************************/
  $scope.approveMisclleneous = function(id,currentPage,orderby,ordertype,searchKeyword) {  
    if(confirm('Do you really want to Approve?')) {
      // $scope.orderby = orderby;
      // $scope.ordertype = ordertype; 
      // $scope.searchKeyword = searchKeyword; 
      // $scope.changedOrderType = (ordertype == 'asc')?'desc':'asc'; 


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

      var approveData = "id=" + id; 
      ApprovalManageService.makeAsyncCall(ApprovalManageService.approveMisclleneousList(approveData))
      .then(function(response1){
        if(response1.data.success == "true"){
          var msg = 'Your request has been approved successfully'; 
          $rootScope.success = msg;

          var misclleneousData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 
          
          ApprovalManageService.makeAsyncCall(ApprovalManageService.allMisclleneousList(misclleneousData))
          .then(function(response){
            if(response.data.success == "true"){
              $scope.records = response.data.misclleneousList;
              $scope.total = response.data.total;
              $scope.currentPage  = currentPage; 
              localStorage.setItem('currentModule', $scope.moduleName);
              $rootScope.msgShow();      
            }else{  
              var msg = 'Error'; 
              $rootScope.danger = msg;        
            }
          },function(reason){}).finally(function(data){

          });         
        }else{  
          var msg = 'Error'; 
          $rootScope.danger = msg;        
        }
      },function(reason){}).finally(function(data){

      });

    }
  }
   /*****************************************************/
    // Function name : advanceList
    // Functionality: View advance List
    // Author : Debamala Dey                                 
    // Created Date : 10/09/2018                                          
    // Purpose : Developing the functionality of listing advance with the help of ApprovalManageService
  /*****************************************************/
  $scope.advanceList = function(currentPage,orderby,ordertype,searchKeyword) {  
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
    
    var advData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 

    ApprovalManageService.makeAsyncCall(ApprovalManageService.allAdvanceList(advData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.advanceList;
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
    // Function name : approveAdv
    // Functionality: approve advance List
    // Author : Debamala Dey                                 
    // Created Date : 10/09/2018                                          
    // Purpose : Developing the functionality of approving advance with the help of ApprovalManageService
  /*****************************************************/
  $scope.approveAdv = function(id,currentPage,orderby,ordertype,searchKeyword) {  
    if(confirm('Do you really want to Approve?')) {
      $scope.orderby = orderby;
      $scope.ordertype = ordertype; 
      $scope.searchKeyword = searchKeyword; 
      $scope.changedOrderType = (ordertype == 'asc')?'desc':'asc'; 

      var approveData = "id=" + id + "&status=Approved"; 
      ApprovalManageService.makeAsyncCall(ApprovalManageService.approveDisapproveAdv(approveData))
      .then(function(response1){
        if(response1.data.success == "true"){
          var msg = 'Your request has been approved successfully'; 
          $rootScope.success = msg;

          var advData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 

          ApprovalManageService.makeAsyncCall(ApprovalManageService.allAdvanceList(advData))
          .then(function(response){
            if(response.data.success == "true"){
              $scope.records = response.data.advanceList;
              $scope.total = response.data.total;
              $scope.currentPage  = currentPage; 
              localStorage.setItem('currentModule', $scope.moduleName);
              $rootScope.msgShow();  
            }else{  
              var msg = 'Error'; 
              $rootScope.danger = msg;        
            }
          },function(reason){}).finally(function(data){

          });         
        }else{  
          var msg = 'Error'; 
          $rootScope.danger = msg;        
        }
      },function(reason){}).finally(function(data){

      });

    }
  }
   /*****************************************************/
    // Function name : disapproveAdv
    // Functionality: disapprove advance List
    // Author : Debamala Dey                                 
    // Created Date : 10/09/2018                                          
    // Purpose : Developing the functionality of disapproving advance with the help of ApprovalManageService
  /*****************************************************/
  $scope.disapproveAdv = function(id,currentPage,orderby,ordertype,searchKeyword) {  
    if(confirm('Do you really want to Disapprove?')) {
      $scope.orderby = orderby;
      $scope.ordertype = ordertype; 
      $scope.searchKeyword = searchKeyword; 
      $scope.changedOrderType = (ordertype == 'asc')?'desc':'asc'; 

      var approveData = "id=" + id + "&status=Disapproved"; 
      ApprovalManageService.makeAsyncCall(ApprovalManageService.approveDisapproveAdv(approveData))
      .then(function(response1){
        if(response1.data.success == "true"){
          var msg = 'Your request has been disapproved successfully'; 
          $rootScope.success = msg;

          var advData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 

          ApprovalManageService.makeAsyncCall(ApprovalManageService.allAdvanceList(advData))
          .then(function(response){
            if(response.data.success == "true"){
              $scope.records = response.data.advanceList;
              $scope.total = response.data.total;
              $scope.currentPage  = currentPage; 
              localStorage.setItem('currentModule', $scope.moduleName);  
              $rootScope.msgShow();
            }else{  
              var msg = 'Error'; 
              $rootScope.danger = msg;        
            }
          },function(reason){}).finally(function(data){

          });         
        }else{  
          var msg = 'Error'; 
          $rootScope.danger = msg;        
        }
      },function(reason){}).finally(function(data){

      });

    }
  }



  /*****************************************************/
  // Function name : reasonPopup
  // Functionality: assign record in pop up
  // Author : Sanchari Ghosh                               
  // Created Date : 28/02/2019                                        
  // Purpose:  Developing the functionality of assigning record in pop up
  /*****************************************************/
  $scope.reasonPopup = function(key1,key2){
    $scope.dataId = key1;
    $scope.status = key2;
  }


  /*****************************************************/
    // Function name : advChangeApproval
    // Functionality: approve/disapprove advance List
    // Author : Sanchari Ghosh                                 
    // Created Date : 28/02/2019                                          
    // Purpose : Developing the functionality of approval/disapproving advance with the help of ApprovalManageService
  /*****************************************************/
  $scope.advChangeApproval = function() {

      var approveData = "id=" + $scope.dataId + "&status=" + $scope.status + "&reason=" + $scope.changeApprovalReason; 
      ApprovalManageService.makeAsyncCall(ApprovalManageService.approveDisapproveAdv(approveData))
      .then(function(response1){
        if(response1.data.success == "true"){
          $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
          window.location.href =  baseUrl + "/approvle-adv-view";         
        }else{  
          var msg = '';
          $rootScope.danger = msg;  
          $rootScope.msgShow();           
        }
      },function(reason){}).finally(function(data){

      });

  }




 /*****************************************************/
    // Function name : dieselList
    // Functionality: View diesel List
    // Author : Debamala Dey                                 
    // Created Date : 10/09/2018                                          
    // Purpose : Developing the functionality of listing diesel with the help of ApprovalManageService
  /*****************************************************/
  $scope.dieselList = function(currentPage,orderby,ordertype,searchKeyword) {  

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
    
    var dieselData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 

    ApprovalManageService.makeAsyncCall(ApprovalManageService.allDieselList(dieselData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.dieselList;
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
    // Function name : approveDiesel
    // Functionality: approve Diesel List
    // Author : Debamala Dey                                 
    // Created Date : 10/09/2018                                          
    // Purpose : Developing the functionality of approving Diesel with the help of ApprovalManageService
  /*****************************************************/
  $scope.approveDiesel = function(id,currentPage,orderby,ordertype,searchKeyword) {  
    if(confirm('Do you really want to Approve?')) {
      $scope.orderby = orderby;
      $scope.ordertype = ordertype; 
      $scope.searchKeyword = searchKeyword; 
      $scope.changedOrderType = (ordertype == 'asc')?'desc':'asc'; 

      var approveData = "id=" + id + "&status=Approved"; 
      ApprovalManageService.makeAsyncCall(ApprovalManageService.approveDisapproveDiesel(approveData))
      .then(function(response1){
        if(response1.data.success == "true"){
          var msg = 'Your request has been approved successfully'; 
          $rootScope.success = msg;

          var dieselData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 

          ApprovalManageService.makeAsyncCall(ApprovalManageService.allDieselList(dieselData))
          .then(function(response){
            if(response.data.success == "true"){
              $scope.records = response.data.dieselList;
              $scope.total = response.data.total;
              $scope.currentPage  = currentPage;   
              localStorage.setItem('currentModule', $scope.moduleName);
              $rootScope.msgShow();
            }else{  
              var msg = 'Error'; 
              $rootScope.danger = msg;        
            }
          },function(reason){}).finally(function(data){

          });       
        }else{  
          var msg = 'Error'; 
          $rootScope.danger = msg;        
        }
      },function(reason){}).finally(function(data){

      });

    }
  }

  /*****************************************************/
    // Function name : disapproveDiesel
    // Functionality: disapprove Diesel List
    // Author : Debamala Dey                                 
    // Created Date : 10/09/2018                                          
    // Purpose : Developing the functionality of disapproving Diesel with the help of ApprovalManageService
  /*****************************************************/
  $scope.disapproveDiesel = function(id,currentPage,orderby,ordertype,searchKeyword) {  
    if(confirm('Do you really want to Disapprove?')) {
      $scope.orderby = orderby;
      $scope.ordertype = ordertype; 
      $scope.searchKeyword = searchKeyword; 
      $scope.changedOrderType = (ordertype == 'asc')?'desc':'asc'; 

      var approveData = "id=" + id + "&status=Disapproved"; 
      ApprovalManageService.makeAsyncCall(ApprovalManageService.approveDisapproveDiesel(approveData))
      .then(function(response1){
        if(response1.data.success == "true"){
          var msg = 'Your request has been disapproved successfully'; 
          $rootScope.success = msg;

          var dieselData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 

          ApprovalManageService.makeAsyncCall(ApprovalManageService.allDieselList(dieselData))
          .then(function(response){
            if(response.data.success == "true"){
              $scope.records = response.data.dieselList;
              $scope.total = response.data.total;
              $scope.currentPage  = currentPage;   
              localStorage.setItem('currentModule', $scope.moduleName);
              $rootScope.msgShow();
            }else{  
              var msg = 'Error'; 
              $rootScope.danger = msg;        
            }
          },function(reason){}).finally(function(data){

          });       
        }else{  
          var msg = 'Error'; 
          $rootScope.danger = msg;        
        }
      },function(reason){}).finally(function(data){

      });

    }
  }  



  /*****************************************************/
    // Function name : dslChangeApproval
    // Functionality: approve/disapprove diesel List
    // Author : Sanchari Ghosh                                 
    // Created Date : 28/02/2019                                          
    // Purpose : Developing the functionality of approval/disapproving diesel with the help of ApprovalManageService
  /*****************************************************/
  $scope.dslChangeApproval = function() {
      var approveData = "id=" + $scope.dataId + "&status=" + $scope.status + "&reason=" + $scope.changeApprovalReason; 
      console.log(approveData);
      ApprovalManageService.makeAsyncCall(ApprovalManageService.approveDisapproveDiesel(approveData))
      .then(function(response1){
        if(response1.data.success == "true"){
          $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
          window.location.href =  baseUrl + "/approvle-dsl-view";         
        }else{  
          var msg = '';
          $rootScope.danger = msg;  
          $rootScope.msgShow();           
        }
      },function(reason){}).finally(function(data){

      });
  }



   /*****************************************************/
    // Function name : miscChangeApproval
    // Functionality: approve/disapprove Miscellaneous List
    // Author : Sanchari Ghosh                                 
    // Created Date : 15/03/2019                                          
    // Purpose : Developing the functionality of approval/disapproving Miscellaneous List with the help of ApprovalManageService
  /*****************************************************/
  $scope.miscChangeApproval = function() {

      var approveData = "id=" + $scope.dataId + "&status=" + $scope.status + "&reason=" + $scope.changeApprovalReason; 
      ApprovalManageService.makeAsyncCall(ApprovalManageService.approveDisapproveMisc(approveData))
      .then(function(response1){
        if(response1.data.success == "true"){
          $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
          window.location.href =  baseUrl + "/misclleneous-view";         
        }else{  
          var msg = '';
          $rootScope.danger = msg;  
          $rootScope.msgShow();           
        }
      },function(reason){}).finally(function(data){

      });

  }
}
