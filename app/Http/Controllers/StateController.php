<?php

/*****************************************************/
# State Controller             
# Class name : StateController
# Functionality: listing, add, edit, deletion of states
# Author : Sanchari Ghosh                                 
# Created Date :  03/08/2018                                
# Purpose: Developing the functionality of listing, add, edit, deletion of states
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Models\State;
use App\Models\Country;
use App\Models\City;

class StateController extends Controller {
 
	/*****************************************************/
	# State Controller             
	# Class name : StateController
	# Functionality: constructor
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/08/2018                                 
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}
	

	/*****************************************************/
	# State Controller             
	# Function name : index
	# Functionality: view state listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/08/2018                                
	# Purpose:  to view state listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('states.stateList');
	}



	/*****************************************************/
	# State Controller             
	# Function name : getStateList
	# Functionality: get data of state listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/08/2018                                
	# Purpose:  to get data of state listing page  
	# Params : Request $request                                          
	/*****************************************************/
	public function getStateList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'stateTable' 				=> config('dbtables.states'),
					'countryTable' 				=> config('dbtables.countries'),
				);

		/*get available records*/
		$stateList = State::availableRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$totalStates = State::totalRecords($dbTables,$request->searchKeyword);

		/*customizing final array*/
		$data['stateList'] 		= $stateList;
		$data['totalStates'] 	= $totalStates;
		$data['success']		= 'true'; 

		return $data;
	}



	/*****************************************************/
	# State Controller             
	# Function name : viewCountryList
	# Functionality: get country lists
	# Author : Sanchari Ghosh                                 
	# Created Date : 06/08/2018                                
	# Purpose:  get country lists
	# Params : $countryId = ''                                          
	/*****************************************************/
	public function viewCountryList($countryId = ''){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$countryList = Country::where('status','A')->get();

		/*customizing final array*/
		$data['countryList'] 		= $countryList;
		$data['success'] 			= 'true';

		return $data;
	}



	/*****************************************************/
	# State Controller             
	# Function name : viewAddState
	# Functionality: view add state page
	# Author : Sanchari Ghosh                                 
	# Created Date : 06/08/2018                                
	# Purpose:  view add state page 
	# Params :                                            
	/*****************************************************/
	public function viewAddState(){
		return view('states.addForm');
	}



	/*****************************************************/
	# State Controller             
	# Function name : viewEditState
	# Functionality: view edit state page
	# Author : Sanchari Ghosh                                 
	# Created Date : 06/08/2018                                
	# Purpose:  view edit state page 
	# Params :                                            
	/*****************************************************/
	public function viewEditState(){
		return view('states.editForm');
	}




	/*****************************************************/
	# State Controller             
	# Function name : getEditState
	# Functionality: get edit state page
	# Author : Sanchari Ghosh                                 
	# Created Date : 06/08/2018                                
	# Purpose:  get edit state page 
	# Params :  Request $request                                          
	/*****************************************************/
	public function getEditState(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$stateId = $request->stateId;

		/*get available records*/
		$stateDetails = State::find($stateId);

		/*customizing final array*/
		$data['stateDetails'] 		= $stateDetails;
		$data['success'] 			= 'true';

		return $data;
	}






	/*****************************************************/
	# State Controller             
	# Function name : saveState
	# Functionality: save state
	# Author : Sanchari Ghosh                                 
	# Created Date : 06/08/2018                                
	# Purpose:  save state 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveState(Request $request){

		$data 			    = array(); /*storing data for listing*/ 
		$existCount 		= 0; /*count whether same name state exists or not*/
		$existCode 			= 0; /*count whether same code state exists or not*/
		$cityId 			= array(); /*storing city ids for change status*/
		
		if (isset($request->stateId) && ($request->stateId != '')) {
			$state 					= State::find($request->stateId);
			$existCount 			= $this->nameExistsCheck('State','state_name',strtolower($request->state_name),$request->stateId);
			$existCode 				= $this->codeExistsCheck('State','state_code',strtolower($request->state_code),$request->stateId);
			$state->updated_by		= \Auth::user()->id;

		} else {
			$state 					= new State();
			$existCount 			= $this->nameExistsCheck('State','state_name',strtolower($request->state_name),'');
			$existCode 				= $this->codeExistsCheck('State','state_code',strtolower($request->state_code),$request->stateId);
			$state->created_by		= \Auth::user()->id;
		}

		if ($existCount > 0 || $existCode > 0) {
			$data['success'] 		= 'false';
			$data['namecount'] 	 	=  $existCount ;
			$data['codecount'] 	 	=  $existCode ;
		} else {
			$state->country_id 		= $request->country_id;
	    	$state->state_name 		= $request->state_name;
	    	$state->state_code 		= $request->state_code;
	    	$state->status 			= $request->status;
	    	
	    	$state->save();

	    	/*change the status of city while state status is being changed*/
	    	if (isset($request->stateId) && ($request->stateId != '') && ($state->status == 'I')) {
	    		$cityDetails = City::where('state_id',$request->stateId)->get()->toArray();

				if (!empty($cityDetails)) {
					foreach ($cityDetails as $city) {
						array_push($cityId, $city['id']);
					}
					City::whereIn('id',$cityId)->update(array('updated_by' => \Auth::user()->id,'status'=>$state->status)); 
				}
	    	}

	 		$data['success'] 		= 'true';
	 		$data['namecount'] 	 	=  $existCount ;
			$data['codecount'] 	 	=  $existCode ;
	 		if (isset($request->stateId) && ($request->stateId != '')) {
				$request->session()->flash('alert-success', 'State Edited Successfully');
			} else {
				$request->session()->flash('alert-success', 'State Added Successfully');
			}
		}
 		
        return $data;
	}




	/*****************************************************/
	# State Controller             
	# Function name : deleteState
	# Functionality: delete state
	# Author : Sanchari Ghosh                                 
	# Created Date : 06/08/2018                                
	# Purpose:  delete state 
	# Params :  Request $request                                          
	/*****************************************************/
	public function deleteState(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*check existance of the city under the state*/
		$cityDetails = City::where('state_id',$request->stateId)->count();


        if ($cityDetails > 0) {
        	$data['success']		= 'false'; 
        } else {

			/*delete data*/
			$state = State::find($request->stateId);
			$state->deleted_by = \Auth::user()->id;/*logged in user id*/
			$state->status     = 'D';
			$state->is_deleted = 'Y';
			$state->save();

			/*soft delete the record*/
			$state->delete();

			$data['success']		= 'true'; 
		}

		return $data;
		
	}
	

}
