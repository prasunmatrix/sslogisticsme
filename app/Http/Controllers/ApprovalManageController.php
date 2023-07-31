<?php

/*****************************************************/
# ApprovalManage Controller             
# Class name : ApprovalManageController
# Functionality: listing
# Author : Debamala Dey                               
# Created Date :  10/09/2018                                
# Purpose: Developing the functionality of listing
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Hash;
use Illuminate\Support\Facades\Input;
use App\Models\Plant;
use App\Models\PlantJournalLaser,App\Models\PetrolPumpJournalLaserEditRequest;
use App\Models\User,App\Models\Trip,App\Models\Truck,App\Models\PlantJournalLaserEditRequest;
use App\Models\PetrolPumpJournalLaser;



class ApprovalManageController extends Controller {
 
	/*****************************************************/
	# ApprovalManage Controller             
	# Class name : ApprovalManageController
	# Functionality: constructor
	# Author : Debamala Dey                               
	# Created Date :  10/09/2018                             
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}
	


	/*****************************************************/
	# ApprovalManage Controller             
	# Class name : ApprovalManageController       
	# Function name : misclleneous
	# Functionality: view misclleneous listing page
	# Author : Debamala Dey                               
	# Created Date : 10/09/2018                          
	# Purpose:  to view misclleneous laser listing page  
	# Params :                                           
	/*****************************************************/
	public function misclleneous(){
		return view('approval.misclleneous');
	}




	/*****************************************************/
	# ApprovalManage Controller             
	# Function name : all_misclleneous_list
	# Functionality: get data of misclleneous listing page
	# Author : Debamala Dey                               
	# Created Date :  10/09/2018                            
	# Purpose:  to get data of misclleneous listing page  
	# Params :   Request $request                                        
	/*****************************************************/
	public function all_misclleneous_list(Request $request){
		$reqby = '';
		if(\Auth::user()->user_role_id == config('constants.supervisorRoleId')){
			$reqby = \Auth::user()->id;
		}

		$data 					= array(); /*storing data for listing*/		
		$dbTables = array(
					'plantJournalLaserTable' 	=> config('dbtables.plant_journal_lasers'),
					'userTable' 				=> config('dbtables.users'),
					'plantTable' 			 	=> config('dbtables.plants'),
					'plantUserRelationTable'    => config('dbtables.plant_user_relations')
				);
		/*get available records*/
		$misclleneousList = PlantJournalLaser::availableMisclleneousRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword,$reqby);
		$total = PlantJournalLaser::totalMisclleneousRecords($dbTables,$request->searchKeyword,$reqby);

		$data['misclleneousList'] 		= $misclleneousList;
		$data['total'] 					= $total;
		$data['success']				= 'true'; 
		$data['currentPage']    		= $request->currentPage;
		return $data;
	}




	/*****************************************************/
	# ApprovalManage Controller             
	# Function name : approve_misclleneous
	# Functionality: approve particular misclleneous request
	# Author : Debamala Dey                               
	# Created Date :  10/09/2018                            
	# Purpose:  approve particular misclleneous request
	# Params : Request $request                                           
	/*****************************************************/
	public function approve_misclleneous(Request $request){

		$data 					= array(); /*storing data for listing*/		
		/*get available records*/
		$plantJournalLaser 					= PlantJournalLaser::find($request->id);
		$plantJournalLaser->approval_status = $request->status;
		$plantJournalLaser->status 			= 'I';
	    $plantJournalLaser->approved_by 	= \Auth::user()->id;
	    $plantJournalLaser->approved_on 	= date('Y-m-d h:i:s');
	    $plantJournalLaser->reason 			= $request->reason;
	    $plantJournalLaser->save();

		$data['success']		= 'true'; 
		return $data;
	}



	/*****************************************************/
	# ApprovalManage Controller             
	# Class name : ApprovalManageController       
	# Function name : approvle_adv_view
	# Functionality: view advance listing page
	# Author : Debamala Dey                               
	# Created Date : 10/09/2018                          
	# Purpose:  to view misclleneous laser listing page  
	# Params :                                           
	/*****************************************************/
	public function approvle_adv_view(){
		return view('approval.advance');
	}



	/*****************************************************/
	# ApprovalManage Controller             
	# Function name : all_adv_list
	# Functionality: get data of advance listing page
	# Author : Debamala Dey                               
	# Created Date :  10/09/2018                            
	# Purpose:  to get data of advance listing page  
	# Params : Request $request                                          
	/*****************************************************/
	public function all_adv_list(Request $request){
		$reqby = '';
		if(\Auth::user()->user_role_id == config('constants.supervisorRoleId')){
			$reqby = \Auth::user()->id;
		}

		$data 					= array(); /*storing data for listing*/		
		$dbTables = array(
					'plantJournalLasersEditRequestTable' 	=> config('dbtables.plant_journal_lasers_edit_requests'),
					'userTable' 				=> config('dbtables.users'),
					'plantTable' 				=> config('dbtables.plants'),
					'truckTable' 				=> config('dbtables.trucks'),
					'tripTable' 				=> config('dbtables.trips'),
				);


		/*get available records*/
		$advanceList = PlantJournalLaserEditRequest::availableAdvRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword,$reqby);
		$total = PlantJournalLaserEditRequest::totalAdvRecords($dbTables,$request->searchKeyword,$reqby);

		$data['advanceList'] 	= $advanceList;
		$data['total'] 			= $total;
		$data['success']		= 'true'; 
		$data['currentPage']    = $request->currentPage;
		return $data;
	}


	/*****************************************************/
	# ApprovalManage Controller             
	# Function name : approve_adv
	# Functionality: approve/disapprove advance
	# Author : Debamala Dey                               
	# Created Date :  10/09/2018                            
	# Purpose:  approve/disapprove advance 
	# Params : Request $request                                          
	/*****************************************************/
	public function approve_adv(Request $request){
		$data 									= array(); /*storing data for listing*/		
		$plantJournalLaserReq 					= PlantJournalLaserEditRequest::find($request->id);
		$tripId 								= $plantJournalLaserReq->trip_id;
		$reqAmount								= $plantJournalLaserReq->requested_amount;
	    $plantJournalLaserReq->approved_by 		= \Auth::user()->id;
	    $plantJournalLaserReq->approved_on 		= date('Y-m-d h:i:s');
	    $plantJournalLaserReq->approval_status 	= $request->status;
	    $plantJournalLaserReq->approval_reason 	= $request->reason;
	    $plantJournalLaserReq->status 			= 'I';
	    $plantJournalLaserReq->save();

	    if ($request->status == 'Approved') {
	    	Trip::where('id',$tripId)->update(array('advance_amount' => $reqAmount)); 
	    	PlantJournalLaser::where('trip_id',$tripId)->update(array('amount' => $reqAmount));
	    }

		$data['success']		= 'true'; 
		return $data;
	}


	/*****************************************************/
	# ApprovalManage Controller             
	# Class name : ApprovalManageController       
	# Function name : approvle_dsl_view
	# Functionality: view diesel listing page
	# Author : Debamala Dey                               
	# Created Date : 10/09/2018                          
	# Purpose:  to view diesel listing page  
	# Params :                                           
	/*****************************************************/
	public function approvle_dsl_view(){
		return view('approval.diesel');
	}




	/*****************************************************/
	# ApprovalManage Controller             
	# Function name : all_dsl_list
	# Functionality: get data of diesel listing page
	# Author : Debamala Dey                               
	# Created Date :  10/09/2018                            
	# Purpose:  to get data of diesel listing page  
	# Params : Request $request                                          
	/*****************************************************/
	public function all_dsl_list(Request $request){
		$reqby = '';
		if(\Auth::user()->user_role_id == config('constants.supervisorRoleId')){
			$reqby = \Auth::user()->id;
		}

		$data 					= array(); /*storing data for listing*/		
		$dbTables = array(
					'petrolPumpJournalLasersEditRequestTable' 	=> config('dbtables.petrol_pump_journal_lasers_edit_requests'),
					'userTable' 				=> config('dbtables.users'),
					'plantTable' 				=> config('dbtables.plants'),
					'petrolpumpTable' 			=> config('dbtables.petrol_pumps'),
					'truckTable' 				=> config('dbtables.trucks'),
					'tripTable' 				=> config('dbtables.trips'),
				);


		/*get available records*/
		$dieselList = PetrolPumpJournalLaserEditRequest::availableDSLRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword,$reqby);
		$total = PetrolPumpJournalLaserEditRequest::totalDSLRecords($dbTables,$request->searchKeyword,$reqby);

		$data['dieselList'] 	= $dieselList;
		$data['total'] 			= $total;
		$data['success']		= 'true'; 
		$data['currentPage']    = $request->currentPage;
		return $data;
	}



	
	/*****************************************************/
	# ApprovalManage Controller             
	# Function name : approve_dsl
	# Functionality: approve/disapprove diesel
	# Author : Debamala Dey                               
	# Created Date :  10/09/2018                            
	# Purpose:  approve/disapprove diesel 
	# Params : Request $request                                          
	/*****************************************************/
	public function approve_dsl(Request $request){
		$data 										= array(); /*storing data for listing*/	
		$petrolpumpJournalLaserReq 					= PetrolPumpJournalLaserEditRequest::find($request->id);
		$tripId 									= $petrolpumpJournalLaserReq->trip_id;
		$reqAmount									= $petrolpumpJournalLaserReq->requested_amount;
	    $petrolpumpJournalLaserReq->approved_by 	= \Auth::user()->id;
	    $petrolpumpJournalLaserReq->approved_on 	= date('Y-m-d h:i:s');
	    $petrolpumpJournalLaserReq->approval_status = $request->status;
	    $petrolpumpJournalLaserReq->approval_reason = $request->reason;
	    $petrolpumpJournalLaserReq->status 			= 'I';
	    $petrolpumpJournalLaserReq->save();

	    if ($request->status == 'Approved') {
	    	Trip::where('id',$tripId)->update(array('diesel_amount' => $reqAmount)); 
	    	PetrolPumpJournalLaser::where('trip_id',$tripId)->update(array('amount' => $reqAmount));
	    }

		$data['success']		= 'true'; 
		return $data;
	}
	
}
