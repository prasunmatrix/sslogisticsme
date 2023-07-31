'use strict'
// ==========================================================================
define(['angular'], function(){
    var app = angular.module('datepicker', []);

    app.directive('datepickershow', function() {
      var link;
      link = function(scope, element, attr, ngModel) {
          setTimeout(()=>{
            element = $('.date');
            element.datepicker({
                format: 'dd-mm-yyyy',
                defaultDate: scope.date,
            });
            element.on('dp.change', function(event) {
                scope.$apply(function() {
                    ngModel.$setViewValue(event.date._d);
                });
            });
          },500)
      };
      return {
        restrict: 'A',
        scope: {
          date: '=ngModel'
        },
        link: link
      };
    });



    /*enable only the selected date, previous date of selected date, next date of selected date, previous 7 dates*/
    app.directive('customdatepickershow', function() {
      var link;
      link = function(scope, element, attr, ngModel) {
          setTimeout(()=>{
            element = $('.date');
            element.datepicker({
                format: 'dd-mm-yyyy',
                defaultDate: scope.date,
                setDate:scope.date,
            });

            setTimeout(()=>{
              var selectedDateArr = scope.date.split('-');
              if ($('#currentUserRole').val() == $('#supervisorRoleId').val()) { 
                  element.datepicker('setStartDate', new Date(selectedDateArr[2],selectedDateArr[1]-1,parseInt(selectedDateArr[0])-parseInt(1)));
                  element.datepicker('setEndDate', new Date(selectedDateArr[2],selectedDateArr[1]-1,parseInt(selectedDateArr[0])+parseInt(1)));
              } else {
                  element.datepicker('setStartDate', new Date(selectedDateArr[2],selectedDateArr[1]-1,parseInt(selectedDateArr[0])-parseInt(7)));
                  element.datepicker('setEndDate', new Date(selectedDateArr[2],selectedDateArr[1]-1,parseInt(selectedDateArr[0])+parseInt(1)));
              }  
              element.on('dp.change', function(event) {
                  scope.$apply(function() {
                      ngModel.$setViewValue(event.date._d);
                  });
              });
             },500)
          },1000)

      };
      return {
        restrict: 'A',
        scope: {
          date: '=ngModel'
        },
        link: link
      };
    });



    
});