<?php

/*****************************************************/
# Notification Controller             
# Class name : NotificationController
# Functionality: listing
# Author : Debamala Dey                                 
# Created Date :  31/08/2018                                
# Purpose: Developing the functionality of listing
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Models\TruckInsurance,App\Models\TruckPermit,App\Models\TruckTax,App\Models\TruckPollution,App\Models\TruckRegistration;

class NotificationController extends Controller {
 
	/*****************************************************/
	# Notification Controller             
	# Class name : NotificationController
	# Functionality: constructor
	# Author : Debamala Dey                                 
	# Created Date :  31/08/2018                                  
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}


	/*****************************************************/
	# Notification Controller             
	# Function name : notification_insurance_view
	# Functionality: view insurance notification listing page
	# Author : Debamala Dey                                 
	# Created Date :  31/08/2018                                 
	# Purpose:  to view insurance notification listing page  
	# Params :                                           
	/*****************************************************/
	public function notification_insurance_view(){

		TruckInsurance::where('read_status','0')->update(array('read_status' => 1)); 
		
		return view('notification.insuranceList');
	}



	/*****************************************************/
	# Notification Controller             
	# Function name : getInsuranceList
	# Functionality: get data of Insurance Notification listing 
	# Author : Debamala Dey                               
	# Created Date : 03/09/2018                                
	# Purpose:  to get data of Insurance Notification listing   
	# Params : Request $request                                          
	/*****************************************************/
	public function getInsuranceList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'TruckInsuranceTable' 		=> config('dbtables.truck_insurances'),
					'TruckTable' 				=> config('dbtables.trucks'),
				);

		/*get available records*/
		$insuranceList = TruckInsurance::availableRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$totalInsuranceList = TruckInsurance::totalRecords($dbTables,$request->searchKeyword);

		/*customizing final array*/
		$data['insuranceList'] 		= $insuranceList;
		$data['totalInsuranceList'] = $totalInsuranceList;
		$data['success']			= 'true'; 
		$data['currentPage']    	= $request->currentPage;
		/*customizing final array*/

		return $data;
	}



	/*****************************************************/
	# Notification Controller             
	# Function name : notification_permit_view
	# Functionality: view permit notification listing 
	# Author : Debamala Dey                                 
	# Created Date :  03/09/2018                                 
	# Purpose:  to view permit notification listing   
	# Params :                                           
	/*****************************************************/
	public function notification_permit_view(){

		TruckPermit::where('read_status','0')->update(array('read_status' => 1)); 
		
		return view('notification.permitList');
	}



	/*****************************************************/
	# Notification Controller             
	# Function name : getPermitList
	# Functionality: get data of permit Notification listing 
	# Author : Debamala Dey                               
	# Created Date : 03/09/2018                                
	# Purpose:  to get data of permit Notification listing   
	# Params : Request $request                                          
	/*****************************************************/
	public function getPermitList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'TruckPermitTable' 		=> config('dbtables.truck_permits'),
					'TruckTable' 			=> config('dbtables.trucks'),
				);

		/*get available records*/
		$permitList = TruckPermit::availableRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$totalPermitList = TruckPermit::totalRecords($dbTables,$request->searchKeyword);

		/*customizing final array*/
		$data['permitList'] 		= $permitList;
		$data['totalPermitList']    = $totalPermitList;
		$data['success']			= 'true'; 
		$data['currentPage']    	= $request->currentPage;
		/*customizing final array*/

		return $data;
	}



	/*****************************************************/
	# Notification Controller             
	# Function name : notification_tax_view
	# Functionality: view tax notification listing 
	# Author : Debamala Dey                                 
	# Created Date :  03/09/2018                                 
	# Purpose: to view tax notification listing   
	# Params :                                           
	/*****************************************************/
	public function notification_tax_view(){

		TruckTax::where('read_status','0')->update(array('read_status' => 1)); 
		
		return view('notification.taxList');
	}



	/*****************************************************/
	# Notification Controller             
	# Function name : getTaxList
	# Functionality: get data of tax Notification listing 
	# Author : Debamala Dey                               
	# Created Date : 03/09/2018                                
	# Purpose:  to get data of tax Notification listing   
	# Params : Request $request                                          
	/*****************************************************/
	public function getTaxList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'TruckTaxTable' 		=> config('dbtables.truck_taxes'),
					'TruckTable' 			=> config('dbtables.trucks'),
				);

		/*get available records*/
		$taxList = TruckTax::availableRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$totalTaxList = TruckTax::totalRecords($dbTables,$request->searchKeyword);

		/*customizing final array*/
		$data['taxList'] 		= $taxList;
		$data['totalTaxList']   = $totalTaxList;
		$data['success']		= 'true'; 
		$data['currentPage']    = $request->currentPage;
		/*customizing final array*/

		return $data;
	}





	/*****************************************************/
	# Notification Controller             
	# Function name : notification_pollution_view
	# Functionality: view pollution notification listing 
	# Author : Debamala Dey                                 
	# Created Date :  03/09/2018                                 
	# Purpose: to view pollution notification listing   
	# Params :                                           
	/*****************************************************/
	public function notification_pollution_view(){

		TruckPollution::where('read_status','0')->update(array('read_status' => 1)); 
		
		return view('notification.pollutionList');
	}




	/*****************************************************/
	# Notification Controller             
	# Function name : getPollutionList
	# Functionality: get data of pollution Notification listing 
	# Author : Debamala Dey                               
	# Created Date : 03/09/2018                                
	# Purpose:  to get data of pollution Notification listing   
	# Params : Request $request                                          
	/*****************************************************/
	public function getPollutionList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'TruckPollutionTable' 	=> config('dbtables.truck_pollutions'),
					'TruckTable' 			=> config('dbtables.trucks'),
				);

		/*get available records*/
		$pollutionList = TruckPollution::availableRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$totalPollutionList = TruckPollution::totalRecords($dbTables,$request->searchKeyword);

		/*customizing final array*/
		$data['pollutionList'] 		  = $pollutionList;
		$data['totalPollutionList']   = $totalPollutionList;
		$data['success']			  = 'true'; 
		$data['currentPage']    	  = $request->currentPage;
		/*customizing final array*/

		return $data;
	}



	/*****************************************************/
	# Notification Controller             
	# Function name : notification_registration_view
	# Functionality: view registration notification listing 
	# Author : Debamala Dey                                 
	# Created Date :  03/09/2018                                 
	# Purpose: to view registration notification listing   
	# Params :                                           
	/*****************************************************/
	public function notification_registration_view(){

		TruckRegistration::where('read_status','0')->update(array('read_status' => 1));
		
		return view('notification.registrationList');
	}




	/*****************************************************/
	# Notification Controller             
	# Function name : getRegistrationList
	# Functionality: get data of registration Notification listing 
	# Author : Debamala Dey                               
	# Created Date : 03/09/2018                                
	# Purpose:  to get data of registration Notification listing   
	# Params : Request $request                                           
	/*****************************************************/
	public function getRegistrationList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'TruckRegistrationTable'=> config('dbtables.truck_registrations'),
					'TruckTable' 			=> config('dbtables.trucks'),
				);

		/*get available records*/
		$pollutionList = TruckRegistration::availableRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$totalPollutionList = TruckRegistration::totalRecords($dbTables,$request->searchKeyword);

		/*customizing final array*/
		$data['registrationList'] 		  = $pollutionList;
		$data['totalRegistrationList']    = $totalPollutionList;
		$data['success']				  = 'true'; 
		$data['currentPage']    	      = $request->currentPage;
		/*customizing final array*/

		return $data;
	}
}
