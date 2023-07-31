<?php

/*****************************************************/
# PlantAddress Controller             
# Class name : PlantAddressController
# Functionality: listing, add, edit, deletion of plantAddresses
# Author : Sanchari Ghosh                                 
# Created Date :  16/08/2018                                
# Purpose: Developing the functionality of listing, add, edit, deletion of plantAddresses
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Hash;
use Illuminate\Support\Facades\Input;
use App\Models\PlantAddress;
use App\Models\Plant;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\User;
use App\Models\PlantJournalLaser;




class PlantAddressController extends Controller {
 
	/*****************************************************/
	# PlantAddress Controller             
	# Class name : PlantAddressController
	# Functionality: constructor
	# Author : Sanchari Ghosh                                 
	# Created Date : 16/08/2018                                 
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}
	

	/*****************************************************/
	# PlantAddress Controller             
	# Function name : index
	# Functionality: view plantAddress listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 16/08/2018                                
	# Purpose:  to view plantAddress listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('plant_addresses.plantAddressList');
	}



	/*****************************************************/
	# PlantAddress Controller             
	# Function name : getPlantAddressList
	# Functionality: get data of plantAddress listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 16/08/2018                                
	# Purpose:  to get data of plantAddress listing page  
	# Params :  Request $request                                         
	/*****************************************************/
	public function getPlantAddressList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'plantAddressTable' 	=> config('dbtables.plant_addresses'),
					'countryTable' 			=> config('dbtables.countries'),
					'stateTable' 			=> config('dbtables.states'),
					'cityTable' 			=> config('dbtables.cities'),
					'plantTable' 			=> config('dbtables.plants'),
				);

		/*get available records*/
		$plantAddressList = PlantAddress::availableRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$total = PlantAddress::totalRecords($dbTables,$request->searchKeyword);
		/*customizing final array*/
		$data['plantAddressList'] 	= $plantAddressList;
		$data['total'] 				= $total;
		$data['success']			= 'true'; 

		return $data;
	}



	/*****************************************************/
	# PlantAddress Controller             
	# Function name : viewPlantList
	# Functionality: get data of plants for plant address
	# Author : Sanchari Ghosh                                 
	# Created Date : 23/08/2018                                
	# Purpose:  get data of plants for plant address
	# Params :                                           
	/*****************************************************/
	public function viewPlantList(){
		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$plantList = Plant::where('status','A')->get();

		/*customizing final array*/
		$data['plantList'] 		= $plantList;
		$data['success'] 		= 'true';

		return $data;
	}




	/*****************************************************/
	# PlantAddress Controller             
	# Function name : viewAddPlantAddress
	# Functionality: view add plantAddress page
	# Author : Sanchari Ghosh                                 
	# Created Date : 16/08/2018                                
	# Purpose:  view add plantAddress page 
	# Params :                                            
	/*****************************************************/
	public function viewAddPlantAddress(){
		return view('plant_addresses.addForm');
	}



	/*****************************************************/
	# PlantAddress Controller             
	# Function name : viewEditPlantAddress
	# Functionality: view edit plantAddress page
	# Author : Sanchari Ghosh                                 
	# Created Date : 16/08/2018                                
	# Purpose:  view edit plantAddress page 
	# Params :                                            
	/*****************************************************/
	public function viewEditPlantAddress(){
		return view('plant_addresses.editForm');
	}




	/*****************************************************/
	# PlantAddress Controller             
	# Function name : getEditPlantAddress
	# Functionality: get edit plantAddress page
	# Author : Sanchari Ghosh                                 
	# Created Date : 16/08/2018                                
	# Purpose:  get edit plantAddress page 
	# Params :  Request $request                                          
	/*****************************************************/
	public function getEditPlantAddress(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$plantAddressId = $request->plantAddressId;

		/*get available records*/
		$plantAddressDetails = PlantAddress::find($plantAddressId);

		/*customizing final array*/
		$data['plantAddressDetails'] 	= $plantAddressDetails;
		$data['success'] 				= 'true';

		return $data;
	}






	/*****************************************************/
	# PlantAddress Controller             
	# Function name : savePlantAddress
	# Functionality: save plantAddress
	# Author : Sanchari Ghosh                                 
	# Created Date : 16/08/2018                                
	# Purpose:  save plantAddress 
	# Params :  Request $request                                          
	/*****************************************************/
	public function savePlantAddress(Request $request){

		$data 		= array(); /*storing data for listing*/ 
        $existCount = 0; /*check duplicate existance*/
		
		if (isset($request->plantAddressId) && ($request->plantAddressId != '')) {
			$plantAddress 					= PlantAddress::find($request->plantAddressId);
			$plantAddress->updated_by		= \Auth::user()->id;
		} else {
			$existCount 					= PlantAddress::where('plant_id',$request->plant_id)->count();
			$plantAddress 					= new PlantAddress();
			$plantAddress->created_by		= \Auth::user()->id;
		}

		if ($existCount > 0) {
			$data['success'] 		= 'false';
		} else {
			$plantAddress->plant_id 		= $request->plant_id;
			$plantAddress->country_id 		= $request->country_id;
			$plantAddress->state_id 		= $request->state_id;
			$plantAddress->city_id 			= $request->city_id;
	    	$plantAddress->address 			= $request->address;
	    	$plantAddress->lat 				= $request->lat;
	    	$plantAddress->lng 				= $request->lng;
	    	$plantAddress->status 			= $request->status;
	    	
	    	
	    	$plantAddress->save();

	 		$data['success'] 		= 'true';

	 		if (isset($request->plantAddressId) && ($request->plantAddressId != '')) {
				$request->session()->flash('alert-success', 'Plant Address Edited Successfully');
			} else {
				$request->session()->flash('alert-success', 'Plant Address Added Successfully');
			}
		}
 		
        return $data;
	}




	/*****************************************************/
	# PlantAddress Controller             
	# Function name : deletePlantAddress
	# Functionality: delete plantAddress
	# Author : Sanchari Ghosh                                 
	# Created Date : 16/08/2018                                
	# Purpose:  delete plantAddress 
	# Params :  Request $request                                          
	/*****************************************************/
	public function deletePlantAddress(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*delete data*/
		$plantAddress = PlantAddress::find($request->plantAddressId);
		$plantAddress->deleted_by = \Auth::user()->id;/*logged in user id*/
		$plantAddress->status     = 'D';
		$plantAddress->is_deleted = 'Y';
		$plantAddress->save();

		/*soft delete the record*/
		$plantAddress->delete();

		$data['success']		= 'true'; 

		return $data;
		
	}




	/*****************************************************/
	# PlantAddress Controller             
	# Function name : saveCSVPlantAddress
	# Functionality: save PlantAddress after importing csv
	# Author : Sanchari Ghosh                                 
	# Created Date : 27/08/2018                                
	# Purpose:  save PlantAddress after importing csv 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveCSVPlantAddress(Request $request){

		$data 		 			= array(); /*storing data for listing*/ 
		$contentdata 			= json_decode($request->plantAddressDetailsData);
		$flag 		 			= 0;
		$lat 		 			= '';
		$lng 		 			= '';
		$existingData			= ''; /*collect the data of plant having party address*/
		$existingSupervisor		= ''; /*collect data of supervisor who is already assigned to a plant*/
		$existingDataText 		= '';
		$existingDataErr		= ''; /*collect the existing data having error*/



		if(isset($contentdata) && count($contentdata)>0){
			for($i=1; $i<(count($contentdata) - 1); $i++) {
				$data['i'] = $i;
				$singleColumnData = explode(',',$contentdata[$i]);

				$phoneNo = str_replace("\r","",$singleColumnData[5]);

				/*check whether the format of the phone number and email is right or not*/
			 	if (/*!(preg_match(\Config::get('constants.phoneNumberPattern'), $singleColumnData[2])) || !(preg_match(\Config::get('constants.emailPattern'), $singleColumnData[3])) || */!(preg_match(\Config::get('constants.phoneNumberPattern'), $phoneNo)) || !(preg_match(\Config::get('constants.emailPattern'), $singleColumnData[4]))) {

			 		$data['success'] = 'false';

			 		// if (!preg_match(\Config::get('constants.phoneNumberPattern'), $singleColumnData[2])) {
			 		// 	$existingDataErr   .=  '"'.$singleColumnData[2].'", ';
			 		// }

			 		// if (!preg_match(\Config::get('constants.emailPattern'), $singleColumnData[3])) {
			 		// 	$existingDataErr   .=  '"'.$singleColumnData[3].'", ';
			 		// }

			 		if (!preg_match(\Config::get('constants.phoneNumberPattern'), $phoneNo)) {
			 			$existingDataErr   .=  '"'.$phoneNo.'", ';
			 		}

			 		if (!preg_match(\Config::get('constants.emailPattern'), $singleColumnData[4])) {
			 			$existingDataErr   .=  '"'.$singleColumnData[4].'", ';
			 		}

			 		$flag = 0;

			 	} else {

					/*check the existance of supervisor*/
					$supervisorDetails = User::where('username',$singleColumnData[4])->count();

					/*if supervisor exists check whether it has plant assigned or not*/
					if ($supervisorDetails > 0) { 
						$user 	=  User::where('username',$singleColumnData[4])->get()->toArray();
						$getSupervisorCount = Plant::where('supervisor_id',$user[0]['id'])->count();
					} else {
						$getSupervisorCount = 0;
					}


					$plantDetails = $this->nameExistsCheck('Plant','name',strtolower($singleColumnData[0]),'');


					if ($plantDetails > 0) { /*if plant exists*/ 
						$plant   =  Plant::whereRaw('LOWER(`name`) = "'.strtolower($singleColumnData[0]).'"')->get()->toArray();

						$plantId = $plant[0]['id'];
						$supervisorId 	   = $plant[0]['supervisor_id'];


						/*check whether address of the plant exist or not*/
						$plantAddressDetails = PlantAddress::where('plant_id',$plantId)->count();


						/*if no address exist for this plant or supervisor already assigned to plant*/
						if ($plantAddressDetails == 0 && $getSupervisorCount == 0) {
							$flag = 1;
						} else {
							$flag = 0;
						}

						if ($plantAddressDetails > 0) {
							$existingData   .=  '"'.$singleColumnData[0].'", ';
						}

						if ($getSupervisorCount > 0) {
							$existingSupervisor    .=  '"'.$singleColumnData[4].'", ';
						}


					} else { /*if plant does not exist*/ 

						/*check the existance of supervisor*/
						$supervisorDetails = User::where('username',$singleColumnData[4])->count();

						if ($getSupervisorCount == 0) {/*if supervisor assigned to no plant*/
							if ($supervisorDetails > 0) { /*if supervisor exists get id*/
								$user 			   =  User::where('username',$singleColumnData[4])->get()->toArray();
								$supervisorId 	   = $user[0]['id'];
							} else { /*if supervisor doesnot exist add new data*/
								$user 				= new User();
								$user->user_role_id = \Config::get('constants.supervisorRoleId');
								$user->username     = $singleColumnData[4];
								$user->full_name    = $singleColumnData[3];
								$user->phone_number = $phoneNo;
								$user->password     = Hash::make(\Config::get('constants.randomUserPassword'));
								$user->created_by   = \Auth::user()->id;
								$user->save();
								$supervisorId 		= $user->id;
							}
							$flag = 1;
						} else {
							$flag 					= 0;
							$existingSupervisor    .=  '"'.$singleColumnData[4].'", ';
						}
					}


					if ($flag == 0) { 
					 	$data['success'] = 'false';
					} else {

					 	/*add plant*/
						$plant 						= new Plant();
						$plant->created_by			= \Auth::user()->id;
						$plant->type 				= $singleColumnData[6];
						$plant->supervisor_id 		= $supervisorId;
						$plant->name 				= $singleColumnData[0];
				    	$plant->description 		= $singleColumnData[1];
				    	// $plant->contact_number 		= $singleColumnData[2];
				    	// $plant->contact_email 		= $singleColumnData[3];
				    	// $plant->contact_person 		= $singleColumnData[4];
				    	$plant->balance_amount 		= $singleColumnData[2];	    	
				    	
				    	$plant->save();

				    	$plantId = $plant->id;


				    	/*save data in plant journal lasers table*/
						$plantJournalLaser 				= new PlantJournalLaser();
						$plantJournalLaser->plant_id 	= $plantId;
						$plantJournalLaser->amount 	 	= $plant->balance_amount;
						$plantJournalLaser->description = 'Balance Initiation';
						$plantJournalLaser->entry_by    = \Auth::user()->id;
						$plantJournalLaser->entry_type  = 'BG';
						$plantJournalLaser->created_by  = \Auth::user()->id;
						$plantJournalLaser->save();


					 	/*check the existance of country*/
						$countryDetails = $this->nameExistsCheck('Country','country_name',strtolower($singleColumnData[7]),'');

						if ($countryDetails > 0) { /*if country exists get id*/
							$country   =  Country::whereRaw('LOWER(`country_name`) = "'.strtolower($singleColumnData[7]).'"')->get()->toArray();

							$countryId = $country[0]['id'];
						} else { /*if country does not exist add new data*/
							$country 					= new Country();
							$country->country_name    	= $singleColumnData[7];
							$country->country_code 		= $singleColumnData[8];
							$country->created_by   		= \Auth::user()->id;
							$country->save();
							$countryId 					= $country->id;
						}




						/*check the existance of state*/
						$stateDetails = $this->nameExistsCheck('State','state_name',strtolower($singleColumnData[9]),'');

						if ($stateDetails > 0) { /*if state exists get id*/
							$state   =  State::whereRaw('LOWER(`state_name`) = "'.strtolower($singleColumnData[9]).'"')->get()->toArray();

							$stateId = $state[0]['id'];
						} else { /*if state does not exist add new data*/
							$state 						= new State();
							$state->country_id    		= $countryId;
							$state->state_name    		= $singleColumnData[9];
							$state->state_code 		 	= $singleColumnData[10];
							$state->created_by   		= \Auth::user()->id;
							$state->save();
							$stateId 					= $state->id;
						}




						/*check the existance of city*/
						$cityDetails = $this->nameExistsCheck('City','city_name',strtolower($singleColumnData[11]),'');

						if ($cityDetails > 0) { /*if city exists get id*/
							$city   =  City::whereRaw('LOWER(`city_name`) = "'.strtolower($singleColumnData[11]).'"')->get()->toArray();

							$cityId = $city[0]['id'];
						} else { /*if city does not exist add new data*/
							$city 						= new City();
							$city->country_id    		= $countryId;
							$city->state_id    			= $stateId;
							$city->city_name    		= $singleColumnData[11];
							$city->city_code 		 	= $singleColumnData[12];
							$city->created_by   		= \Auth::user()->id;
							$city->save();
							$cityId 					= $city->id;
						}

						/*get latitude longitude*/
						$address = $singleColumnData[9].'+'.$singleColumnData[11].'+'.$singleColumnData[7].'+'.$singleColumnData[13];
						$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key='.\Config::get('constants.api_key');

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL verification
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_URL,htmlspecialchars_decode($url));
						$result=curl_exec($ch);
						curl_close($ch);
						$json 		  	= json_decode($result);
						$lat  			= $json->results[0]->geometry->location->lat; 
						$lng 			= $json->results[0]->geometry->location->lng;


					 	$plantAddress 					= new PlantAddress();
						$plantAddress->plant_id 		= $plantId;
						$plantAddress->country_id 		= $countryId;
						$plantAddress->state_id 		= $stateId;
						$plantAddress->city_id 			= $cityId;
				    	$plantAddress->address 			= $singleColumnData[13];
				    	$plantAddress->lat 				= ($lat == '') ? NULL : $lat;
				    	$plantAddress->lng 				= ($lng == '') ? NULL : $lng;
				    	$plantAddress->created_by		= \Auth::user()->id;
		    	
		    	
		    			$plantAddress->save();
				    	
				 		$data['success'] 		= 'true';
					} 

				}

			}
		}
		
		if ($existingData != '') {
			$existingDataText  .= ' Plant named '.$existingData.' already have address. So these data are not added.';
		}


		if ($existingSupervisor != '') {
			$existingDataText  .= ' Supervisor having Email Adrress '.$existingSupervisor.' already assigned to a Plant. So these data are not added.';
		}

		if ($existingDataErr != '') {
			$existingDataText  .= 'Data format error in following data:- '.$existingDataErr;
		}
		
		$data['success'] 	 = 'true';

		if ($data['success'] == 'true') {
			$request->session()->flash('alert-success', 'Plant Address Imported Successfully. '.$existingDataText);
		}
        return $data;

	}
	

}
