'use strict';

/*****************************************************/
  // Categories Controller             
  // Function name : CategoriesController
  // Functionality: category list , category add, category edit, category delete
  // Author : Sanchari Ghosh                                 
  // Created Date : 07/08/2018                                        
  // Purpose:  Developing the functionalities of categories
/*****************************************************/

function CategoriesController($rootScope, $scope, $http, $window, $q, $location, $timeout, CategoriesService) {

  $scope.titleChange = '<h1>Category</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';
  $scope.moduleName = 'category';

   /*****************************************************/
    // Function name : categoryList
    // Functionality: Category List
    // Author : Sanchari Ghosh                               
    // Created Date : 07/08/2018                                          
    // Purpose:  Developing the functionality of listing categories with the help of CategoriesService
  /*****************************************************/
  $scope.categoryList = function(currentPage,orderby,ordertype,searchKeyword) {  

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
    

    
    var categoryData = "currentPage=" + $rootScope.paginationControl.currentPage + "&perPageRecord=" + $rootScope.paginationControl.perPageRecord+"&orderby="+$rootScope.paginationControl.orderby+"&ordertype="+$rootScope.paginationControl.ordertype+"&searchKeyword="+$rootScope.paginationControl.searchKeyword; 
    CategoriesService.makeAsyncCall(CategoriesService.categoryList(categoryData))
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.categoryList;
        $scope.total = response.data.totalCategories;
        $rootScope.paginationControl.currentPage  = response.data.currentPage;  
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
        },function(reason){}).finally(function(data){

        });
  }



  /*****************************************************/
    // Function name : categoryEdit
    // Functionality: View Category Edit page
    // Author : Sanchari Ghosh                               
    // Created Date : 07/08/2018                                          
    // Purpose:  Developing the functionality of view category edit page with the help of CategoriesService
  /*****************************************************/ 
  $scope.categoryEdit = function(formObj) {  
    var categoryData = $location.absUrl();
    var categoryDataSplit = categoryData.split('/');
    var categoryId = 'categoryId='+categoryDataSplit[categoryDataSplit.length - 2]; 
    var currentPageNo = categoryDataSplit[categoryDataSplit.length - 1];

    CategoriesService.makeAsyncCall(CategoriesService.categoryEdit(categoryId))
    .then(function(response){
      if(response.data.success == "true"){

        $scope.categoryId     = response.data.categoryDetails.id;
        $scope.categoryName   = response.data.categoryDetails.category_name;
        $scope.categoryDesc   = response.data.categoryDetails.category_description;
        $scope.status         = response.data.categoryDetails.status;
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
    // Function name : saveCategory
    // Functionality: Save category after add or edit
    // Author : Sanchari Ghosh                               
    // Created Date : 07/08/2018                                          
    // Purpose:  Developing the functionality of saving categories with the help of CategoriesService
  /*****************************************************/
  $scope.saveCategory = function(formObj) {

    var categoryData = "categoryName=" + $scope.categoryName +"&categoryDesc=" + $scope.categoryDesc + "&status=" + $scope.status + "&currentPageNo=" + $scope.currentPageNo; ; 
    
    /*for Edit and Save category*/
    if($scope.categoryId) {
      categoryData += '&categoryId='+$scope.categoryId;
    }

    CategoriesService.makeAsyncCall(CategoriesService.saveCategory(categoryData))
    .then(function(response){
      if(response.data.success == "true"){ 
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        if($scope.categoryId) {
          if($scope.currentPageNo) {
            $rootScope.paginationControl.currentPage = $scope.currentPageNo; 
          }
          
          /*for redirecting to same page after editing is done*/
          localStorage.setItem('currentPageNo', $scope.currentPageNo);
          localStorage.setItem('currentModule', $scope.moduleName);
        } 
        window.location.href =  baseUrl + "/categories";
      }else{  
        var msg = 'Category already exists'; 
        $rootScope.danger = msg;  
        $rootScope.msgShow();
      }
        },function(reason){}).finally(function(data){

        });
  }




  /*****************************************************/
    // Function name : deleteCategory
    // Functionality: Delete category
    // Author : Sanchari Ghosh                               
    // Created Date : 07/08/2018                                          
    // Purpose:  Developing the functionality of deleting category with the help of CategoriesService
  /*****************************************************/
  $scope.deleteCategory = function(formObj,currentPage,orderby,ordertype,searchKeyword) {

    if (confirm('Do You really want to delete the data? ')) {
      var categoryData = "categoryId=" + formObj; 
      console.log(categoryData);
      /*for Edit and Save category*/
      CategoriesService.makeAsyncCall(CategoriesService.deleteCategory(categoryData))
      .then(function(response){
        if(response.data.success == "true"){
          $scope.categoryList(currentPage,orderby,ordertype,searchKeyword); /*get category list*/
          $rootScope.success = 'Deleted Succesfully';
          $rootScope.msgShow();         
        }else{  
          if(response.data.success == "not_numeric") {
            var msg = 'The id must contain numeric value'; 
          } else {
             var msg = 'There are dependencies under this Category'; 
          }
          
          $rootScope.danger = msg; 
          $rootScope.msgShow();       
        }
          },function(reason){}).finally(function(data){

          });
    }   
  }



}
