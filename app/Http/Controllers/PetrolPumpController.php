<?php

/*****************************************************/
# PetrolPump Controller             
# Class name : PetrolPumpController
# Functionality: listing, add, edit, deletion of petrolPumps,generating reports
# Author : Sanchari Ghosh                                 
# Created Date :  09/08/2018                                
# Purpose: Developing the functionality of listing, add, edit, deletion of petrolPumps,generating reports
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Models\PetrolPump;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\AddressZone;
use App\Models\PetrolPumpJournalLaser;


class PetrolPumpController extends Controller {
 
	/*****************************************************/
	# PetrolPump Controller             
	# Class name : PetrolPumpController
	# Functionality: constructor
	# Author : Sanchari Ghosh                                 
	# Created Date : 09/08/2018                                 
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}
	

	/*****************************************************/
	# PetrolPump Controller             
	# Function name : index
	# Functionality: view petrolPump listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 09/08/2018                                
	# Purpose:  to view petrolPump listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('petrol_pumps.petrolPumpList');
	}



	/*****************************************************/
	# PetrolPump Controller             
	# Function name : getPetrolPumpList
	# Functionality: get data of petrolPump listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 09/08/2018                                
	# Purpose:  to get data of petrolPump listing page  
	# Params : Request $request                                          
	/*****************************************************/
	public function getPetrolPumpList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'petrolPumpTable' 			=> config('dbtables.petrol_pumps'),
					'addressZoneTable'			=> config('dbtables.address_zones'),
				);

		/*get available records*/
		$petrolPumpList = PetrolPump::availableRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$total = PetrolPump::totalRecords($dbTables,$request->searchKeyword);
		/*customizing final array*/
		$data['petrolPumpList'] = $petrolPumpList;
		$data['total'] 			= $total;
		$data['currentPage']    = $request->currentPage;
		$data['success']		= 'true'; 

		return $data;
	}




	/*****************************************************/
	# PetrolPump Controller             
	# Function name : viewCityList
	# Functionality: get city lists
	# Author : Sanchari Ghosh                                 
	# Created Date : 09/08/2018                                
	# Purpose:  get city lists
	# Params : Request $request                                          
	/*****************************************************/
	public function viewCityList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$cityList = City::where('state_id',$request->state_id)->where('status','A')->get();

		/*customizing final array*/
		$data['cityList'] 		= $cityList;
		$data['success'] 		= 'true';

		return $data;
	}





	/*****************************************************/
	# PetrolPump Controller             
	# Function name : viewAddPetrolPump
	# Functionality: view add petrolPump page
	# Author : Sanchari Ghosh                                 
	# Created Date : 09/08/2018                                
	# Purpose:  view add petrolPump page 
	# Params :                                            
	/*****************************************************/
	public function viewAddPetrolPump(){
		return view('petrol_pumps.addForm');
	}



	/*****************************************************/
	# PetrolPump Controller             
	# Function name : viewEditPetrolPump
	# Functionality: view edit petrolPump page
	# Author : Sanchari Ghosh                                 
	# Created Date : 09/08/2018                                
	# Purpose:  view edit petrolPump page 
	# Params :                                            
	/*****************************************************/
	public function viewEditPetrolPump(){
		return view('petrol_pumps.editForm');
	}




	/*****************************************************/
	# PetrolPump Controller             
	# Function name : getEditPetrolPump
	# Functionality: get edit petrolPump page
	# Author : Sanchari Ghosh                                 
	# Created Date : 09/08/2018                                
	# Purpose:  get edit petrolPump page 
	# Params :  Request $request                                          
	/*****************************************************/
	public function getEditPetrolPump(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$petrolPumpId = $request->petrolPumpId;

		/*get available records*/
		$petrolPumpDetails = PetrolPump::find($petrolPumpId);

		/*address zone*/
		$addressZoneDetails = AddressZone::find($petrolPumpDetails->address_zone_id);

		/*customizing final array*/
		$data['petrolPumpDetails'] 	= $petrolPumpDetails;
		$data['addressDetails']		= $addressZoneDetails;
		$data['success'] 			= 'true';

		return $data;
	}


	/*****************************************************/
	# PetrolPump Controller             
	# Function name : viewRecord
	# Functionality: view petrol pump details page
	# Author : Sanchari Ghosh                                 
	# Created Date : 04/01/2019                                
	# Purpose:  to view etrol pump details page  
	# Params :                                           
	/*****************************************************/
	public function viewRecord(){
		return view('petrol_pumps.petrolPumpView');
	}



	/*****************************************************/
	# PetrolPump Controller             
	# Function name : getPetrolPumpDetails
	# Functionality: get details of a particular petrol pump
	# Author : Sanchari Ghosh                                 
	# Created Date : 04/01/2019                               
	# Purpose:  to get details of particular petrol pump
	# Params : Request $request                                          
	/*****************************************************/
	public function getPetrolPumpDetails(Request $request){

		/*get petrol pump id*/
		$petrolPumpId = $request->petrolPumpId;

		$data 	= array(); /*storing data for listing*/ 

		$data['petrolPumpDetails'] 	= $this->getEditPetrolPump($request);
        $data['success'] 	 		= 'true';

		return $data;
	}






	/*****************************************************/
	# PetrolPump Controller             
	# Function name : savePetrolPump
	# Functionality: save petrolPump
	# Author : Sanchari Ghosh                                 
	# Created Date : 09/08/2018                                
	# Purpose:  save petrolPump 
	# Params :  Request $request                                          
	/*****************************************************/
	public function savePetrolPump(Request $request){

		$data 		= array(); /*storing data for listing*/ 
		$existCount = 0;
		$flag       = 0;
		
		if (isset($request->petrolPumpId) && ($request->petrolPumpId != '')) {
			$petrolPump 					= PetrolPump::find($request->petrolPumpId);
			$existCount 					= $this->nameExistsCheck('PetrolPump','petrol_pump_name',strtolower($request->petrol_pump_name),$request->petrolPumpId);
			$petrolPump->updated_by			= \Auth::user()->id;
		} else {
			$petrolPump 					= new PetrolPump();
			$existCount 					= $this->nameExistsCheck('PetrolPump','petrol_pump_name',strtolower($request->petrol_pump_name),'');
			$petrolPump->created_by			= \Auth::user()->id;
		}

		/*check address*/
		$addressCount = AddressZone::where('id',$request->address_zone_id)->count();

		if ($existCount > 0) {
			$data['success'] = 'false';
			$data['count'] 	 =  $existCount ;
			$data['msg'] 	 =  'Petrol Pump already exists' ;
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
		    	$petrolPump->petrol_pump_name 	= strtoupper($request->petrol_pump_name);
		    	$petrolPump->address_zone_id 	= $addressZoneId;
		    	$petrolPump->contact_number 	= ($request->contact_number == 'undefined' || $request->contact_number == 'null') ? NULL :($request->contact_number);
	    		$petrolPump->contact_email 		= ($request->contact_email == 'undefined' || $request->contact_email == 'null') ? NULL :($request->contact_email);
	    		$petrolPump->contact_person 	= ($request->contact_person == 'undefined' || $request->contact_person == 'null') ? NULL : strtoupper($request->contact_person);
		    	
		    	$petrolPump->status 			= $request->status;

		    	
		    	$petrolPump->save();

		    	$data['petrolPump']		= $petrolPump->id;
		 		$data['success'] 		= 'true';

		 		if (isset($request->petrolPumpId) && ($request->petrolPumpId != '')) {
					$request->session()->flash('alert-success', 'PetrolPump edited Successfully');
				} else {
					$request->session()->flash('alert-success', 'PetrolPump added Successfully');
				}
			} else {
				$data['success'] = 'false';
			}	
		}
 		
        return $data;
	}




	/*****************************************************/
	# PetrolPump Controller             
	# Function name : deletePetrolPump
	# Functionality: delete petrolPump
	# Author : Sanchari Ghosh                                 
	# Created Date : 09/08/2018                                
	# Purpose:  delete petrolPump 
	# Params :  Request $request                                          
	/*****************************************************/
	public function deletePetrolPump(Request $request){

		$data 	= array(); /*storing data for listing*/ 


		/*check existance of petrol pump in trip*/
		$tripPetrolPumpDetails = Trip::where('petrol_pump_id',$request->petrolPumpId)->count();

		if(is_numeric($request->petrolPumpId)) {
			if ($tripPetrolPumpDetails > 0) {
				$data['success']		= 'false'; 
			} else {

				/*delete data*/
				$petrolPump = PetrolPump::find($request->petrolPumpId);
				$petrolPump->deleted_by = \Auth::user()->id;/*logged in user id*/
				$petrolPump->status     = 'D';
				$petrolPump->is_deleted = 'Y';
				$petrolPump->save();

				/*soft delete the record*/
				$petrolPump->delete();

				$data['success']		= 'true'; 
		    }
	    } else {
			$data['success']		= 'not_numeric'; 
		}


		return $data;
		
	}






	/*****************************************************/
	# Plant Controller             
	# Function name : saveCSVPetrolPump
	# Functionality: save petrol pump after importing csv
	# Author : Sanchari Ghosh                                 
	# Created Date : 27/08/2018                                
	# Purpose:  save petrol pump after importing csv 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveCSVPetrolPump(Request $request){

		$data 		 		= array(); /*storing data for listing*/ 
		$contentdata 		= json_decode($request->petrolPumpDetailsData);
		$existingData		= ''; /*collect the existing data*/
		$existingDataText 	= '';
		$existingDataErr	= ''; /*collect the existing data having error*/
		$flag 				= 0;
		$blankDataErr 		= 0;
		$rowNo 				= 0;
		
		if(isset($contentdata) && count($contentdata)>0){
			for($i=1; $i<(count($contentdata) - 1); $i++) {
				$singleColumnData = explode(',',$contentdata[$i]);

				/*check duplicate petrol pump name*/
				$existCount = $this->nameExistsCheck('PetrolPump','petrol_pump_name',strtolower($singleColumnData[0]),'');

				/*check address*/
				$addressCount = AddressZone::where('address',$singleColumnData[1])->count();

				/*check address title*/
				$addressTitleCount = AddressZone::where('title',$singleColumnData[2])->count();

				if ($existCount > 0) { /*if duplicate petrol pump exists*/
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

						$phoneNo = str_replace("\r","",$singleColumnData[3]);

						/*check whether the format of the phone number and email is right or not*/
					 	if (!(preg_match(\Config::get('constants.phoneNumberPattern'), $phoneNo)) || !(preg_match(\Config::get('constants.emailPattern'), $singleColumnData[4]))){
					 		$data['success'] = 'false';

					 		if (!preg_match(\Config::get('constants.phoneNumberPattern'), $phoneNo)) {
					 			$existingDataErr   .=  '"'.$phoneNo.'", ';
					 		}

					 		if (!preg_match(\Config::get('constants.emailPattern'), $singleColumnData[4])) {
					 			$existingDataErr   .=  '"'.$singleColumnData[4].'", ';
					 		}
					 		
					 	} else {

					 		/*add address zone*/
							if($addressCount > 0) {/*get id if address zone exists*/
							   $addressDetails = AddressZone::where('address',$singleColumnData[1])->get()->toArray();
							   $addressZoneId  = $addressDetails[0]['id'];
							   $flag 		   = 1;
							} else if ($addressTitleCount > 0) { /*get id if address title exists*/
							   $addressDetails = AddressZone::where('title',$singleColumnData[2])->get()->toArray();
							   $addressZoneId  = $addressDetails[0]['id'];
							   $flag 		   = 1;	
							} else {/*add address zone if does not exists*/
								$address = $singleColumnData[1];
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
							    	$addressZone->title 		= $singleColumnData[2];
							    	$addressZone->save();

							    	$addressZoneId  = $addressZone->id;
							    	$flag 		   = 1;
							    } else {
									$existingDataErr   .=  '"'.$singleColumnData[1].'", ';
									$flag 		   = 0;
								}
							}

							if ($flag == 1)	{
							    	$petrolPump 					= new PetrolPump();
									$petrolPump->created_by			= \Auth::user()->id;
							    	$petrolPump->petrol_pump_name 	= $singleColumnData[0];
							    	$petrolPump->address_zone_id	= $addressZoneId;
							    	$petrolPump->contact_number 	= $phoneNo;
							    	$petrolPump->contact_email 		= $singleColumnData[4];
							    	$petrolPump->contact_person 	= $singleColumnData[5];
							    	
							    	$petrolPump->save();
							    	
							 		$data['success'] 		= 'true';
							}
				 		}
			 		}
				}
			}
		}
		
		if ($existingData != '') {
			$existingDataText  = ' Petrol Pump named '.$existingData.' already exists. So these data are not added.';
		}

		if ($existingDataErr != '') {
			$existingDataText  .= 'Data format error in following data:- '.$existingDataErr;
		}

		if ($blankDataErr == 1) {
			$existingDataText  .= ' Data is not imported of row number :- '.$rowNo.', as some of the fields are blank.';
		}

		$data['success'] 	 = 'true';

		if ($data['success'] == 'true') {
			$request->session()->flash('alert-success', 'Petrol Pump Imported Successfully. '.$existingDataText);
		}
		

        return $data;

	}




	/*****************************************************/
	# PetrolPump Controller             
	# Function name : viewPetrolpumpList
	# Functionality: get data of petrol pumps for trip
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/09/2018                                
	# Purpose:  get data of petrol pumps for trip
	# Params :                                           
	/*****************************************************/
	public function viewPetrolpumpList() {
		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) {
			$petrolPumpList = PetrolPump::where('status','A')->orderby('petrol_pump_name')->where('created_by',\Auth::user()->id)->get();
		} else {
			$petrolPumpList = PetrolPump::where('status','A')->orderby('petrol_pump_name')->get();
		}
		

		/*customizing final array*/
		$data['petrolPumpList'] = $petrolPumpList;
		$data['success'] 		= 'true';

		return $data;
	}



	/*****************************************************/
	# PetrolPump Controller             
	# Function name : dieselReport
	# Functionality: view diesel report page
	# Author : Sanchari Ghosh                                 
	# Created Date : 04/04/2019                               
	# Purpose:  to view diesel report page
	# Params : Request $request                                          
	/*****************************************************/
	public function dieselReport(Request $request) {
		return view('petrol_pumps.dieselReport');
	}


	/*****************************************************/
	# PetrolPump Controller             
	# Function name : getDieselReport
	# Functionality: get diesel report details
	# Author : Sanchari Ghosh                                 
	# Created Date : 04/04/2019                                
	# Purpose:  get diesel report details
	# Params : Request $request                                        
	/*****************************************************/
	public function getDieselReport(Request $request){
		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'petrolPumpTable' 				  => config('dbtables.petrol_pumps'),
					'petrolPumpJournalLaserTable' 	  => config('dbtables.petrol_pump_journal_lasers'),
					'truckTable' 				      => config('dbtables.trucks'),
					'plantTable'					  => config('dbtables.plants'),
					'tripTable'						  => config('dbtables.trips'),
					'vendorTable'					  => config('dbtables.vendors'),
				);
		/*get available records*/
		$dieselReportList = PetrolPump::getDieselReport($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->petrolPump,$request->dateRangeValue);
		$totalDieselReports = PetrolPump::totalDieselReportRecords($dbTables,$request->petrolPump,$request->dateRangeValue);


		/*calculate today's purchase and payment*/
		$petrolpumpLaserCredit 	= PetrolPumpJournalLaser::where('petrol_pump_id',$request->petrolPump)
													->where('created_at', '>=', date('Y-m-d 00:00:00'))
													->where('type', '=', 'C')
													->sum('amount');	
		$petrolpumpLaserDebit 	= PetrolPumpJournalLaser::where('petrol_pump_id',$request->petrolPump)
													->where('created_at', '>=', date('Y-m-d 00:00:00'))
													->where('type', '=', 'D')
													->sum('amount');	

		

		/*calculate last day'd purchase and payment*/
		$lastDay = date('Y-m-d 23:59:59',strtotime("-1 days"));
		$petrolpumpLaserCreditLastDay 	= PetrolPumpJournalLaser::where('petrol_pump_id',$request->petrolPump)
													->where('created_at', '<=', $lastDay)
													->where('type', '=', 'C')
													->sum('amount');	
		$petrolpumpLaserDebitLastDay 	= PetrolPumpJournalLaser::where('petrol_pump_id',$request->petrolPump)
													->where('created_at', '<=', $lastDay)
													->where('type', '=', 'D')
													->sum('amount');														
		$balanceLastDay = $petrolpumpLaserCreditLastDay - $petrolpumpLaserDebitLastDay;

		/*customizing final array*/
		$data['dieselReportList'] 		= $dieselReportList;
		$data['totalDieselReports'] 	= $totalDieselReports;
		$data['success']				= 'true'; 
		$data['currentPage']    		= $request->currentPage;
		$data['todaysPayment']			= $petrolpumpLaserCredit;
		$data['todaysPurchase']			= $petrolpumpLaserDebit;
		$data['petrolpumpLaserDebitLastDay']			= $petrolpumpLaserDebitLastDay;
		$data['petrolpumpLaserCreditLastDay']			= $petrolpumpLaserCreditLastDay;
		$data['balanceLastDay']			= $balanceLastDay;
		$data['carryForwardBalance']	= $dieselReportList[0]['carryForwardBalance'];
		$data['pumpName']				= $dieselReportList[0]['pumpName'];

		return $data;
	}
	

}
