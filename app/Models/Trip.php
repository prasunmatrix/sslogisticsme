<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\Models\PlantJournalLaserEditRequest;
use App\Models\PetrolPumpJournalLaserEditRequest;
use App\User;


/*****************************************************/
# Trip Model             
# Class name : Trip
# Functionality: listing of trips
# Author : Sanchari Ghosh                                 
# Created Date :  31/08/2018                                
# Purpose: Developing the functionality of listing of trips
/*****************************************************/
class Trip extends Model {
	use SoftDeletes;
	
	protected $table = 'trips';
	protected $guarded 	= ['id'];
    protected $fillable = ['trip_date','trip_type','lr_no','plant_id','invoice_challan_no','do_shipment_no','party_id','truck_id','quantity','truck_owner','truck_driver_name','truck_driver_phone_number','truck_driver_email','petrol_pump_id','advance_amount','diesel_amount','trip_status','GPS_trip_status','POD_file','POD_status','current_challan_status','POD_uploaded_by','POD_uploaded_at','remarks','bags','description','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by','closed_at','closed_by'];

	protected $dates    = ['deleted_at'];


    /*****************************************************/
	# Trip Model             
	# Function name : availableRecords
	# Functionality: view trip listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 31/08/2018                                
	# Purpose:  to view trip listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword 
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {
		
		$totalQty = 0;

		$records = Trip::select($dbTables['tripTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['partyTable'].'.party_name',$dbTables['truckTable'].'.truck_no',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['vendorTable'].'.name AS vendor_name',$dbTables['userTable'].'.full_name AS user_name')
			->join($dbTables['plantTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
			->join($dbTables['partyTable'], $dbTables['tripTable'].'.party_id', '=', $dbTables['partyTable'].'.id')
			->join($dbTables['truckTable'], $dbTables['tripTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
			->join($dbTables['petrolPumpTable'], $dbTables['tripTable'].'.petrol_pump_id', '=', $dbTables['petrolPumpTable'].'.id')
			->join($dbTables['vendorTable'], $dbTables['tripTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id')
			->join($dbTables['userTable'], $dbTables['tripTable'].'.created_by', '=', $dbTables['userTable'].'.id');


			if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) { /*for supervisor*/
		    	//$records = $records->where($dbTables['tripTable'].'.created_by', \Auth::user()->id);
			} 


			if($searchKeyword != ''){

				/*check for trip id only*/
				if (substr_count($searchKeyword,"SSLT000") > 0) {
				 	$newSearchKeyword = str_replace("SSLT000", '', $searchKeyword);
				 	$tripIdSearchKeyword = $newSearchKeyword;
				} else {
					$tripIdSearchKeyword = $searchKeyword;
				}


				/*if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) { 
		    		$records = $records->where($dbTables['tripTable'].'.created_by', \Auth::user()->id)
		    						   ->where(function ($query) use ($dbTables,$searchKeyword,$tripIdSearchKeyword) {
								                $query->where($dbTables['tripTable'].'.lr_no', 'like', '%'.$searchKeyword.'%')
								                     ->orWhere($dbTables['tripTable'].'.id', 'like', '%'.$tripIdSearchKeyword.'%')
								                	 ->orWhere($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%')
								                	 ->orWhere($dbTables['partyTable'].'.party_name', 'like', '%'.$searchKeyword.'%')
								                	 ->orWhere($dbTables['truckTable'].'.truck_no', 'like', '%'.$searchKeyword.'%')
								                	 ->orWhere($dbTables['vendorTable'].'.name', 'like', '%'.$searchKeyword.'%');
								            });
				} else { */
					$records = $records->where($dbTables['tripTable'].'.lr_no', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['tripTable'].'.id', 'like', '%'.$tripIdSearchKeyword.'%')->orWhere($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['partyTable'].'.party_name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['truckTable'].'.truck_no', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['vendorTable'].'.name', 'like', '%'.$searchKeyword.'%');
				//}
			}

			/*customizing ordering section*/
			if($orderby == 'user_name' || $orderby == 'closedByName') {
				$records = 	$records->orderBy($dbTables['userTable'].'.full_name',$ordertype);
			} else if($orderby == 'plant_name') {
				$records = 	$records->orderBy($dbTables['plantTable'].'.name',$ordertype);
			} else if($orderby == 'party_name') {
				$records = 	$records->orderBy($dbTables['partyTable'].'.party_name',$ordertype);
			} else if($orderby == 'vendor_name') {
				$records = 	$records->orderBy($dbTables['vendorTable'].'.name',$ordertype);
			} else if($orderby == 'truck_no') {
				$records = 	$records->orderBy($dbTables['truckTable'].'.truck_no',$ordertype);
			} else {
				$records = 	$records->orderBy($dbTables['tripTable'].'.'.$orderby,$ordertype);
			}

			

			$records = 	$records->skip(($currentPage-1)*$perPageRecord)
			            ->take($perPageRecord)
			            ->get()->toArray();

			
			for ($i=0; $i<sizeof($records); $i++) {
				$records[$i]['plantJournalLaserEditRequestCount'] = PlantJournalLaserEditRequest::where('trip_id',$records[$i]['id'])->where('approval_status','Pending')->where('status','A')->count();

				$records[$i]['plantJournalLaserEditRequestApprovedCount'] = PlantJournalLaserEditRequest::where('trip_id',$records[$i]['id'])->where('request_by',\Auth::user()->id)->where('approval_status','Approved')->where('status','A')->count();

				$records[$i]['plantJournalLaserEditActiveRequestCount'] = PlantJournalLaserEditRequest::where('trip_id',$records[$i]['id'])->where('request_by',\Auth::user()->id)->where('status','A')->count();

				$records[$i]['petrolPumpJournalLaserEditRequestCount'] = PetrolPumpJournalLaserEditRequest::where('trip_id',$records[$i]['id'])->where('approval_status','Pending')->where('status','A')->count();


				$records[$i]['petrolPumpJournalLaserEditRequestApprovedCount'] = PetrolPumpJournalLaserEditRequest::where('trip_id',$records[$i]['id'])->where('approval_status','Approved')->where('request_by',\Auth::user()->id)->where('status','A')->count();

				// $records[$i]['petrolPumpJournalLaserEditActiveRequestCount'] = PetrolPumpJournalLaserEditRequest::where('trip_id',$records[$i]['id'])->where('request_by',\Auth::user()->id)->where('approval_status','Pending')->where('status','A')->count();


				/*get POD file*/
				if ($records[$i]['POD_status'] == 'Yes') {
					$podFile = TripPOD::select($dbTables['tripPODTable'].'.pod_file',$dbTables['tripPODTable'].'.status',$dbTables['tripPODTable'].'.reason')->where($dbTables['tripPODTable'].'.trip_id',$records[$i]['id'])->orderBy($dbTables['tripPODTable'].'.id','DESC')->get()->toArray();
					$records[$i]['podFileStatus'] = '('.$podFile[0]['status'].')';
				} else {
					if(count(TripPOD::select($dbTables['tripPODTable'].'.pod_file',$dbTables['tripPODTable'].'.status',$dbTables['tripPODTable'].'.reason')->where($dbTables['tripPODTable'].'.trip_id',$records[$i]['id'])->get()->toArray()) > 0) {
						$podFile = TripPOD::select($dbTables['tripPODTable'].'.pod_file',$dbTables['tripPODTable'].'.status',$dbTables['tripPODTable'].'.reason')->where($dbTables['tripPODTable'].'.trip_id',$records[$i]['id'])->orderBy($dbTables['tripPODTable'].'.id','DESC')->get()->toArray();
						$records[$i]['podFileStatus'] = '('.$podFile[0]['status'].')';
					} else {
						$records[$i]['podFileStatus'] = '';
					}
				}

				/*get 'closed by' value*/
				if ($records[$i]['trip_status'] == 'Completed') {
					$closedByName = User::select('full_name')->where('id',$records[$i]['closed_by'])->get()->toArray();
					$records[$i]['closedByName'] = $closedByName[0]['full_name'];
				} else {
					$records[$i]['closedByName'] = '-';
				}
				
				if(\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) {
				 	if ($records[$i]['created_by'] == \Auth::user()->id){
				 		$records[$i]['canDo'] = 1;
				 	} else {
				 		$records[$i]['canDo'] = 0;
				 	}
				} else {
					$records[$i]['canDo'] = 1;
				}

				$totalQty += $records[$i]['quantity']; /*total quantity*/
			}
			
		$records[0]['totalQty'] = $totalQty;
		return $records;
	}



	/*****************************************************/
	# Trip Model             
	# Function name : totalRecords
	# Functionality: get total count of trip
	# Author : Sanchari Ghosh                                
	# Created Date : 31/08/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                               
	/*****************************************************/

	public static function totalRecords($dbTables,$searchKeyword) {
		
        $records = Trip::select($dbTables['tripTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['partyTable'].'.party_name',$dbTables['truckTable'].'.truck_no',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['vendorTable'].'.name AS vendor_name',$dbTables['userTable'].'.full_name AS user_name')
			->join($dbTables['plantTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
			->join($dbTables['partyTable'], $dbTables['tripTable'].'.party_id', '=', $dbTables['partyTable'].'.id')
			->join($dbTables['truckTable'], $dbTables['tripTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
			->join($dbTables['petrolPumpTable'], $dbTables['tripTable'].'.petrol_pump_id', '=', $dbTables['petrolPumpTable'].'.id')
			->join($dbTables['vendorTable'], $dbTables['tripTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id')
			->join($dbTables['userTable'], $dbTables['tripTable'].'.created_by', '=', $dbTables['userTable'].'.id');

		if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) { /*for supervisor*/
		    //$records = $records->where($dbTables['tripTable'].'.created_by', \Auth::user()->id);
		} 	

		if($searchKeyword != ''){
			/*if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) { 
	    		$records = $records->where($dbTables['tripTable'].'.created_by', \Auth::user()->id)
	    						   ->where(function ($query) use ($dbTables,$searchKeyword) {
							                $query->where($dbTables['tripTable'].'.lr_no', 'like', '%'.$searchKeyword.'%')
							                	 ->orWhere($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%')
							                	 ->orWhere($dbTables['partyTable'].'.party_name', 'like', '%'.$searchKeyword.'%')
							                	 ->orWhere($dbTables['truckTable'].'.truck_no', 'like', '%'.$searchKeyword.'%');
							            });
			} else { */
				$records = $records->where($dbTables['tripTable'].'.lr_no', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['partyTable'].'.party_name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['truckTable'].'.truck_no', 'like', '%'.$searchKeyword.'%');
			//}
			


		}	
		
		$records = 	$records->orderBy($dbTables['tripTable'].'.id','ASC')
            		->get();
            		
        $recordsCount = $records->count();

		return $recordsCount;
	}




	/*****************************************************/
	# Trip Model             
	# Function name : getTripDetails
	# Functionality: get trip details
	# Author : Sanchari Ghosh                                
	# Created Date : 31/08/2018                                
	# Purpose:  get trip details
	# Params :  $dbTables, $tripId                                    
	/*****************************************************/

	public static function getTripDetails($dbTables, $tripId) {
		 $records = Trip::select($dbTables['tripTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['plantTable'].'.description AS plant_description',$dbTables['partyTable'].'.party_name',$dbTables['truckTable'].'.truck_no',$dbTables['truckRegistrationTable'].'.registration_no',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['categoryTable'].'.category_name')
			->join($dbTables['plantTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
			->join($dbTables['partyTable'], $dbTables['tripTable'].'.party_id', '=', $dbTables['partyTable'].'.id')
			->join($dbTables['truckTable'], $dbTables['tripTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
			->join($dbTables['truckRegistrationTable'], $dbTables['tripTable'].'.truck_id', '=', $dbTables['truckRegistrationTable'].'.truck_id')
			->join($dbTables['petrolPumpTable'], $dbTables['tripTable'].'.petrol_pump_id', '=', $dbTables['petrolPumpTable'].'.id')
			->join($dbTables['categoryTable'], $dbTables['tripTable'].'.category_id', '=', $dbTables['categoryTable'].'.id')
			->where($dbTables['tripTable'].'.id',$tripId)
			->orderBy($dbTables['tripTable'].'.id','ASC')
            ->get(); 
		return $records;
	}




	/*****************************************************/
	# Trip Model             
	# Function name : getConsolidatedTripDetails
	# Functionality: get Consolidated Trip Details
	# Author : Sanchari Ghosh                                
	# Created Date : 10/09/2018                                
	# Purpose:  get Consolidated Trip pDetails
	# Params :  $dbTables, $truckId, $year, $currentPage, $perPageRecord, $orderby, $ordertype
	/*****************************************************/

	public static function getConsolidatedTripDetails($dbTables,$vendorId, $startDate,$endDate) {
		$checkBoxCount = 0; /*track the checkbox count*/

		$records = Trip::select($dbTables['tripTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['plantTable'].'.address_zone_id AS plant_address',$dbTables['partyTable'].'.party_name',$dbTables['partyTable'].'.address_zone_id AS party_address',$dbTables['truckTable'].'.truck_no',$dbTables['truckRegistrationTable'].'.registration_no',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['tripPaymentManagements'].'.freight_charge',$dbTables['tripPaymentManagements'].'.toll',$dbTables['tripPaymentManagements'].'.unloading_charge',$dbTables['tripPaymentManagements'].'.tare_charge',$dbTables['tripPaymentManagements'].'.balance',$dbTables['tripPaymentManagements'].'.rate',$dbTables['tripPaymentManagements'].'.short_bag_amount')
			->join($dbTables['plantTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
			->join($dbTables['partyTable'], $dbTables['tripTable'].'.party_id', '=', $dbTables['partyTable'].'.id')
			->join($dbTables['truckTable'], $dbTables['tripTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
			->join($dbTables['truckRegistrationTable'], $dbTables['tripTable'].'.truck_id', '=', $dbTables['truckRegistrationTable'].'.truck_id')
			->join($dbTables['petrolPumpTable'], $dbTables['tripTable'].'.petrol_pump_id', '=', $dbTables['petrolPumpTable'].'.id')
			->leftjoin($dbTables['tripPaymentManagements'], $dbTables['tripTable'].'.id', '=', $dbTables['tripPaymentManagements'].'.trip_id')
			->where($dbTables['tripTable'].'.vendor_id',$vendorId)
			->where($dbTables['tripTable'].'.bill_status','N')
			->orderBy($dbTables['tripTable'].'.trip_date','ASC');
			
			
		if ($startDate !== '1970-01-01'){
			$records = $records->where($dbTables['tripTable'].'.trip_date', '>=', $startDate);
		}

		if ($endDate !== '1970-01-01'){
			$records = $records->where($dbTables['tripTable'].'.trip_date', '<=', $endDate);
		}


		

		/*for supervisor show only his/her trip*/		
		if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId'))	 {
			$records = $records->where($dbTables['tripTable'].'.created_by', '=', \Auth::user()->id);
		}
        
        $records = $records->get()->toArray();



        /*get POD file*/
        for ($i=0; $i<sizeof($records); $i++) {
			if ($records[$i]['POD_status'] == 'Yes') {
				$podFile = TripPOD::select($dbTables['tripPODTable'].'.pod_file',$dbTables['tripPODTable'].'.status',$dbTables['tripPODTable'].'.reason')->where($dbTables['tripPODTable'].'.trip_id',$records[$i]['id'])->orderBy($dbTables['tripPODTable'].'.id','DESC')->get()->toArray();

				if ($podFile[0]['status'] == 'OK CHALLAN' || $podFile[0]['status'] == 'STAMPED SHORT CHALLAN') {
					$records[$i]['podFileStatus'] = 'Yes';

					/*for enabling checkbox for Bill Generation*/
					if ($records[$i]['freight_charge'] !== null) {
						$records[$i]['checkBoxStatus'] = 'y';
						$checkBoxCount++;
					} else {
						$records[$i]['checkBoxStatus'] = 'n';
					}
				} else {
					$records[$i]['podFileStatus'] = 'No';
					$records[$i]['checkBoxStatus'] = 'n';
				}

				
				
			} else {
				if(count(TripPOD::select($dbTables['tripPODTable'].'.pod_file',$dbTables['tripPODTable'].'.status',$dbTables['tripPODTable'].'.reason')->where($dbTables['tripPODTable'].'.trip_id',$records[$i]['id'])->get()->toArray()) > 0) {
					$podFile = TripPOD::select($dbTables['tripPODTable'].'.pod_file',$dbTables['tripPODTable'].'.status',$dbTables['tripPODTable'].'.reason')->where($dbTables['tripPODTable'].'.trip_id',$records[$i]['id'])->orderBy($dbTables['tripPODTable'].'.id','DESC')->get()->toArray();

					if ($podFile[0]['status'] == 'OK CHALLAN' || $podFile[0]['status'] == 'STAMPED SHORT CHALLAN') {
						$records[$i]['podFileStatus'] = 'Yes';
					} else {
						$records[$i]['podFileStatus'] = 'No';
					}
				} else {
					$records[$i]['podFileStatus'] = 'No';
				}
				$records[$i]['checkBoxStatus'] = 'n';
			}
		}
		if(sizeof($records) > 0){
			$records[0]['checkboxCount'] = $checkBoxCount;
		}
		
		return $records;
	}



	/*****************************************************/
	# Trip Model             
	# Function name : totalConsolidatedTripRecords
	# Functionality: get Consolidated Trip Details Count
	# Author : Sanchari Ghosh                                
	# Created Date : 10/09/2018                                
	# Purpose:  get Consolidated Trip Details Count
	# Params :  $dbTables,$truckId,$year
	/*****************************************************/
	public static function totalConsolidatedTripRecords($dbTables,$truckId,$year) {
		// $records = Trip::select($dbTables['tripTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['plantAddressTable'].'.address',$dbTables['partyTable'].'.party_name',$dbTables['truckTable'].'.truck_no',$dbTables['truckRegistrationTable'].'.registration_no',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['tripPaymentManagements'].'.freight_charge',$dbTables['tripPaymentManagements'].'.toll',$dbTables['tripPaymentManagements'].'.unloading_charge',$dbTables['tripPaymentManagements'].'.tare_charge',$dbTables['tripPaymentManagements'].'.balance')
		// 	->join($dbTables['plantTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
		// 	->join($dbTables['plantAddressTable'], $dbTables['tripTable'].'.plant_address_id', '=', $dbTables['plantAddressTable'].'.id')
		// 	->join($dbTables['partyTable'], $dbTables['tripTable'].'.party_id', '=', $dbTables['partyTable'].'.id')
		// 	->join($dbTables['truckTable'], $dbTables['tripTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
		// 	->join($dbTables['truckRegistrationTable'], $dbTables['tripTable'].'.truck_id', '=', $dbTables['truckRegistrationTable'].'.truck_id')
		// 	->join($dbTables['petrolPumpTable'], $dbTables['tripTable'].'.petrol_pump_id', '=', $dbTables['petrolPumpTable'].'.id')
		// 	->leftjoin($dbTables['tripPaymentManagements'], $dbTables['tripTable'].'.id', '=', $dbTables['tripPaymentManagements'].'.trip_id')
		// 	->where($dbTables['truckTable'].'.id',$truckId)
		// 	->whereYear($dbTables['tripTable'].'.created_at', '=', $year)
		// 	->orderBy($dbTables['tripTable'].'.id','ASC')
  //           ->get();
            

	        // for ($i=1; $i<count($records); $i++) {
	        // 	$records[0]['updated_POD_status'] = $records[0]['POD_status'];
	        // 	if ($records[$i-1]['POD_status'] == 'No') {
	        // 		$records[$i]['updated_POD_status'] = 'No';
	        // 	} else {
	        // 		$records[$i]['updated_POD_status'] = $records[$i]['POD_status'];
	        // 	}
	        // }
        
        $recordsCount = $records->count();

		return $recordsCount;
		
	}




	/*****************************************************/
	# Trip Model             
	# Function name : plantWiseTripRecords
	# Functionality: get Plant wise Trip list
	# Author : Sanchari Ghosh                                
	# Created Date : 26/09/2018                                
	# Purpose:  get Plant wise Trip list
	# Params : $dbTables,$plantId
	/*****************************************************/
	public static function plantWiseTripRecords($dbTables,$plantId) {
		$records = Trip::select($dbTables['tripTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['partyTable'].'.party_name',$dbTables['truckTable'].'.truck_no',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['categoryTable'].'.category_name',$dbTables['plantTable'].'.address_zone_id AS plant_address',$dbTables['partyTable'].'.party_name',$dbTables['partyTable'].'.address_zone_id AS party_address',$dbTables['tripPaymentTable'].'.rate')
			->join($dbTables['plantTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
			->join($dbTables['partyTable'], $dbTables['tripTable'].'.party_id', '=', $dbTables['partyTable'].'.id')
			->join($dbTables['truckTable'], $dbTables['tripTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
			->join($dbTables['petrolPumpTable'], $dbTables['tripTable'].'.petrol_pump_id', '=', $dbTables['petrolPumpTable'].'.id')
			->join($dbTables['categoryTable'], $dbTables['tripTable'].'.category_id', '=', $dbTables['categoryTable'].'.id')
			->leftjoin($dbTables['tripPaymentTable'], $dbTables['tripTable'].'.id', '=', $dbTables['tripPaymentTable'].'.trip_id')
			->where($dbTables['tripTable'].'.plant_id',$plantId);

		if (\Auth::user()->user_role_id ==  \Config::get('constants.supervisorRoleId'))	 {
				$records = $records->where($dbTables['plantTable'].'.supervisor_id', '=', \Auth::user()->id);
		}
	
		
		$records = 	$records->orderBy($dbTables['tripTable'].'.id','ASC')
            		->get();
            		

		return $records;
	}




	/*****************************************************/
	# Trip Model             
	# Function name : getTripReport
	# Functionality: get trip report
	# Author : Sanchari Ghosh                                 
	# Created Date : 18/03/2019                                
	# Purpose:  to view trip report  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype, $tripStatus,$company,$timePeriod,$dateRangeValue 
	/*****************************************************/
	public static function getTripReport($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$tripStatus,$timePeriod,$company,$dateRangeValue) {
			$dbPrefix			= DB::getTablePrefix();

			$records = Trip::select($dbTables['tripTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['partyTable'].'.party_name',$dbTables['partyTable'].'.address_zone_id',$dbTables['addressZoneTable'].'.address',$dbTables['truckTable'].'.truck_no',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['vendorTable'].'.name  AS vendor_name',$dbTables['vendorTable'].'.contact_number',$dbTables['itemTable'].'.item_name',DB::raw('TIMEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ) AS timeDiff'),$dbTables['userTable'].'.full_name AS user_name')
				->join($dbTables['plantTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
				->join($dbTables['partyTable'], $dbTables['tripTable'].'.party_id', '=', $dbTables['partyTable'].'.id')
				->join($dbTables['truckTable'], $dbTables['tripTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
				->join($dbTables['petrolPumpTable'], $dbTables['tripTable'].'.petrol_pump_id', '=', $dbTables['petrolPumpTable'].'.id')
				->join($dbTables['vendorTable'], $dbTables['tripTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id')
				->join($dbTables['itemTable'], $dbTables['tripTable'].'.subcategory_id', '=', $dbTables['itemTable'].'.id')
				->join($dbTables['addressZoneTable'], $dbTables['partyTable'].'.address_zone_id', '=', $dbTables['addressZoneTable'].'.id')
				->join($dbTables['userTable'], $dbTables['tripTable'].'.created_by', '=', $dbTables['userTable'].'.id');


			if (\Auth::user()->user_role_id ==  \Config::get('constants.supervisorRoleId'))	 {
				$records = $records->join($dbTables['plantUserRelationTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantUserRelationTable'].'.plant_id')
					->where($dbTables['plantUserRelationTable'].'.user_id','=',\Auth::user()->id)
					->where($dbTables['plantUserRelationTable'].'.deleted_by','=',NULL);
			}


		/*========================================filter section=========================================*/
		if($tripStatus != 'undefined' && $tripStatus != ''){
			$records = $records->where($dbTables['tripTable'].'.trip_status', 'like', $tripStatus);
		}
		
		if($company != 'undefined' && $company != ''){ 
			$records = $records->where($dbTables['tripTable'].'.vendor_id', 'like', $company);
		}

		if($dateRangeValue != 'undefined' && $dateRangeValue != '') {
			$dateValue = explode('-',$dateRangeValue);

			$startDate = date('Y-m-d 00:00:00', strtotime(trim($dateValue[0]))); 
			$endDate = date('Y-m-d 23:59:59', strtotime(trim($dateValue[1])));

			$records = $records->where($dbTables['tripTable'].'.trip_date', '>=', $startDate)
							   ->where($dbTables['tripTable'].'.trip_date', '<=', $endDate);
		}

		/*filter on time period (If the trip status is 'Awaiting' or 'Running' or 'Unsettled' then the trip duration will be calculated on the basis of trip date & current datetime. If the trip status is 'Settled' or 'Closed' or 	'Cancelled' then the trip duration will be calculated on the basis of trip date & updated at.)*/
		if($timePeriod != '' && $timePeriod != 'undefined'){ 
			$timeToBeCompared = '';

			if(($tripStatus != 'undefined') && ($tripStatus != '') && ($tripStatus == 'Awaiting' || $tripStatus == 'Running' || $tripStatus == 'Unsettled')) {
				$timeToBeCompared = "'".date('Y-m-d H:i:s')."'";
			} else if(($tripStatus != 'undefined') && ($tripStatus != '') && ($tripStatus == 'Settled' || $tripStatus == 'Closed' || $tripStatus == 'Cancelled')){
				$timeToBeCompared = '`'.$dbPrefix.$dbTables['tripTable'].'`.`updated_at`';
			} 

			if($timePeriod == '<12') {
				if($timeToBeCompared != '') {
					$records = $records->where(DB::raw('TIME_TO_SEC(TIMEDIFF('.$timeToBeCompared.',`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<',12);
				} else {
					$records =  $records->where(function($query) use ($dbPrefix,$dbTables) {
			                    $query->where(DB::raw('TIME_TO_SEC(TIMEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<',12)
			                          ->whereIn($dbTables['tripTable'].'.trip_status',array('Awaiting','Running','Unsettled'));
			                })
			                ->orWhere(function($query) use ($dbPrefix,$dbTables) {
			                    $query->where(DB::raw('TIME_TO_SEC(TIMEDIFF(`'.$dbPrefix.$dbTables['tripTable'].'`.`updated_at`,`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<',12)
			                          ->whereIn($dbTables['tripTable'].'.trip_status',array('Settled','Closed','Cancelled'));			                    
			                });
			    }

			} else if ($timePeriod == '12TO24') { 
				
				if($timeToBeCompared != '') {
					$records = $records->where(DB::raw('TIME_TO_SEC(TIMEDIFF('.$timeToBeCompared.',`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>=',12)->where(DB::raw('TIME_TO_SEC(TIMEDIFF('.$timeToBeCompared.',`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<=',24);
				} else {
			  		$records =  $records->where(function($query) use ($dbPrefix,$dbTables) {
			                    $query->where(DB::raw('TIME_TO_SEC(TIMEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>=',12)
			                        ->where(DB::raw('TIME_TO_SEC(TIMEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<=',24)
			                        ->whereIn($dbTables['tripTable'].'.trip_status',array('Awaiting','Running','Unsettled'));
			                })
			                ->orWhere(function($query) use ($dbPrefix,$dbTables) {
			                    $query->where(DB::raw('TIME_TO_SEC(TIMEDIFF(`'.$dbPrefix.$dbTables['tripTable'].'`.`updated_at`,`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>=',12)
			                    	->where(DB::raw('TIME_TO_SEC(TIMEDIFF(`'.$dbPrefix.$dbTables['tripTable'].'`.`updated_at`,`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<=',12)
			                        ->whereIn($dbTables['tripTable'].'.trip_status',array('Settled','Closed','Cancelled'));			                    
			                });	
			    }
			} else if($timePeriod == '24TO36') {
				if($timeToBeCompared != '') {
					$records = $records->where(DB::raw('TIME_TO_SEC(TIMEDIFF('.$timeToBeCompared.',`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>=',24)->where(DB::raw('TIME_TO_SEC(TIMEDIFF('.$timeToBeCompared.',`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<=',36);
				} else {
    				$records =  $records->where(function($query) use ($dbPrefix,$dbTables) {
			                    $query->where(DB::raw('TIME_TO_SEC(TIMEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>=',24)
			                        ->where(DB::raw('TIME_TO_SEC(TIMEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<=',36)
			                        ->whereIn($dbTables['tripTable'].'.trip_status',array('Awaiting','Running','Unsettled'));
			                })
			                ->orWhere(function($query) use ($dbPrefix,$dbTables) {
			                    $query->where(DB::raw('TIME_TO_SEC(TIMEDIFF(`'.$dbPrefix.$dbTables['tripTable'].'`.`updated_at`,`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>=',24)
			                    	->where(DB::raw('TIME_TO_SEC(TIMEDIFF(`'.$dbPrefix.$dbTables['tripTable'].'`.`updated_at`,`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<=',36)
			                        ->whereIn($dbTables['tripTable'].'.trip_status',array('Settled','Closed','Cancelled'));			                    
			                });	
			        }

			} else if ($timePeriod == '>36') {
				if($timeToBeCompared != '') {
					$records = $records->where(DB::raw('TIME_TO_SEC(TIMEDIFF('.$timeToBeCompared.',`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>',36);
				} else {
					$records =  $records->where(function($query) use ($dbPrefix,$dbTables) {
			                    $query->where(DB::raw('TIME_TO_SEC(TIMEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>',36)
			                          ->whereIn($dbTables['tripTable'].'.trip_status',array('Awaiting','Running','Unsettled'));
			                })
			                ->orWhere(function($query) use ($dbPrefix,$dbTables) {
			                    $query->where(DB::raw('TIME_TO_SEC(TIMEDIFF(`'.$dbPrefix.$dbTables['tripTable'].'`.`updated_at`,`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>',36)
			                          ->whereIn($dbTables['tripTable'].'.trip_status',array('Settled','Closed','Cancelled'));			                    
			                });
			    }
			}
		}
		/*========================================filter section=========================================*/


			$records = 	$records->orderBy($dbTables['tripTable'].'.'.$orderby,$ordertype)
						->skip(($currentPage-1)*$perPageRecord)
			            ->take($perPageRecord)
			            ->get()->toArray();


			for ($i=0; $i<sizeof($records); $i++) {
			    /*get 'closed by' value*/
				if ($records[$i]['trip_status'] == 'Completed') {
					$closedByName = User::select('full_name')->where('id',$records[$i]['closed_by'])->get()->toArray();
					$records[$i]['closedByName'] = $closedByName[0]['full_name'];
				} else {
					$records[$i]['closedByName'] = '-';
				}
			}            

			return $records;
	}



	/*****************************************************/
	# Trip Model             
	# Function name : totalTripReportRecords
	# Functionality: get total count of trip reports
	# Author : Sanchari Ghosh                                
	# Created Date : 18/03/2019                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$tripStatus,$company,$timePeriod,$dateRangeValue                              
	/*****************************************************/
	public static function totalTripReportRecords($dbTables,$tripStatus,$timePeriod,$company,$dateRangeValue) {

		$dbPrefix			= DB::getTablePrefix();
		
        $records = Trip::select($dbTables['tripTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['partyTable'].'.party_name',$dbTables['partyTable'].'.address_zone_id',$dbTables['addressZoneTable'].'.address',$dbTables['truckTable'].'.truck_no',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['vendorTable'].'.name  AS vendor_name',$dbTables['vendorTable'].'.contact_number',$dbTables['itemTable'].'.item_name',DB::raw('TIMEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ) AS timeDiff'),$dbTables['userTable'].'.full_name AS user_name')
			->join($dbTables['plantTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
			->join($dbTables['partyTable'], $dbTables['tripTable'].'.party_id', '=', $dbTables['partyTable'].'.id')
			->join($dbTables['truckTable'], $dbTables['tripTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
			->join($dbTables['petrolPumpTable'], $dbTables['tripTable'].'.petrol_pump_id', '=', $dbTables['petrolPumpTable'].'.id')
			->join($dbTables['vendorTable'], $dbTables['tripTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id')
			->join($dbTables['itemTable'], $dbTables['tripTable'].'.subcategory_id', '=', $dbTables['itemTable'].'.id')
			->join($dbTables['addressZoneTable'], $dbTables['partyTable'].'.address_zone_id', '=', $dbTables['addressZoneTable'].'.id')
			->join($dbTables['userTable'], $dbTables['tripTable'].'.created_by', '=', $dbTables['userTable'].'.id');

		if (\Auth::user()->user_role_id ==  \Config::get('constants.supervisorRoleId'))	 {
				$records = $records->join($dbTables['plantUserRelationTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantUserRelationTable'].'.plant_id')
					->where($dbTables['plantUserRelationTable'].'.user_id','=',\Auth::user()->id)
					->where($dbTables['plantUserRelationTable'].'.deleted_by','=',NULL);
		}


		/*========================================filter section=========================================*/
		if($tripStatus != 'undefined' && $tripStatus != ''){
			$records = $records->where($dbTables['tripTable'].'.trip_status', 'like', $tripStatus);
		}

		if($company != 'undefined' && $company != ''){
			$records = $records->where($dbTables['tripTable'].'.vendor_id', 'like', $company);
		}

		if($dateRangeValue != 'undefined' && $dateRangeValue != '') {
			$dateValue = explode('-',$dateRangeValue);

			$startDate = date('Y-m-d 00:00:00', strtotime(trim($dateValue[0]))); 
			$endDate = date('Y-m-d 23:59:59', strtotime(trim($dateValue[1])));

			$records = $records->where($dbTables['tripTable'].'.trip_date', '>=', $startDate)
							   ->where($dbTables['tripTable'].'.trip_date', '<=', $endDate);
		}

		/*filter on time period (If the trip status is 'Awaiting' or 'Running' or 'Unsettled' then the trip duration will be calculated on the basis of trip date & current datetime. If the trip status is 'Settled' or 'Closed' or 	'Cancelled' then the trip duration will be calculated on the basis of trip date & updated at.)*/
		if($timePeriod != '' && $timePeriod != 'undefined'){ 
			$timeToBeCompared = '';

			if(($tripStatus != 'undefined') && ($tripStatus != '') && ($tripStatus == 'Awaiting' || $tripStatus == 'Running' || $tripStatus == 'Unsettled')) {
				$timeToBeCompared = "'".date('Y-m-d H:i:s')."'";
			} else if(($tripStatus != 'undefined') && ($tripStatus != '') && ($tripStatus == 'Settled' || $tripStatus == 'Closed' || $tripStatus == 'Cancelled')){
				$timeToBeCompared = '`'.$dbPrefix.$dbTables['tripTable'].'`.`updated_at`';
			} 

			if($timePeriod == '<12') {
				if($timeToBeCompared != '') {
					$records = $records->where(DB::raw('TIME_TO_SEC(TIMEDIFF('.$timeToBeCompared.',`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<',12);
				} else {
					$records =  $records->where(function($query) use ($dbPrefix,$dbTables) {
			                    $query->where(DB::raw('TIME_TO_SEC(TIMEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<',12)
			                          ->whereIn($dbTables['tripTable'].'.trip_status',array('Awaiting','Running','Unsettled'));
			                })
			                ->orWhere(function($query) use ($dbPrefix,$dbTables) {
			                    $query->where(DB::raw('TIME_TO_SEC(TIMEDIFF(`'.$dbPrefix.$dbTables['tripTable'].'`.`updated_at`,`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<',12)
			                          ->whereIn($dbTables['tripTable'].'.trip_status',array('Settled','Closed','Cancelled'));			                    
			                });
			    }

			} else if ($timePeriod == '12TO24') { 
				
				if($timeToBeCompared != '') {
					$records = $records->where(DB::raw('TIME_TO_SEC(TIMEDIFF('.$timeToBeCompared.',`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>=',12)->where(DB::raw('TIME_TO_SEC(TIMEDIFF('.$timeToBeCompared.',`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<=',24);
				} else {
			  		$records =  $records->where(function($query) use ($dbPrefix,$dbTables) {
			                    $query->where(DB::raw('TIME_TO_SEC(TIMEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>=',12)
			                        ->where(DB::raw('TIME_TO_SEC(TIMEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<=',24)
			                        ->whereIn($dbTables['tripTable'].'.trip_status',array('Awaiting','Running','Unsettled'));
			                })
			                ->orWhere(function($query) use ($dbPrefix,$dbTables) {
			                    $query->where(DB::raw('TIME_TO_SEC(TIMEDIFF(`'.$dbPrefix.$dbTables['tripTable'].'`.`updated_at`,`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>=',12)
			                    	->where(DB::raw('TIME_TO_SEC(TIMEDIFF(`'.$dbPrefix.$dbTables['tripTable'].'`.`updated_at`,`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<=',12)
			                        ->whereIn($dbTables['tripTable'].'.trip_status',array('Settled','Closed','Cancelled'));			                    
			                });	
			    }
			} else if($timePeriod == '24TO36') {
				if($timeToBeCompared != '') {
					$records = $records->where(DB::raw('TIME_TO_SEC(TIMEDIFF('.$timeToBeCompared.',`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>=',24)->where(DB::raw('TIME_TO_SEC(TIMEDIFF('.$timeToBeCompared.',`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<=',36);
				} else {
    				$records =  $records->where(function($query) use ($dbPrefix,$dbTables) {
			                    $query->where(DB::raw('TIME_TO_SEC(TIMEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>=',24)
			                        ->where(DB::raw('TIME_TO_SEC(TIMEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<=',36)
			                        ->whereIn($dbTables['tripTable'].'.trip_status',array('Awaiting','Running','Unsettled'));
			                })
			                ->orWhere(function($query) use ($dbPrefix,$dbTables) {
			                    $query->where(DB::raw('TIME_TO_SEC(TIMEDIFF(`'.$dbPrefix.$dbTables['tripTable'].'`.`updated_at`,`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>=',24)
			                    	->where(DB::raw('TIME_TO_SEC(TIMEDIFF(`'.$dbPrefix.$dbTables['tripTable'].'`.`updated_at`,`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'<=',36)
			                        ->whereIn($dbTables['tripTable'].'.trip_status',array('Settled','Closed','Cancelled'));			                    
			                });	
			        }

			} else if ($timePeriod == '>36') {
				if($timeToBeCompared != '') {
					$records = $records->where(DB::raw('TIME_TO_SEC(TIMEDIFF('.$timeToBeCompared.',`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>',36);
				} else {
					$records =  $records->where(function($query) use ($dbPrefix,$dbTables) {
			                    $query->where(DB::raw('TIME_TO_SEC(TIMEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>',36)
			                          ->whereIn($dbTables['tripTable'].'.trip_status',array('Awaiting','Running','Unsettled'));
			                })
			                ->orWhere(function($query) use ($dbPrefix,$dbTables) {
			                    $query->where(DB::raw('TIME_TO_SEC(TIMEDIFF(`'.$dbPrefix.$dbTables['tripTable'].'`.`updated_at`,`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ))/3600 '),'>',36)
			                          ->whereIn($dbTables['tripTable'].'.trip_status',array('Settled','Closed','Cancelled'));			                    
			                });
			    }
			}
		}
		/*========================================filter section=========================================*/

		
		
		$records = 	$records->orderBy($dbTables['tripTable'].'.id','ASC')
            		->get();
            		
        $recordsCount = $records->count();

		return $recordsCount;
	}




	/*****************************************************/
	# Trip Model             
	# Function name : getPaymentReport
	# Functionality: get payment report
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/04/2019                                
	# Purpose:  to view payment report  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$company
	/*****************************************************/
	public static function getPaymentReport($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$company) {
			$dbPrefix			= DB::getTablePrefix();
			$totalBalance = 0;

			$records = Trip::select($dbTables['tripTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['partyTable'].'.party_name',$dbTables['partyTable'].'.address_zone_id',$dbTables['addressZoneTable'].'.address',$dbTables['truckTable'].'.truck_no',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['vendorTable'].'.name  AS vendor_name',$dbTables['vendorTable'].'.contact_number',$dbTables['itemTable'].'.item_name',DB::raw('TIMEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ) AS timeDiff'),$dbTables['tripPaymentTable'].'.freight_charge',$dbTables['tripPaymentTable'].'.toll',$dbTables['tripPaymentTable'].'.unloading_charge',$dbTables['tripPaymentTable'].'.tare_charge',$dbTables['tripPaymentTable'].'.rate',$dbTables['tripPaymentTable'].'.short_bag_amount' )
				->join($dbTables['plantTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
				->join($dbTables['partyTable'], $dbTables['tripTable'].'.party_id', '=', $dbTables['partyTable'].'.id')
				->join($dbTables['truckTable'], $dbTables['tripTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
				->join($dbTables['petrolPumpTable'], $dbTables['tripTable'].'.petrol_pump_id', '=', $dbTables['petrolPumpTable'].'.id')
				->join($dbTables['vendorTable'], $dbTables['tripTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id')
				->join($dbTables['itemTable'], $dbTables['tripTable'].'.subcategory_id', '=', $dbTables['itemTable'].'.id')
				->leftjoin($dbTables['tripPaymentTable'], $dbTables['tripTable'].'.id', '=', $dbTables['tripPaymentTable'].'.trip_id')
				->join($dbTables['addressZoneTable'], $dbTables['partyTable'].'.address_zone_id', '=', $dbTables['addressZoneTable'].'.id');


			if (\Auth::user()->user_role_id ==  \Config::get('constants.supervisorRoleId'))	 {
				$records = $records->join($dbTables['plantUserRelationTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantUserRelationTable'].'.plant_id')
					->where($dbTables['plantUserRelationTable'].'.user_id','=',\Auth::user()->id)
					->where($dbTables['plantUserRelationTable'].'.deleted_by','=',NULL);
			}

			/*========================================filter section=========================================*/
				if($company != 'undefined' && $company != ''){
					$records = $records->where($dbTables['tripTable'].'.vendor_id', 'like', $company);
				}
			/*========================================filter section=========================================*/

			$records = 	$records->orderBy($dbTables['tripTable'].'.'.$orderby,$ordertype)
						->skip(($currentPage-1)*$perPageRecord)
			            ->take($perPageRecord)
			            ->get()->toArray();

			/*calculating freight charge and balance for report*/   
			for ($i=0; $i<sizeof($records);$i++) {
				$records[$i]['serial_no'] = $i+1;

				$unloadingCharge = ($records[$i]['unloading_charge'] == null) ? 0 : $records[$i]['unloading_charge'];
				$tareCharge = ($records[$i]['tare_charge'] == null) ? 0 : $records[$i]['tare_charge'];
				$tollCharge = ($records[$i]['toll'] == null) ? 0 : $records[$i]['toll'];
				$rate = ($records[$i]['rate'] == null) ? 0 : $records[$i]['rate'];
				$shortBags = ($records[$i]['short_bag_amount'] == null) ? 0 : $records[$i]['short_bag_amount'];

				$records[$i]['freight'] = ($records[$i]['quantity'] * $rate) + $unloadingCharge + $tollCharge + $tareCharge;
				$records[$i]['payment_balance'] = $records[$i]['freight'] - $records[$i]['advance_amount'] - $records[$i]['diesel_amount'] - $shortBags;


				$totalBalance += $records[$i]['payment_balance'];
			}
			$records[0]['totalBalance'] = $totalBalance;

			/*calculate balance after deduction*/
			$challanExps = \Config::get('constants.challan_Exps');
			$tds = \Config::get('constants.tds');
			$balanceAfterDeduction = $totalBalance - (($challanExps) + (($totalBalance*$tds)/100));
			$records[0]['balanceAfterDeduction'] = $balanceAfterDeduction;
			$records[0]['totalBalance'] = $totalBalance;

			return $records;
	}



	/*****************************************************/
	# Trip Model             
	# Function name : totalPaymentReportRecords
	# Functionality: get total count of payment reports
	# Author : Sanchari Ghosh                                
	# Created Date : 03/04/2019                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$company                        
	/*****************************************************/
	public static function totalPaymentReportRecords($dbTables,$company) {

		$dbPrefix			= DB::getTablePrefix();
		
        $records = Trip::select($dbTables['tripTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['partyTable'].'.party_name',$dbTables['partyTable'].'.address_zone_id',$dbTables['addressZoneTable'].'.address',$dbTables['truckTable'].'.truck_no',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['vendorTable'].'.name  AS vendor_name',$dbTables['vendorTable'].'.contact_number',$dbTables['itemTable'].'.item_name',DB::raw('TIMEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date` ) AS timeDiff'),$dbTables['tripPaymentTable'].'.freight_charge',$dbTables['tripPaymentTable'].'.toll',$dbTables['tripPaymentTable'].'.unloading_charge',$dbTables['tripPaymentTable'].'.tare_charge',$dbTables['tripPaymentTable'].'.rate',$dbTables['tripPaymentTable'].'.short_bag_amount')
				->join($dbTables['plantTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
				->join($dbTables['partyTable'], $dbTables['tripTable'].'.party_id', '=', $dbTables['partyTable'].'.id')
				->join($dbTables['truckTable'], $dbTables['tripTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
				->join($dbTables['petrolPumpTable'], $dbTables['tripTable'].'.petrol_pump_id', '=', $dbTables['petrolPumpTable'].'.id')
				->join($dbTables['vendorTable'], $dbTables['tripTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id')
				->join($dbTables['itemTable'], $dbTables['tripTable'].'.subcategory_id', '=', $dbTables['itemTable'].'.id')
				->leftjoin($dbTables['tripPaymentTable'], $dbTables['tripTable'].'.id', '=', $dbTables['tripPaymentTable'].'.trip_id')
				->join($dbTables['addressZoneTable'], $dbTables['partyTable'].'.address_zone_id', '=', $dbTables['addressZoneTable'].'.id');

		if (\Auth::user()->user_role_id ==  \Config::get('constants.supervisorRoleId'))	 {
				$records = $records->join($dbTables['plantUserRelationTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantUserRelationTable'].'.plant_id')
					->where($dbTables['plantUserRelationTable'].'.user_id','=',\Auth::user()->id)
					->where($dbTables['plantUserRelationTable'].'.deleted_by','=',NULL);
		}

		/*========================================filter section=========================================*/
				if($company != 'undefined' && $company != ''){
					$records = $records->where($dbTables['tripTable'].'.vendor_id', 'like', $company);
				}
		/*========================================filter section=========================================*/


		
		$records = 	$records->orderBy($dbTables['tripTable'].'.id','ASC')
            		->get();
            		
        $recordsCount = $records->count();

		return $recordsCount;
	}




	/*****************************************************/
	# Trip Model             
	# Function name : truckWiseTripRecords
	# Functionality: get Truck wise Trip list
	# Author : Sanchari Ghosh                                
	# Created Date : 15/05/2018                                
	# Purpose:  get Truck wise Trip list
	# Params : $dbTables,$truckId
	/*****************************************************/
	public static function truckWiseTripRecords($dbTables,$truckId,$startDate,$endDate) {
		$records = Trip::select($dbTables['tripTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['partyTable'].'.party_name',$dbTables['truckTable'].'.truck_no',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['categoryTable'].'.category_name',$dbTables['plantTable'].'.address_zone_id AS plant_address',$dbTables['partyTable'].'.party_name',$dbTables['partyTable'].'.address_zone_id AS party_address',$dbTables['tripPaymentTable'].'.rate')
			->join($dbTables['plantTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
			->join($dbTables['partyTable'], $dbTables['tripTable'].'.party_id', '=', $dbTables['partyTable'].'.id')
			->join($dbTables['truckTable'], $dbTables['tripTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
			->join($dbTables['petrolPumpTable'], $dbTables['tripTable'].'.petrol_pump_id', '=', $dbTables['petrolPumpTable'].'.id')
			->join($dbTables['categoryTable'], $dbTables['tripTable'].'.category_id', '=', $dbTables['categoryTable'].'.id')
			->leftjoin($dbTables['tripPaymentTable'], $dbTables['tripTable'].'.id', '=', $dbTables['tripPaymentTable'].'.trip_id')
			->where($dbTables['tripTable'].'.truck_id',$truckId);

		if ($startDate !== '1970-01-01'){
			$records = $records->where($dbTables['tripTable'].'.trip_date', '>=', $startDate);
		}

		if ($endDate !== '1970-01-01'){
			$records = $records->where($dbTables['tripTable'].'.trip_date', '<=', $endDate);
		}

		/*for supervisor show only his/her trip*/		
		if (\Auth::user()->user_role_id ==  \Config::get('constants.supervisorRoleId'))	 {
				$records = $records->where($dbTables['plantTable'].'.supervisor_id', '=', \Auth::user()->id);
		}
	
		
		$records = 	$records->orderBy($dbTables['tripTable'].'.id','ASC')
            		->get();
            		

		return $records;
	}
}

?>