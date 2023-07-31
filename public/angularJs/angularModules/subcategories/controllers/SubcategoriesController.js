'use strict';

/*****************************************************/
  // Subcategories Controller             
  // Function name : SubcategoriesController
  // Functionality: subcategory list , subcategory add, subcategory edit, subcategory delete, import subcategory
  // Author : Sanchari Ghosh                                 
  // Created Date : 07/08/2018                                        
  // Purpose:  Developing the functionalities of subcategories
/*****************************************************/

function SubcategoriesController($rootScope, $scope, $http, $window, $q, $location, $timeout, SubcategoriesService) {

  $scope.titleChange = '<h1>Subcategory</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.moduleName = 'subcategory';

  /*****************************************************/
  // Function name : viewCategoryList
  // Functionality: get lists of categories
  // Author : Sanchari Ghosh                               
  // Created Date : 07/08/2018                                        
  // Purpose:  Developing the functionality of get the lists of categories
  /*****************************************************/
  $scope.viewCategoryList = function(keyname){
         SubcategoriesService.makeAsyncCall(SubcategoriesService.getCategoryList())
        .then(function(response){
          if(response.data.success == "true"){
            $scope.records     = response.data.categoryList;
          }else{  
            var msg = 'Error'; 
            $rootScope.danger = msg;        
          }
            },function(reason){}).finally(function(data){

    });
    }


   /*****************************************************/
    // Function name : subcategoryList
    // Functionality: Subcategory List
    // Author : Sanchari Ghosh                               
    // Created Date : 07/08/2018                                          
    // Purpose:  Developing the functionality of listing subcategories with the help of SubcategoriesService
  /*****************************************************/
  $scope.subcategoryList = function(currentPage,orderby,ordertype,searchKeyword) {  

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

    var subcategoryData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 

    SubcategoriesService.makeAsyncCall(SubcategoriesService.subcategoryList(subcategoryData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.subcategoryList;
        $scope.total = response.data.totalSubcategory;
        $rootScope.paginationControl.currentPage  = response.data.currentPage;  
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : subcategoryEdit
    // Functionality: View Subcategory Edit page
    // Author : Sanchari Ghosh                               
    // Created Date : 07/08/2018                                          
    // Purpose:  Developing the functionality of view subcategory edit page with the help of SubcategoriesService
  /*****************************************************/ 
  $scope.subcategoryEdit = function(formObj) {  
    var subcategoryData = $location.absUrl();
    var subcategoryDataSplit = subcategoryData.split('/');
    var subcategoryId = 'subcategoryId='+subcategoryDataSplit[subcategoryDataSplit.length - 2]; 
    var currentPageNo = subcategoryDataSplit[subcategoryDataSplit.length - 1];

    $scope.viewCategoryList(); /*get  category list*/

    SubcategoriesService.makeAsyncCall(SubcategoriesService.subcategoryEdit(subcategoryId))
    .then(function(response){
      if(response.data.success == "true"){

        $scope.subcategoryId     = response.data.subcategoryDetails.id;
        $scope.selectCategory    = response.data.subcategoryDetails.category_id;
        $scope.subcategoryName   = response.data.subcategoryDetails.item_name;
        $scope.subcategoryDesc   = response.data.subcategoryDetails.item_description;
        $scope.status            = response.data.subcategoryDetails.status;
        $scope.currentPageNo     = currentPageNo;
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
    // Function name : saveCategory
    // Functionality: Save subcategory after add or edit
    // Author : Sanchari Ghosh                               
    // Created Date : 07/08/2018                                          
    // Purpose:  Developing the functionality of saving subcategories with the help of SubcategoriesService
  /*****************************************************/
  $scope.saveSubcategory = function(formObj) {

    var subcategoryData = "categoryId="+ $scope.selectCategory +"&subcategoryName=" + $scope.subcategoryName +"&subcategoryDesc=" + $scope.subcategoryDesc + "&status=" + $scope.status + "&currentPageNo=" + $scope.currentPageNo; ; 
    
    /*for Edit and Save subcategory*/
    if($scope.subcategoryId) {
      subcategoryData += '&subcategoryId='+$scope.subcategoryId;
    }

    SubcategoriesService.makeAsyncCall(SubcategoriesService.saveSubcategory(subcategoryData))
    .then(function(response){
      if(response.data.success == "true"){
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        if($scope.subcategoryId) {
          if($scope.currentPageNo) {
            $rootScope.paginationControl.currentPage = $scope.currentPageNo; 
          }
          
          /*for redirecting to same page after editing is done*/
          localStorage.setItem('currentPageNo', $scope.currentPageNo);
          localStorage.setItem('currentModule', $scope.moduleName);
        } 
        window.location.href =  baseUrl + "/subcategories";
      }else{  
        if(response.data.success == "not_numeric") {
            var msg = 'The id must contain numeric value'; 
        } else {
          var msg = 'Subcategory already exists'; 
        }
        $rootScope.danger = msg;   
        $rootScope.msgShow();    
      }
        },function(reason){}).finally(function(data){

        });
  }




  /*****************************************************/
    // Function name : deleteSubcategory
    // Functionality: Delete subcategory
    // Author : Sanchari Ghosh                               
    // Created Date : 07/08/2018                                          
    // Purpose:  Developing the functionality of deleting subcategory with the help of SubcategoriesService
  /*****************************************************/
  $scope.deleteSubcategory = function(formObj,currentPage,orderby,ordertype,searchKeyword) {

    if (confirm('Do You really want to delete the data? ')) {
      var subcategoryData = "subcategoryId=" + formObj; 
      
      /*for Edit and Save subcategory*/
      SubcategoriesService.makeAsyncCall(SubcategoriesService.deleteSubcategory(subcategoryData))
      .then(function(response){
        if(response.data.success == "true"){
          $scope.subcategoryList(currentPage,orderby,ordertype,searchKeyword); /*get subcategory list*/
          $rootScope.success = 'Deleted Succesfully';
          $rootScope.msgShow();
        }else{ 
          if(response.data.success == "not_numeric") {
            var msg = 'The id must contain numeric value'; 
          } else { 
            var msg = 'There are dependencies under this Sub-Category'; 
          }
          $rootScope.danger = msg;
          $rootScope.msgShow();        
        }
          },function(reason){}).finally(function(data){

          });
    }   
  }




 /*****************************************************/
    // Function name : saveSubcategoryCSV
    // Functionality: Save imported CSV file
    // Author : Sanchari Ghosh                               
    // Created Date : 09/08/2018                                          
    // Purpose:  Developing the functionality of saving imported csv file with the help of SubcategoriesService
  /*****************************************************/
   $scope.saveSubcategoryCSV = function(formObj) {
    if ($scope.contentData === undefined) {
      $rootScope.danger = 'Wrong File Type. Please upload CSV file.'; 
      $rootScope.msgShow();  
    } else {
      var dataLength = $scope.contentData[0].split(','); 
      if (dataLength.length == 4) {
        var subcatdata =  'subcatDetailsData='+ JSON.stringify($scope.contentData); 
        SubcategoriesService.makeAsyncCall(SubcategoriesService.saveCSVSubcategory(subcatdata))
          .then(function(response){
            if(response.data.success == "true"){
              $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
              window.location.href =  baseUrl + "/subcategories";
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
