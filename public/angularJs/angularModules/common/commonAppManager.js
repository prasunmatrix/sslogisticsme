'use strict'
define([ 
        'angular',
        'ngAnimate',
        'ngSanitize',
        'uiSelect',
        'spinner',
        'angularModules/common/controllers/CommonController',
		'angularModules/common/services/CommonService',		
		'bower_components/angular-paging/dist/paging',
		'angularModules/common/directives/datepicker',
		'bower_components/angularjs-dropdown-multiselect/dist/angularjs-dropdown-multiselects.min',
		//'bower_components/pdfmake/build/pdfmake.min',	
		], function() {
	var coreModule = angular.module('myApp', ['ngAnimate', 'ngSanitize', 'ui.select', 'treasure-overlay-spinner', 'bw.paging','datepicker','angularjs-dropdown-multiselect',
		]);
	// ==========================================================================
	
	// ==========================================================================
	coreModule.value('APIEndpoint', {
		base : baseUrl,
	});




	//==================================== COMPARE VALUE FOR 2 FIELDS =====================
	var compareTo = function() {
	    return {
	      require: "ngModel",
	      scope: {
	        otherModelValue: "=compareTo"
	      },
	      link: function(scope, element, attributes, ngModel) {

	        ngModel.$validators.compareTo = function(modelValue) {
	          return modelValue == scope.otherModelValue;
	        };

	        scope.$watch("otherModelValue", function() {
	          ngModel.$validate();
	        });
	      }
	    };
	  };
	//====================================== COMPARE VALUE FOR 2 FIELDS =====================







	//======================================= COMPARE VALUE FOR 2 DATES =====================
	coreModule.directive("compareWithStartDate", function () {
	    return {
	        restrict: "A",
	        require: "?ngModel",
	        link: function (scope, element, attributes, ngModel) {
	            var validateEndDate = function (endDate, startDate) {
	                if (endDate && startDate) {
	                 	var start = startDate.split("-"); 
	            		startDate = new Date(start[2], start[1] - 1, start[0]); 
	                    var end = endDate.split("-"); 
	                    endDate = new Date(end[2], end[1] - 1, end[0]); 
	                    return endDate >= startDate;
	                }
	                else {
	                    return true;
	                }
	            }
	 
	            // use $validators.validation_name to do the validation
	            ngModel.$validators.checkEndDate = function (modelValue) {
	                return validateEndDate(modelValue, attributes.startDate);
	            };
	             
	            // use $observe if we need to keep an eye for changes on a passed value
	            attributes.$observe('startDate', function (value) {
	                var startDate = value;
	                var endDate = ngModel.$viewValue;
	                 
	                // use $setValidity method to determine the validation result 
	                // the first parameter is the validation name, this name is the same in ng-message template as well
	                // the second parameter sets the validity (true or false), we can pass a function returning a boolean
	                ngModel.$setValidity("checkEndDate", validateEndDate(endDate, startDate));
	            });
	        }
	    };
	});
	//========================================== COMPARE VALUE FOR 2 FIELDS =====================







   //============================ SPINNER =========================================
	coreModule.run(['$rootScope','$window',function($rootScope,$window){
		//'treasure-overlay-spinner'
		$rootScope.spinner = {
			active: false,
			on: function () {
				this.active = true;
			},
			off: function () {
				this.active = false;
			}
		};
	} ]);

	// ============================== SPINNER =======================================




	//=============================== CSV EXPORT =====================================
	coreModule.directive('exportToCsv',function($document){ 
	  	return {
	    	restrict: 'A',
	    	link: function (scope, element, attrs) {
	    		var el = element[0];
		        element.bind('click', function(e){
		        	var csvName = 'table_'+Math.floor((Math.random() * 100000) + 1)+'.csv';
		        	var table = document.getElementById('tableContainer'); 
		        	var csvString = '';
		        	for(var i=0; i<table.rows.length;i++){
		        		var rowData = table.rows[i].cells; 

		        		for(var j=0; j<rowData.length-1;j++){
		        			var myStr = '';

		        			/*calculating the colspan if available*/
		        			if (rowData[j].hasAttribute('colspan')) {
		        				for (var k = 1; k < rowData[j].getAttribute('colspan'); k++) {
		        					myStr += '=" ",';
		        				}
		        			} 

		        			/*for any textfield or dynamic field value (Reference:- Payment Report page)*/
		        			if (rowData[j].hasAttribute('rel')) {
		        				var relContent = rowData[j].getAttribute('rel');

		        				if (document.getElementById(relContent).value !== undefined) {
		        					myStr += '="'+document.getElementById(relContent).value+'",';
		        				}
		        			}

		        			/*get the cell's text value that not having any dynamic text field or select box*/
		        			if (!rowData[j].hasAttribute('nocsv')) {
		        				var textString = rowData[j].textContent.trim().replace(/,/g, '   ');
		        			} else {
		        				var textString = '';
		        			}
	        				myStr  += '="'+textString+'"';
		        			csvString  += myStr + ','; 
		        		} 
		        		csvString = csvString.substring(0,csvString.length - 1);
		        		csvString = csvString + "\n"; 
				    }
		         	csvString = csvString.substring(0, csvString.length - 1);
		         	var a = $('<a/>', {
			            style:'display:none',
			            href:'data:application/octet-stream;base64,'+btoa(csvString),
			            download:csvName
			        }).appendTo('body')
			        a[0].click()
			        a.remove();
		        });
	    	}
	  	}
	});
	//=============================== CSV EXPORT =====================================




	//================================ CSV IMPORT =====================================
	coreModule.directive('fileReader', function() {//text/csv
	  return {
	    scope: {
	      fileReader:"="
	    },
	    link: function(scope, element) {
	      $(element).on('change', function(changeEvent) {
	        var files = changeEvent.target.files;
	        console.log(files[0].type);

	        /*allow CSV files*/
	        if ((files[0].type == 'text/csv') || (files[0].type == 'application/vnd.ms-excel')) { 
		        if (files.length) {
		          var r = new FileReader();
		          r.onload = function(e) {
		              var contents = e.target.result;
		              scope.$apply(function () {
		                var contentDataSplit = contents.split('\n');
		                scope.fileReader = contentDataSplit;
		                scope.data = contentDataSplit;
		              });
		          };
		          r.readAsText(files[0]);
		        }
	    	} 
	      });
	    }
	  };
	});
	//================================ CSV IMPORT ========================================





	//================================ FILE UPLOAD DIRECTIVE ========================================
	coreModule.directive('fileModel', ['$parse', function ($parse) {
            return {
               restrict: 'A',
               link: function(scope, element, attrs) {
                  var model = $parse(attrs.fileModel);
                  var modelSetter = model.assign;
                  
                  element.bind('change', function(){
                     scope.$apply(function(){
                        modelSetter(scope, element[0].files[0]);
                     });
                  });
               }
            };
         }]);
	//================================ FILE UPLOAD DIRECTIVE ========================================






	//================================ FILE UPLOAD SERVICE ========================================
	coreModule.service('fileUploadService', function ($http, $q) { 
	        this.uploadFileToUrl = function (file, uploadUrl) { 
	            //FormData, object of key/value pair for form fields and values
	            var fileFormData = new FormData();
	            fileFormData.append('file', file);
	 
	            try {
				    return $http({
				        method: 'POST',
				        url: uploadUrl,
				        data: fileFormData,
				        headers: {'Content-Type': undefined}
				    })
				    .then(function successCallback(response) {	
					    return response;
					     
					  },function errorCallback(response) {
					    return response;
					  });

				} catch (error) {
					console.warn('error occured' + error.toString());
				}
	        }
	    });
	//================================ FILE UPLOAD SERVICE ========================================




	//====================================================================================
    coreModule.controller('commonController', CommonController);
	coreModule.service('CommonService', CommonService);
	coreModule.directive('compareTo', compareTo);
	// ==========================================================================
});
