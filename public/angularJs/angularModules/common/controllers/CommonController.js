'use strict';

/*****************************************************/
	// Common Controller             
	// Function name : CommonController
	// Functionality: common functionalties of the sites
	// Author : Dilip Kumar Shaw                                 
	// Created Date : 26/07/2018                                        
	// Purpose:  Developing common functionalties of the sites (logout, sorting table column,get country/state/city lists) 
/*****************************************************/

function CommonController($rootScope, $timeout, $scope, $http, $window, $q, $location, CommonService) {

    
    $scope.gPlace; 

    //============================================
    
    /*default pagination settings*/
    $rootScope.paginationControl = {
    	orderby : 'id',
        ordertype : 'asc',          
        currentPage : 1,
        perPageRecord : 10,
        searchKeyword : ''
    };	
    //============================================

    //==Loding Bar
    angular.element(document).ready(function () {   
    	$("#loderMainDiv").hide("slow");

    	$timeout(function () { $("#loderMainDiv").hide("slow"); }, 1000);
    });
    //===========================================

	$scope.total = 0;
	// $scope.currentPage 	= 0;
	// $scope.perPageRecord = 10;


	$scope.phoneNumberPattern   = /^\+?[0-9]+$/ ; /*defining pattern of phone number*/
	$scope.numberPattern 		= /^[0-9]+$/ ; 
	$scope.emailPattern 		= /^[a-zA-Z0-9-._+]+(@[a-zA-Z0-9-.]{1,}[a-zA-Z0-9_.-]+\.)+[a-zA-Z]{2,4}$/ ;
	$scope.truckNumberPattern	= /^[a-z]{2}[-][0-9]{2}[a-z]{0,1}[-][0-9]{4}$/i;
	$scope.panNumberPattern 	= /^[a-z]{5}[0-9]{4}[a-z]{1}$/i;
	$scope.ifscCodePattern 		= /^[A-Za-z]{4}\d{7}$/;
	//$scope.ifscCodePattern 		= /^[A-Za-z0-9\(\)-_. ]+$/;
	$scope.bankAccNoPattern 	= /^\d{9,18}$/;
	//$scope.decimalNoPattern     = /\d+(\.\d{1,2})?/; 
	$scope.decimalNoPattern     = /^\d{0,7}(\.\d{0,2})?$/;

	//==================================================================
	$scope.msgDisplayTime = 2000;	
	$scope.msgDisplay = false; 
	$timeout(function () {
		 $scope.msgDisplay 						= true; 
		 $rootScope.success 					= '';
		 $rootScope.danger 						= '';
		 $rootScope.catSuccess 					= '';
		 $rootScope.catDanger 					= '';
		 $rootScope.plantSuccess 				= '';
		 $rootScope.plantDanger 				= '';
		 $rootScope.partySuccess 				= '';
		 $rootScope.partyDanger 				= '';
		 $rootScope.petrolPumpSuccess 			= '';
		 $rootScope.petrolPumpDanger 			= '';
		 $rootScope.subCatSuccess 				= '';
		 $rootScope.subCatDanger 				= '';
		 $rootScope.vendorSuccess 				= '';
		 $rootScope.vendorDanger 				= '';
		 $rootScope.truckSuccess 				= '';
		 $rootScope.truckDanger 				= '';
		 $rootScope.tripCloseSuccess 			= '';
		 $rootScope.tripCloseDanger 			= '';
		 $rootScope.advEditRequestSuccess 		= '';
		 $rootScope.advEditRequestDanger 		= '';
		 $rootScope.dslEditRequestSuccess 		= '';
		 $rootScope.dslEditRequestDanger 		= '';
		 $rootScope.reasonSuccess 				= '';
		 $rootScope.reasonDanger 				= '';
		 $rootScope.addressZoneSuccess 			= '';
		 $rootScope.addressZoneDanger 			= '';
		 $rootScope.podSuccess 					= '';
		 $rootScope.podDanger 					= '';
		 $rootScope.podDeleteSuccess 			= '';
		 $rootScope.podDeleteDanger 			= '';
		 

		 $('.flashMsgHolder').html('');
		 $('.flashMsgHolder').removeClass('alert-success').removeClass('alert-danger');
	}, $scope.msgDisplayTime);
	//==================================================================




	/*****************************************************/
	// Function name : msgShow
	// Functionality: hiding message after some time
	// Author : Sanchari Ghosh                               
	// Created Date : 29/08/2018                                        
	// Purpose:  Developing the functionality of hiding message after some time 
	/*****************************************************/
	$rootScope.msgShow = function(keyname){
		$scope.msgDisplayTime = 3000;	
		$scope.msgDisplay = false; 
		$timeout(function () { 
			$scope.msgDisplay 						= true;  
			$rootScope.success 						= '';
			$rootScope.danger 						= '';
			$rootScope.catSuccess 					= '';
		 	$rootScope.catDanger 					= '';
		 	$rootScope.plantSuccess 				= '';
		 	$rootScope.plantDanger 					= '';
		 	$rootScope.partySuccess 				= '';
		 	$rootScope.partyDanger 					= '';
		 	$rootScope.petrolPumpSuccess 			= '';
		 	$rootScope.petrolPumpDanger 			= '';
		 	$rootScope.subCatSuccess 				= '';
		 	$rootScope.subCatDanger 				= '';
		 	$rootScope.vendorSuccess 				= '';
		 	$rootScope.vendorDanger 				= '';
		 	$rootScope.truckSuccess 				= '';
		 	$rootScope.truckDanger 					= '';
		 	$rootScope.tripCloseSuccess 			= '';
		 	$rootScope.tripCloseDanger 				= '';
		 	$rootScope.advEditRequestSuccess 		= '';
		 	$rootScope.advEditRequestDanger 		= '';
		 	$rootScope.dslEditRequestSuccess 		= '';
		 	$rootScope.dslEditRequestDanger 		= '';
		 	$rootScope.reasonSuccess 				= '';
		 	$rootScope.reasonDanger 				= '';
		 	$rootScope.addressZoneSuccess 			= '';
		 	$rootScope.addressZoneDanger 			= '';
		 	$rootScope.podSuccess 					= '';
		 	$rootScope.podDanger 					= '';
			$('.flashMsgHolder').html('');
			$('.flashMsgHolder').removeClass('alert-success').removeClass('alert-danger');
		}, $scope.msgDisplayTime);
	}

	/*****************************************************/
	// Function name : adminLogout
	// Functionality: logout
	// Author : Sanchari Ghosh                               
	// Created Date : 30/07/2018                                        
	// Purpose:  Developing the functionality of logout 
	/*****************************************************/
	$scope.adminLogout = function(){
		$window.localStorage.clear();
		$window.location.href = baseUrl + '/do-logout';
	}



	/*****************************************************/
	// Function name : sort
	// Functionality: sort table column
	// Author : Sanchari Ghosh                               
	// Created Date : 03/08/2018                                        
	// Purpose:  Developing the functionality of sort on the basis of table column 
	/*****************************************************/
	$scope.sort = function(keyname){
        //$scope.sortKey = keyname;   //set the sortKey to the param passed
        //$scope.reverse = !$scope.reverse; //if true make it false and vice versa
    }



    /*****************************************************/
	// Function name : callCountryList
	// Functionality: get lists of countries
	// Author : Sanchari Ghosh                               
	// Created Date : 06/08/2018                                        
	// Purpose:  allow other Controller's function to call this function
	/*****************************************************/
    $rootScope.$on("callCountryList", function(){
           $scope.viewCountryList();
    });




    /*****************************************************/
	// Function name : callStateList
	// Functionality: get lists of states
	// Author : Sanchari Ghosh                               
	// Created Date : 07/08/2018                                        
	// Purpose:  allow other Controller's function to call this function
	/*****************************************************/
    $rootScope.$on("callStateList", function(event,countryId){
           $scope.viewStateList(countryId);
    });




    /*****************************************************/
	// Function name : callCityList
	// Functionality: get lists of cities
	// Author : Sanchari Ghosh                               
	// Created Date : 09/08/2018                                        
	// Purpose:  allow other Controller's function to call this function
	/*****************************************************/
    $rootScope.$on("callCityList", function(event,stateId){
           $scope.viewCityList(stateId);
    });




    /*****************************************************/
	// Function name : getLatLong
	// Functionality: get latitude longitude from given address
	// Author : Sanchari Ghosh                               
	// Created Date : 17/08/2018                                        
	// Purpose:  Developing the functionality of getting Latitude Longitude from Address
	/*****************************************************/
    $rootScope.getLatLong = function(keyname){
     	return new Promise((resolve, reject)=>{
		    CommonService.makeAsyncCall(CommonService.getLatLong(keyname))
		    .then(function(response){  
		      if(response.data.status == "OK"){
		      	$scope.lat  = response.data.results[0].geometry.location.lat;
		      	$scope.lng  = response.data.results[0].geometry.location.lng;
		      } else {  
		        var msg = 'Error'; 
		        $rootScope.danger = msg;        
		      }
		      resolve();
		        },function(reason){}).finally(function(data){

		     });
     		
     	})
    }


    /*****************************************************/
	// Function name : callGetSupervisor
	// Functionality: get lists of Supervisors
	// Author : Sanchari Ghosh                               
	// Created Date : 22/08/2018                                        
	// Purpose:  allow other Controller's function to call this function
	/*****************************************************/
    $rootScope.$on("callGetSupervisor", function(event,data = ''){
           $scope.getSupervisor(data);
    });




    /*****************************************************/
	// Function name : viewCountryList
	// Functionality: get lists of countries
	// Author : Sanchari Ghosh                               
	// Created Date : 06/08/2018                                        
	// Purpose:  Developing the functionality of get the lists of countries
	/*****************************************************/
	$scope.viewCountryList = function(keyname){
         CommonService.makeAsyncCall(CommonService.getCountryList())
		    .then(function(response){
		      if(response.data.success == "true"){
		        $scope.records 		 = response.data.countryList;
		      }else{  
		        var msg = 'Error'; 
		        $rootScope.danger = msg;        
		      }
		        },function(reason){}).finally(function(data){

		});
    }



    /*****************************************************/
	// Function name : viewStateList
	// Functionality: get lists of states
	// Author : Sanchari Ghosh                               
	// Created Date : 07/08/2018                                        
	// Purpose:  Developing the functionality of get the lists of states
	/*****************************************************/
	$scope.viewStateList = function(keyname){
         CommonService.makeAsyncCall(CommonService.getStateList(keyname))
		    .then(function(response){
		      if(response.data.success == "true"){
		        $scope.stateRecords 		 = response.data.stateList;
		      }else{  
		        var msg = 'Error'; 
		        $rootScope.danger = msg;        
		      }
		        },function(reason){}).finally(function(data){

		});
    }




    /*****************************************************/
	// Function name : viewCityList
	// Functionality: get lists of cities
	// Author : Sanchari Ghosh                               
	// Created Date : 09/08/2018                                        
	// Purpose:  Developing the functionality of get the lists of cities
	/*****************************************************/
	$scope.viewCityList = function(keyname){
         CommonService.makeAsyncCall(CommonService.getCityList(keyname))
		    .then(function(response){
		      if(response.data.success == "true"){
		        $scope.cityRecords 		 = response.data.cityList;
		      }else{  
		        var msg = 'Error'; 
		        $rootScope.danger = msg;        
		      }
		        },function(reason){}).finally(function(data){

		});
    }



    /*****************************************************/
	// Function name : getSupervisor
	// Functionality: get lists of supervisor
	// Author : Sanchari Ghosh                               
	// Created Date : 22/08/2018                                        
	// Purpose:  Developing the functionality of getting lists of Supervisor
	/*****************************************************/
    $scope.getSupervisor = function(data){
     	
	    CommonService.makeAsyncCall(CommonService.getSupervisor(data))
	    .then(function(response){
	      if(response.data.success == "true"){
	      	 
	      	$scope.supervisorRecords = response.data.supervisorList;
	      }else{  
	        var msg = 'Error'; 
	        $rootScope.danger = msg;        
	      }
	        },function(reason){}).finally(function(data){

	     });
    }




    /*****************************************************/
	// Function name : formatDate
	// Functionality: format given date as per requirement
	// Author : Sanchari Ghosh                               
	// Created Date : 05/09/2018                                        
	// Purpose:  Developing the functionality of formatting given date as per requirement
	/*****************************************************/
    $scope.formatDate = function(date){
          var dateOut = new Date(date);
          return dateOut;
    };


    /*****************************************************/
	// Function name : buildTableBody
	// Functionality: sub functionality of export data in pdf format
	// Author : Sanchari Ghosh                               
	// Created Date : 10/04/2019                                        
	// Purpose:  Developing the sub functionality of exporting data in pdf format
	/*****************************************************/ 
    $scope.buildTableBody = function(data, columns, actualHeader){
	    var body = [];

	    body.push(actualHeader);

	    data.forEach(function(row) {
	        var dataRow = [];

	        columns.forEach(function(column) {
	        	if (row[column] != null) {
	        		var newData = {text: row[column].toString(), fontSize: 8}
	        		dataRow.push(newData);
	        	} else {
	        		dataRow.push('-');
	        	}
	        })

	        body.push(dataRow);
	    });
	    return body;
	}

	/*****************************************************/
	// Function name : tableMake
	// Functionality: sub functionality of export data in pdf format
	// Author : Sanchari Ghosh                               
	// Created Date : 10/04/2019                                        
	// Purpose:  Developing the sub functionality of exporting data in pdf format
	/*****************************************************/ 
	$scope.tableMake = function(data, columns, actualHeader) { 
	    return {
	        table: {
	            headerRows: 1,
	            body: $scope.buildTableBody(data, columns, actualHeader)
	        }
	    };
	}




    /*****************************************************/
	// Function name : exportToPDF
	// Functionality: export data in pdf format
	// Author : Sanchari Ghosh                               
	// Created Date : 10/04/2019                                        
	// Purpose:  Developing the functionality of exporting data in pdf format(table format creation)
	/*****************************************************/ 
    $rootScope.exportToPDF = function(records){
    	var pdfName = 'report_'+Math.floor((Math.random() * 100000) + 1)+'.pdf';
    	var header = []; /*storing the field name of DB table*/
    	var actualHeader = []; /*storing the header name which will be shown in PDF*/
    	var columnSize = [];

    	/*Constructing the header*/
    	$('#pdfDataHolder tr.hiddenHeading th').each(function(){
    		header.push($(this).text());
    	});
    	$('#pdfDataHolder tr.actualHeading th').each(function(){
    		actualHeader.push($(this).text());
    	});

    	var docDefinition = {
        	pageSize: 'A2',
        	pageOrientation: 'potrait',

			content: [
				{ text: 'Reports', style: 'header' },
		        $scope.tableMake(records, header, actualHeader)
		    ],

            styles: {
				header: {
					fontSize: 20,
					bold: true,
					margin: [10, 10, 10, 10]
				},
				subheader: {
					fontSize: 10,
					bold: true,
					margin: [0, 0, 0, 10]
				}
			},
			layout: {
				fillColor: function (rowIndex, node, columnIndex) {
					return (rowIndex % 2 === 0) ? '#CCCCCC' : null;
				}
			},
        };
        pdfMake.createPdf(docDefinition).download(pdfName);

    }



    /*****************************************************/
	// Function name : exportLedgerToPDF
	// Functionality: export ledger data in pdf format
	// Author : Sanchari Ghosh                               
	// Created Date : 12/09/2019                                        
	// Purpose:  Developing the functionality of exporting data in pdf format(table format creation)
	/*****************************************************/ 
    $rootScope.exportLedgerToPDF = function(records){
    	var pdfName = 'report_'+Math.floor((Math.random() * 100000) + 1)+'.pdf';
    	var header = []; /*storing the field name of DB table*/
    	var actualHeader = []; /*storing the header name which will be shown in PDF*/
    	var columnSize = [];

    	/*Constructing the header*/
    	$('#pdfDataHolder tr.hiddenHeading th').each(function(){
    		header.push($(this).text());
    	});
    	$('#pdfDataHolder tr.actualHeading th').each(function(){
    		actualHeader.push($(this).text());
    	});

    	var docDefinition = {
        	pageSize: 'A4',
        	pageOrientation: 'potrait',

			content: [
				{ text: 'Ledger Reports', style: 'header' },
		        $scope.tableMake(records, header, actualHeader)
		    ],

            styles: {
				header: {
					fontSize: 20,
					bold: true,
					margin: [10, 10, 10, 10]
				},
				subheader: {
					fontSize: 10,
					bold: true,
					margin: [0, 0, 0, 10]
				}
			},
			layout: {
				fillColor: function (rowIndex, node, columnIndex) {
					return (rowIndex % 2 === 0) ? '#CCCCCC' : null;
				}
			},
        };
        pdfMake.createPdf(docDefinition).download(pdfName);

    }


    /*****************************************************/
	// Function name : exportToPDFCanvas
	// Functionality: export data in pdf format using html2cnvas
	// Author : Sanchari Ghosh                               
	// Created Date : 24/04/2019                                        
	// Purpose:  Developing the functionality of exporting data in pdf format using html2cnvas
	/*****************************************************/ 
    $rootScope.exportToPDFCanvas = function(){
    	var pdfName = Math.floor((Math.random() * 100000) + 1)+'.pdf';
    	
    	html2canvas(document.getElementById('pdfDataHolder'), {
            onrendered: function (canvas) {
                var data = canvas.toDataURL();
                var docDefinition = {
                    content: [{
                        image: data,
                        width: 500,
                    }]
                };
                pdfMake.createPdf(docDefinition).download(pdfName);
            }
        });
    }


    /*****************************************************/
	// Function name : getPDF
	// Functionality: export data in pdf format using html2cnvas & jspdf
	// Author : Sanchari Ghosh                               
	// Created Date : 26/04/2019                                        
	// Purpose:  Developing the functionality of exporting data in pdf format using html2cnvas & jspdf
	/*****************************************************/ 
    $rootScope.getPDF = function(){
    	var pdfName = Math.floor((Math.random() * 100000) + 1)+'.pdf';

		var HTML_Width 			= $("#pdfDataHolder").width();
		var HTML_Height 		= $("#pdfDataHolder").height();
		var top_left_margin 	= 15;
		//var PDF_Width 			= HTML_Width+(top_left_margin*2);
		//var PDF_Height 			= (PDF_Width*1.5)+(top_left_margin*2);
		var PDF_Width 			= $('#originalPDF').width()+70;
		var PDF_Height          = $('#originalPDF').height()+58.75;
		var canvas_image_width  = HTML_Width;
		var canvas_image_height = HTML_Height;
		var totalPDFPages 		= Math.ceil(HTML_Height/PDF_Height)-1;
		 

		html2canvas($("#pdfDataHolder")[0], {
    		allowTaint:true,
    		//scale: 3000,
            onrendered: function (canvas) {
                canvas.getContext('2d');
				 
				var imgData = canvas.toDataURL();
				var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
				pdf.addImage(imgData, 'JPEG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
				 
				 
				for (var i = 1; i <= totalPDFPages; i++) { 
					pdf.addPage(PDF_Width, PDF_Height);
					pdf.addImage(imgData, 'JPEG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
				}
				pdf.save(pdfName);
            }
        });
	}



    /*****************************************************/
	// Function name : inWords
	// Functionality: convert a number in text format
	// Author : Sanchari Ghosh                               
	// Created Date : 26/09/2018                                        
	// Purpose:  Developing the functionality of converting a number in text format
	/*****************************************************/
	$rootScope.inWords = function(num){
	    var a = ['','One ','Two ','Three ','Four ', 'Five ','Six ','Seven ','Eight ','Nine ','Ten ','Eleven ','Twelve ','Thirteen ','Fourteen ','Fifteen ','Sixteen ','Seventeen ','Eighteen ','Nineteen '];
		var b = ['', '', 'Twenty','Thirty','Forty','Fifty', 'Sixty','Seventy','Eighty','Ninety'];


	    if ((num = num.toString()).length > 9) {
	    	return 'overflow';
	    }
	    var n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
	    if (!n) {
	    	return;
	    } 
	    var str = '';
	    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'Crore ' : '';
	    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'Lakh ' : '';
	    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'Thousand ' : '';
	    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'Hundred ' : '';
	    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
	    return str;
	}




	/*****************************************************/
	    // Function name : saveModalAddressZone
	    // Functionality: save address zone from modal
	    // Author : Sanchari Ghosh                               
	    // Created Date : 11/03/2019                                          
	    // Purpose:  Developing the functionality of saving address zone from  modal with the help of CommonService
	/*****************************************************/
	$scope.saveModalAddressZone = function(formObj) {
	    var addressData = "title=" + $scope.adressTitle + "&address=" + $scope.addressZoneAddress; 
	    CommonService.makeAsyncCall(CommonService.saveModalAddressZone(addressData))
	    .then(function(response){
	      if(response.data.success == "true"){
	      	$rootScope.disableSubmitButton(); /*disable submit button after form submission*/
	      	$scope.getAddressZoneListing(); /*reload the address zones*/
	        var msg = response.data.msg; 
	        $rootScope.addressZoneSuccess = msg;    
	        $rootScope.msgShow();  
	        $timeout(function () { 
	          $('.closeModal').click(); /*close modal*/
	          $scope.adressTitle = '';
	          $scope.addressZoneAddress = '';
	          $scope.selectAddressZone = response.data.lastInsertedId;
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
    // Function name : getAddressZoneListing
    // Functionality: get Address Zone List
    // Author : Sanchari Ghosh                               
    // Created Date : 11/03/2019                                          
    // Purpose:  Developing the functionality of getting Address Zone List with the help of CommonService
    /*****************************************************/
	  $scope.getAddressZoneListing = function() {
	    CommonService.makeAsyncCall(CommonService.getAddressZoneListing())
	    .then(function(response){
	      if(response.data.success == "true"){
	        $scope.addressZoneRecords = response.data.addressZoneList;  
	      }else{  
	        var msg = 'Error'; 
	        $rootScope.danger = msg;        
	      }
	    },function(reason){}).finally(function(data){

	    });
	  }



	/*****************************************************/
    // Function name : disableSubmitButton
    // Functionality: disable submit button after form submission
    // Author : Sanchari Ghosh                               
    // Created Date : 16/05/2019                                          
    // Purpose:  Developing the functionality of disabling submit button after form submission
    /*****************************************************/  
	$rootScope.disableSubmitButton = function() {  
		$('button[type=submit]').attr('disabled', true);

		$timeout(function () { 
			$('button[type=submit]').attr('disabled', false);
		}, 2000);
    }
}
//============================================================================