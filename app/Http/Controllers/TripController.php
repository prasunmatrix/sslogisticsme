<?php

/*****************************************************/
# Trip Controller             
# Class name : TripController
# Functionality: listing, add, edit, view of trips,generating reports
# Author : Sanchari Ghosh                                 
# Created Date :  31/08/2018                                
# Purpose: Developing the functionality of listing, add, edit, view of trips, generating reports
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Models\Trip;
use App\Models\Country;
use App\Models\City;
use App\Models\Plant;
use App\Models\Party;
use App\Models\PlantJournalLaser;
use App\Models\PetrolPumpJournalLaser;
use App\Models\Truck;
use App\Models\PlantJournalLaserEditRequest;
use App\Models\PetrolPumpJournalLaserEditRequest;
use App\Models\Subcategory;
use App\Models\Vendor;
use App\Models\PlantUserRelation;
use App\Models\TripPOD;
use App\Models\AddressZone;
use App\Models\TripPaymentManagement;
use App\Models\TripBill;
use App\User;
use App;

//use Dompdf\Dompdf;
use PDF;
use PDFTC;


class TripController extends Controller {
 
	/*****************************************************/
	# Trip Controller             
	# Class name : TripController
	# Functionality: constructor
	# Author : Sanchari Ghosh                                 
	# Created Date : 31/08/2018                                 
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}
	

	/*****************************************************/
	# Trip Controller             
	# Function name : index
	# Functionality: view trip listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 31/08/2018                                
	# Purpose:  to view trip listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('trips.tripList');
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : getTripList
	# Functionality: get data of trip listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 31/08/2018                                
	# Purpose:  to get data of trip listing page  
	# Params :   Request $request                                        
	/*****************************************************/
	public function getTripList(Request $request){
		
		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'tripTable' 				      => config('dbtables.trips'),
					'plantTable' 				      => config('dbtables.plants'),
					'partyTable' 				      => config('dbtables.parties'),
					'truckTable' 				      => config('dbtables.trucks'),
					'petrolPumpTable' 				  => config('dbtables.petrol_pumps'),
					'petrolPumpJournalLaserEditTable' => config('dbtables.plant_journal_lasers_edit_requests'),
					'petrolPumpJournalLaserEditTable' => config('dbtables.petrol_pump_journal_lasers_edit_requests'),
					'plantUserRelationTable'		  => config('dbtables.plant_user_relations'),
					'tripPODTable'					  => config('dbtables.trip_POD'),
					'userTable' 					  => config('dbtables.users'),	
					'vendorTable'					  => config('dbtables.vendors'),
				);


		/*get available records*/
		$tripList = Trip::availableRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$totalTrips = Trip::totalRecords($dbTables,$request->searchKeyword);


		/*customizing final array*/
		$data['tripList'] 		= $tripList;
		$data['totalTrips'] 	= $totalTrips;
		$data['success']		= 'true';
		$data['currentPage']    = $request->currentPage;

		return $data;
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : viewRecord
	# Functionality: view trip details page
	# Author : Sanchari Ghosh                                 
	# Created Date : 31/08/2018                                
	# Purpose:  to view trip details page  
	# Params :                                           
	/*****************************************************/
	public function viewRecord(){
		return view('trips.tripView');
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : getTripDetails
	# Functionality: get details of a particular trip
	# Author : Sanchari Ghosh                                 
	# Created Date : 31/08/2018                                
	# Purpose:  to get details of particular trip
	# Params : Request $request                                          
	/*****************************************************/
	public function getTripDetails(Request $request){
		$userIdDetails = array();
		$supervisorNames = '';


		/*get trip id*/
		$tripId = $request->tripId;
		$subcatName = ''; /*storing sub category name*/

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'tripTable' 				=> config('dbtables.trips'),
					'plantTable' 				=> config('dbtables.plants'),
					'partyTable' 				=> config('dbtables.parties'),
					'truckTable' 				=> config('dbtables.trucks'),
					'truckRegistrationTable'	=> config('dbtables.truck_registrations'),
					'petrolPumpTable' 			=> config('dbtables.petrol_pumps'),
					'userTable' 				=> config('dbtables.users'),
					'categoryTable'				=> config('dbtables.categories'),
					'addressZoneTable' 			=> config('dbtables.address_zones'),
					'plantUserRelations'      	=> config('dbtables.plant_user_relations'),
					'vendorTable'				=> config('dbtables.vendors'),
					'tripPODTable'				=> config('dbtables.trip_POD')	
				);

		/*get available records*/
		$tripDetails = Trip::getTripDetails($dbTables,$tripId);


		/*get last POD uploaded*/
		$podDetails = TripPOD::select($dbTables['tripPODTable'].'.pod_file',$dbTables['tripPODTable'].'.status AS pod_file_status')
					  ->where($dbTables['tripPODTable'].'.trip_id',$tripDetails[0]['id'])	
					  ->orderBy($dbTables['tripPODTable'].'.id','DESC')
					  ->first();

		if (isset($podDetails['pod_file'])) {
			$tripDetails[0]['pod_file'] 		= $podDetails['pod_file'];
			$tripDetails[0]['pod_file_status'] 	= '('.$podDetails['pod_file_status'].')';
		}else {
			$tripDetails[0]['pod_file'] 		= '';
			$tripDetails[0]['pod_file_status'] 	= '';
		}			  
				  

		/*get company name*/
		$companyDetails = Vendor::select($dbTables['vendorTable'].'.name')
						  ->where($dbTables['vendorTable'].'.id',$tripDetails[0]['vendor_id'])	
						  ->get()->toArray();
		$tripDetails[0]['company_name'] = $companyDetails[0]['name'];							  

		/*get plant address details*/
		$plantDetails = Plant::select($dbTables['plantTable'].'.address_zone_id',$dbTables['addressZoneTable'].'.address')
						->join($dbTables['addressZoneTable'], $dbTables['plantTable'].'.address_zone_id', '=', $dbTables['addressZoneTable'].'.id')
						->where($dbTables['plantTable'].'.id',$tripDetails[0]['plant_id'])
						->get()->toArray();
		
		$tripDetails[0]['start_location'] = $plantDetails[0]['address'];						


		/*get party destination details*/
		$partyDetails = Party::select($dbTables['partyTable'].'.address_zone_id',$dbTables['addressZoneTable'].'.address')
						->join($dbTables['addressZoneTable'], $dbTables['partyTable'].'.address_zone_id', '=', $dbTables['addressZoneTable'].'.id')
						->where($dbTables['partyTable'].'.id',$tripDetails[0]['party_id'])
						->get()->toArray();
		
		$tripDetails[0]['end_location'] = $partyDetails[0]['address'];		


		/*get supervisor name*/
		$plantUserData 	= PlantUserRelation::where('plant_id',$tripDetails[0]['plant_id'])->get()->toArray();
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
		$tripDetails[0]['user_name'] = $supervisorNames;				


		/*get subcategory details*/
		$subCatIdArray = explode(',', $tripDetails[0]['subcategory_id']);
		$subCatDetails = Subcategory::select('item_name')->whereIn('id',$subCatIdArray)->get()->toArray(); 
		for ($i=0; $i<sizeof($subCatDetails); $i++) {
			if ($i == (sizeof($subCatDetails)-1)) {
				$subcatName .= $subCatDetails[$i]['item_name'];
			} else {
				$subcatName .= $subCatDetails[$i]['item_name'].', ';
			}
		}

		/*get trip payment details*/
		$tripPaymentDetails = TripPaymentManagement::where('trip_id',$tripId)->get()->toArray();

		/*customizing final array*/
		$data['subCatDetails']  = $subcatName;
		$data['tripDetails'] 	= $tripDetails[0];
		$data['tripPayment']	= count($tripPaymentDetails) > 0 ? $tripPaymentDetails[0] : '';
		$data['success']		= 'true'; 

		return $data;
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : viewAddTrip
	# Functionality: view add trip page
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/08/2018                                
	# Purpose:  view add trip page 
	# Params :                                            
	/*****************************************************/
	public function viewAddTrip(){
		return view('trips.addForm');
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : viewEditTrip
	# Functionality: view edit trip page
	# Author : Sanchari Ghosh                                 
	# Created Date : 05/09/2018                                
	# Purpose:  view edit trip page 
	# Params :                                            
	/*****************************************************/
	public function viewEditTrip(){
		return view('trips.editForm');
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : getEditTrip
	# Functionality: get edit trip page
	# Author : Sanchari Ghosh                                 
	# Created Date : 05/09/2018                                
	# Purpose:  get edit trip page 
	# Params :  Request $request                                          
	/*****************************************************/
	public function getEditTrip(Request $request){ 
		$data 	= array(); /*storing data for listing*/ 

		/*get id*/
		$tripId = $request->tripId;

		/*get available records*/
		$tripDetails = Trip::find($tripId); 

		/*get ADV edit request details*/
		$plantJournalLaserEditRequestCount = PlantJournalLaserEditRequest::where('trip_id',$request->tripId)->where('status','A')->where('request_by',\Auth::user()->id)->where('approval_status','Approved')->count();

		/*get DSL edit request details*/
		$petrolPumpJournalLaserEditRequestCount = PetrolPumpJournalLaserEditRequest::where('trip_id',$request->tripId)->where('status','A')->where('request_by',\Auth::user()->id)->where('approval_status','Approved')->count();

		/*find vendor*/
		$vendorDetails = Vendor::select('name')->where('id',$tripDetails->vendor_id)->get();

		/*customizing final array*/
		$data['tripDetails'] 		= $tripDetails;
		$data['ADVeditReqCount']    = $plantJournalLaserEditRequestCount;
		$data['DSLeditReqCount']    = $petrolPumpJournalLaserEditRequestCount;
		$data['success'] 			= 'true';
		$data['vendorList']			= $vendorDetails[0]['name'];
		$data['loggedInUserRole']   = \Auth::user()->user_role_id;
		$data['supervisorRoleId']   = \Config::get('constants.supervisorRoleId');


		return $data;
	}



	/*****************************************************/
	# Trip Controller             
	# Function name : getTruckOwner
	# Functionality: get truck owner name on the basis of truck id
	# Author : Sanchari Ghosh                                 
	# Created Date : 04/09/2018                                
	# Purpose:  get truck owner name on the basis of truck id 
	# Params :  Request $request                                          
	/*****************************************************/
	public function getTruckOwner(Request $request){
		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$details = Vendor::select('contact_person')->where('name',$request->vendorId)->get();

		/*customizing final array*/
		$data['ownerName'] 		= $details[0]['contact_person'];
		$data['success'] 		= 'true';

		return $data;
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : saveTrip
	# Functionality: save trip
	# Author : Sanchari Ghosh                                 
	# Created Date : 04/09/2018                                
	# Purpose:  save trip 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveTrip(Request $request){

		$data 			    = array(); /*storing data for listing*/ 
		
		if (isset($request->tripId) && ($request->tripId != '')) { /*for Edit*/
			$trip 								= Trip::find($request->tripId);
			$trip->trip_status					= $request->trip_status;
			$trip->updated_by					= \Auth::user()->id;

			$plantJournalLaserDetails			= PlantJournalLaser::where('trip_id',$request->tripId)->get()->toArray();
			$plantJournalLaser 					= PlantJournalLaser::find($plantJournalLaserDetails[0]['id']);
			$plantJournalLaser->updated_by		= \Auth::user()->id;

			$petrolPumpJournalLaserDetails		= PetrolPumpJournalLaser::where('trip_id',$request->tripId)->get()->toArray();
			$petrolPumpJournalLaser 			= PetrolPumpJournalLaser::find($petrolPumpJournalLaserDetails[0]['id']);
			$petrolPumpJournalLaser->updated_by	= \Auth::user()->id;



			/*Update Edit Request for Plant Journal Laser status if any*/
			$plantJournalLaserEditRequestCount = PlantJournalLaserEditRequest::where('trip_id',$request->tripId)->where('request_by',\Auth::user()->id)->where('status','A')->count();

			/*Inactive Previous Edit Request for Plant Journal Laser*/
			if ($plantJournalLaserEditRequestCount > 0) {
				PlantJournalLaserEditRequest::where('trip_id',$request->tripId)->where('request_by',\Auth::user()->id)->where('status','A')->update(array('updated_by' => \Auth::user()->id, 'status'=>'I')); 
			}


			/*Update Edit Request for Petrol Pump Journal Laser status if any*/			
			$petrolPumpJournalLaserEditRequestCount = PetrolPumpJournalLaserEditRequest::where('trip_id',$request->tripId)->where('request_by',\Auth::user()->id)->where('status','A')->count();

			/*Inactive Previous Request for Petrol Pump Journal Laser*/
			if ($petrolPumpJournalLaserEditRequestCount > 0) {
				PetrolPumpJournalLaserEditRequest::where('trip_id',$request->tripId)->where('request_by',\Auth::user()->id)->where('status','A')->update(array('updated_by' => \Auth::user()->id, 'status'=>'I')); 
			}

		} else { /*for Add*/
			$trip 								= new Trip();
			$trip->trip_status					= 'Running';
			$trip->created_by					= \Auth::user()->id;

			$plantJournalLaser 					= new PlantJournalLaser();
			$plantJournalLaser->created_by		= \Auth::user()->id;

			$petrolPumpJournalLaser 			= new PetrolPumpJournalLaser();
			$petrolPumpJournalLaser->created_by	= \Auth::user()->id;
		}

	
	  /*=============================== Add data in "trips" table ============================ */

	    /*find id of vendor*/
		$vendorIdDetails = Vendor::select('id')->where('name',$request->company)->get();

		$trip->trip_type					= $request->tripType;
    	$trip->status 						= $request->status;
    	$trip->trip_date        			= date(\Config::get('constants.onlyDateFormat'),strtotime($request->trip_date)).' '.date('H:i:s');
    	$trip->lr_no        				= urlencode($request->lr_no);
    	$trip->category_id        			= $request->category_id;
    	$trip->subcategory_id        		= $request->subcategory_id;
    	$trip->plant_id        				= $request->plant_id;
    	$trip->invoice_challan_no        	= urlencode($request->invoice_challan_no);
    	$trip->do_shipment_no        		= urlencode($request->do_shipment_no);
    	$trip->party_id        				= $request->party_id;
    	$trip->vendor_id        			= $vendorIdDetails[0]['id'];
    	$trip->truck_id        				= $request->truck_id;
    	$trip->quantity        				= $request->quantity;
    	$trip->truck_owner        			= ($request->truck_owner == 'undefined' || $request->truck_owner == 'null') ? NULL : strtoupper($request->truck_owner);
    	$trip->truck_driver_name   			= ((isset($request->truck_driver_name) && !empty($request->truck_driver_name)) && $request->truck_driver_name != 'null') ? $request->truck_driver_name : NULL;
    	$trip->truck_driver_phone_number	= ((isset($request->truck_driver_phone_number) && !empty($request->truck_driver_phone_number)) && $request->truck_driver_phone_number != 'null') ? $request->truck_driver_phone_number : NULL;
    	$trip->truck_driver_email			= ((isset($request->truck_driver_email) && !empty($request->truck_driver_email)) && $request->truck_driver_email != 'null') ? $request->truck_driver_email : NULL;
    	$trip->petrol_pump_id				= $request->petrol_pump_id;
    	$trip->advance_amount				= $request->advance_amount;
    	$trip->diesel_amount				= $request->diesel_amount;
    	$trip->description					= $request->description;
    	$trip->additional1					= ((isset($request->additional1) && !empty($request->additional1)) && $request->additional1 != 'null') ? $request->additional1 : NULL;
    	$trip->additional2					= ((isset($request->additional2) && !empty($request->additional2)) && $request->additional2 != 'null') ? $request->additional2 : NULL;
    	$trip->additional3					= ((isset($request->additional3) && !empty($request->additional3)) && $request->additional3 != 'null') ? $request->additional3 : NULL;
    	//$trip->GPS_trip_status				= $request->GPS_trip_status;
    	$trip->status 					    = 'A';

    	$trip->save(); /*save trip in trip table*/
    	$lastInsertedId = $trip->id;

      /*================================== Add data in "trips" table ============================== */


       /*get vendor details in case of truck driver name unavailability*/
       $vendorDetails = Vendor::find($vendorIdDetails[0]['id']);


      /*============================= Add data in "plant_journal_lasers" table ===================== */
		$plantJournalLaser->plant_id 		 = $request->plant_id;
		$plantJournalLaser->type    		 = 'D';
    	$plantJournalLaser->trip_id 		 = $lastInsertedId;
		$plantJournalLaser->amount 	 		 = $request->advance_amount;
		$plantJournalLaser->truck_id 		 = $request->truck_id;

		if((isset($request->truck_driver_name) && !empty($request->truck_driver_name)) && $request->truck_driver_name != 'null') {
			$plantJournalLaser->description 	 = 'Advance Amount paid to Driver named '.$request->truck_driver_name;
		} else {
			$plantJournalLaser->description 	 = 'Advance Amount paid to Vendor named '.$vendorDetails->name;
		}
		
		$plantJournalLaser->entry_type  	 = 'A';
		$plantJournalLaser->approval_status  = 'Approved';
		$plantJournalLaser->entry_by    	 = \Auth::user()->id;
		$plantJournalLaser->status      	 = $trip->status;
		$plantJournalLaser->save();
      /*============================== Add data in "plant_journal_lasers" table ======================= */




      /*======================== Add data in "petrol_pump_journal_lasers" table ======================= */
    	$petrolPumpJournalLaser->petrol_pump_id = $request->petrol_pump_id;
    	$petrolPumpJournalLaser->truck_id 	 	= $request->truck_id;
		$petrolPumpJournalLaser->type    	 	= 'D';
    	$petrolPumpJournalLaser->trip_id 	 	= $lastInsertedId;
		$petrolPumpJournalLaser->amount 	 	= $request->diesel_amount;

		if((isset($request->truck_driver_name) && !empty($request->truck_driver_name)) && $request->truck_driver_name != 'null') {
			$petrolPumpJournalLaser->description = 'Diesel Amount paid to Drive named '.$request->truck_driver_name;
		} else {
			$petrolPumpJournalLaser->description = 'Diesel Amount paid to Vendor named '.$vendorDetails->name;
		}
		$petrolPumpJournalLaser->entry_by    	= \Auth::user()->id;
		$petrolPumpJournalLaser->status      	= $trip->status;
		$petrolPumpJournalLaser->save();
      /*======================== Add data in "petrol_pump_journal_lasers" table ======================= */




      /*=================================== Edit Balance amount of Plant ===============================*/
      	$plant 					= Plant::find($request->plant_id);
      	$balanceAmount 			= ($request->advance_amount) - ($plant->balance_amount);
      	$plant->balance_amount 	= $balanceAmount;
      	$plant->save();
      /*=================================== Edit Balance amount of Plant ===============================*/


    	//$data['plantAddressDetails'] = $plantAddressDetails;
 		$data['success'] 			 = 'true';
 		$data['lr_no']				 = urlencode($request->lr_no);

 		if (isset($request->tripId) && ($request->tripId != '')) {
			$request->session()->flash('alert-success', 'Trip Edited Successfully');
		} else {
			$request->session()->flash('alert-success', 'Trip Added Successfully');
		}
	
 		
        return $data;
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : uploadPODFile
	# Functionality: Upload POD File for trip
	# Author : Sanchari Ghosh                                 
	# Created Date : 04/09/2018                                
	# Purpose:  Upload POD File for trip
	# Params :  Request $request                                          
	/*****************************************************/
	public function uploadPODFile(Request $request){
		$target_dir  	= public_path().'/'.\Config::get('constants.tripPODPath');		
		$fileExtension  = explode('.', $_FILES["file"]["name"]);
		$fileName 		= 'pod_'.time().'.'.$fileExtension[count($fileExtension) - 1];
	    $target_file 	= $target_dir . $fileName ;
	    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
	    return $fileName; 
	}



	/*****************************************************/
	# Trip Controller             
	# Function name : savePOD
	# Functionality: save POD File for trip
	# Author : Sanchari Ghosh                                 
	# Created Date : 04/09/2018                                
	# Purpose:  save POD File for trip
	# Params :  Request $request                                          
	/*****************************************************/
	public function savePOD(Request $request){

		/*save info in Trip table*/
		$trip = Trip::find($request->tripId);
		$trip->POD_status 		= 'Yes';
		$trip->POD_uploaded_by  = \Auth::user()->id;
		$trip->POD_uploaded_at	= date('Y-m-d H:i:s'); 
		$trip->updated_at 		= date('Y-m-d H:i:s');
		$trip->updated_by 		= \Auth::user()->id;
		$trip->save();

		/*save info in trip_POD table*/
		$tripPOD = new TripPOD();
		$tripPOD->trip_id = $request->tripId;
		$tripPOD->pod_file = $request->pod_file;
		$tripPOD->save();

		$data['success']  = 'true'; 
		$request->session()->flash('alert-success', 'POD Uploaded Successfully');
		return $data;
	}
	


	/*****************************************************/
	# Trip Controller             
	# Function name : ADVEditRequest
	# Functionality: Edit Request for Advance Amount
	# Author : Sanchari Ghosh                                 
	# Created Date : 05/09/2018                                
	# Purpose:  Send Edit Request for Advance Amount
	# Params :  Request $request                                          
	/*****************************************************/
	public function ADVEditRequest(Request $request){
		$tripDetails = Trip::find($request->tripId); /*get trip details*/

		/*check for any existing data*/
		$plantJournalLaserEditRequestCount = PlantJournalLaserEditRequest::where('trip_id',$request->tripId)->count();

		/*Inactive Previous Request*/
		if ($plantJournalLaserEditRequestCount > 0) {
			PlantJournalLaserEditRequest::where('trip_id',$request->tripId)->update(array('updated_by' => \Auth::user()->id, 'status'=>'I')); 
		}

		/*get plant journal laser id*/
		$plantJournalLaser = PlantJournalLaser::select('id')->where('trip_id',$request->tripId)->get()->toArray();

		$plantJournalLaserEditRequest 							= new PlantJournalLaserEditRequest();
		$plantJournalLaserEditRequest->plant_id 				= $tripDetails->plant_id;
		$plantJournalLaserEditRequest->trip_id 					= $request->tripId;
		$plantJournalLaserEditRequest->plant_journal_laser_id 	= $plantJournalLaser[0]['id'];
		$plantJournalLaserEditRequest->truck_id 				= $tripDetails->truck_id;
		$plantJournalLaserEditRequest->request_by 				= \Auth::user()->id;
		$plantJournalLaserEditRequest->created_by 				= \Auth::user()->id;
		$plantJournalLaserEditRequest->requested_amount  		= $request->advanceAmount;
		$plantJournalLaserEditRequest->actual_amount  			= $tripDetails->advance_amount;
		$plantJournalLaserEditRequest->save();

		$data['success']  = 'true'; 
		$request->session()->flash('alert-success', 'Edit Requset sent Successfully');
		return $data;
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : DSLEditRequest
	# Functionality: Edit Request for Diesel Amount
	# Author : Sanchari Ghosh                                 
	# Created Date : 05/09/2018                                
	# Purpose:  Send Edit Request for Diesel Amount
	# Params :  Request $request                                          
	/*****************************************************/
	public function DSLEditRequest(Request $request){
		$tripDetails = Trip::find($request->tripId); /*get trip details*/

		/*check for any existing data*/
		$petrolPumpJournalLaserEditRequestCount = PetrolPumpJournalLaserEditRequest::where('trip_id',$request->tripId)->count();

		/*Inactive Previous Request*/
		if ($petrolPumpJournalLaserEditRequestCount > 0) {
			PetrolPumpJournalLaserEditRequest::where('trip_id',$request->tripId)->update(array('updated_by' => \Auth::user()->id, 'status'=>'I')); 
		}

		/*get petrol pump journal laser id*/
		$petrolPumpJournalLaser = PetrolPumpJournalLaser::select('id')->where('trip_id',$request->tripId)->get()->toArray();

		$petrolPumpJournalLaserEditRequest 						= new PetrolPumpJournalLaserEditRequest();
		$petrolPumpJournalLaserEditRequest->petrol_pump_id 		= $tripDetails->petrol_pump_id;
		$petrolPumpJournalLaserEditRequest->trip_id 			= $request->tripId;
		$petrolPumpJournalLaserEditRequest->petrol_pump_journal_laser_id 	= $petrolPumpJournalLaser[0]['id'];
		$petrolPumpJournalLaserEditRequest->truck_id 			= $tripDetails->truck_id;
		$petrolPumpJournalLaserEditRequest->request_by 			= \Auth::user()->id;
		$petrolPumpJournalLaserEditRequest->created_by 			= \Auth::user()->id;
		$petrolPumpJournalLaserEditRequest->requested_amount  	= $request->dslAmount;
		$petrolPumpJournalLaserEditRequest->actual_amount  		= $tripDetails->diesel_amount;
		$petrolPumpJournalLaserEditRequest->save();

		$data['success']  = 'true'; 
		$request->session()->flash('alert-success', 'Edit Requset sent Successfully');
		return $data;
	}



	/*****************************************************/
	# Trip Controller             
	# Function name : closeTrip
	# Functionality: Closing a Trip
	# Author : Sanchari Ghosh                                 
	# Created Date : 12/09/2018                                
	# Purpose:  Closing a Trip
	# Params :  Request $request                                          
	/*****************************************************/
	public function closeTrip(Request $request){
		$tripDetails = Trip::find($request->tripId); /*get trip details*/

		Trip::where('id',$request->tripId)->update(array('updated_by' => \Auth::user()->id, 'trip_status'=>'Completed','GPS_trip_status' => 'End','closed_by' => \Auth::user()->id,'closing_reason' => $request->closingReason, 'closed_at' => date('Y-m-d H:i:s'))); 

		$data['success']  = 'true'; 
		$request->session()->flash('alert-success', 'Trip Closed Successfully');
		return $data;
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : pdfTrip
	# Functionality: download pdf for Trip
	# Author : Sanchari Ghosh                                 
	# Created Date : 26/09/2018                                
	# Purpose:  downloading pdf for Trip
	# Params :                                          
	/*****************************************************/
	public function pdfTrip() {
		return view('trips.tripPDF');
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : getPlantWiseTripList
	# Functionality: get plant wise trip list
	# Author : Sanchari Ghosh                                 
	# Created Date : 26/09/2018                                
	# Purpose:  getting plant wise trip list
	# Params : Request $request                                         
	/*****************************************************/
	public function getPlantWiseTripList(Request $request) {
		$data 	= array(); /*storing data for listing*/ 
		$record = array();

		/*defining db tables for joining*/
		$dbTables = array(
					'tripTable' 			=> config('dbtables.trips'),
					'plantTable' 			=> config('dbtables.plants'),
					'partyTable' 			=> config('dbtables.parties'),
					'truckTable' 			=> config('dbtables.trucks'),
					'petrolPumpTable' 		=> config('dbtables.petrol_pumps'),
					'categoryTable'			=> config('dbtables.categories'),
					'addressZoneTable'		=> config('dbtables.address_zones'),
					'tripPaymentTable'      => config('dbtables.trip_payment_managements'),
				);

		/*get available records*/
		$tripList = Trip::plantWiseTripRecords($dbTables,$request->plantId);

		/*Customizing final record*/
		for ($i=0; $i<sizeof($tripList); $i++){

			/*get plant address details*/
			$plantAddressDetails =  AddressZone::select('address')->where($dbTables['addressZoneTable'].'.id',$tripList[$i]['plant_address'])->get()->toArray();
			$startLocation = $plantAddressDetails[0]['address'];


			/*get party destination details*/
			$partyAddressDetails =  AddressZone::select('address')->where($dbTables['addressZoneTable'].'.id',$tripList[$i]['party_address'])->get()->toArray();
			$endLocation = $partyAddressDetails[0]['address'];

			$record[$i]['name']   = 'SSLT000'.$tripList[$i]['id'].' - '.$tripList[$i]['party_name']. ' ("'.$startLocation.'" to "'.$endLocation.'") on '.date(\Config::get('constants.dateFormat'),strtotime($tripList[$i]['trip_date']));	
			$record[$i]['id'] = $tripList[$i]['id'] ;
		}


		/*customizing final array*/
		$data['tripList'] 		= $record;
		$data['success']		= 'true'; 

		return $data;
	}



	/*****************************************************/
	# Trip Controller             
	# Function name : viewSelectedSubCatDetails
	# Functionality: get details of selected subcategories
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/10/2018                                
	# Purpose:  get details of selected subcategories
	# Params : Request $request                                         
	/*****************************************************/
	public function viewSelectedSubCatDetails(Request $request) {
		$data 	= array(); /*storing data for listing*/ 
		$subCatIdArray = explode(',',$request->subCatId);/*converting subcategory ids in an array*/

		/*get available records*/
		$subcategoryList = Subcategory::select('item_name AS name','id')->where('status','A')->whereIn('id',$subCatIdArray)->get()->toArray();

		/*customizing final array*/
		$data['subcategoryList'] 	= $subcategoryList;
		$data['success'] 			= 'true';

		return $data;
	}



	/*****************************************************/
	# Trip Controller             
	# Function name : savePlantEditRequest
	# Functionality: saving Advance Amount for a trip
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/10/2018                                
	# Purpose:  saving Advance Amount for a trip
	# Params : Request $request                                         
	/*****************************************************/
	public function savePlantEditRequest(Request $request) {
		$data 								= array();
		$trip 								= Trip::find($request->tripId);
		$trip->advance_amount				= $request->advance_amount;
		$trip->updated_by					= \Auth::user()->id;
		$trip->save();

		$plantJournalLaserDetails			= PlantJournalLaser::where('trip_id',$request->tripId)->get()->toArray();
		$plantJournalLaser 					= PlantJournalLaser::find($plantJournalLaserDetails[0]['id']);
		$plantJournalLaser->amount 			= $request->advance_amount;
		$plantJournalLaser->updated_by		= \Auth::user()->id;
		$plantJournalLaser->save();


		$plantDetails						= Trip::where('plant_id',$request->plantId)->get()->toArray();
		$plant 								= Plant::find($request->plantId); 
      	$balanceAmount 						= ($request->advance_amount) - ($plant['balance_amount']);
      	$plant->balance_amount 				= $balanceAmount;
      	$plant->save();


      	/*Update Edit Request for Plant Journal Laser status if any*/
		$plantJournalLaserEditRequestCount = PlantJournalLaserEditRequest::where('trip_id',$request->tripId)->where('request_by',\Auth::user()->id)->where('status','A')->count();

		/*Inactive Previous Edit Request for Plant Journal Laser*/
		if ($plantJournalLaserEditRequestCount > 0) {
			PlantJournalLaserEditRequest::where('trip_id',$request->tripId)->where('request_by',\Auth::user()->id)->where('status','A')->update(array('updated_by' => \Auth::user()->id, 'status'=>'I')); 
		}
		
		$request->session()->flash('alert-success', 'Amount Updated Successfully');
		$data['success']		= 'true'; 

		return $data;
	}



	/*****************************************************/
	# Trip Controller             
	# Function name : savePetrolPumpEditRequest
	# Functionality: saving Diesel Amount for a trip
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/10/2018                                
	# Purpose:  saving Diesel Amount for a trip
	# Params : Request $request                                         
	/*****************************************************/
	public function savePetrolPumpEditRequest(Request $request) {
		$data 								= array();
		$trip 								= Trip::find($request->tripId);
		$trip->diesel_amount				= $request->diesel_amount;
		$trip->updated_by					= \Auth::user()->id;
		$trip->save();

		$petrolPumpJournalLaserDetails		= PetrolPumpJournalLaser::where('trip_id',$request->tripId)->get()->toArray();
		$petrolPumpJournalLaser 			= PetrolPumpJournalLaser::find($petrolPumpJournalLaserDetails[0]['id']);
		$petrolPumpJournalLaser->amount 	= $request->diesel_amount;
		$petrolPumpJournalLaser->updated_by	= \Auth::user()->id;
		$petrolPumpJournalLaser->save();


		/*Update Edit Request for Petrol Pump Journal Laser status if any*/			
		$petrolPumpJournalLaserEditRequestCount = PetrolPumpJournalLaserEditRequest::where('trip_id',$request->tripId)->where('request_by',\Auth::user()->id)->where('status','A')->count();

		/*Inactive Previous Request for Petrol Pump Journal Laser*/
		if ($petrolPumpJournalLaserEditRequestCount > 0) {
			PetrolPumpJournalLaserEditRequest::where('trip_id',$request->tripId)->where('request_by',\Auth::user()->id)->where('status','A')->update(array('updated_by' => \Auth::user()->id, 'status'=>'I')); 
		}


		$request->session()->flash('alert-success', 'Amount Updated Successfully');
		$data['success']		= 'true'; 

		return $data;
	}




	/*****************************************************/
	# Trip Controller             
	# Function name : gpsTripList
	# Functionality: view gps triplist page
	# Author : Sanchari Ghosh                                 
	# Created Date : 29/10/2018                                
	# Purpose:  to view gps triplist page  
	# Params :                                           
	/*****************************************************/
	public function gpsTripList(){
		return view('trips.gpsTripList');
	}



	/*****************************************************/
	# Trip Controller             
	# Function name : viewGPSTripList
	# Functionality: get data of trips for GPS Tracking
	# Author : Sanchari Ghosh                                 
	# Created Date : 29/10/2018                                
	# Purpose:  get data of trips for GPS Tracking
	# Params :  Request $request                                         
	/*****************************************************/
	public function viewGPSTripList(Request $request) {
		$data 				= array(); /*storing data for listing*/ 
		$truckIdDetails 	= array(); /*storing truck id*/
		$tripTruckIdDetails = array(); /*get the truck id currently availing a trip*/
		$regTruckIdDetails  = array(); /*get the truck id having registration*/
		$resultIds 			= array(); /*array of final truck ids*/

		/*get truck ids having registration number*/
		$tripList = Trip::where('trip_status','Running')->orWhere('trip_status','Awaiting')->get()->toArray();

		for ($i=0; $i<sizeof($tripList); $i++) {
			$truckDetails = Truck::select('id AS truck_id','truck_no')->where('id',$tripList[$i]['truck_id'])->get()->toArray();

			$tripList[$i]['optionData'] = 'SSLT000'.$tripList[$i]['id'].' ( '.$truckDetails[0]['truck_no'].' ) ';
		}

		/*customizing final array*/
		$data['tripList']  = $tripList;
		$data['success']   = 'true';

		return $data;
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : saveTripPod
	# Functionality: save trip status from modal
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/03/2019                                
	# Purpose:  save trip status from modal
	# Params :  Request $request                                         
	/*****************************************************/
	public function saveTripPod(Request $request) {
		
		/*save info in trip_POD table*/
		$tripPODDetails = TripPOD::where('is_active','Y')->where('trip_id',$request->tripId)->get()->toArray();

		$tripPOD = TripPOD::find($tripPODDetails[0]['id']);
		$tripPOD->status = $request->status;
		$tripPOD->updated_by = \Auth::user()->id;
		$tripPOD->reason = ((isset($request->reason) && !empty($request->reason)) && $request->reason != 'null') ? $request->reason : NULL;
		$tripPOD->save();

		/*inactive previous record*/
		TripPOD::where('trip_id',$request->tripId)->where('is_active','Y')->update(array('is_active'=>'N')); 


		/*save info in Trip table*/
		if ($tripPOD->status == 'UNSTAMPED CHALLAN' || $tripPOD->status == 'UNSTAMPED SHORT CHALLAN') {
			$trip = Trip::find($request->tripId);
			$trip->POD_status 		= 'No';
			$trip->current_challan_status = $tripPOD->status;
			$trip->POD_uploaded_by  = NULL;
			$trip->POD_uploaded_at	= NULL; 
			$trip->save();
		}

		if ($tripPOD->status == 'OK CHALLAN' || $tripPOD->status == 'STAMPED SHORT CHALLAN') {
			$trip = Trip::find($request->tripId);
			$trip->POD_status  = 'Yes';
			$trip->trip_status = 'Settled';
			$trip->updated_at = date('Y-m-d H:i:s');
			$trip->updated_by = \Auth::user()->id;
			$trip->current_challan_status = $tripPOD->status;
			$trip->save();
		}

		/*save remarks*/
		if ($tripPOD->status == 'UNSTAMPED SHORT CHALLAN' || $tripPOD->status == 'STAMPED SHORT CHALLAN') {
			$trip = Trip::find($request->tripId);
			$trip->remarks = ((isset($request->remarks) && !empty($request->remarks)) && $request->remarks != 'null') ? $request->remarks : NULL;
			$trip->bags = (isset($request->bags) && !empty($request->bags)) ? $request->bags : NULL;
			$trip->updated_at = date('Y-m-d H:i:s');
			$trip->updated_by = \Auth::user()->id;
			$trip->save();
		} else {
			$trip = Trip::find($request->tripId);
			$trip->remarks = NULL;
			$trip->bags = NULL;
			$trip->updated_at = date('Y-m-d H:i:s');
			$trip->updated_by = \Auth::user()->id;
			$trip->save();
		}
		

		$data['success']  = 'true'; 
		$request->session()->flash('alert-success', 'POD Status Changed Successfully');
		return $data;
	}



	/*****************************************************/
	# Trip Controller             
	# Function name : tripWisePOD
	# Functionality: get trip wise POD file details
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/03/2019                                
	# Purpose:  get trip wise POD file details
	# Params :  Request $request                                         
	/*****************************************************/
	public function tripWisePOD(Request $request) {
		$podFileDetails = TripPOD::where('trip_id',$request->tripId)->get()->toArray();

		/*get current pod status of a trip*/
		$latestPodDetails = TripPOD::select('status')->where('trip_id',$request->tripId)->orderBy('id','DESC')
		                    ->first();

		$data['success']  = 'true'; 
		$data['latestPODStatus'] = $latestPodDetails['status'];
		$data['podRecords']  = $podFileDetails; 

		return $data;
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : tripLatestPOD
	# Functionality: get trip's latest POD file details
	# Author : Sanchari Ghosh                                 
	# Created Date : 14/03/2019                                
	# Purpose:  get trip's latest POD file details
	# Params :  Request $request                                         
	/*****************************************************/
	public function tripLatestPOD(Request $request) {

		/*get current pod status of a trip*/
		$latestPodDetails = TripPOD::select('pod_file')->where('trip_id',$request->tripId)->orderBy('id','DESC')
		                    ->first();

		$data['success']  = 'true'; 
		$data['podFile']  = $latestPodDetails['pod_file']; 
		
		return $data;
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : tripReport
	# Functionality: view trip report page
	# Author : Sanchari Ghosh                                 
	# Created Date : 18/03/2019                                
	# Purpose:  view  trip report page
	# Params :                                         
	/*****************************************************/
	public function tripReport(){
		return view('trips.tripReport');
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : getTripReport
	# Functionality: get trip report details
	# Author : Sanchari Ghosh                                 
	# Created Date : 18/03/2019                                
	# Purpose:  get trip report details
	# Params : Request $request                                        
	/*****************************************************/
	public function getTripReport(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'tripTable' 				      => config('dbtables.trips'),
					'plantTable' 				      => config('dbtables.plants'),
					'partyTable' 				      => config('dbtables.parties'),
					'truckTable' 				      => config('dbtables.trucks'),
					'petrolPumpTable' 				  => config('dbtables.petrol_pumps'),
					'plantUserRelationTable'		  => config('dbtables.plant_user_relations'),
					'vendorTable'					  => config('dbtables.vendors'),	
					'addressZoneTable'				  => config('dbtables.address_zones'),
					'itemTable'						  => config('dbtables.subcategories'),
					'userTable' 					  => config('dbtables.users'),	
	
				);


		/*get available records*/
		$tripReportList = Trip::getTripReport($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->tripStatus,$request->timePeriod,$request->company,$request->dateRangeValue);
		$totalTripReports = Trip::totalTripReportRecords($dbTables,$request->tripStatus,$request->timePeriod,$request->company,$request->dateRangeValue);


		/*customizing final array*/
		$data['tripReportList'] 	= $tripReportList;
		$data['totalTripReports'] 	= $totalTripReports;
		$data['success']			= 'true'; 
		$data['currentPage']    	= $request->currentPage;

		return $data;
	}



	/*****************************************************/
	# Trip Controller             
	# Function name : paymentReport
	# Functionality: view payment report page
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/04/2019                                
	# Purpose:  view  payment report page
	# Params :                                         
	/*****************************************************/
	public function paymentReport(){
		return view('payments.paymentReport');
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : getPaymentReport
	# Functionality: get payment report details
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/04/2019                                
	# Purpose:  get payment report details
	# Params : Request $request                                        
	/*****************************************************/
	public function getPaymentReport(Request $request) {
		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'tripTable' 				      => config('dbtables.trips'),
					'plantTable' 				      => config('dbtables.plants'),
					'partyTable' 				      => config('dbtables.parties'),
					'truckTable' 				      => config('dbtables.trucks'),
					'petrolPumpTable' 				  => config('dbtables.petrol_pumps'),
					'plantUserRelationTable'		  => config('dbtables.plant_user_relations'),
					'vendorTable'					  => config('dbtables.vendors'),	
					'addressZoneTable'				  => config('dbtables.address_zones'),
					'itemTable'						  => config('dbtables.subcategories'),
					'tripPaymentTable'				  => config('dbtables.trip_payment_managements'),
				);


		/*get available records*/
		$paymentReportList = Trip::getPaymentReport($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->company);
		$totalPaymentReports = Trip::totalPaymentReportRecords($dbTables,$request->company);


		/*customizing final array*/
		$data['paymentReportList'] 		= $paymentReportList;
		$data['totalPaymentReports'] 	= $totalPaymentReports;
		$data['success']				= 'true'; 
		$data['currentPage']    		= $request->currentPage;
		$data['totalBalance']			= $paymentReportList[0]['totalBalance'];

		return $data;
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : deletePOD
	# Functionality: deleting POD
	# Author : Sanchari Ghosh                                 
	# Created Date : 14/05/2019                                
	# Purpose:  deleting POD
	# Params : Request $request                                        
	/*****************************************************/
	public function deletePOD(Request $request) {
		$data 	= array(); 

		$tripPOD = TripPOD::find($request->podId);
		$tripPOD->deleted_by = \Auth::user()->id;/*logged in user id*/
		$tripPOD->is_deleted = 'Y';
		$tripPOD->is_active  = 'N';
		$tripPOD->save();

		$tripId = $tripPOD->trip_id;

		$tripPOD->delete();

		if (TripPOD::where('trip_id',$tripId)->count() == 0) {
			Trip::where('id',$tripId)->update(array('POD_status' => 'No','current_challan_status'=>NULL,'POD_uploaded_by'=>NULL,'POD_uploaded_at'=>NULL,'bags'=>NULL,'remarks'=>NULL,'trip_status'=>'Unsettled','updated_at' => date('Y-m-d H:i:s'),'updated_by' => \Auth::user()->id)); 
		}
		$request->session()->flash('alert-success', 'POD Deleted Successfully');

		$data['tripId']  = $tripId;
		$data['success'] = 'true'; 
		$data['msg'] 	 = 'POD Deleted Successfully'; 

		return $data;
	}



	/*****************************************************/
	# Trip Controller             
	# Function name : getTruckWiseTripList
	# Functionality: get truck wise trip list
	# Author : Sanchari Ghosh                                 
	# Created Date : 15/05/2019                                
	# Purpose:  to get truck wise trip list
	# Params : Request $request                                        
	/*****************************************************/
	public function getTruckWiseTripList(Request $request) {
		$data 	= array(); /*storing data for listing*/ 
		$record = array();

		$startDate = date('Y-m-d', strtotime($request->start_date)); 
		$endDate = date('Y-m-d', strtotime($request->end_date)); 

		/*defining db tables for joining*/
		$dbTables = array(
					'tripTable' 			=> config('dbtables.trips'),
					'plantTable' 			=> config('dbtables.plants'),
					'partyTable' 			=> config('dbtables.parties'),
					'truckTable' 			=> config('dbtables.trucks'),
					'petrolPumpTable' 		=> config('dbtables.petrol_pumps'),
					'categoryTable'			=> config('dbtables.categories'),
					'addressZoneTable'		=> config('dbtables.address_zones'),
					'tripPaymentTable'      => config('dbtables.trip_payment_managements'),
				);

		/*get available records*/
		$tripList = Trip::truckWiseTripRecords($dbTables,$request->truckId,$startDate,$endDate);

		/*Customizing final record*/
		for ($i=0; $i<sizeof($tripList); $i++){

			/*get plant address details*/
			$plantAddressDetails =  AddressZone::select('title','address')->where($dbTables['addressZoneTable'].'.id',$tripList[$i]['plant_address'])->get()->toArray();
			$startLocation = $plantAddressDetails[0]['title'];


			/*get party destination details*/
			$partyAddressDetails =  AddressZone::select('title','address')->where($dbTables['addressZoneTable'].'.id',$tripList[$i]['party_address'])->get()->toArray();
			$endLocation = $partyAddressDetails[0]['title'];

			$record[$i]['name']   = 'SSLT000'.$tripList[$i]['id'].' - '.$tripList[$i]['party_name']. ' ("'.$startLocation.'" to "'.$endLocation.'") on '.date(\Config::get('constants.dateFormat'),strtotime($tripList[$i]['trip_date']));	
			$record[$i]['id'] = $tripList[$i]['id'] ;
		}


		/*customizing final array*/
		$data['tripList'] 		= $record;
		$data['success']		= 'true'; 

		return $data;
	}




	/*****************************************************/
	# Trip Controller             
	# Function name : tripDelete
	# Functionality: delete trip
	# Author : Sanchari Ghosh                                 
	# Created Date : 15/05/2019                                
	# Purpose:  delete trip
	# Params : Request $request                                        
	/*****************************************************/
	public function tripDelete(Request $request) {
		$data 	= array(); /*storing data for listing*/ 

		$date = strtotime(date("Y-m-d 23:59:59", strtotime("-3 day"))); /*get 3 days previous date*/

		
		/*check existance of Trip*/
		$tripDetails = Trip::where('id',$request->tripId)
						   ->where('trip_date','>=',$date)
						   ->where('trip_status','Running')
						   ->where('POD_status','No')
						   ->count();

		if(is_numeric($request->tripId)) {
			if ($tripDetails > 0) {
				$data['success']		= 'true'; 

				/*changing status of trip in trip table*/
				$trip = Trip::find($request->tripId);
				$trip->deleted_by = \Auth::user()->id;/*logged in user id*/
				$trip->status     = 'D';
				$trip->is_deleted = 'Y';
				$trip->save();

				/*pay the advance_amount in plant which was used in that trip*/
				$plantLaser 				= new PlantJournalLaser();
				$plantLaser->plant_id		= $trip->plant_id;
				$plantLaser->type			= 'C';
				$plantLaser->amount			= $trip->advance_amount;
				$plantLaser->description	= 'Returning balance as trip "SSLT000'.$request->tripId.'" has been deleted';
				$plantLaser->entry_type		= 'BG';
				$plantLaser->entry_by		= \Auth::user()->id;
				$plantLaser->status			= 'A';
				$plantLaser->approval_status= 'Approved';	
				$plantLaser->created_by		= \Auth::user()->id;
				$plantLaser->save();

				/*pay the diesel_amount in petrol pump which was used in that trip*/
				$petrolPumpJournalLaser 				= new PetrolPumpJournalLaser();
				$petrolPumpJournalLaser->petrol_pump_id	= $trip->petrol_pump_id;
				$petrolPumpJournalLaser->type			= 'C';
				$petrolPumpJournalLaser->amount			= $trip->diesel_amount;
				$petrolPumpJournalLaser->description	= 'Returning amount as trip "SSLT000'.$request->tripId.'" has been deleted';
				$petrolPumpJournalLaser->entry_by		= \Auth::user()->id;
				$petrolPumpJournalLaser->created_by		= \Auth::user()->id;
				$petrolPumpJournalLaser->save();

				/*soft delete the record*/
				$trip->delete();

			} else {
				$data['success']		= 'false'; 
			}
		} else {
			$data['success']		= 'not_numeric'; 
		}

		return $data;
	}




	/*****************************************************/
	# Trip Controller             
	# Function name : getTcPdf
	# Functionality: generate trip pdf using tcpdf
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/06/2019                                
	# Purpose:  generate trip pdf using tcpdf
	# Params : Request $request                                        
	/*****************************************************/
	public function getTcPdf_13_08_2019(Request $request){
		$data = array();
		
		$fileName 		   = $request->fileName; /*unique file name*/
		
		$record = $this->getTripDetails($request); /*get the details to be printed*/

		$noOfBags = $record['tripDetails']['quantity']*20;
		$advanceAmountInWords = $this->getNumberToWords($record['tripDetails']['advance_amount']);

		$LogoImageFileName = env('DOMAIN_NAME').'/images/pdf_logo.jpg'; 
		PDFTC::SetTitle('Trip Data');
	    PDFTC::AddPage();
		
		$originalHtmlData = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>SSLogistics</title>
		</head>

		<body style="margin:0; padding:0;" id="pdfOriginalDataHolder">
		<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
		  <tr>
		    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
		    	<table width="100%" border="0" cellpadding="0">
		  			<tr>
		    			<td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:10px 5px 5px 5px;"><img style="width:45px;" src="'.$LogoImageFileName.'" alt="SSLogistics" /></td>
		    			<td width="75%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">
								<table width="100%" border="0">
									<tr>
										<td width="100%" style="font-family: Arial, Helvetica, sans-serif; font-size:10px;line-height:14px; color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
									</tr>
									<tr>
										<td width="100%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px;line-height:9px; color:#000; text-align:center; padding:3px 0;">11/5/1 Cossipore Road, Kolkata, West Bengal - 700002<br />
												Phone: +91 9007759038, +91 98365 82274, Email- info@sslogistics.org<br />
											GSTIN: 19ACFFS8681L1Z8<br />
											<strong><u>Consignment Note</u></strong>
										</td>
										</tr>
								</table>		    
		    				</td>
								<td width="10%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px;line-height:12px; color:#000; padding:3px; text-align:right;">
									Original
								</td>
		  			</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:1px;">&nbsp;</td>
							<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px; text-align:center;">&nbsp;</td>
							<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px; text-align:right;">&nbsp;</td>
						</tr>
		      </table>
					<table width="100%" border="0">
						<tr>
							<td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">LR No.:</td>
							<td width="25%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['lr_no'].'</td>
							<td width="5%" align="left" valign="top">&nbsp;</td>
							<td width="12%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">FROM:</td>
							<td width="33%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['start_location'].'</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">DATE:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.date_format(date_create($record['tripDetails']['trip_date']),'d-m-Y :: H:i:s a').'</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">TO:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['end_location'].'</td>
						</tr>
					</table>
					<table width="100%" border="0">
						<tr>
							<td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">Consignor M/S:</td>
							<td width="25%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['plant_description'].'</td>
							<td width="5%" align="left" valign="top">&nbsp;</td>
							<td width="12%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">TRUCK:</td>
							<td width="33%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['truck_no'].'</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">Consignee M/S:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">'.$record['tripDetails']['party_name'].'</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">Trip No:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">SSLT000'.$record['tripDetails']['id'].'</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:1px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:1px 5px;">&nbsp;</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:1px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:1px 5px;">&nbsp;</td>
						</tr>
						
					</table>
				<table width="100%" border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
					<tr width="100%">
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000; border-left:none;">No of Bags</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">WT</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">DESCRIPTION</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">RATE</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">DIESEL</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000; border-right:none;">ADVANCE</td>
					</tr>
					<tr  width="100%">
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000; border-left:none;">'.$noOfBags.'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">'.$record['tripDetails']['quantity'].'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">'.$record['tripDetails']['category_name'].' - '.$record['subCatDetails'].'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">'.(($record['tripPayment'] !== '') ? $record['tripPayment']['rate'] : '' ).'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">'.$record['tripDetails']['diesel_amount'].'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000;border:1px solid #000; border-right:none;">'.$record['tripDetails']['advance_amount'].'</td>
						</tr>
				</table>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" >
					
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
					</tr>
						
					<tr>
						<td width="30%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">INVOICE NO:</td>
						<td width="70%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['invoice_challan_no'].'</td>
						</tr>
					<tr>
						<td width="30%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">SHIPMENT/DELIVERY NO:</td>
						<td width="70%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['do_shipment_no'].'</td>
						</tr>
						<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
					</tr>
				</table>


				<table width="100%" border="0">
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">Received above material in Good Condition</td>
					</tr>
					<tr>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
					</tr>
		  </table>
				<table width="100%" border="0">
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">'.$record['tripDetails']['user_name'].'</td>
						</tr>
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">Consignee Signature with Seal</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
						<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
						</tr>
						<tr>
						<td colspan="3" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:11px; color:#000; padding:3px 5px;">Note: All disputes are subjected to Kolkata Jurisdiction</td>
					</tr>
						
				</table>
		</td>
		  </tr>
		</table>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
		    <td style="border-bottom: 1px dashed #000; font-size:2px; height:10px">&nbsp;</td>
		  </tr>
		  <tr>
		    <td style="font-size:2px; height:10px">&nbsp;</td>
		  </tr>
		</table>
		<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
		  <tr>
		    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
		    	<table width="100%" border="0" cellpadding="0" >
		  <tr>
		    <td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;"><img  style="width:45px;" src="'.$LogoImageFileName.'" alt="SSLogistics" /></td>
		    <td width="75%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">
		    <table width="100%" border="0">
		  <tr>
		    <td style="font-family: Arial, Helvetica, sans-serif; font-size:10px;line-height:14px; color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
		  </tr>
		  <tr>
		    <td style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; font-weight: bold; text-align:center; padding:3px 0 0 0;">'.$record['tripDetails']['plant_name'].'</td>
		  </tr>
		  <tr>
						<td width="100%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px;line-height:10px; color:#000; text-align:center; padding:3px 0;">11/5/1 Cossipore Road, Kolkata, West Bengal - 700002<br />
						Phone: +91 9007759038, +91 98365 82274, Email- info@sslogistics.org<br />
					GSTIN: 19ACFFS8681L1Z8<br />
					<strong><u>Payment Voucher</u></strong>
				</td>
		  </tr>
		</table>

		    
		    </td>
		    <td width="10%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px;line-height:10px; color:#000; padding:3px; text-align:right;">Original</td>
		  </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;">&nbsp;</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px; text-align:center;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px; text-align:right;">&nbsp;</td>
		  </tr>
		  
		      </table>

		<table width="100%" border="0">
		  <tr>
		    <td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">LR No.:</td>
		    <td width="25%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['lr_no'].'</td>
		    <td width="5%" align="left" valign="top">&nbsp;</td>
		    <td width="12%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">DATE:</td>
		    <td width="33%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.date_format(date_create($record['tripDetails']['trip_date']),'d-m-Y :: H:i:s a').'</td>
		  </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">Pay to:</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">'.$record['tripDetails']['truck_owner'].'</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">Trip No:</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">SSLT000'.$record['tripDetails']['id'].'</td>
		  </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px;padding:3px 5px;">&nbsp;</td>
		  </tr>
		  
		</table>
		<table width="100%" border="0" cellpadding="3" cellspacing="0" style="border-collapse: collapse;">
		  <tr>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; spadding:3px 5px; border:1px solid #000; border-left:none;">TRUCK</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">QTY</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">PARTY</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">DESTINATION</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">CASH AMOUNT PAID</td>
		    </tr>
		  <tr>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000; border-left:none;">'.$record['tripDetails']['truck_no'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">'.$record['tripDetails']['quantity'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">'.$record['tripDetails']['party_name'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">'.$record['tripDetails']['end_location'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">'.$record['tripDetails']['advance_amount'].'</td>
		    </tr>
		</table>
		<table width="100%" border="0">
		  
				<tr>
				<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
			</tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">Amount in Words: '.$advanceAmountInWords.' </td>
				</tr>
				<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
					</tr>
		  
		</table>
		<table width="100%" border="0">
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;"><table width="200" border="0">
		      <tr>
		        <td style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border-bottom:1px solid #000;">&nbsp;</td>
		      </tr>
		    </table></td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">'.$record['tripDetails']['user_name'].'</td>
		    </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:5px 10px 5px 50px;">Receiver Signature</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
				</tr>
		  <tr>
		    <td colspan="3" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:10px; font-size:7px; color:#000; padding:3px 5px;">Note: All disputes are subjected to Kolkata Jurisdiction</td>
		    </tr>
		    
		</table></td>
		  </tr>
		</table>

		<table width="100%" border="0" cellpadding="10" cellspacing="0">
		  <tr>
		    <td style="border-bottom: 1px dashed #000; font-size:2px; height:10px">&nbsp;</td>
		  </tr>
		  <tr>
		    <td style="font-size:2px; height:10px">&nbsp;</td>
		  </tr>
		</table><table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
		  <tr>
		    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
		    	<table width="100%" border="0" >
		  <tr>
		    <td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;"><img  style="width:45px;" src="'.$LogoImageFileName.'" alt="SSLogistics" /></td>
		    <td width="75%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">
		      <table width="100%" border="0">
		        <tr>
		          <td style="font-family: Arial, Helvetica, sans-serif; font-size:10px;line-height:14px; color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
		          </tr>
				<tr>
		          <td style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; font-weight: bold; text-align:center; padding:3px 0 0 0;">'.$record['tripDetails']['plant_name'].' - Diesel Slip</td>
		          </tr>
		        <tr>
		          <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; text-align:center; padding:3px 0;">'.$record['tripDetails']['petrol_pump_name'].'</td>
		          </tr>
		        </table>
		      
		      
		    </td>
		    <td width="10%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px; text-align:right;">Original</td>
		    </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px; text-align:left;">&nbsp;</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px; text-align:center;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:1px;">&nbsp;</td>
		  </tr>
		  
		      </table>
					 <table width="100%" border="0" cellpadding="3" cellspacing="0" style="border-collapse: collapse;">
		   	    <tr>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000; border-left:none;">Trip No</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">DATE</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">LR NO</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">TRUCK</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">DIESEL</td>
		    </tr>
		  <tr>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000; border-left:none;">SSLT000'.$record['tripDetails']['id'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">'.date_format(date_create($record['tripDetails']['trip_date']),'d-m-Y :: H:i:s a').'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">'.$record['tripDetails']['lr_no'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">'.$record['tripDetails']['truck_no'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">'.$record['tripDetails']['diesel_amount'].'</td>
		    </tr>
		</table>
		   	  <table width="100%" border="0">
		      <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    </tr>
		   	 <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">'.$record['tripDetails']['user_name'].'</td>
		    </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">Pump Signature &amp; Sign</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">Slip is valid for 24 Hour from Loading Date &amp; Time</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
		    </tr>
		  </table></td>
		  </tr>
		</table>
		</body>
		</html>
		';

		/*page break in pdf*/
		PDFTC::writeHTML($originalHtmlData, true, false, true, false, '');
		PDFTC::AddPage();


		$duplicateHtmlData = '<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
			  <tr>
			    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
			    	<table width="100%" border="0">
			  <tr>
			    <td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;"><img src="'.$LogoImageFileName.'" alt="SSLogistics" /></td>
			    <td width="75%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">
			    <table width="100%" border="0">
			      <tr>
			        <td style="font-family: Arial, Helvetica, sans-serif; font-size:14px;line-height:18px color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
			      </tr>
			      <tr>
						<td width="100%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px;line-height:14px; color:#000; text-align:center; padding:3px 0;">11/5/1 Cossipore Road, Kolkata, West Bengal - 700002<br />
						Phone: +91 9007759038, +91 98365 82274, Email- info@sslogistics.org<br />
					GSTIN: 19ACFFS8681L1Z8<br />
					<strong><u>Consignment Note</u></strong>
				</td>
			      </tr>
			    </table>

			    
			    </td>
			    <td width="10%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:right;">Duplicate</td>
			  </tr>
			  <tr>
			    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;">&nbsp;</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">&nbsp;</td>
			    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:right;">&nbsp;</td>
			  </tr>
			  
			      </table>

			<table width="100%" border="0">
						<tr>
							<td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">LR No.:</td>
							<td width="25%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">'.$record['tripDetails']['lr_no'].'</td>
							<td width="5%" align="left" valign="top">&nbsp;</td>
							<td width="12%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">FROM:</td>
							<td width="33%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">'.$record['tripDetails']['start_location'].'</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">DATE:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">'.date_format(date_create($record['tripDetails']['trip_date']),'d-m-Y :: H:i:s a').'</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TO:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">'.$record['tripDetails']['end_location'].'</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">&nbsp;</td>
						</tr>
						
					</table>
					<table width="100%" border="0">
						<tr>
							<td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">Consignor M/S:</td>
							<td width="25%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">'.$record['tripDetails']['plant_description'].'</td>
							<td width="5%" align="left" valign="top">&nbsp;</td>
							<td width="12%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TRUCK:</td>
							<td width="33%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">'.$record['tripDetails']['truck_no'].'</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">Consignee M/S:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">'.$record['tripDetails']['party_name'].'</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">Trip No:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">SSLT000'.$record['tripDetails']['id'].'</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">&nbsp;</td>
						</tr>
						
					</table>
				<table width="100%" border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
					<tr width="100%">
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000; border-left:none;">No of Bags</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">WT</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">DESCRIPTION</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">RATE</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">DIESEL</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000; border-right:none;">ADVANCE</td>
						</tr>
					<tr  width="100%">
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000; border-left:none;">'.$noOfBags.'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">'.$record['tripDetails']['quantity'].'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">'.$record['tripDetails']['category_name'].' - '.$record['subCatDetails'].'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">'.(($record['tripPayment'] !== '') ? $record['tripPayment']['rate'] : '' ).'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">'.$record['tripDetails']['diesel_amount'].'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000;border:1px solid #000; border-right:none;">'.$record['tripDetails']['advance_amount'].'</td>
						</tr>
				</table>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" >
					
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
					</tr>
						
					<tr>
						<td width="30%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">INVOICE NO:</td>
						<td width="70%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">'.$record['tripDetails']['invoice_challan_no'].'</td>
						</tr>
					<tr>
						<td width="30%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">SHIPMENT/DELIVERY NO:</td>
						<td width="70%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">'.$record['tripDetails']['do_shipment_no'].'</td>
						</tr>
						<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
					</tr>
				</table>


				<table width="100%" border="0">
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">Received above material in Good Condition</td>
					</tr>
					<tr>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
					</tr>
		  </table>
				<table width="100%" border="0">
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">'.$record['tripDetails']['user_name'].'</td>
						</tr>
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">Consignee Signature with Seal</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
						</tr>
						<tr>
						<td colspan="3" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:15px; color:#000; padding:3px 5px;">Note: All disputes are subjected to Kolkata Jurisdiction</td>
					</tr>
						
				</table>
			</td>
			  </tr>
			</table>


			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td style="border-bottom: 1px dashed #000; font-size:2px; height:10px">&nbsp;</td>
			  </tr>
			  <tr>
			    <td style="font-size:2px; height:10px">&nbsp;</td>
			  </tr>
			</table>

			<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
			  <tr>
			    <td align="center" valign="middle" style="vertical-align: middle; border: 1px solid #000; text-align:center; border-collapse: collapse; height:100px; text-align: center; vertical-align: middle; line-height:100px; font-weight: bold; font-size:22px;">Intentionally Left Blank </td>
			  </tr>
			</table>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td style="border-bottom: 1px dashed #000; font-size:2px; height:10px">&nbsp;</td>
			  </tr>
			  <tr>
			    <td style="font-size:2px; height:10px">&nbsp;</td>
			  </tr>
			</table><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
			  <tr>
			    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
			    	<table width="100%" border="0">
			  <tr>
		    <td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;"><img src="'.$LogoImageFileName.'" alt="SSLogistics" /></td>
		    <td width="75%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">
		      <table width="100%" border="0">
		        <tr>
		          <td style="font-family: Arial, Helvetica, sans-serif; font-size:14px;line-height:18px; color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
		          </tr>
					<tr>
			          <td style="font-family: Arial, Helvetica, sans-serif; font-size:5px; color:#000; font-weight: bold; text-align:center; padding:3px 0 0 0;">'.$record['tripDetails']['plant_name'].' - Diesel Slip</td>
			          </tr>
			        <tr>
			          <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:5px; color:#000; text-align:center; padding:3px 0;">'.$record['tripDetails']['petrol_pump_name'].'</td>
			          </tr>
		        </table>
		      
		      
		    </td>
		    <td width="10%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:right;">Duplicate</td>
				</tr>
				<tr>
				<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
				<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
				<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
				</tr>
			  
			      </table>
			   	  <table width="100%" border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
			   	    <tr>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000; border-left:none;">Trip No</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">DATE</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">LR NO</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">TRUCK</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">DIESEL</td>
			    </tr>
			  <tr>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000; border-left:none;">SSLT000'.$record['tripDetails']['id'].'</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">'.date_format(date_create($record['tripDetails']['trip_date']),'d-m-Y :: H:i:s a').'</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">'.$record['tripDetails']['lr_no'].'</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">'.$record['tripDetails']['truck_no'].'</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">'.$record['tripDetails']['diesel_amount'].'</td>
			    </tr>
			</table>
			   	  <table width="100%" border="0">
			      <tr>
			    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
			    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
			    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
			    </tr>
			   	 <tr>
			    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
			    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
			    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">'.$record['tripDetails']['user_name'].'</td>
			    </tr>
			  <tr>
			    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">Pump Signature &amp; Sign</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">Slip is valid for 24 Hour from Loading Date &amp; Time</td>
			    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
			    </tr>
			</table></td>
			  </tr>
			</table>
		';

		/*Output a PDF*/
	    PDFTC::writeHTML($duplicateHtmlData, true, false, true, false, '');
		PDFTC::Output(public_path().'/pdftrip/'.$fileName,'FD');
	}




	/*****************************************************/
	# Trip Controller             
	# Function name : getTcPdf
	# Functionality: generate trip pdf using tcpdf
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2019                                
	# Purpose:  generate trip pdf using tcpdf
	# Params : Request $request                                        
	/*****************************************************/
	public function getTcPdf(Request $request){
		$data = array();
		
		$fileName 		   = $request->fileName; /*unique file name*/
		
		$record = $this->getTripDetails($request); /*get the details to be printed*/

		$noOfBags = $record['tripDetails']['quantity']*20;
		$advanceAmountInWords = $this->getNumberToWords($record['tripDetails']['advance_amount']);

		$LogoImageFileName = env('DOMAIN_NAME').'/images/pdf_logo.jpg'; 
		PDFTC::SetTitle('Trip Data');
	    PDFTC::AddPage();
		
		$originalHtmlData = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>SSLogistics</title>
		</head>

		<body style="margin:0; padding:0;" id="pdfOriginalDataHolder">
		<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
		  <tr>
		    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
		    	<table width="100%" border="0" cellpadding="0">
		  			<tr>
		    			<td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:10px 5px 5px 5px;"><img style="width:45px;" src="'.$LogoImageFileName.'" alt="SSLogistics" /></td>
		    			<td width="75%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">
								<table width="100%" border="0">
									<tr>
										<td width="100%" style="font-family: Arial, Helvetica, sans-serif; font-size:10px;line-height:14px; color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
									</tr>
									<tr>
										<td width="100%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px;line-height:9px; color:#000; text-align:center; padding:3px 0;">11/5/1 Cossipore Road, Kolkata, West Bengal - 700002<br />
												Phone: +91 9007759038, +91 98365 82274, Email- info@sslogistics.org<br />
											GSTIN: 19ACFFS8681L1Z8<br />
											<strong><u>Consignment Note</u></strong>
										</td>
										</tr>
								</table>		    
		    				</td>
								<td width="10%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px;line-height:12px; color:#000; padding:3px; text-align:right;">
									Original
								</td>
		  			</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:1px;">&nbsp;</td>
							<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px; text-align:center;">&nbsp;</td>
							<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px; text-align:right;">&nbsp;</td>
						</tr>
		      </table>
					<table width="100%" border="0">
						<tr>
							<td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">LR No.:</td>
							<td width="25%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['lr_no'].'</td>
							<td width="5%" align="left" valign="top">&nbsp;</td>
							<td width="12%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">FROM:</td>
							<td width="33%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['start_location'].'</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">DATE:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.date_format(date_create($record['tripDetails']['trip_date']),'d-m-Y :: H:i:s a').'</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">TO:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['end_location'].'</td>
						</tr>
					</table>
					<table width="100%" border="0">
						<tr>
							<td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">Consignor M/S:</td>
							<td width="25%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['plant_description'].'</td>
							<td width="5%" align="left" valign="top">&nbsp;</td>
							<td width="12%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">TRUCK:</td>
							<td width="33%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['truck_no'].'</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">Consignee M/S:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">'.$record['tripDetails']['party_name'].'</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">Trip No:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">SSLT000'.$record['tripDetails']['id'].'</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:1px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:1px 5px;">&nbsp;</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:1px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:1px 5px;">&nbsp;</td>
						</tr>
						
					</table>
				<table width="100%" border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
					<tr width="100%">
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000; border-left:none;">No of Bags</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">WT</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">DESCRIPTION</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">RATE</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">DIESEL</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000; border-right:none;">ADVANCE</td>
					</tr>
					<tr  width="100%">
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000; border-left:none;">'.$noOfBags.'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">'.$record['tripDetails']['quantity'].'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">'.$record['tripDetails']['category_name'].' - '.$record['subCatDetails'].'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">'.(($record['tripPayment'] !== '') ? $record['tripPayment']['rate'] : '' ).'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">'.$record['tripDetails']['diesel_amount'].'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000;border:1px solid #000; border-right:none;">'.$record['tripDetails']['advance_amount'].'</td>
						</tr>
				</table>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" >
					
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
					</tr>
						
					<tr>
						<td width="30%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">INVOICE NO:</td>
						<td width="70%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['invoice_challan_no'].'</td>
						</tr>
					<tr>
						<td width="30%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">SHIPMENT/DELIVERY NO:</td>
						<td width="70%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['do_shipment_no'].'</td>
						</tr>
						<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
					</tr>
				</table>


				<table width="100%" border="0">
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">Received above material in Good Condition</td>
					</tr>
					<tr>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
					</tr>
		  </table>
				<table width="100%" border="0">
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">'.$record['tripDetails']['user_name'].'</td>
						</tr>
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">Consignee Signature with Seal</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
						<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
						</tr>
						<tr>
						<td colspan="3" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:11px; color:#000; padding:3px 5px;">Note: All disputes are subjected to Kolkata Jurisdiction</td>
					</tr>
						
				</table>
		</td>
		  </tr>
		</table>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
		    <td style="border-bottom: 1px dashed #000; font-size:2px; height:10px">&nbsp;</td>
		  </tr>
		  <tr>
		    <td style="font-size:2px; height:10px">&nbsp;</td>
		  </tr>
		</table>
		<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
		  <tr>
		    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
		    	<table width="100%" border="0" cellpadding="0" >
		  <tr>
		    <td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;"><img  style="width:45px;" src="'.$LogoImageFileName.'" alt="SSLogistics" /></td>
		    <td width="75%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">
		    <table width="100%" border="0">
		  <tr>
		    <td style="font-family: Arial, Helvetica, sans-serif; font-size:10px;line-height:14px; color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
		  </tr>
		  <tr>
		    <td style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; font-weight: bold; text-align:center; padding:3px 0 0 0;">'.$record['tripDetails']['plant_name'].'</td>
		  </tr>
		  <tr>
						<td width="100%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px;line-height:10px; color:#000; text-align:center; padding:3px 0;">11/5/1 Cossipore Road, Kolkata, West Bengal - 700002<br />
						Phone: +91 9007759038, +91 98365 82274, Email- info@sslogistics.org<br />
					GSTIN: 19ACFFS8681L1Z8<br />
					<strong><u>Payment Voucher</u></strong>
				</td>
		  </tr>
		</table>

		    
		    </td>
		    <td width="10%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px;line-height:10px; color:#000; padding:3px; text-align:right;">Original</td>
		  </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;">&nbsp;</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px; text-align:center;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px; text-align:right;">&nbsp;</td>
		  </tr>
		  
		      </table>

		<table width="100%" border="0">
		  <tr>
		    <td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">LR No.:</td>
		    <td width="25%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['lr_no'].'</td>
		    <td width="5%" align="left" valign="top">&nbsp;</td>
		    <td width="12%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">DATE:</td>
		    <td width="33%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.date_format(date_create($record['tripDetails']['trip_date']),'d-m-Y :: H:i:s a').'</td>
		  </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">Pay to:</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">'.$record['tripDetails']['truck_owner'].'</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">Trip No:</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">SSLT000'.$record['tripDetails']['id'].'</td>
		  </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px;padding:3px 5px;">&nbsp;</td>
		  </tr>
		  
		</table>
		<table width="100%" border="0" cellpadding="3" cellspacing="0" style="border-collapse: collapse;">
		  <tr>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; spadding:3px 5px; border:1px solid #000; border-left:none;">TRUCK</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">QTY</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">PARTY</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">DESTINATION</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">CASH AMOUNT PAID</td>
		    </tr>
		  <tr>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000; border-left:none;">'.$record['tripDetails']['truck_no'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">'.$record['tripDetails']['quantity'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">'.$record['tripDetails']['party_name'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">'.$record['tripDetails']['end_location'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">'.$record['tripDetails']['advance_amount'].'</td>
		    </tr>
		</table>
		<table width="100%" border="0">
		  
				<tr>
				<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
			</tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">Amount in Words: '.$advanceAmountInWords.' </td>
				</tr>
				<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
					</tr>
		  
		</table>
		<table width="100%" border="0">
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;"><table width="200" border="0">
		      <tr>
		        <td style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border-bottom:1px solid #000;">&nbsp;</td>
		      </tr>
		    </table></td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">'.$record['tripDetails']['user_name'].'</td>
		    </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:5px 10px 5px 50px;">Receiver Signature</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
				</tr>
		  <tr>
		    <td colspan="3" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:10px; font-size:7px; color:#000; padding:3px 5px;">Note: All disputes are subjected to Kolkata Jurisdiction</td>
		    </tr>
		    
		</table></td>
		  </tr>
		</table>

		<table width="100%" border="0" cellpadding="10" cellspacing="0">
		  <tr>
		    <td style="border-bottom: 1px dashed #000; font-size:2px; height:10px">&nbsp;</td>
		  </tr>
		  <tr>
		    <td style="font-size:2px; height:10px">&nbsp;</td>
		  </tr>
		</table><table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
		  <tr>
		    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
		    	<table width="100%" border="0" >
		  <tr>
		    <td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;"><img  style="width:45px;" src="'.$LogoImageFileName.'" alt="SSLogistics" /></td>
		    <td width="75%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">
		      <table width="100%" border="0">
		        <tr>
		          <td style="font-family: Arial, Helvetica, sans-serif; font-size:10px;line-height:14px; color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
		          </tr>
				<tr>
		          <td style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; font-weight: bold; text-align:center; padding:3px 0 0 0;">'.$record['tripDetails']['plant_name'].' - Diesel Slip</td>
		          </tr>
		        <tr>
		          <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; text-align:center; padding:3px 0;">'.$record['tripDetails']['petrol_pump_name'].'</td>
		          </tr>
		        </table>
		      
		      
		    </td>
		    <td width="10%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px; text-align:right;">Original</td>
		    </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px; text-align:left;">&nbsp;</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px; text-align:center;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:1px;">&nbsp;</td>
		  </tr>
		  
		      </table>
					 <table width="100%" border="0" cellpadding="3" cellspacing="0" style="border-collapse: collapse;">
		   	    <tr>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000; border-left:none;">Trip No</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">DATE</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">LR NO</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">TRUCK</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">DIESEL</td>
		    </tr>
		  <tr>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000; border-left:none;">SSLT000'.$record['tripDetails']['id'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">'.date_format(date_create($record['tripDetails']['trip_date']),'d-m-Y :: H:i:s a').'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">'.$record['tripDetails']['lr_no'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">'.$record['tripDetails']['truck_no'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">'.$record['tripDetails']['diesel_amount'].'</td>
		    </tr>
		</table>
		   	  <table width="100%" border="0">
		      <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    </tr>
		   	 <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">'.$record['tripDetails']['user_name'].'</td>
		    </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">Pump Signature &amp; Sign</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">Slip is valid for 24 Hour from Loading Date &amp; Time</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
		    </tr>
		  </table></td>
		  </tr>
		</table>
		</body>
		</html>
		';

		/*page break in pdf*/
		PDFTC::writeHTML($originalHtmlData, true, false, true, false, '');
		PDFTC::AddPage();


		$duplicateHtmlData = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>SSLogistics</title>
		</head>

		<body style="margin:0; padding:0;" id="pdfOriginalDataHolder">
		<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
		  <tr>
		    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
		    	<table width="100%" border="0" cellpadding="0">
		  			<tr>
		    			<td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:10px 5px 5px 5px;"><img style="width:45px;" src="'.$LogoImageFileName.'" alt="SSLogistics" /></td>
		    			<td width="75%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">
								<table width="100%" border="0">
									<tr>
										<td width="100%" style="font-family: Arial, Helvetica, sans-serif; font-size:10px;line-height:14px; color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
									</tr>
									<tr>
										<td width="100%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px;line-height:9px; color:#000; text-align:center; padding:3px 0;">11/5/1 Cossipore Road, Kolkata, West Bengal - 700002<br />
												Phone: +91 9007759038, +91 98365 82274, Email- info@sslogistics.org<br />
											GSTIN: 19ACFFS8681L1Z8<br />
											<strong><u>Consignment Note</u></strong>
										</td>
										</tr>
								</table>		    
		    				</td>
								<td width="10%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px;line-height:12px; color:#000; padding:3px; text-align:right;">
									Duplicate
								</td>
		  			</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:1px;">&nbsp;</td>
							<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px; text-align:center;">&nbsp;</td>
							<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px; text-align:right;">&nbsp;</td>
						</tr>
		      </table>
					<table width="100%" border="0">
						<tr>
							<td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">LR No.:</td>
							<td width="25%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['lr_no'].'</td>
							<td width="5%" align="left" valign="top">&nbsp;</td>
							<td width="12%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">FROM:</td>
							<td width="33%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['start_location'].'</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">DATE:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.date_format(date_create($record['tripDetails']['trip_date']),'d-m-Y :: H:i:s a').'</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">TO:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['end_location'].'</td>
						</tr>
					</table>
					<table width="100%" border="0">
						<tr>
							<td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">Consignor M/S:</td>
							<td width="25%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['plant_description'].'</td>
							<td width="5%" align="left" valign="top">&nbsp;</td>
							<td width="12%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">TRUCK:</td>
							<td width="33%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['truck_no'].'</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">Consignee M/S:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">'.$record['tripDetails']['party_name'].'</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">Trip No:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">SSLT000'.$record['tripDetails']['id'].'</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:1px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:1px 5px;">&nbsp;</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:1px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:1px 5px;">&nbsp;</td>
						</tr>
						
					</table>
				<table width="100%" border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
					<tr width="100%">
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000; border-left:none;">No of Bags</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">WT</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">DESCRIPTION</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">RATE</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">DIESEL</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000; border-right:none;">ADVANCE</td>
					</tr>
					<tr  width="100%">
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000; border-left:none;">'.$noOfBags.'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">'.$record['tripDetails']['quantity'].'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">'.$record['tripDetails']['category_name'].' - '.$record['subCatDetails'].'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">'.(($record['tripPayment'] !== '') ? $record['tripPayment']['rate'] : '' ).'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border:1px solid #000;">'.$record['tripDetails']['diesel_amount'].'</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000;border:1px solid #000; border-right:none;">'.$record['tripDetails']['advance_amount'].'</td>
						</tr>
				</table>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" >
					
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
					</tr>
						
					<tr>
						<td width="30%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">INVOICE NO:</td>
						<td width="70%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['invoice_challan_no'].'</td>
						</tr>
					<tr>
						<td width="30%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">SHIPMENT/DELIVERY NO:</td>
						<td width="70%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['do_shipment_no'].'</td>
						</tr>
						<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
					</tr>
				</table>


				<table width="100%" border="0">
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">Received above material in Good Condition</td>
					</tr>
					<tr>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
					</tr>
		  </table>
				<table width="100%" border="0">
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">'.$record['tripDetails']['user_name'].'</td>
						</tr>
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">Consignee Signature with Seal</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:1px 5px;">&nbsp;</td>
						<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
						</tr>
						<tr>
						<td colspan="3" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:11px; color:#000; padding:3px 5px;">Note: All disputes are subjected to Kolkata Jurisdiction</td>
					</tr>
						
				</table>
		</td>
		  </tr>
		</table>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
		    <td style="border-bottom: 1px dashed #000; font-size:2px; height:10px">&nbsp;</td>
		  </tr>
		  <tr>
		    <td style="font-size:2px; height:10px">&nbsp;</td>
		  </tr>
		</table>
		<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
		  <tr>
		    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
		    	<table width="100%" border="0" cellpadding="0" >
		  <tr>
		    <td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;"><img  style="width:45px;" src="'.$LogoImageFileName.'" alt="SSLogistics" /></td>
		    <td width="75%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">
		    <table width="100%" border="0">
		  <tr>
		    <td style="font-family: Arial, Helvetica, sans-serif; font-size:10px;line-height:14px; color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
		  </tr>
		  <tr>
		    <td style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; font-weight: bold; text-align:center; padding:3px 0 0 0;">'.$record['tripDetails']['plant_name'].'</td>
		  </tr>
		  <tr>
						<td width="100%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px;line-height:10px; color:#000; text-align:center; padding:3px 0;">11/5/1 Cossipore Road, Kolkata, West Bengal - 700002<br />
						Phone: +91 9007759038, +91 98365 82274, Email- info@sslogistics.org<br />
					GSTIN: 19ACFFS8681L1Z8<br />
					<strong><u>Payment Voucher</u></strong>
				</td>
		  </tr>
		</table>

		    
		    </td>
		    <td width="10%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px;line-height:10px; color:#000; padding:3px; text-align:right;">Duplicate</td>
		  </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;">&nbsp;</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px; text-align:center;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px; text-align:right;">&nbsp;</td>
		  </tr>
		  
		      </table>

		<table width="100%" border="0">
		  <tr>
		    <td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">LR No.:</td>
		    <td width="25%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.$record['tripDetails']['lr_no'].'</td>
		    <td width="5%" align="left" valign="top">&nbsp;</td>
		    <td width="12%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">DATE:</td>
		    <td width="33%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px;">'.date_format(date_create($record['tripDetails']['trip_date']),'d-m-Y :: H:i:s a').'</td>
		  </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">Pay to:</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">'.$record['tripDetails']['truck_owner'].'</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">Trip No:</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">SSLT000'.$record['tripDetails']['id'].'</td>
		  </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:10px;padding:3px 5px;">&nbsp;</td>
		  </tr>
		  
		</table>
		<table width="100%" border="0" cellpadding="3" cellspacing="0" style="border-collapse: collapse;">
		  <tr>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; spadding:3px 5px; border:1px solid #000; border-left:none;">TRUCK</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">QTY</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">PARTY</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">DESTINATION</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">CASH AMOUNT PAID</td>
		    </tr>
		  <tr>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000; border-left:none;">'.$record['tripDetails']['truck_no'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">'.$record['tripDetails']['quantity'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">'.$record['tripDetails']['party_name'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000;">'.$record['tripDetails']['end_location'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">'.$record['tripDetails']['advance_amount'].'</td>
		    </tr>
		</table>
		<table width="100%" border="0">
		  
				<tr>
				<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
			</tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">Amount in Words: '.$advanceAmountInWords.' </td>
				</tr>
				<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
					</tr>
		  
		</table>
		<table width="100%" border="0">
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;"><table width="200" border="0">
		      <tr>
		        <td style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; border-bottom:1px solid #000;">&nbsp;</td>
		      </tr>
		    </table></td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">'.$record['tripDetails']['user_name'].'</td>
		    </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:5px 10px 5px 50px;">Receiver Signature</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
				</tr>
		  <tr>
		    <td colspan="3" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:10px; font-size:7px; color:#000; padding:3px 5px;">Note: All disputes are subjected to Kolkata Jurisdiction</td>
		    </tr>
		    
		</table></td>
		  </tr>
		</table>

		<table width="100%" border="0" cellpadding="10" cellspacing="0">
		  <tr>
		    <td style="border-bottom: 1px dashed #000; font-size:2px; height:10px">&nbsp;</td>
		  </tr>
		  <tr>
		    <td style="font-size:2px; height:10px">&nbsp;</td>
		  </tr>
		</table><table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
		  <tr>
		    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
		    	<table width="100%" border="0" >
		  <tr>
		    <td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;"><img  style="width:45px;" src="'.$LogoImageFileName.'" alt="SSLogistics" /></td>
		    <td width="75%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">
		      <table width="100%" border="0">
		        <tr>
		          <td style="font-family: Arial, Helvetica, sans-serif; font-size:10px;line-height:14px; color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
		          </tr>
				<tr>
		          <td style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; font-weight: bold; text-align:center; padding:3px 0 0 0;">'.$record['tripDetails']['plant_name'].' - Diesel Slip</td>
		          </tr>
		        <tr>
		          <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; text-align:center; padding:3px 0;">'.$record['tripDetails']['petrol_pump_name'].'</td>
		          </tr>
		        </table>
		      
		      
		    </td>
		    <td width="10%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px; text-align:right;">Duplicate</td>
		    </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px; text-align:left;">&nbsp;</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px; text-align:center;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:1px;">&nbsp;</td>
		  </tr>
		  
		      </table>
					 <table width="100%" border="0" cellpadding="3" cellspacing="0" style="border-collapse: collapse;">
		   	    <tr>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000; border-left:none;">Trip No</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">DATE</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">LR NO</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">TRUCK</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">DIESEL</td>
		    </tr>
		  <tr>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000; border-left:none;">SSLT000'.$record['tripDetails']['id'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">'.date_format(date_create($record['tripDetails']['trip_date']),'d-m-Y :: H:i:s a').'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">'.$record['tripDetails']['lr_no'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000;">'.$record['tripDetails']['truck_no'].'</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; line-height:10px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">'.$record['tripDetails']['diesel_amount'].'</td>
		    </tr>
		</table>
		   	  <table width="100%" border="0">
		      <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    </tr>
		   	 <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">'.$record['tripDetails']['user_name'].'</td>
		    </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">Pump Signature &amp; Sign</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">Slip is valid for 24 Hour from Loading Date &amp; Time</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
		    </tr>
		  </table></td>
		  </tr>
		</table>
		</body>
		</html>
		';

		/*Output a PDF*/
	    PDFTC::writeHTML($duplicateHtmlData, true, false, true, false, '');
		PDFTC::Output(public_path().'/pdftrip/'.$fileName,'FD');
	}



	/*****************************************************/
	# Trip Controller             
	# Function name : ledgerReport
	# Functionality: view ledger report page
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/07/2019                                
	# Purpose:  view  ledger report page
	# Params :                                         
	/*****************************************************/
	public function ledgerReport(){
		return view('trips.ledgerReport');
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : getLedgerReport
	# Functionality: get ledger report details
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/07/2019                                
	# Purpose:  get ledger report details
	# Params : Request $request                                        
	/*****************************************************/
	public function getLedgerReport(Request $request) {
		$data 	= array(); /*storing data for listing*/ 
		$vendorList = '';
		$company = '';

		if($request->company != 'undefined' && $request->company != ''){
			$vendorNameDetails = explode('(', $request->company);
			$vendorList = Vendor::where('name','like',trim($vendorNameDetails[0]))->get()->toArray();

			if(!empty($vendorList)){
				$company = $vendorList[0]['id'];
			}
		}

		/*defining db tables for joining*/
		$dbTables = array(
					'tripTable' 				      => config('dbtables.trips'),
					'plantTable' 				      => config('dbtables.plants'),
					'partyTable' 				      => config('dbtables.parties'),
					'truckTable' 				      => config('dbtables.trucks'),
					'petrolPumpTable' 				  => config('dbtables.petrol_pumps'),
					'vendorTable'					  => config('dbtables.vendors'),	
					'tripBillTable'				  	  => config('dbtables.trip_bills'),
				);


		/*get available records*/
		$ledgerReportList = TripBill::getLedgerReport($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$company);
		$totalLedgerReports = TripBill::totalLedgerReportRecords($dbTables,$company);


		/*customizing final array*/
		$data['ledgerReportList'] 		= $ledgerReportList;
		$data['totalLedgerReports'] 	= $totalLedgerReports;
		$data['success']				= 'true'; 
		$data['currentPage']    		= $request->currentPage;

		return $data;
	}


	/*****************************************************/
	# Trip Controller             
	# Function name : getBillDetails
	# Functionality: get bill details
	# Author : Sanchari Ghosh                                 
	# Created Date : 09/09/2019                                
	# Purpose:  get bill details
	# Params : Request $request                                        
	/*****************************************************/
	public function getBillDetails(Request $request){
		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'tripTable' 					=> config('dbtables.trips'),
					'tripBillTable'					=> config('dbtables.trip_bills'),
					'tripPaymentManagementTable'    => config('dbtables.trip_payment_managements'),
				);


		/*get available records*/
		$billList = TripBill::getBillDetails($dbTables,$request->billNo);

		/*customizing final array*/
		$data['billList'] 		= $billList;
		$data['success']		= 'true'; 

		return $data;
	}

}
