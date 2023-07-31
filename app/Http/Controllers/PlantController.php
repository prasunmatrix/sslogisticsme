<?php

/*****************************************************/
# Plant Controller             
# Class name : PlantController
# Functionality: listing, add, edit, deletion of plants, generating reports
# Author : Sanchari Ghosh                                 
# Created Date :  08/08/2018                                
# Purpose: Developing the functionality of listing, add, edit, deletion of plants, generating reports
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Hash;
use DB;
use Illuminate\Support\Facades\Input;
use App\Models\Plant;
use App\Models\PlantJournalLaser;
use App\Models\PlantAddress;
use App\Models\AddressZone;
use App\User;
use App\Models\PlantUserRelation;


class PlantController extends Controller {
 
	/*****************************************************/
	# Plant Controller             
	# Class name : PlantController
	# Functionality: constructor
	# Author : Sanchari Ghosh                                 
	# Created Date : 08/08/2018                                 
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}
	

	/*****************************************************/
	# Plant Controller             
	# Function name : index
	# Functionality: view plant listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 08/08/2018                                
	# Purpose:  to view plant listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('plants.plantList');
	}



	/*****************************************************/
	# Plant Controller             
	# Function name : getPlantList
	# Functionality: get data of plant listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 08/08/2018                                
	# Purpose:  to get data of plant listing page  
	# Params : Request $request                                          
	/*****************************************************/
	public function getPlantList(Request $request){

		$data 	= array(); /*storing data for listing*/ 


		/*defining db tables for joining*/
		$dbTables = array(
					'plantTable' 				=> config('dbtables.plants'),
					'userTable' 				=> config('dbtables.users'),
					'addressZoneTable'			=> config('dbtables.address_zones'),
					'plantUserRelationTable' 	=> config('dbtables.plant_user_relations')
				);

		/*get available records*/
		$plantList = Plant::availableRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$total = Plant::totalRecords($dbTables,$request->searchKeyword);
		/*customizing final array*/
		$data['plantList'] 		= $plantList;
		$data['currentPage']    = $request->currentPage;
		$data['total'] 			= $total;
		$data['success']		= 'true'; 

		return $data;
	}




	/*****************************************************/
	# Plant Controller             
	# Function name : viewAddPlant
	# Functionality: view add plant page
	# Author : Sanchari Ghosh                                 
	# Created Date : 08/08/2018                                
	# Purpose:  view add plant page 
	# Params :                                            
	/*****************************************************/
	public function viewAddPlant(){
		return view('plants.addForm');
	}



	/*****************************************************/
	# Plant Controller             
	# Function name : viewEditPlant
	# Functionality: view edit plant page
	# Author : Sanchari Ghosh                                 
	# Created Date : 08/08/2018                                
	# Purpose:  view edit plant page 
	# Params :                                            
	/*****************************************************/
	public function viewEditPlant(){
		return view('plants.editForm');
	}




	/*****************************************************/
	# Plant Controller             
	# Function name : getEditPlant
	# Functionality: get edit plant page
	# Author : Sanchari Ghosh                                 
	# Created Date : 08/08/2018                                
	# Purpose:  get edit plant page 
	# Params :  Request $request                                          
	/*****************************************************/
	public function getEditPlant(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$plantId = $request->plantId;

		/*get available records*/
		$plantDetails = Plant::find($plantId);

		/*address zone*/
		$addressZoneDetails = AddressZone::find($plantDetails->address_zone_id);

		/*customizing final array*/
		$data['plantDetails'] 		= $plantDetails;
		$data['addressDetails']		= $addressZoneDetails;
		$data['success'] 			= 'true';

		return $data;
	}






	/*****************************************************/
	# Plant Controller             
	# Function name : savePlant
	# Functionality: save plant
	# Author : Sanchari Ghosh                                 
	# Created Date : 08/08/2018                                
	# Purpose:  save plant 
	# Params :  Request $request                                          
	/*****************************************************/
	public function savePlant(Request $request){

		$data 			= array(); /*storing data for listing*/ 
		$plantIdAddress = array(); /*storing plant address ids for status change*/
		$flag           = 0;
		
		if (isset($request->plantId) && ($request->plantId != '')) {
			$plant 				= Plant::find($request->plantId);
			$plant->updated_by	= \Auth::user()->id;
			$existCount 		= $this->nameExistsCheck('Plant','name',strtolower($request->name),$request->plantId);
		} else {
			$plant 				= new Plant();
			$plant->created_by	= \Auth::user()->id;
			$existCount 		= $this->nameExistsCheck('Plant','name',strtolower($request->name),'');
		}

		/*check address*/
		$addressCount = AddressZone::where('id',$request->address_zone_id)->count();

		if ($existCount > 0) {
			$data['success'] = 'false';
			$data['count'] 	 =  $existCount ;
			$data['msg'] 	 =  'Plant already exists' ;
		} else {

			if($addressCount > 0) {/*get id if address zone exists*/
			   $addressZoneId  = $request->address_zone_id;
			   $flag 		   = 1;
			} else {
				$flag 		   = 0;
		    	$data['msg']   = 'Please provide proper address' ;
				// $address = $request->address_zone_id; 
				// $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key='.\Config::get('constants.api_key2');

				// $ch = curl_init();
				// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL verification
				// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				// curl_setopt($ch, CURLOPT_URL,htmlspecialchars_decode($url));
				// $result=curl_exec($ch); 
				// curl_close($ch);
				// $json 		  	= json_decode($result);


				// if(isset($json->results[0])) {
				// 	$lat  			= $json->results[0]->geometry->location->lat; 
				// 	$lng 			= $json->results[0]->geometry->location->lng;

				// 	$addressZone 				= new AddressZone();
				// 	$addressZone->created_by	= \Auth::user()->id;
				// 	$addressZone->latitude 		= $lat;
			 //    	$addressZone->longitude 	= $lng;
			 //    	$addressZone->address 		= $address;
			 //    	$addressZone->save();

			 //    	$addressZoneId  = $addressZone->id;
			 //    	$flag 		    = 1;
		  //   	} else {
		  //   		$flag 		   = 0;
		  //   		$data['msg']   =  'Please provide proper address' ;
		  //   	}
			}


			if ($flag == 1) {
				$plant->type 				= $request->type;
				$plant->address_zone_id 	= $addressZoneId;
				$plant->name 				= strtoupper($request->name);
		    	$plant->description 		= ($request->description == 'undefined' || $request->description == 'null') ? NULL : strtoupper($request->description);
		    	$plant->balance_amount 		= $request->balance_amount;
		    	$plant->status 				= $request->status;
		    	
		    	
		    	$plant->save();

		    	/*Insert data into Plant Journal Laser table*/
		    	$lastInsertedId = $plant->id;
		    	if (isset($request->plantId) && ($request->plantId != '')) {
					PlantJournalLaser::where('plant_id',$request->plantId)->update(array('entry_by' => \Auth::user()->id, 'status'=>$plant->status, 'amount' => $plant->balance_amount, 'updated_by'=> \Auth::user()->id)); 

					
					if ($plant->status == 'I'){

						/*change status of Plant Journal Lasers while Plant status is being changed*/
						PlantJournalLaser::where('plant_id',$request->plantId)->update(array('status'=>$plant->status, 'updated_by'=> \Auth::user()->id)); 					
					}

				} else {
					$plantJournalLaser = new PlantJournalLaser();
					$plantJournalLaser->plant_id 			= $lastInsertedId;
					$plantJournalLaser->amount 	 			= $plant->balance_amount;
					$plantJournalLaser->description 		= 'Balance Initiation';
					$plantJournalLaser->entry_by    		= \Auth::user()->id;
					$plantJournalLaser->status      		= $plant->status;
					$plantJournalLaser->entry_type  		= 'BG';
					$plantJournalLaser->approval_status  	= 'Approved';
					$plantJournalLaser->created_by  		= \Auth::user()->id;
					$plantJournalLaser->save();
				}

				/*save data into Plant User relation table*/
				$plantUserData 	= PlantUserRelation::where('user_id',\Auth::user()->id)->count();
				if($plantUserData > 0) {
					$plantUserData = PlantUserRelation::where('user_id',\Auth::user()->id)->get(); 
					$plantUser = PlantUserRelation::find($plantUserData[0]->id);
		            $plantUser->deleted_by = \Auth::user()->id;/*logged in user id*/
		            $plantUser->is_deleted = 'Y';
		            $plantUser->save();
		            $plantUser->delete();
				}
				$plantUserRelation = new PlantUserRelation();
				$plantUserRelation->user_id = \Auth::user()->id;
	            $plantUserRelation->plant_id = $plant->id;
	            $plantUserRelation->created_by = \Auth::user()->id;
	            $plantUserRelation->save();


				$data['plant']			= $plant->id;
		 		$data['success'] 		= 'true';

		 		if (isset($request->plantId) && ($request->plantId != '')) {
					$request->session()->flash('alert-success', 'Plant Edited Successfully');
				} else {
					$request->session()->flash('alert-success', 'Plant Added Successfully');
				}
			} else {
				$data['success'] = 'false';
			}
		}
 		
        return $data;
	}




	/*****************************************************/
	# Plant Controller             
	# Function name : deletePlant
	# Functionality: delete plant
	# Author : Sanchari Ghosh                                 
	# Created Date : 08/08/2018                                
	# Purpose:  delete plant 
	# Params :  Request $request                                          
	/*****************************************************/
	public function deletePlant(Request $request){

		$data 			= array(); /*storing data for listing*/ 
		$plantIdJournal	= array(); /*storing journal laser plants ids for deletion*/


		/*check existance of plant in trip*/
		$tripPlantDetails = Trip::where('plant_id',$request->plantId)->count();

		if(is_numeric($request->plantId)) {
			if ($tripPlantDetails > 0) {
				$data['success']		= 'false'; 
			} else {
				/*delete data*/
				$plant = Plant::find($request->plantId);
				$plant->deleted_by = \Auth::user()->id;/*logged in user id*/
				$plant->status     = 'D';
				$plant->is_deleted = 'Y';
				$plant->save();


				/*delete Plant Journal Lasers*/
				$plantJournalLaserDetails = PlantJournalLaser::where('plant_id',$request->plantId)->get()->toArray();

				if (!empty($plantJournalLaserDetails)) {
					foreach ($plantJournalLaserDetails as $p) {
						array_push($plantIdJournal, $p['id']);
					}
					PlantJournalLaser::whereIn('id',$plantIdJournal)->update(array('deleted_by' => \Auth::user()->id,'status'=>'D','is_deleted'=>'Y')); 
					PlantJournalLaser::whereIn('id',$plantIdJournal)->delete(); /*Soft Deletion of data*/
				}

				/*soft delete the record*/
				$plant->delete();

				$data['success']		= 'true'; 
		    }
	    } else {
			$data['success']		= 'not_numeric'; 
		}

		return $data;
		
	}


	/*****************************************************/
	# Plant Controller             
	# Function name : viewRecord
	# Functionality: view plant details page
	# Author : Sanchari Ghosh                                 
	# Created Date : 31/12/2018                                
	# Purpose:  to view plant details page  
	# Params :                                           
	/*****************************************************/
	public function viewRecord(){
		return view('plants.plantView');
	}



	/*****************************************************/
	# Plant Controller             
	# Function name : getPlantDetails
	# Functionality: get details of a particular plant
	# Author : Sanchari Ghosh                                 
	# Created Date : 31/12/2018                                
	# Purpose:  to get details of particular plant
	# Params : Request $request                                          
	/*****************************************************/
	public function getPlantDetails(Request $request){
		$userIdDetails = array();
		$supervisorNames = '';

		/*get plant id*/
		$plantId = $request->plantId;

		$data 	= array(); /*storing data for listing*/ 

		$data['plantDetails'] = $this->getEditPlant($request);

		/*get user assigned to plant*/
		$plantUserData 	= PlantUserRelation::where('plant_id',$request->plantId)->get()->toArray();
		foreach($plantUserData as $p) {
			array_push($userIdDetails,$p['user_id']);
		}
		$userDetails = User::select('full_name')->whereIn('id',$userIdDetails)->get()->toArray();

		for($i=0;$i<sizeof($userDetails);$i++) {
			if(($i+1) == sizeof($userDetails)) {
				$supervisorNames .= $userDetails[$i]['full_name'];
			} else {
				$supervisorNames .= $userDetails[$i]['full_name'].', ';
			}
		}

		/*calculate balance*/
		$plantLaserCredit 	= PlantJournalLaser::where('plant_id',$plantId)
													->where('created_at', '<=', date('Y-m-d 23:59:59'))
													->where('type', '=', 'C')
													->where('approval_status','Approved')
													->sum('amount');	
		$plantLaserDebit 	= PlantJournalLaser::where('plant_id',$plantId)
													->where('created_at', '<=', date('Y-m-d 23:59:59'))
													->where('type', '=', 'D')
													->where('approval_status','Approved')
													->sum('amount');	

		$balance = $plantLaserCredit - $plantLaserDebit;  

		$data['actualBalance'] 	= $balance;
		$data['userDetails'] 	= $supervisorNames;
        $data['success'] 	 	= 'true';
		return $data;
	}






	/*****************************************************/
	# Plant Controller             
	# Function name : viewSupervisorList
	# Functionality: get lists of supervisors
	# Author : Sanchari Ghosh                                 
	# Created Date : 22/08/2018                                
	# Purpose:  get supervisor lists
	# Params :   Request $request                                        
	/*****************************************************/
	public function viewSupervisorList(Request $request){

		$data 			      = array();  /*storing data for listing*/ 
		$allSupervisorId      = array(); /*store all supervisor id*/
		$assignedSupervisorId = array(); /*store already assigned supervisor id*/
		$resultIds            = array(); /*storing final data*/

		$data['data'] = $request->data;

		/*get available records*/
		$allSupervisorList = User::where('user_role_id',\Config::get('constants.supervisorRoleId'))->where('status','A')->get()->toArray();
		foreach ($allSupervisorList as $s) {
			array_push($allSupervisorId, $s['id']); 
		}


		/*get already assigned supervisor list*/
		$assignedSupervisorList = Plant::select('supervisor_id')->get()->toArray();
		foreach ($assignedSupervisorList as $s) {
			array_push($assignedSupervisorId, $s['supervisor_id']); 
		}

		/*get supervisor not assigned to any plant*/
		$resultIds = array_diff($allSupervisorId,$assignedSupervisorId);

		if ($request->data != 'undefined') {
			array_push($resultIds, $request->data);
		}

		/*get unassigned supervisor details*/
		$supervisorList = User::whereIn('id',$resultIds)->where('status','A')->get()->toArray();
		

		

		/*customizing final array*/
		$data['allSupervisorId']      = $allSupervisorId;
		$data['assignedSupervisorId'] = $assignedSupervisorId;
		$data['supervisorList'] 	  = $supervisorList;
		$data['success'] 			  = 'true';

		return $data;
	}




	/*****************************************************/
	# Plant Controller             
	# Function name : saveCSVPlant
	# Functionality: save plant after importing csv
	# Author : Sanchari Ghosh                                 
	# Created Date : 24/08/2018                                
	# Purpose:  save plant after importing csv 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveCSVPlant(Request $request){
		$getSupervisorCount = 0; /*check whether supervisor has any plant assigned or not*/
		$data 		 		= array(); /*storing data for listing*/ 
		$contentdata 		= json_decode($request->plantDetailsData);
		$existingData		= ''; /*collect the existing data*/
		$existingDataText 	= '';
		$existingDataErr	= ''; /*collect the existing data having error*/
		$blankDataErr 		= 0;
		$flag 				= 0;
		$rowNo 				= 0;

		if(isset($contentdata) && count($contentdata)>0){
			for($i=1; $i<(count($contentdata) - 1); $i++) { $data['i'] = $i;
				$singleColumnData = explode(',',$contentdata[$i]);

				/*for checking blank data*/
				if(trim($singleColumnData[0]) == '' || trim($singleColumnData[1]) == '' || trim($singleColumnData[2]) == '' || trim($singleColumnData[3]) == '' || trim($singleColumnData[4]) == '' || trim($singleColumnData[5]) == ''){
					$data['success'] = 'false';
			 		$blankDataErr    =  1;
			 		$rowNo 			 =  $i;
			 		$flag 			 =  0;
				} else {
					/*check whether the format of the balance and type is right or not*/
				 	if (!(preg_match(\Config::get('constants.numberPattern'), $singleColumnData[3]))) {
				 		$data['success'] = 'false';
				 		$existingDataErr   .=  '"'.$singleColumnData[3].'", ';
				 		$flag = 0;
				 	} else if ($singleColumnData[0] != 'P' && $singleColumnData[0] != 'W'){
				 		$data['success'] = 'false';
				 		$existingDataErr   .=  '"'.$singleColumnData[0].'", ';
				 		$flag = 0;
				 	} else {
						/*check duplicate plant name*/
						$existCount = $this->nameExistsCheck('Plant','name',strtolower($singleColumnData[1]),'');

						/*check address title*/
						$addressTitleCount = AddressZone::where('title',$singleColumnData[5])->count();

						/*check address*/
						$addressCount = AddressZone::where('address',$singleColumnData[4])->count();


						/*if duplicate plant exists or supervisor has already assigned to a plant*/
						if ($existCount > 0 ) { 
						 	$data['success'] = 'false';
						 	$data['count'] 	 =  $existCount ;
						 	$existingData   .=  '"'.$singleColumnData[1].'", ';
						} else {
							/*add address zone*/
							if($addressCount > 0) {/*get id if address zone exists*/
							   $addressDetails = AddressZone::where('address',$singleColumnData[4])->get()->toArray();
							   $addressZoneId  = $addressDetails[0]['id'];
							   $flag 		   = 1;	
							} else if ($addressTitleCount > 0) { /*get id if address title exists*/
							   $addressDetails = AddressZone::where('title',$singleColumnData[5])->get()->toArray();
							   $addressZoneId  = $addressDetails[0]['id'];
							   $flag 		   = 1;	
							} else {/*add address zone if does not exists*/
								$address = $singleColumnData[4];
								$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key='.\Config::get('constants.api_key2');

								$ch = curl_init();
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL verification
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								curl_setopt($ch, CURLOPT_URL,htmlspecialchars_decode($url));
								$result=curl_exec($ch);
								curl_close($ch);
								$json 		  	= json_decode($result);

								if(isset($json->results[0])) {
									$flag 			= 1;
									$lat  			= $json->results[0]->geometry->location->lat; 
									$lng 			= $json->results[0]->geometry->location->lng;

									$addressZone 				= new AddressZone();
									$addressZone->created_by	= \Auth::user()->id;
									$addressZone->latitude 		= $lat;
							    	$addressZone->longitude 	= $lng;
							    	$addressZone->address 		= $address;
							    	$addressZone->title 		= $singleColumnData[5];
							    	$addressZone->save();

							    	$addressZoneId  = $addressZone->id;
							    } else {
									$flag = 0;
									$existingDataErr   .=  '"'.$singleColumnData[4].'", ';
								}
							}
							    
							if ($flag == 1)	{
						    	/*save plant*/
							 	$plant 						= new Plant();
								$plant->created_by			= \Auth::user()->id;
								$plant->address_zone_id		= $addressZoneId;
								$plant->type 				= $singleColumnData[0];
								$plant->name 				= $singleColumnData[1];
						    	$plant->description 		= $singleColumnData[2];
						    	$plant->balance_amount 		= $singleColumnData[3];
						    	$plant->save();

						    	$lastInsertedId = $plant->id; 
						    	
						    	/*save data in plant journal lasers table*/
								$plantJournalLaser 					= new PlantJournalLaser();
								$plantJournalLaser->plant_id 		= $lastInsertedId;
								$plantJournalLaser->amount 	 		= $plant->balance_amount;
								$plantJournalLaser->description 	= 'Balance Initiation';
								$plantJournalLaser->entry_by    	= \Auth::user()->id;
								$plantJournalLaser->approval_status = 'Approved';
								$plantJournalLaser->entry_type  	= 'BG';
								$plantJournalLaser->created_by  	= \Auth::user()->id;
								$plantJournalLaser->save();

						 		$data['success'] 		= 'true';
							}
						} 
					}
				}	

			}
		}

		if ($existingData != '') {
			$existingDataText  .= ' Plant named '.$existingData.' already exists. So these data are not added.';
		}

		if ($existingDataErr != '') {
			$existingDataText  .= ' Data format error in following data:- '.$existingDataErr;
		}

		if ($blankDataErr == 1) {
			$existingDataText  .= ' Data is not imported of row number :- '.$rowNo.', as some of the fields are blank.';
		}


		$data['success'] 	 = 'true';

		if ($data['success'] == 'true') {
			$request->session()->flash('alert-success', 'Plant Imported Successfully. '.$existingDataText);
		}


        return $data;

	}





	/*****************************************************/
	# Plant Controller             
	# Function name : viewPlantListHavingPlantAddress
	# Functionality: get lists of plants having plant address
	# Author : Sanchari Ghosh                                 
	# Created Date : 04/09/2018                                
	# Purpose:  get lists of plants having plant address
	# Params :                                           
	/*****************************************************/
	public function viewPlantListHavingPlantAddress(){

		$data 			= array(); /*storing data for listing*/ 
		$year           = array(); /*store year lists*/

		/*get year lists*/
		$plantMinYear 		= Plant::select(DB::raw('MIN(YEAR(created_at)) year'))->where('status','A')->get()->toArray();
		$currentYear 		= date('Y');


		for($i=$plantMinYear[0]['year']; $i<=$currentYear; $i++) {
			array_push($year, $i);
		}
		$yearList = array_unique($year);

		/*get plant details having plant address*/
		$plantList 			= Plant::where('status','A')->orderby('name')->get();
		$data['details'] 	= $plantList;
		$data['plantList'] 	= $plantList;
		$data['yearList']   = $yearList;
		$data['success'] 	= 'true';

		return $data;
	}






	/*****************************************************/
	# Plant Controller             
	# Function name : viewTripPlantList
	# Functionality: get lists of plants for trip
	# Author : Sanchari Ghosh                                 
	# Created Date : 20/09/2018                                
	# Purpose:  get lists of plants for trip
	# Params :                                           
	/*****************************************************/
	public function viewTripPlantList(){

		$data 			= array(); /*storing data for listing*/ 
		$year           = array(); /*store year lists*/


		/*get year lists*/
		$plantMinYear 		= Plant::select(DB::raw('MIN(YEAR(created_at)) year'))->where('status','A')->get()->toArray();
		$currentYear 		= date('Y');


		for($i=$plantMinYear[0]['year']; $i<=$currentYear; $i++) {
			array_push($year, $i);
		}
		$yearList = array_unique($year);

		/*get plant details*/
		if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) {
			$plantUserData 	= PlantUserRelation::where('user_id',\Auth::user()->id)->get();
        	$plantId 		= $plantUserData[0]->plant_id;
        	$plantList 		= Plant::where('status','A')->where('id',$plantId)->get();
		} else {
			$plantList 			= Plant::where('status','A')->orderby('name')->get();
		}
		
		$data['details'] 	= $plantList;
		$data['plantList'] 	= $plantList;
		$data['yearList']   = $yearList;
		$data['success'] 	= 'true';

		return $data;
	}


	/*****************************************************/
	# Plant Controller             
	# Function name : getUserPlant
	# Functionality: get user plant
	# Author : Sanchari Ghosh                                 
	# Created Date : 02/01/2019                                
	# Purpose:  get lists of plants for trip
	# Params :  get user plant                                         
	/*****************************************************/
	public function getUserPlant(Request $request) {
		$userId 		= $request->user_id;
		$plantUserData 	= PlantUserRelation::where('user_id',dnc($userId))->get();
        $plantId 		= $plantUserData[0]->plant_id;
        return $plantId;
	}


	/*****************************************************/
	# Plant Controller             
	# Function name : activePlantList
	# Functionality: get active plant
	# Author : Sanchari Ghosh                                 
	# Created Date : 02/04/2019                                
	# Purpose:  get lists of active plants 
	# Params :                                          
	/*****************************************************/
	public function activePlantList() {

		$dbTables = array(
					'plantTable' 				      => config('dbtables.plants'),
					'plantUserRelationTable' 		  => config('dbtables.plant_user_relations'),
				);

		$records = Plant::select($dbTables['plantTable'].'.*')->where($dbTables['plantTable'].'.status','A');


		if (\Auth::user()->user_role_id ==  \Config::get('constants.supervisorRoleId'))	 {
			$records = $records->join($dbTables['plantUserRelationTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantUserRelationTable'].'.plant_id')
			->where($dbTables['plantUserRelationTable'].'.user_id','=',\Auth::user()->id)
			->where($dbTables['plantUserRelationTable'].'.deleted_by','=',NULL);
		}

		$records = 	$records->orderby($dbTables['plantTable'].'.name')->get();

		$data['plantList'] 	= $records;
		$data['success'] 	= 'true';
		return $data;
	}



	/*****************************************************/
	# Plant Controller             
	# Function name : cashReport
	# Functionality: view cash report page
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/04/2019                                
	# Purpose:  view cash report page
	# Params :                                          
	/*****************************************************/
	public function cashReport() {
		return view('plants.cashReport');
	}



	/*****************************************************/
	# Plant Controller             
	# Function name : getCashReport
	# Functionality: get cash report
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/04/2019                                
	# Purpose:  get cash report
	# Params :    Request $request                                      
	/*****************************************************/
	public function getCashReport(Request $request) {
		
		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'plantTable' 				      => config('dbtables.plants'),
					'plantJournalLaserTable' 		  => config('dbtables.plant_journal_lasers'),
					'truckTable' 				      => config('dbtables.trucks'),
					'tripTable'						  => config('dbtables.trips'),
					'vendorTable'					  => config('dbtables.vendors'),
				);


		/*get available records*/
		$cashReportList = Plant::getCashReport($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->plant,$request->dateRangeValue,$request->searchKeyword);
		$totalCashReports = Plant::totalCashReportRecords($dbTables,$request->plant,$request->dateRangeValue,$request->searchKeyword);


		/*customizing final array*/
		$data['cashReportList'] 		= $cashReportList;
		$data['totalCashReports'] 		= $totalCashReports;
		$data['openingBalance']			= $cashReportList[0]['balanceFirstDay'];
		$data['closingBalance']			= $cashReportList[0]['balanceLastDay'];
		$data['carryForwardBalance']	= $cashReportList[0]['carryForwardBalance'];
		$data['plantName']				= $cashReportList[0]['plantName'];
		$data['success']				= 'true'; 
		$data['currentPage']    		= $request->currentPage;

		return $data;
	}
}
