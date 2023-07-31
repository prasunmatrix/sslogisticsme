<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;



/*****************************************************/
# Vendor Model             
# Class name : Vendor
# Functionality: listing of vendors
# Author : Sanchari Ghosh                                 
# Created Date :  24/12/2018                                
# Purpose: Developing the functionality of listing of vendors
/*****************************************************/
class Vendor extends Model {
	use SoftDeletes;

	protected $table = 'vendors';
	protected $guarded 	= ['id'];
    protected $fillable = ['name','contact_number','contact_email','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

    protected $dates    = ['deleted_at'];


    /*****************************************************/
	# Vendor Model             
	# Function name : availableRecords
	# Functionality: view vendor listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 24/12/2018                                
	# Purpose:  to view vendor listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword                    
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {
		
		$records = Vendor::select($dbTables['vendorTable'].'.id',$dbTables['vendorTable'].'.name',$dbTables['vendorTable'].'.contact_number',$dbTables['vendorTable'].'.contact_email',$dbTables['vendorTable'].'.status',$dbTables['vendorTable'].'.updated_at');

			if($searchKeyword != ''){
				$records = $records->where($dbTables['vendorTable'].'.name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['vendorTable'].'.contact_number', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['vendorTable'].'.contact_email', 'like', '%'.$searchKeyword.'%');
				$currentPage = 1;
			}
			$records = 	$records->orderBy($dbTables['vendorTable'].'.'.$orderby,$ordertype)
						->skip(($currentPage-1)*$perPageRecord)
			            ->take($perPageRecord)
						->get();

		return $records;
	}



	/*****************************************************/
	# Vendor Model             
	# Function name : totalRecords
	# Functionality: get total count of vendor
	# Author : Debamala Dey                                
	# Created Date : 22/08/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                                         
	/*****************************************************/
	public static function totalRecords($dbTables,$searchKeyword) {
		
		$records = Vendor::select($dbTables['vendorTable'].'.id',$dbTables['vendorTable'].'.name',$dbTables['vendorTable'].'.contact_number',$dbTables['vendorTable'].'.contact_email',$dbTables['vendorTable'].'.status',$dbTables['vendorTable'].'.updated_at');

			if($searchKeyword != ''){
				$records = $records->where($dbTables['vendorTable'].'.name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['vendorTable'].'.contact_number', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['vendorTable'].'.contact_email', 'like', '%'.$searchKeyword.'%');
			}

			$records = 	$records->orderBy($dbTables['vendorTable'].'.id','ASC')
						->get();

		$recordsCount = $records->count();

		return $recordsCount;
	}


	/*****************************************************/
	# Vendor Model             
	# Function name : getAllVendorList
	# Functionality: view vendor listing for trucks
	# Author : Sanchari Ghosh                                 
	# Created Date : 27/12/2018                                
	# Purpose:  to view vendor listing for trucks  
	# Params : $dbTables                     
	/*****************************************************/
	public static function getAllVendorList($dbTables) {
		
		$records = Vendor::select($dbTables['vendorTable'].'.id',$dbTables['vendorTable'].'.name')->where($dbTables['vendorTable'].'.status','A')->get();

		return $records;
	}




	/*****************************************************/
	# Vendor Model             
	# Function name : getCustomerReport
	# Functionality: get customer report
	# Author : Sanchari Ghosh                                 
	# Created Date : 01/04/2019                                
	# Purpose:  to view customer report  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$challanStatus,$pendingPeriod,$company,$dateRangeValue
	/*****************************************************/
	public static function getCustomerReport($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$challanStatus,$pendingPeriod,$company,$dateRangeValue) {

		    $dbPrefix			= DB::getTablePrefix();
		    $totalQuantity = 0;
			$noOfTrips = 0;

			$records = Trip::select($dbTables['tripTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['partyTable'].'.party_name',$dbTables['partyTable'].'.address_zone_id',$dbTables['addressZoneTable'].'.address',$dbTables['truckTable'].'.truck_no',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['vendorTable'].'.name  AS vendor_name',$dbTables['vendorTable'].'.contact_number',$dbTables['itemTable'].'.item_name',$dbTables['userTable'].'.full_name AS user_name')
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



			/*================================== filter section =======================================*/	

				/*customer name*/
			 	if($company != 'undefined' && $company != ''){
					$records = $records->where($dbTables['tripTable'].'.vendor_id', 'like', $company);
				}

				/*challan status*/
				if($challanStatus != 'undefined' && $challanStatus != ''){
					if ($challanStatus != 'All') {
						if ($challanStatus == 'No') {
							$records = $records->where($dbTables['tripTable'].'.POD_status', 'like', 'No');
						} else {
							$records = $records->where($dbTables['tripTable'].'.current_challan_status', 'like', $challanStatus);
						}
					}
					
				}

				/*date range*/
				if($dateRangeValue != 'undefined' && $dateRangeValue != '') {
					$dateValue = explode('-',$dateRangeValue);

					$startDate = date('Y-m-d 00:00:00', strtotime(trim($dateValue[0]))); 
					$endDate = date('Y-m-d 23:59:59', strtotime(trim($dateValue[1])));

					$records = $records->where($dbTables['tripTable'].'.trip_date', '>=', $startDate)
									   ->where($dbTables['tripTable'].'.trip_date', '<=', $endDate);
				}


				/*pending since*/
				if($pendingPeriod != 'undefined' && $pendingPeriod != ''){ 
					if ($pendingPeriod != 'all') {

						if($pendingPeriod == '<30') {
							$records = $records->where(DB::raw('DATEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date`) '),'<',30)->where($dbTables['tripTable'].'.POD_status','like', 'No');
						} else if($pendingPeriod == '30TO90') {
							$records = $records->where(DB::raw('DATEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date`) '),'>=',30)->where(DB::raw('DATEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date`) '),'<=',90)->where($dbTables['tripTable'].'.POD_status','like', 'No');
						} else if($pendingPeriod == '>90') {
							$records = $records->where(DB::raw('DATEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date`) '),'>',90)->where($dbTables['tripTable'].'.POD_status','like', 'No');
						}
					}
				}

			/*================================== filter section =======================================*/

			$records = 	$records->orderBy($dbTables['tripTable'].'.'.$orderby,$ordertype)
						->skip(($currentPage-1)*$perPageRecord)
			            ->take($perPageRecord)
			            ->get()->toArray();


			for ($i=0; $i<sizeof($records); $i++) {
				if ($records[$i]['POD_status'] == 'No') {
					$date1 = date_create($records[$i]['trip_date']);
					$date2 = date_create(date('Y-m-d H:i:s'));
					$diff  = date_diff($date1,$date2);	
					$records[$i]['pending_since'] = $diff->format("%a Day(s)");
				} else {
					$records[$i]['pending_since'] = '';
				}


				if($records[$i]['current_challan_status'] !== NULL) {
					$records[$i]['podFileStatus'] = $records[$i]['current_challan_status'];
				} else {
					$records[$i]['podFileStatus'] = '';
				}


				$totalQuantity += $records[$i]['quantity'];
				$noOfTrips += 1;


				/*get 'closed by' value*/
				if ($records[$i]['trip_status'] == 'Completed') {
					$closedByName = User::select('full_name')->where('id',$records[$i]['closed_by'])->get()->toArray();
					$records[$i]['closedByName'] = $closedByName[0]['full_name'];
				} else {
					$records[$i]['closedByName'] = '-';
				}
				
			}
			$records[0]['totalQuantity'] = $totalQuantity;
			$records[0]['noOfTrips'] 	 = $noOfTrips;
			return $records;
	}



	/*****************************************************/
	# Vendor Model             
	# Function name : totalCustomerReportRecords
	# Functionality: get count of customer report
	# Author : Sanchari Ghosh                                 
	# Created Date : 01/04/2019                                
	# Purpose:  to view count of customer report  
	# Params :  $dbTables,$challanStatus,$pendingPeriod,$company,$dateRangeValue
	/*****************************************************/
	public static function totalCustomerReportRecords($dbTables,$challanStatus,$pendingPeriod,$company,$dateRangeValue) {
			$dbPrefix			= DB::getTablePrefix();

			$records = Trip::select($dbTables['tripTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['partyTable'].'.party_name',$dbTables['partyTable'].'.address_zone_id',$dbTables['addressZoneTable'].'.address',$dbTables['truckTable'].'.truck_no',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['vendorTable'].'.name  AS vendor_name',$dbTables['vendorTable'].'.contact_number',$dbTables['itemTable'].'.item_name',$dbTables['userTable'].'.full_name AS user_name')
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

			/*================================== filter section =======================================*/	

				/*customer name*/
			 	if($company != 'undefined' && $company != ''){
					$records = $records->where($dbTables['tripTable'].'.vendor_id', 'like', $company);
				}

				/*challan status*/
				if($challanStatus != 'undefined' && $challanStatus != ''){

					if ($challanStatus != 'All') {
						if ($challanStatus == 'No') {
							$records = $records->where($dbTables['tripTable'].'.POD_status', 'like', 'No');
						} else {
							$records = $records->where($dbTables['tripTable'].'.current_challan_status', 'like', $challanStatus);
						}
					}
				}

				/*date range*/
				if($dateRangeValue != 'undefined' && $dateRangeValue != '') {
					$dateValue = explode('-',$dateRangeValue);

					$startDate = date('Y-m-d 00:00:00', strtotime(trim($dateValue[0]))); 
					$endDate = date('Y-m-d 23:59:59', strtotime(trim($dateValue[1])));

					$records = $records->where($dbTables['tripTable'].'.trip_date', '>=', $startDate)
									   ->where($dbTables['tripTable'].'.trip_date', '<=', $endDate);
				}


				/*pending since*/
				if($pendingPeriod != 'undefined' && $pendingPeriod != ''){ 
					if ($pendingPeriod != 'all') {

						if($pendingPeriod == '<30') {
							$records = $records->where(DB::raw('DATEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date`) '),'<',30)->where($dbTables['tripTable'].'.POD_status','like', 'No');
						} else if($pendingPeriod == '30TO90') {
							$records = $records->where(DB::raw('DATEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date`) '),'>=',30)->where(DB::raw('DATEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date`) '),'<=',90)->where($dbTables['tripTable'].'.POD_status','like', 'No');
						} else if($pendingPeriod == '>90') {
							$records = $records->where(DB::raw('DATEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date`) '),'>',90)->where($dbTables['tripTable'].'.POD_status','like', 'No');
						}
					}
				}

			/*================================== filter section =======================================*/


			$records = 	$records->orderBy($dbTables['tripTable'].'.id','ASC')
			            ->get();

			$recordsCount = $records->count();

			return $recordsCount;            
	}



	/*****************************************************/
	# Vendor Model             
	# Function name : getVendorReport
	# Functionality: get vendor report
	# Author : Sanchari Ghosh                                 
	# Created Date : 02/04/2019                                
	# Purpose:  to view vendor report  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$challanStatus, $pendingPeriod,$plant,$dateRangeValue
	/*****************************************************/
	public static function getVendorReport($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$challanStatus,$pendingPeriod,$plant,$dateRangeValue) {

		    $dbPrefix			= DB::getTablePrefix();

		    $totalQuantity = 0;
			$noOfTrips = 0;

			$records = Trip::select($dbTables['tripTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['partyTable'].'.party_name',$dbTables['partyTable'].'.address_zone_id',$dbTables['addressZoneTable'].'.address',$dbTables['truckTable'].'.truck_no',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['vendorTable'].'.name  AS vendor_name',$dbTables['vendorTable'].'.contact_number',$dbTables['itemTable'].'.item_name',$dbTables['userTable'].'.full_name AS user_name')
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

			/*================================== filter section =======================================*/	

				/*plant name*/
			 	if($plant != 'undefined' && $plant != ''){
					$records = $records->where($dbTables['tripTable'].'.plant_id', 'like', $plant);
				}

				/*challan status*/
				if($challanStatus != 'undefined' && $challanStatus != ''){
					if ($challanStatus != 'All') {
						if ($challanStatus == 'No') {
							$records = $records->where($dbTables['tripTable'].'.POD_status', 'like', 'No');
						} else {
							$records = $records->where($dbTables['tripTable'].'.current_challan_status', 'like', $challanStatus);
						}
					}
					
				}

				/*date range*/
				if($dateRangeValue != 'undefined' && $dateRangeValue != '') {
					$dateValue = explode('-',$dateRangeValue);

					$startDate = date('Y-m-d 00:00:00', strtotime(trim($dateValue[0]))); 
					$endDate = date('Y-m-d 23:59:59', strtotime(trim($dateValue[1])));

					$records = $records->where($dbTables['tripTable'].'.trip_date', '>=', $startDate)
									   ->where($dbTables['tripTable'].'.trip_date', '<=', $endDate);
				}


				/*pending since*/
				if($pendingPeriod != 'undefined' && $pendingPeriod != ''){ 
					if ($pendingPeriod != 'all') {
						if($pendingPeriod == '<30') {
							$records = $records->where(DB::raw('DATEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date`) '),'<',30)->where($dbTables['tripTable'].'.POD_status','like', 'No');
						} else if($pendingPeriod == '30TO90') {
							$records = $records->where(DB::raw('DATEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date`) '),'>=',30)->where(DB::raw('DATEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date`) '),'<=',90)->where($dbTables['tripTable'].'.POD_status','like', 'No');
						} else if($pendingPeriod == '>90') {
							$records = $records->where(DB::raw('DATEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date`) '),'>',90)->where($dbTables['tripTable'].'.POD_status','like', 'No');
						}
					}
					
				}

			/*================================== filter section =======================================*/


			$records = 	$records->orderBy($dbTables['tripTable'].'.'.$orderby,$ordertype)
						->skip(($currentPage-1)*$perPageRecord)
			            ->take($perPageRecord)
			            ->get()->toArray();


			for ($i=0; $i<sizeof($records); $i++) {
				if ($records[$i]['POD_status'] == 'No') {
					$date1 = date_create($records[$i]['trip_date']);
					$date2 = date_create(date('Y-m-d H:i:s'));
					$diff  = date_diff($date1,$date2);	
					$records[$i]['pending_since'] = $diff->format("%a Day(s)");
				} else {
					$records[$i]['pending_since'] = '';
				}


				if($records[$i]['current_challan_status'] !== NULL) {
					$records[$i]['podFileStatus'] = $records[$i]['current_challan_status'];
				} else {
					$records[$i]['podFileStatus'] = '';
				}


				$totalQuantity += $records[$i]['quantity'];
				$noOfTrips += 1;


				/*get 'closed by' value*/
				if ($records[$i]['trip_status'] == 'Completed') {
					$closedByName = User::select('full_name')->where('id',$records[$i]['closed_by'])->get()->toArray();
					$records[$i]['closedByName'] = $closedByName[0]['full_name'];
				} else {
					$records[$i]['closedByName'] = '-';
				}
				
			}
			$records[0]['totalQuantity'] = $totalQuantity;
			$records[0]['noOfTrips'] 	 = $noOfTrips;
			return $records;
	}



	/*****************************************************/
	# Vendor Model             
	# Function name : totalVendorReportRecords
	# Functionality: get count of vendor report
	# Author : Sanchari Ghosh                                 
	# Created Date : 02/04/2019                                
	# Purpose:  to view count of vendor report  
	# Params :  $dbTables,$challanStatus,$pendingPeriod,$plant,$dateRangeValue
	/*****************************************************/
	public static function totalVendorReportRecords($dbTables,$challanStatus,$pendingPeriod,$plant,$dateRangeValue) {
			$dbPrefix			= DB::getTablePrefix();

			$records = Trip::select($dbTables['tripTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['partyTable'].'.party_name',$dbTables['partyTable'].'.address_zone_id',$dbTables['addressZoneTable'].'.address',$dbTables['truckTable'].'.truck_no',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['vendorTable'].'.name  AS vendor_name',$dbTables['vendorTable'].'.contact_number',$dbTables['itemTable'].'.item_name',$dbTables['userTable'].'.full_name AS user_name')
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

			/*================================== filter section =======================================*/	

				/*plant name*/
			 	if($plant != 'undefined' && $plant != ''){
					$records = $records->where($dbTables['tripTable'].'.plant_id', 'like', $plant);
				}

				/*challan status*/
				if($challanStatus != 'undefined' && $challanStatus != ''){

					if ($challanStatus != 'All') {
						if ($challanStatus == 'No') {
							$records = $records->where($dbTables['tripTable'].'.POD_status', 'like', 'No');
						} else {
							$records = $records->where($dbTables['tripTable'].'.current_challan_status', 'like', $challanStatus);
						}
					}
					
				}

				/*date range*/
				if($dateRangeValue != 'undefined' && $dateRangeValue != '') {
					$dateValue = explode('-',$dateRangeValue);

					$startDate = date('Y-m-d 00:00:00', strtotime(trim($dateValue[0]))); 
					$endDate = date('Y-m-d 23:59:59', strtotime(trim($dateValue[1]))); 

					$records = $records->where($dbTables['tripTable'].'.trip_date', '>=', $startDate)
									   ->where($dbTables['tripTable'].'.trip_date', '<=', $endDate);
				}

				/*pending since*/
				if($pendingPeriod != 'undefined' && $pendingPeriod != ''){ 
					if ($pendingPeriod != 'all') {
						if($pendingPeriod == '<30') {
							$records = $records->where(DB::raw('DATEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date`) '),'<',30)->where($dbTables['tripTable'].'.POD_status','like', 'No');
						} else if($pendingPeriod == '30TO90') {
							$records = $records->where(DB::raw('DATEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date`) '),'>=',30)->where(DB::raw('DATEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date`) '),'<=',90)->where($dbTables['tripTable'].'.POD_status','like', 'No');
						} else if($pendingPeriod == '>90') {
							$records = $records->where(DB::raw('DATEDIFF("'.date('Y-m-d H:i:s').'",`'.$dbPrefix.$dbTables['tripTable'].'`.`trip_date`) '),'>',90)->where($dbTables['tripTable'].'.POD_status','like', 'No');
						}
					}
				}

			/*================================== filter section =======================================*/


			$records = 	$records->orderBy($dbTables['tripTable'].'.id','ASC')
			            ->get();

			$recordsCount = $records->count();

			return $recordsCount;            
	}

}

?>