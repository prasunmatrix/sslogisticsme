<?php

/*****************************************************/
# PartyDestination Controller             
# Class name : PartyDestinationController
# Functionality: listing, add, edit, deletion of partyDestinations
# Author : Sanchari Ghosh                                 
# Created Date :  13/08/2018                                
# Purpose: Developing the functionality of listing, add, edit, deletion of partyDestinations
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Models\PartyDestination;
use App\Models\Party;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class PartyDestinationController extends Controller {
 
	/*****************************************************/
	# PartyDestination Controller             
	# Class name : PartyDestinationController
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
	# PartyDestination Controller             
	# Function name : index
	# Functionality: view partyDestination listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  to view partyDestination listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('party_destinations.partyDestinationList');
	}



	/*****************************************************/
	# PartyDestination Controller             
	# Function name : getPartyDestinationList
	# Functionality: get data of partyDestination listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  to get data of partyDestination listing page  
	# Params : Request $request                                          
	/*****************************************************/
	public function getPartyDestinationList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'partyDestinationTable' => config('dbtables.party_destinations'),
					'countryTable' 			=> config('dbtables.countries'),
					'stateTable' 			=> config('dbtables.states'),
					'cityTable' 			=> config('dbtables.cities'),
					'partyTable' 			=> config('dbtables.parties'),
				);

		/*get available records*/
		$partyDestinationList = PartyDestination::availableRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$total = PartyDestination::totalRecords($dbTables,$request->searchKeyword);
		/*customizing final array*/
		$data['partyDestinationList'] 	= $partyDestinationList;
		$data['total'] 					= $total;
		$data['success']				= 'true'; 

		return $data;
	}




	/*****************************************************/
	# PartyDestination Controller             
	# Function name : viewAddPartyDestination
	# Functionality: view add partyDestination page
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  view add partyDestination page 
	# Params :                                            
	/*****************************************************/
	public function viewAddPartyDestination(){
		return view('party_destinations.addForm');
	}



	/*****************************************************/
	# PartyDestination Controller             
	# Function name : viewEditPartyDestination
	# Functionality: view edit partyDestination page
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  view edit partyDestination page 
	# Params :                                            
	/*****************************************************/
	public function viewEditPartyDestination(){
		return view('party_destinations.editForm');
	}




	/*****************************************************/
	# PartyDestination Controller             
	# Function name : getEditPartyDestination
	# Functionality: get edit partyDestination page
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  get edit partyDestination page 
	# Params :  Request $request                                          
	/*****************************************************/
	public function getEditPartyDestination(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$partyDestinationId = $request->partyDestinationId;

		/*get available records*/
		$partyDestinationDetails = PartyDestination::find($partyDestinationId);

		/*customizing final array*/
		$data['partyDestinationDetails'] 	= $partyDestinationDetails;
		$data['success'] 					= 'true';

		return $data;
	}






	/*****************************************************/
	# PartyDestination Controller             
	# Function name : savePartyDestination
	# Functionality: save partyDestination
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  save partyDestination 
	# Params :  Request $request                                          
	/*****************************************************/
	public function savePartyDestination(Request $request){

		$data 		= array(); /*storing data for listing*/ 
		$existCount = 0; /*check duplicate existance*/
		
		if (isset($request->partyDestinationId) && ($request->partyDestinationId != '')) {
			$partyDestination 				= PartyDestination::find($request->partyDestinationId);
			$partyDestination->updated_by	= \Auth::user()->id;
		} else {
			$existCount 					= PartyDestination::where('party_id',$request->party_id)->count();
			$partyDestination 				= new PartyDestination();
			$partyDestination->created_by	= \Auth::user()->id;
		}


		if ($existCount > 0) {
			$data['success'] 		= 'false';
		} else {
			$partyDestination->party_id 		= $request->party_id;
			$partyDestination->country_id 		= $request->country_id;
			$partyDestination->state_id 		= $request->state_id;
			$partyDestination->city_id 			= $request->city_id;
			$partyDestination->address 			= $request->address;
	    	$partyDestination->contact_number 	= $request->contact_number;
	    	$partyDestination->contact_email 	= $request->contact_email;
	    	$partyDestination->contact_person 	= $request->contact_person;
	    	$partyDestination->lat 				= $request->lat;
	    	$partyDestination->lng 				= $request->lng;
	    	$partyDestination->status 			= $request->status;
	    	
	    	
	    	$partyDestination->save();

	 		$data['success'] 		= 'true';

	 		if (isset($request->partyDestinationId) && ($request->partyDestinationId != '')) {
				$request->session()->flash('alert-success', 'Party Destination Edited Successfully');
			} else {
				$request->session()->flash('alert-success', 'Party Destination Added Successfully');
			}
 		}
        return $data;
	}




	/*****************************************************/
	# PartyDestination Controller             
	# Function name : deletePartyDestination
	# Functionality: delete partyDestination
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  delete partyDestination 
	# Params :  Request $request                                          
	/*****************************************************/
	public function deletePartyDestination(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*delete data*/
		$partyDestination = PartyDestination::find($request->partyDestinationId);
		$partyDestination->deleted_by = \Auth::user()->id;/*logged in user id*/
		$partyDestination->status     = 'D';
		$partyDestination->is_deleted = 'Y';
		$partyDestination->save();

		/*soft delete the record*/
		$partyDestination->delete();

		$data['success']		= 'true'; 

		return $data;
		
	}





	/*****************************************************/
	# PartyDestination Controller             
	# Function name : saveCSVPartyDestination
	# Functionality: save PartyDestination after importing csv
	# Author : Sanchari Ghosh                                 
	# Created Date : 28/08/2018                                
	# Purpose:  save PartyDestination after importing csv 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveCSVPartyDestination(Request $request){

		$data 		 			= array(); /*storing data for listing*/ 
		$contentdata 			= json_decode($request->partyDestinationDetailsData);
		$flag 		 			= 0;
		$lat 		 			= '';
		$lng 		 			= '';
		$existingData			= ''; /*collect the data of party having party destination*/
		$existingDataText 		= '';
		$existingDataErr		= ''; /*collect the existing data having error*/

		if(isset($contentdata) && count($contentdata)>0){
			for($i=1; $i<(count($contentdata) - 1); $i++) {
				$data['i'] = $i;
				$singleColumnData = explode(',',$contentdata[$i]);

				$partyDetails = $this->nameExistsCheck('Party','party_name',strtolower($singleColumnData[0]),'');
				$data['partyDetails'] = $partyDetails;

				$phoneNoParty 		= str_replace("\r","",$singleColumnData[2]);
				$phoneNoDestination = str_replace("\r","",$singleColumnData[11]);

				/*check whether the format of the phone number and email is right or not*/
			 	if (!(preg_match(\Config::get('constants.phoneNumberPattern'), $phoneNoParty)) || !(preg_match(\Config::get('constants.emailPattern'), $singleColumnData[3])) || !(preg_match(\Config::get('constants.phoneNumberPattern'), $phoneNoDestination)) || !(preg_match(\Config::get('constants.emailPattern'), $singleColumnData[12]))) {

			 		$data['success'] = 'false';

			 		if (!preg_match(\Config::get('constants.phoneNumberPattern'), $phoneNoParty)) {
			 			$existingDataErr   .=  '"'.$phoneNoParty.'", ';
			 		}

			 		if (!preg_match(\Config::get('constants.emailPattern'), $singleColumnData[3])) {
			 			$existingDataErr   .=  '"'.$singleColumnData[3].'", ';
			 		}

			 		if (!preg_match(\Config::get('constants.phoneNumberPattern'), $phoneNoDestination)) {
			 			$existingDataErr   .=  '"'.$phoneNoDestination.'", ';
			 		}

			 		if (!preg_match(\Config::get('constants.emailPattern'), $singleColumnData[12])) {
			 			$existingDataErr   .=  '"'.$singleColumnData[12].'", ';
			 		}

			 		$flag = 0;
			 	} else {

					if ($partyDetails > 0) { /*if party exists*/ 
						$party   =  Party::whereRaw('LOWER(`party_name`) = "'.strtolower($singleColumnData[0]).'"')->get()->toArray();

						$partyId = $party[0]['id'];
						$data['partyId'] = $partyId;

						/*check whether destination of the party exist or not*/
						$partyDestinationDetails = PartyDestination::where('party_id',$partyId)->count();
						$data['partyCount'] = $partyDestinationDetails;
						if ($partyDestinationDetails == 0) { /*if no destination exist for this party*/
							$flag = 1;
						} else {
							$flag = 0;
							$existingData   .=  '"'.$singleColumnData[0].'", ';
						}
					} else { /*if party does not exist*/

							/*add party*/
							$party 						= new Party();
							$party->created_by			= \Auth::user()->id;
							$party->party_name 			= $singleColumnData[0];
					    	$party->party_description 	= $singleColumnData[1];
					    	$party->phone_number 		= $phoneNoParty;
					    	$party->email 				= $singleColumnData[3];
			    	
			    			$party->save();    	
					    	
					    	$partyId = $party->id;
					    	$flag = 1;
					}



					if ($flag == 0) { 
					 	$data['success'] = 'false';
					} else {
					 	/*check the existance of country*/
						$countryDetails = $this->nameExistsCheck('Country','country_name',strtolower($singleColumnData[4]),'');

						if ($countryDetails > 0) { /*if country exists get id*/
							$country   =  Country::whereRaw('LOWER(`country_name`) = "'.strtolower($singleColumnData[4]).'"')->get()->toArray();

							$countryId = $country[0]['id'];
						} else { /*if country does not exist add new data*/
							$country 					= new Country();
							$country->country_name    	= $singleColumnData[4];
							$country->country_code 		= $singleColumnData[5];
							$country->created_by   		= \Auth::user()->id;
							$country->save();
							$countryId 					= $country->id;
						}




						/*check the existance of state*/
						$stateDetails = $this->nameExistsCheck('State','state_name',strtolower($singleColumnData[6]),'');

						if ($stateDetails > 0) { /*if state exists get id*/
							$state   =  State::whereRaw('LOWER(`state_name`) = "'.strtolower($singleColumnData[6]).'"')->get()->toArray();

							$stateId = $state[0]['id'];
						} else { /*if state does not exist add new data*/
							$state 						= new State();
							$state->country_id    		= $countryId;
							$state->state_name    		= $singleColumnData[6];
							$state->state_code 		 	= $singleColumnData[7];
							$state->created_by   		= \Auth::user()->id;
							$state->save();
							$stateId 					= $state->id;
						}




						/*check the existance of city*/
						$cityDetails = $this->nameExistsCheck('City','city_name',strtolower($singleColumnData[8]),'');

						if ($cityDetails > 0) { /*if city exists get id*/
							$city   =  City::whereRaw('LOWER(`city_name`) = "'.strtolower($singleColumnData[8]).'"')->get()->toArray();

							$cityId = $city[0]['id'];
						} else { /*if city does not exist add new data*/
							$city 						= new City();
							$city->country_id    		= $countryId;
							$city->state_id    			= $stateId;
							$city->city_name    		= $singleColumnData[8];
							$city->city_code 		 	= $singleColumnData[9];
							$city->created_by   		= \Auth::user()->id;
							$city->save();
							$cityId 					= $city->id;
						}

						/*get latitude longitude*/
						$address = $singleColumnData[6].'+'.$singleColumnData[8].'+'.$singleColumnData[4].'+'.$singleColumnData[10];
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


					 	$partyDestination 					= new PartyDestination();
						$partyDestination->party_id 		= $partyId;
						$partyDestination->country_id 		= $countryId;
						$partyDestination->state_id 		= $stateId;
						$partyDestination->city_id 			= $cityId;
				    	$partyDestination->contact_number 	= $phoneNoDestination;
				    	$partyDestination->contact_email 	= $singleColumnData[12];
				    	$partyDestination->contact_person 	= $singleColumnData[13];
				    	$partyDestination->address 			= $singleColumnData[10];
				    	$partyDestination->lat 				= ($lat == '') ? NULL : $lat;;
				    	$partyDestination->lng 				= ($lng == '') ? NULL : $lng;;
				    	$partyDestination->created_by		= \Auth::user()->id;
		    	
		    			$partyDestination->save();
				    	
				 		$data['success'] 		= 'true';
					}

				}

			}
		}
		

		if ($existingData != '') {
			$existingDataText  = ' Party named '.$existingData.' already have destination. So these data are not added.';
		}

		if ($existingDataErr != '') {
			$existingDataText  .= 'Data format error in following data:- '.$existingDataErr;
		}

		$data['success'] 	 = 'true';

		if ($data['success'] == 'true') {
			$request->session()->flash('alert-success', 'Party Destination Imported Successfully. '.$existingDataText);
		}

        return $data;

	}
	

}
