<?php

/*****************************************************/
# AddressZone Controller             
# Class name : AddressZoneController
# Functionality: listing, add, edit, deletion of AddressZones
# Author : Sanchari Ghosh                                 
# Created Date :  20/12/2018                                
# Purpose: Developing the functionality of listing, add, edit, deletion of AddressZone
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Models\AddressZone;
use App\Models\Party;
use App\Models\Plant;
use App\Models\PetrolPump;

class AddressZoneController extends Controller {
 	
	/*****************************************************/
	# AddressZone Controller             
	# Class name : AddressZoneController
	# Functionality: constructor
	# Author : Sanchari Ghosh                                 
	# Created Date : 20/12/2018                                 
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 
		session_start();
	}
	

	/*****************************************************/
	# AddressZone Controller             
	# Function name : index
	# Functionality: view AddressZone listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 20/12/2018                                
	# Purpose:  to view AddressZone listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('addressZones.addressZoneList');
	}



	/*****************************************************/
	# AddressZone Controller             
	# Function name : getAddressZoneList
	# Functionality: get data of addressZone listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  to get data of addressZone listing page  
	# Params : Request $request                                          
	/*****************************************************/
	public function getAddressZoneList(Request $request){
		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'addressZoneTable' => config('dbtables.address_zones'),
				);

		if(isset($_SESSION["currentPageNumber"])) {
			$pageNo = $_SESSION["currentPageNumber"];
		} else {
			$pageNo = $request->currentPage;
		}
		


		/*get available records*/
		$addressZoneList = AddressZone::availableRecords($dbTables,$pageNo,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$totalAddressZones = AddressZone::totalRecords($dbTables,$request->searchKeyword);
		
		/*customizing final array*/
		$data['addressZoneList'] 	= $addressZoneList;
		$data['total']				= $totalAddressZones;
		$data['success']		    = 'true'; 
		$data['currentPage']    	= $pageNo;
		$data['pageNo'] 			= $pageNo;
		//echo '<pre>'; print_r($data);
		unset($_SESSION["currentPageNumber"]);
		return $data;
		
	}




	/*****************************************************/
	# AddressZone Controller             
	# Function name : viewAddAddressZone
	# Functionality: view add addressZone page
	# Author : Sanchari Ghosh                                 
	# Created Date : 20/12/2018                                
	# Purpose:  view add addressZone page 
	# Params :                                            
	/*****************************************************/
	public function viewAddAddressZone(){
		return view('addressZones.addForm');
	}



	/*****************************************************/
	# AddressZone Controller             
	# Function name : viewEditAddressZone
	# Functionality: view edit addressZone page
	# Author : Sanchari Ghosh                                 
	# Created Date : 20/12/2018                                
	# Purpose:  view edit addressZone page 
	# Params :                                            
	/*****************************************************/
	public function viewEditAddressZone(){

		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";        
        $currentUrlArr  = explode('/',$actual_link); 
		$data 	= array(); /*storing data for listing*/ 

		$addressZoneId = $currentUrlArr[sizeof($currentUrlArr) - 2]; 
    	$currentPageNo = $currentUrlArr[sizeof($currentUrlArr) - 1]; 

  //   	if(isset($_SESSION["currentPageNumber"])) {
		// 	$pageNo = $_SESSION["currentPageNumber"];
		// } else {
		// 	$pageNo = $currentPageNo;
		// }

		$_SESSION["currentPageNumber"] = $currentPageNo;

		/*get available records*/
		$addressZoneDetails = AddressZone::find($addressZoneId)->toArray();

		/*customizing final array*/
		$data['addressZoneDetails'] = $addressZoneDetails;
		$data['pageNo'] 			= $currentPageNo;
		$data['success'] 			= 'true';
		
		return view('addressZones.editForm',$data);	
	}




	/*****************************************************/
	# AddressZone Controller             
	# Function name : saveAddressZone
	# Functionality: save addressZone
	# Author : Sanchari Ghosh                                 
	# Created Date : 20/12/2018                                
	# Purpose:  save addressZone 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveAddressZone(Request $request){ 
		
		$data 	    = array(); /*storing data for listing*/ 
		$address    = array();
		
		if (isset($request->addressZoneId) && ($request->addressZoneId != '')) {
			$page 							= $request->currentPageNo;
			$addressZone 					= AddressZone::find($request->addressZoneId);
			$addressZone->updated_by		= \Auth::user()->id;
			$existCount = $this->nameExistsCheck('AddressZone','address',strtolower($request->addressZoneAddress),$request->addressZoneId);
			$existTitleCount = $this->nameExistsCheck('AddressZone','title',strtolower($request->title),$request->addressZoneId);
			$_SESSION["currentPageNumber"]=$page;
		} else {
			$addressZone 					= new AddressZone();
			$addressZone->created_by		= \Auth::user()->id;
			$existCount = $this->nameExistsCheck('AddressZone','address',strtolower($request->addressZoneAddress),'');
			$existTitleCount = $this->nameExistsCheck('AddressZone','title',strtolower($request->title),'');
		}


		if (($existCount > 0) || ($existTitleCount > 0)) {
			$data['success'] 		= 'false';

			if ($existCount > 0) {
				$request->session()->flash('alert-danger', 'Address already exists');
			}

			if ($existTitleCount > 0) {
				$request->session()->flash('alert-danger', 'Title already exists');
			}

			$address['addressZoneDetails'] = $request->addressZoneAddress;

			if (isset($request->addressZoneId) && ($request->addressZoneId != '')) {
				$addressZoneDetails = AddressZone::find($request->addressZoneId)->toArray();

				/*customizing final array*/
				$data['addressZoneDetails'] = $addressZoneDetails;
				$data['pageNo']				= $request->currentPageNo;
				return view('addressZones.editForm',$data);
			} else {
				return view('addressZones.addForm',$address);	
			}
		} else {

	    	$addressZone->latitude 		= $request->latitude;
	    	$addressZone->longitude 	= $request->longitude;
	    	$addressZone->address 		= $request->addressZoneAddress;
	    	$addressZone->title 		= $request->title;
	    	
	    	
	    	$addressZone->save();

	 		$data['success'] 		= 'true';

	 		if (isset($request->addressZoneId) && ($request->addressZoneId != '')) {
				$request->session()->flash('alert-success', 'Address Zone Edited Successfully');
			} else {
				$request->session()->flash('alert-success', 'Address Zone Added Successfully');
			}
        	return \Redirect::route('addressZones');
        }
	}



	/*****************************************************/
	# AddressZone Controller             
	# Function name : saveAddressZoneModal
	# Functionality: save addressZone from modal window
	# Author : Sanchari Ghosh                                 
	# Created Date : 11/03/2019                                
	# Purpose:  save addressZone from modal window
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveModalAddressZone(Request $request){ 
		
		$data 	    = array(); /*storing data for listing*/ 
		$address    = array();
		
		$existCount = $this->nameExistsCheck('AddressZone','address',strtolower($request->address),'');
		$existTitleCount = $this->nameExistsCheck('AddressZone','title',strtolower($request->title),'');


		if (($existCount > 0) || ($existTitleCount > 0)) {
			$data['success'] 		= 'false';

			if ($existCount > 0) {
				$data['msg'] 		= 'Address already exists';
			}

			if ($existTitleCount > 0) {
				$data['msg'] 		= 'Title already exists';
			}

			$data['success'] 	= 'false';
		} else {

	    	$address = $request->address; 
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

			     //$lat = '11.11';
			     //$lng = '11.11';

				$addressZone 				= new AddressZone();
				$addressZone->created_by	= \Auth::user()->id;
				$addressZone->latitude 		= $lat;
		    	$addressZone->longitude 	= $lng;
		    	$addressZone->address 		= $request->address;
	    		$addressZone->title 		= $request->title;
		    	$addressZone->save();

		    	$lastInsertedId = $addressZone->id;
  				
  				$data['lastInsertedId'] = $lastInsertedId;
		    	$data['success'] 		= 'true';
	 			$data['msg'] 			= 'Address Zone Added Successfully';
	    	} else {
	    		$data['msg']   		=  'Please provide proper address' ;
	    		$data['success'] 	= 'false';
	    	}	    	
        }
        return $data;
	}



	/*****************************************************/
	# AddressZone Controller             
	# Function name : deleteAddressZone
	# Functionality: delete addressZone
	# Author : Sanchari Ghosh                                 
	# Created Date : 09/01/2019                                
	# Purpose:  delete addressZone 
	# Params :  Request $request                                          
	/*****************************************************/
	public function deleteAddressZone(Request $request){
		$data 		= array(); /*storing data for listing*/ 

		/*check existance of party under the address zone*/
		$partyDetails = Party::where('address_zone_id',$request->addressZoneId)->count();

		/*check existance of plant under the address zone*/
		$plantDetails = Plant::where('address_zone_id',$request->addressZoneId)->count();

		/*check existance of petrol pump under the address zone*/
		$petrolPumpDetails = PetrolPump::where('address_zone_id',$request->addressZoneId)->count();


		if(is_numeric($request->addressZoneId)) {
			if (($partyDetails > 0) || ($plantDetails > 0) || ($petrolPumpDetails > 0)) {
				$data['count'] 		= $partyDetails.'----'.$plantDetails.'----'.$petrolPumpDetails;
				$data['success']	= 'false'; 
			} else {
				/*delete data*/
				$addressZone = AddressZone::find($request->addressZoneId);
				$addressZone->deleted_by = \Auth::user()->id;/*logged in user id*/
				$addressZone->status     = 'D';
				$addressZone->is_deleted = 'Y';
				$addressZone->save();

				/*soft delete the record*/
				$addressZone->delete();

				$data['success']		= 'true'; 
			}
		} else {
			$data['success']		= 'not_numeric'; 
		}

		return $data;
	}



	/*****************************************************/
	# AddressZone Controller             
	# Function name : getAddressZoneList
	# Functionality: get AddressZoneList for other modules
	# Author : Sanchari Ghosh                                 
	# Created Date : 31/12/2018                                
	# Purpose:  get AddressZoneList for other modules
	# Params :                                           
	/*****************************************************/
	public function getAddressZoneListing(){
		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'addressZoneTable' => config('dbtables.address_zones'),
				);

		/*get available records*/
		$addressZoneList = AddressZone::getAddressZoneListing($dbTables);
		
		/*customizing final array*/
		$data['addressZoneList'] 	= $addressZoneList;
		$data['success']		    = 'true'; 

		return $data;
	}
	

}
