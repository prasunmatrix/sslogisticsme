<?php

/*****************************************************/
# Party Controller             
# Class name : PartyController
# Functionality: listing, add, edit, deletion of parties
# Author : Sanchari Ghosh                                 
# Created Date :  10/08/2018                                
# Purpose: Developing the functionality of listing, add, edit, deletion of parties
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Models\Party;
use App\Models\PartyDestination;
use App\Models\AddressZone;


class PartyController extends Controller {
 
	/*****************************************************/
	# Party Controller             
	# Class name : PartyController
	# Functionality: constructor
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                 
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}
	

	/*****************************************************/
	# Party Controller             
	# Function name : index
	# Functionality: view party listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  to view party listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('parties.partyList');
	}



	/*****************************************************/
	# Party Controller             
	# Function name : getPartyList
	# Functionality: get data of party listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  to get data of party listing page  
	# Params : Request $request                                          
	/*****************************************************/
	public function getPartyList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'partyTable' 				=> config('dbtables.parties'),
					'addressZoneTable'			=> config('dbtables.address_zones'),
				);

		/*get available records*/
		$partyList = Party::availableRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$totalParties = Party::totalRecords($dbTables,$request->searchKeyword);
		/*customizing final array*/
		$data['partyList'] 		= $partyList;
		$data['totalParties'] 	= $totalParties;
		$data['currentPage']    = $request->currentPage;
		$data['success']		= 'true'; 

		return $data;
	}




	/*****************************************************/
	# Party Controller             
	# Function name : viewPartyList
	# Functionality: get data of party listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  to get data of party listing page  
	# Params :                                           
	/*****************************************************/
	public function viewPartyList(){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$partyList = Party::where('status','A')->get();

		/*customizing final array*/
		$data['partyList'] 		= $partyList;
		$data['success'] 		= 'true';

		return $data;
	}




	/*****************************************************/
	# Party Controller             
	# Function name : viewAddParty
	# Functionality: view add party page
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  view add party page 
	# Params :                                            
	/*****************************************************/
	public function viewAddParty(){
		return view('parties.addForm');
	}



	/*****************************************************/
	# Party Controller             
	# Function name : viewEditParty
	# Functionality: view edit party page
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  view edit party page 
	# Params :                                            
	/*****************************************************/
	public function viewEditParty(){
		return view('parties.editForm');
	}




	/*****************************************************/
	# Party Controller             
	# Function name : getEditParty
	# Functionality: get edit party page
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  get edit party page 
	# Params :  Request $request                                          
	/*****************************************************/
	public function getEditParty(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$partyId = $request->partyId;

		/*get available records*/
		$partyDetails = Party::find($partyId);

		/*address zone*/
		$addressZoneDetails = AddressZone::find($partyDetails->address_zone_id);

		/*customizing final array*/
		$data['partyDetails'] 		= $partyDetails;
		$data['addressDetails']		= $addressZoneDetails;
		$data['success'] 			= 'true';

		return $data;
	}






	/*****************************************************/
	# Party Controller             
	# Function name : saveParty
	# Functionality: save party
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  save party 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveParty(Request $request){

		$data 				= array(); /*storing data for listing*/ 
		$partyDestinationId = array(); /*storing party destination ids for change status*/
		$flag           	= 0;

		
		if (isset($request->partyId) && ($request->partyId != '')) {
			$party 						= Party::find($request->partyId);
			$party->updated_by			= \Auth::user()->id;
			$existCount 				= $this->nameExistsCheck('Party','party_name',strtolower($request->party_name),$request->partyId);
		} else {
			$party 			   = new Party();
			$party->created_by = \Auth::user()->id;
			$existCount 				= $this->nameExistsCheck('Party','party_name',strtolower($request->party_name),'');
		}

		/*check address*/
		$addressCount = AddressZone::where('id',$request->address_zone_id)->count();

		if ($existCount > 0) {
			$data['success'] = 'false';
			$data['count'] 	 =  $existCount ;
			$data['msg'] 	 =  'Party already exists' ;
		} else {

			if($addressCount > 0) {/*get id if address zone exists*/
			   $addressZoneId  = $request->address_zone_id;
			   $flag 		   = 1;
			} else {
				$flag 		   = 0;
		    	$data['msg']   =  'Please provide proper address' ;
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
				$party->party_name 			= strtoupper($request->party_name);
				$party->address_zone_id 	= $addressZoneId;
		    	$party->party_description 	= ($request->party_description == 'undefined' || $request->party_description == 'null') ? NULL :(strtoupper($request->party_description));
		    	$party->phone_number 		= ($request->phone_number == 'undefined' || $request->phone_number == 'null') ? NULL :(strtoupper($request->phone_number));
		    	$party->email 				= ($request->email == 'undefined' || $request->email == 'null') ? NULL :(strtoupper($request->email));
		    	$party->status 				= $request->status;
		    	
		    	
		    	$party->save();




		    	/*change the status of party destination while party status is being changed*/
		    	if (isset($request->partyId) && ($request->partyId != '') && ($party->status == 'I')) {
			    	
					$partyDestinationDetails = PartyDestination::where('party_id',$request->partyId)->get()->toArray();

					if (!empty($partyDestinationDetails)) {
						foreach ($partyDestinationDetails as $p) {
							array_push($partyDestinationId, $p['id']);
						}
						PartyDestination::whereIn('id',$partyDestinationId)->update(array('updated_by' => \Auth::user()->id,'status'=>$party->status)); 
					}
			    }

			    $data['party']			= $party->id;
			    $data['partyAddress']   =  (int)$addressZoneId;
		 		$data['success'] 		= 'true';

		 		if (isset($request->partyId) && ($request->partyId != '')) {
					$request->session()->flash('alert-success', 'Party Edited Successfully');
				} else {
					$request->session()->flash('alert-success', 'Party Added Successfully');
				}
			} else {
				$data['success'] = 'false';
			}
		}
        return $data;
	}


	/*****************************************************/
	# Party Controller             
	# Function name : viewRecord
	# Functionality: view party details page
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/01/2019                                
	# Purpose:  to view party details page  
	# Params :                                           
	/*****************************************************/
	public function viewRecord(){
		return view('parties.partyView');
	}



	/*****************************************************/
	# Party Controller             
	# Function name : getPartyDetails
	# Functionality: get details of a particular party
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/01/2019                                
	# Purpose:  to get details of particular party
	# Params : Request $request                                          
	/*****************************************************/
	public function getPartyDetails(Request $request){
		$partyId = $request->partyId;

		$data 	= array(); /*storing data for listing*/ 

		$data['partyDetails'] = $this->getEditParty($request);
		
        $data['success'] 	 = 'true';
		return $data;
	}



	/*****************************************************/
	# Party Controller             
	# Function name : deleteParty
	# Functionality: delete party
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  delete party 
	# Params :  Request $request                                          
	/*****************************************************/
	public function deleteParty(Request $request){

		$data 				= array(); /*storing data for listing*/ 


		/*check existance of party in trip*/
		$tripPartyDetails = Trip::where('party_id',$request->partyId)->count();

		if(is_numeric($request->partyId)) {
			if ($tripPartyDetails > 0) {
				$data['success']		= 'false'; 
			} else {
			
				/*delete data*/
				$party = Party::find($request->partyId);
				$party->deleted_by = \Auth::user()->id;/*logged in user id*/
				$party->status     = 'D';
				$party->is_deleted = 'Y';
				$party->save();


				/*soft delete the record*/
				$party->delete();

				$data['success']		= 'true'; 	
			}	
		} else {
			$data['success']		= 'not_numeric'; 
		}

		return $data;
		
	}



	/*****************************************************/
	# Party Controller             
	# Function name : saveCSVParty
	# Functionality: save party after importing csv
	# Author : Sanchari Ghosh                                 
	# Created Date : 27/08/2018                                
	# Purpose:  save party after importing csv 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveCSVParty(Request $request){

		$data 		 		= array(); /*storing data for listing*/ 
		$contentdata 		= json_decode($request->partyDetailsData);
		$existingData		= ''; /*collect the existing data*/
		$existingDataText 	= '';
		$existingDataErr	= ''; /*collect the existing data having error*/
		$validEmail         = 'false'; /*check validity of email*/
		$flag 				= 0;
		$blankDataErr 		= 0;
		$flag 				= 0;
		$rowNo 				= 0;


		if(isset($contentdata) && count($contentdata)>0){
			for($i=1; $i<(count($contentdata) - 1); $i++) {
				$singleColumnData = explode(',',$contentdata[$i]);

				/*check duplicate party name*/
				$existCount = $this->nameExistsCheck('Party','party_name',strtolower($singleColumnData[0]),'');

				/*check existance of '@' and '.' in email address*/
				$countInEmail1 = substr_count($singleColumnData[3],"@");
				$countInEmail2 = substr_count($singleColumnData[3],".");

				if ($countInEmail1 == 1 && $countInEmail2 > 0) {
					$validEmail = 'true';
				}

				/*check address title*/
				$addressTitleCount = AddressZone::where('title',$singleColumnData[5])->count();

				/*check address*/
				$addressCount = AddressZone::where('address',$singleColumnData[4])->count();

				if ($existCount > 0) { /*if duplicate party exists*/
				 	$data['success'] = 'false';
				 	$data['count'] 	 =  $existCount ;
				 	$existingData   .=  '"'.$singleColumnData[0].'", ';
				} else {

					/*for checking blank data*/
					if(trim($singleColumnData[0]) == '' || trim($singleColumnData[1]) == '' || trim($singleColumnData[2]) == '' || trim($singleColumnData[3]) == '' || trim($singleColumnData[4]) == '' || trim($singleColumnData[5]) == ''){
						$data['success'] = 'false';
				 		$blankDataErr    =  1;
				 		$rowNo 			 =  $i;
				 		$flag 			 =  0;
					} else {

					 	$phoneNo = str_replace("\r","",$singleColumnData[2]);

					 	/*check whether the format of the phone number and email is right or not*/
					 	if (!(preg_match(\Config::get('constants.phoneNumberPattern'), $phoneNo)) || ($validEmail == 'false')){
					 		$data['success'] = 'false';

					 		if (!preg_match(\Config::get('constants.phoneNumberPattern'), $phoneNo)) {
					 			$existingDataErr   .=  '"'.$phoneNo.'", ';
					 		}

					 		if ($validEmail == 'false') {
					 			$existingDataErr   .=  '"'.$singleColumnData[3].'", ';
					 		}
					 		
					 		
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
									$flag 			= 1;
								} else {
									$existingDataErr   .=  '"'.$singleColumnData[4].'", ';
									$flag = 0;
								}
							}

							if ($flag == 1)	{
						    	$party 						= new Party();
						 		$party->created_by			= \Auth::user()->id;
								$party->party_name 			= $singleColumnData[0];
								$party->address_zone_id		= $addressZoneId;
						    	$party->party_description 	= $singleColumnData[1];
						 		$party->phone_number 		= $phoneNo;
						 		$party->email 				= $singleColumnData[3];
						 		$party->save();
					 			$data['success'] 		= 'true';
							}	
					 	}
				 	}
				}
			}
		}
		
		if ($existingData != '') {
			$existingDataText  = ' Party named '.$existingData.' already exists. So these data are not added.';
		}

		if ($existingDataErr != '') {
			$existingDataText  .= 'Data format error in following data:- '.$existingDataErr;
		}

		if ($blankDataErr == 1) {
			$existingDataText  .= ' Data is not imported of row number :- '.$rowNo.', as some of the fields are blank.';
		}

		$data['success'] 	 = 'true';

		if ($data['success'] == 'true') {
			$request->session()->flash('alert-success', 'Party Imported Successfully. '.$existingDataText);
		}
        return $data;
	}




	/*****************************************************/
	# Party Controller             
	# Function name : viewPartyListHavingPartyDestination
	# Functionality: get lists of parties having party destination
	# Author : Sanchari Ghosh                                 
	# Created Date : 04/09/2018                                
	# Purpose:  get lists of parties having party destinations
	# Params :                                           
	/*****************************************************/
	public function viewPartyListHavingPartyDestination(){

		$data 			= array(); /*storing data for listing*/ 
		
		/*get party details*/
		$partyList = Party::where('status','A')->orderby('party_name')->get();

		$data['partyList'] 		= $partyList;
		$data['details']        = $partyList;
		$data['success'] 		= 'true';

		return $data;
	}
	




	/*****************************************************/
	# Party Controller             
	# Function name : viewTripPartyList
	# Functionality: get lists of parties for trip
	# Author : Sanchari Ghosh                                 
	# Created Date : 04/09/2018                                
	# Purpose:  get lists of parties for trip
	# Params :                                           
	/*****************************************************/
	public function viewTripPartyList(){

		$data 			= array(); /*storing data for listing*/ 
		
		/*get party details*/
		if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) { 
			$partyList = Party::where('status','A')->orderby('party_name')->where('created_by',\Auth::user()->id)->get();
		} else {
			$partyList = Party::where('status','A')->orderby('party_name')->get();
		}
		

		$data['partyList'] 		= $partyList;
		$data['details']        = $partyList;
		$data['success'] 		= 'true';

		return $data;
	}




	/*****************************************************/
	# Party Controller             
	# Function name : getAddressWisePartyDetails
	# Functionality: get address wise party details
	# Author : Sanchari Ghosh                                 
	# Created Date : 14/02/2019                                
	# Purpose:  get address wise party details
	# Params :  Request $request                                          
	/*****************************************************/
	public function getAddressWisePartyDetails(Request $request){
		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) { 
			$partyList = Party::select('party_name','id')->where('status','A')->where('created_by',\Auth::user()->id)->where('address_zone_id',$request->addressZoneId)->orderby('party_name')->get()->toArray();
		} else {
			$partyList = Party::select('party_name','id')->where('status','A')->orderby('party_name')->where('address_zone_id',$request->addressZoneId)->get()->toArray();
		}
		
		/*customizing final array*/
		$data['partyList'] 	= $partyList;
		$data['success'] 	= 'true';

		return $data;
	}


	/*****************************************************/
	# Party Controller             
	# Function name : viewTripPartyAddressZone
	# Functionality: get address details of selected party
	# Author : Sanchari Ghosh                                 
	# Created Date : 14/02/2019                                
	# Purpose:  get address details of selected party
	# Params :  Request $request                                          
	/*****************************************************/
	public function viewTripPartyAddressZone(Request $request){
		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$addressList = Party::select('address_zone_id')->where('id',$request->partyId)->get()->toArray();

		/*customizing final array*/
		$data['addressList'] 	= $addressList[0]['address_zone_id'];
		$data['success'] 		= 'true';

		return $data;
	}

}
