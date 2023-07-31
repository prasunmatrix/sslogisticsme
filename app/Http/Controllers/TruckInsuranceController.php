<?php

/*****************************************************/
# TruckInsurance Controller             
# Class name : TruckInsuranceController
# Functionality: listing, add, edit, deletion of truckInsurances
# Author : Sanchari Ghosh                                 
# Created Date :  13/08/2018                                
# Purpose: Developing the functionality of listing, add, edit, deletion of truckInsurances
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Models\TruckInsurance;


class TruckInsuranceController extends Controller {
 
	/*****************************************************/
	# TruckInsurance Controller             
	# Class name : TruckInsuranceController
	# Functionality: constructor
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                 
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}
	

	/*****************************************************/
	# TruckInsurance Controller             
	# Function name : index
	# Functionality: view truckInsurance listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  to view truckInsurance listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('truck_insurances.truckInsuranceList');
	}



	/*****************************************************/
	# TruckInsurance Controller             
	# Function name : getTruckInsuranceList
	# Functionality: get data of truckInsurance listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  to get data of truckInsurance listing page  
	# Params :                                           
	/*****************************************************/
	public function getTruckInsuranceList(){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'truckInsuranceTable' 	=> config('dbtables.truck_insurances'),
					'truckTable' 			=> config('dbtables.trucks'),
				);

		/*get available records*/
		$truckInsuranceList = TruckInsurance::availableRecords($dbTables,\Config::get('constants.adminPerPageRecord'));

		/*customizing final array*/
		$data['truckInsuranceList'] = $truckInsuranceList;
		$data['success']			= 'true'; 

		return $data;
	}




	/*****************************************************/
	# TruckInsurance Controller             
	# Function name : viewAddTruckInsurance
	# Functionality: view add truckInsurance page
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  view add truckInsurance page 
	# Params :                                            
	/*****************************************************/
	public function viewAddTruckInsurance(){
		return view('truck_insurances.addForm');
	}



	/*****************************************************/
	# TruckInsurance Controller             
	# Function name : viewEditTruckInsurance
	# Functionality: view edit truckInsurance page
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  view edit truckInsurance page 
	# Params :                                            
	/*****************************************************/
	public function viewEditTruckInsurance(){
		return view('truck_insurances.editForm');
	}




	/*****************************************************/
	# TruckInsurance Controller             
	# Function name : getEditTruckInsurance
	# Functionality: get edit truckInsurance page
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  get edit truckInsurance page 
	# Params :  Request $request                                          
	/*****************************************************/
	public function getEditTruckInsurance(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$truckInsuranceId = $request->truckInsuranceId;

		/*get available records*/
		$truckInsuranceDetails = TruckInsurance::find($truckInsuranceId);

		/*customizing final array*/
		$data['truckInsuranceDetails'] 	= $truckInsuranceDetails;
		$data['success'] 				= 'true';

		return $data;
	}






	/*****************************************************/
	# TruckInsurance Controller             
	# Function name : saveTruckInsurance
	# Functionality: save truckInsurance
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  save truckInsurance 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveTruckInsurance(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		
		if (isset($request->truckInsuranceId) && ($request->truckInsuranceId != '')) {
			$truckInsurance 					= TruckInsurance::find($request->truckInsuranceId);
			$truckInsurance->updated_by			= \Auth::user()->id;
		} else {
			$truckInsurance 					= new TruckInsurance();
			$truckInsurance->created_by			= \Auth::user()->id;
		}


		$truckInsurance->truck_id 			= $request->truck_id;
		$truckInsurance->policy_no 			= $request->policy_no;
    	$truckInsurance->name 				= $request->name;
    	$truckInsurance->policy_on 			= $request->policy_on;
    	$truckInsurance->policy_start 		= $request->policy_start;
    	$truckInsurance->policy_end 		= $request->policy_end;
    	$truckInsurance->policy_file 		= $request->policy_file;
    	$truckInsurance->status 			= $request->status;
    	
    	
    	$truckInsurance->save();

 		$data['success'] 		= 'true';

 		if (isset($request->truckInsuranceId) && ($request->truckInsuranceId != '')) {
			$request->session()->flash('alert-success', 'Truck Insurance Edited Successfully');
		} else {
			$request->session()->flash('alert-success', 'Truck Insurance Added Successfully');
		}
 		
        return $data;
	}




	/*****************************************************/
	# TruckInsurance Controller             
	# Function name : deleteTruckInsurance
	# Functionality: delete truckInsurance
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  delete truckInsurance 
	# Params :  Request $request                                          
	/*****************************************************/
	public function deleteTruckInsurance(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*delete data*/
		$truckInsurance = TruckInsurance::find($request->truckInsuranceId);
		$truckInsurance->deleted_by = \Auth::user()->id;/*logged in user id*/
		$truckInsurance->status     = 'D';
		$truckInsurance->is_deleted = 'Y';
		$truckInsurance->save();

		/*soft delete the record*/
		$truckInsurance->delete();

		$data['success']	= 'true'; 

		return $data;
		
	}
	

}
