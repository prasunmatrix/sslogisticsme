<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PetrolPumpJournalLaser;
use Session;


/*****************************************************/
# PetrolPump Model             
# Class name : PetrolPump
# Functionality: listing of petrolPumps
# Author : Sanchari Ghosh                                 
# Created Date :  09/08/2018                                
# Purpose: Developing the functionality of listing of petrolPumps
/*****************************************************/
class PetrolPump extends Model {
	use SoftDeletes;
	
	protected $table = 'petrol_pumps';
	protected $guarded 	= ['id'];
    protected $fillable = ['petrol_pump_name','address_zone_id','contact_number','contact_email','contact_person','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

	protected $dates    = ['deleted_at'];


    /*****************************************************/
	# PetrolPump Model             
	# Function name : availableRecords
	# Functionality: view PetrolPump listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 09/08/2018                                
	# Purpose:  to view petrolPump listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword      
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {
		
		$records = PetrolPump::select($dbTables['petrolPumpTable'].'.id',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['petrolPumpTable'].'.address_zone_id',$dbTables['petrolPumpTable'].'.contact_number',$dbTables['petrolPumpTable'].'.contact_email',$dbTables['petrolPumpTable'].'.contact_person',$dbTables['petrolPumpTable'].'.status',$dbTables['petrolPumpTable'].'.updated_at',$dbTables['addressZoneTable'].'.address',$dbTables['petrolPumpTable'].'.created_by')
			->join($dbTables['addressZoneTable'], $dbTables['petrolPumpTable'].'.address_zone_id', '=', $dbTables['addressZoneTable'].'.id');

			// if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) { /*for supervisor*/
		 //    	$records = $records->where($dbTables['petrolPumpTable'].'.created_by', \Auth::user()->id);
			// } 

			if($searchKeyword != ''){
				/*if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')){
			    	$records = $records->where($dbTables['petrolPumpTable'].'.created_by', \Auth::user()->id)
			    					    ->where(function ($query) use ($dbTables,$searchKeyword) {
							                $query->where($dbTables['petrolPumpTable'].'.petrol_pump_name', 'like', '%'.$searchKeyword.'%')
							                	  ->orWhere($dbTables['petrolPumpTable'].'.contact_number', 'like', '%'.$searchKeyword.'%')
							                	  ->orWhere($dbTables['petrolPumpTable'].'.contact_email', 'like', '%'.$searchKeyword.'%')
							                	  ->orWhere($dbTables['petrolPumpTable'].'.contact_person', 'like', '%'.$searchKeyword.'%')
							                	  ->orWhere($dbTables['addressZoneTable'].'.address','like', '%'.$searchKeyword.'%');
							            });
				} else { */
					$records = $records->where($dbTables['petrolPumpTable'].'.petrol_pump_name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['petrolPumpTable'].'.contact_number', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['petrolPumpTable'].'.contact_email', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['petrolPumpTable'].'.contact_person', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['addressZoneTable'].'.address','like', '%'.$searchKeyword.'%');
				//}
							
				$currentPage = 1;
			}
			$records = 	$records->orderBy($dbTables['petrolPumpTable'].'.'.$orderby,$ordertype)
						->skip(($currentPage-1)*$perPageRecord)
            			->take($perPageRecord)
						->get()->toArray();

			for ($i=0; $i<sizeof($records); $i++) {			
				if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')){	/*for supervisor*/
					if ($records[$i]['created_by'] == \Auth::user()->id) { /*for records created by current user*/
						$records[$i]['canEditDelete'] = true;
					} else {
						$records[$i]['canEditDelete'] = false;
					}
				} else {
					$records[$i]['canEditDelete'] = true;
				}		
			} 	

		return $records;
	}


	

	/*****************************************************/
	# PetrolPump Model             
	# Function name : totalRecords
	# Functionality: get total count of PetrolPump
	# Author : Debamala Dey                                
	# Created Date : 22/08/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                                         
	/*****************************************************/
	public static function totalRecords($dbTables,$searchKeyword) {
		
		$records = PetrolPump::select($dbTables['petrolPumpTable'].'.id',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['petrolPumpTable'].'.address_zone_id',$dbTables['petrolPumpTable'].'.contact_number',$dbTables['petrolPumpTable'].'.contact_email',$dbTables['petrolPumpTable'].'.contact_person',$dbTables['petrolPumpTable'].'.status',$dbTables['petrolPumpTable'].'.updated_at',$dbTables['addressZoneTable'].'.address',$dbTables['petrolPumpTable'].'.created_by')
			->join($dbTables['addressZoneTable'], $dbTables['petrolPumpTable'].'.address_zone_id', '=', $dbTables['addressZoneTable'].'.id');

			if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) { /*for supervisor*/
		    	//$records = $records->where($dbTables['petrolPumpTable'].'.created_by', \Auth::user()->id);
			} 

			if($searchKeyword != ''){
				/*if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')){ 
			    	$records = $records->where($dbTables['petrolPumpTable'].'.created_by', \Auth::user()->id)
			    					    ->where(function ($query) use ($dbTables,$searchKeyword) {
							                $query->where($dbTables['petrolPumpTable'].'.petrol_pump_name', 'like', '%'.$searchKeyword.'%')
							                	  ->orWhere($dbTables['petrolPumpTable'].'.contact_number', 'like', '%'.$searchKeyword.'%')
							                	  ->orWhere($dbTables['petrolPumpTable'].'.contact_email', 'like', '%'.$searchKeyword.'%')
							                	  ->orWhere($dbTables['petrolPumpTable'].'.contact_person', 'like', '%'.$searchKeyword.'%')
							                	  ->orWhere($dbTables['addressZoneTable'].'.address','like', '%'.$searchKeyword.'%');
							            });
				} else { */
					$records = $records->where($dbTables['petrolPumpTable'].'.petrol_pump_name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['petrolPumpTable'].'.contact_number', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['petrolPumpTable'].'.contact_email', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['petrolPumpTable'].'.contact_person', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['addressZoneTable'].'.address','like', '%'.$searchKeyword.'%');
				//}
			}

			$records = 	$records->orderBy($dbTables['petrolPumpTable'].'.id','ASC')
            			->get();

        $recordsCount = $records->count();

		return $recordsCount;
	}



	/*****************************************************/
	# PetrolPump Model             
	# Function name : getDieselReport
	# Functionality: get diesel report
	# Author : Sanchari Ghosh                                 
	# Created Date : 04/04/2019                                
	# Purpose:  to view diesel report  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$petrolPump,$dateRangeValue
	/*****************************************************/
	public static function getDieselReport($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$petrolPump,$dateRangeValue) {

			$balance = 0; /*for calculating balance*/
			$totalPayment = 0; /*for calculating total payment*/
			$totalPurchase = 0; /*for calculating total purchase*/
			$balanceFirstDay = '';
			
		    $records = PetrolPumpJournalLaser::select($dbTables['petrolPumpJournalLaserTable'].'.*',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['tripTable'].'.id AS trip_id',$dbTables['truckTable'].'.truck_no',$dbTables['vendorTable'].'.name AS vendor_name',$dbTables['vendorTable'].'.contact_person',$dbTables['plantTable'].'.name AS plant_name')
			    ->join($dbTables['petrolPumpTable'], $dbTables['petrolPumpJournalLaserTable'].'.petrol_pump_id', '=', $dbTables['petrolPumpTable'].'.id')
				->leftjoin($dbTables['tripTable'], $dbTables['petrolPumpJournalLaserTable'].'.trip_id', '=', $dbTables['tripTable'].'.id')
				->leftjoin($dbTables['truckTable'], $dbTables['petrolPumpJournalLaserTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
				->leftjoin($dbTables['vendorTable'], $dbTables['tripTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id')
				->leftjoin($dbTables['plantTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantTable'].'.id');


			// if (\Auth::user()->user_role_id ==  \Config::get('constants.supervisorRoleId'))	 {
			// 	$records = $records->join($dbTables['plantUserRelationTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantUserRelationTable'].'.plant_id')
			// 	->where($dbTables['plantUserRelationTable'].'.user_id','=',\Auth::user()->id)
			// 	->where($dbTables['plantUserRelationTable'].'.deleted_by','=',NULL);
			// }

			/*================================== filter section =======================================*/	

				/*petrol pump name*/
			 	if($petrolPump != 'undefined' && $petrolPump != ''){
					$records = $records->where($dbTables['petrolPumpJournalLaserTable'].'.petrol_pump_id', 'like', $petrolPump);
				}


				/*date range*/
				if($dateRangeValue != 'undefined' && $dateRangeValue != '') {
					$dateValue = explode('-',$dateRangeValue);

					$startDate = date('Y-m-d 00:00:00', strtotime(trim($dateValue[0]))); 
					$endDate = date('Y-m-d 23:59:59', strtotime(trim($dateValue[1])));

					$records = $records->where($dbTables['petrolPumpJournalLaserTable'].'.created_at', '>=', $startDate)
									   ->where($dbTables['petrolPumpJournalLaserTable'].'.created_at', '<=', $endDate);


					/*calculate opening balance*/
					$pumpLaserCreditFirstDay 	= PetrolPumpJournalLaser::where('petrol_pump_id',$petrolPump)
																->where('created_at', '<=', $startDate)
																->where('type', '=', 'C')
																->where('status','A')
																->sum('amount');	
					$pumpLaserDebitFirstDay 	= PetrolPumpJournalLaser::where('petrol_pump_id',$petrolPump)
																->where('created_at', '<=', $startDate)
																->where('type', '=', 'D')
																->where('status','A')
																->sum('amount');	

					$balanceFirstDay = $pumpLaserCreditFirstDay - $pumpLaserDebitFirstDay;				   
				}

			/*================================== filter section =======================================*/


			$records = 	$records->orderBy($dbTables['petrolPumpJournalLaserTable'].'.'.$orderby,$ordertype)
						->skip(($currentPage-1)*$perPageRecord)
			            ->take($perPageRecord)
			            ->get()->toArray();

			for ($i=0; $i<sizeof($records); $i++) {
				if ($records[$i]['trip_id'] !== null) {
					$records[$i]['diesel_slip'] = 'DSL/SSLT000'.$records[$i]['trip_id'];
					$records[$i]['truck_owner'] = $records[$i]['vendor_name'].'( '.$records[$i]['contact_person'].' )';
					$records[$i]['purchase'] = $records[$i]['amount']; /*for view purpose*/
					$records[$i]['actualPurchase'] = $records[$i]['amount']; /*for calculating balance*/
					$records[$i]['actualPayment'] = 0;  /*for calculating balance*/
					$records[$i]['payment'] = '-'; /*for view purpose*/
				} else {
					$records[$i]['diesel_slip'] = '';
					$records[$i]['plant_name'] = 'HEAD OFFICE';

					if ($records[$i]['type'] == 'C') { /*if credited*/
						$records[$i]['truck_owner'] = 'Payment';
						$records[$i]['payment'] = $records[$i]['amount']; /*for view purpose*/
						$records[$i]['actualPayment'] = $records[$i]['amount']; /*for calculating balance*/
						$records[$i]['purchase'] = '-'; /*for view purpose*/
						$records[$i]['actualPurchase'] = 0; /*for calculating balance*/
					} else {
						$records[$i]['truck_owner'] = '';
					}
				}

				/*calculate balance for each row*/
				if($currentPage > 1) { /*for carry forward concept*/
					if($i == 0) {
						$balance = Session::get('carryforwardBalanceAmount');
					}
				}
				$balance += $records[$i]['actualPayment'] - $records[$i]['actualPurchase'];
				$records[$i]['balance'] = $balance;
				$totalPayment += $records[$i]['actualPayment'];
				$totalPurchase += $records[$i]['actualPurchase'];
			}   

			$totalRecordLength = sizeof($records);

			$records[0]['totalPayment']  = $totalPayment;
			$records[0]['totalPurchase'] = $totalPurchase;
			$records[0]['pumpName'] 	 = isset($records[0]['petrol_pump_name']) ? $records[0]['petrol_pump_name']:'' ;

			/*carry forward calculation*/
			if($currentPage == 1) {
				$records[0]['remainingBalance'] = $totalPayment - $totalPurchase;
				Session::put('carryforwardBalanceAmount',$records[$totalRecordLength-1]['balance']) ;
				$records[0]['carryForwardBalance'] 	= ($balanceFirstDay == '') ? '0' :$balanceFirstDay ;
			} else {
				$records[0]['remainingBalance'] = $totalPayment - $totalPurchase;
				$records[0]['carryForwardBalance'] 	= Session::get('carryforwardBalanceAmount');
				Session::put('carryforwardBalanceAmount', $records[$totalRecordLength-1]['balance']);
			}
			
		
			return $records;
	}



	/*****************************************************/
	# PetrolPump Model             
	# Function name : totalDieselReportRecords
	# Functionality: get count of diesel report
	# Author : Sanchari Ghosh                                 
	# Created Date : 04/04/2019                                
	# Purpose:  to view count of diesel report  
	# Params :  $dbTables,petrolPump,$dateRangeValue
	/*****************************************************/
	public static function totalDieselReportRecords($dbTables,$petrolPump,$dateRangeValue) {

			$records = PetrolPumpJournalLaser::select($dbTables['petrolPumpJournalLaserTable'].'.*',$dbTables['petrolPumpTable'].'.petrol_pump_name',$dbTables['tripTable'].'.id AS trip_id',$dbTables['truckTable'].'.truck_no',$dbTables['vendorTable'].'.name AS vendor_name',$dbTables['vendorTable'].'.contact_person',$dbTables['plantTable'].'.name AS plant_name')
			    ->join($dbTables['petrolPumpTable'], $dbTables['petrolPumpJournalLaserTable'].'.petrol_pump_id', '=', $dbTables['petrolPumpTable'].'.id')
				->leftjoin($dbTables['tripTable'], $dbTables['petrolPumpJournalLaserTable'].'.trip_id', '=', $dbTables['tripTable'].'.id')
				->leftjoin($dbTables['truckTable'], $dbTables['petrolPumpJournalLaserTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
				->leftjoin($dbTables['vendorTable'], $dbTables['tripTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id')
				->leftjoin($dbTables['plantTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantTable'].'.id');


				// if (\Auth::user()->user_role_id ==  \Config::get('constants.supervisorRoleId'))	 {
				// 	$records = $records->join($dbTables['plantUserRelationTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantUserRelationTable'].'.plant_id')
				// 	->where($dbTables['plantUserRelationTable'].'.user_id','=',\Auth::user()->id)
				// 	->where($dbTables['plantUserRelationTable'].'.deleted_by','=',NULL);
				// }

			/*================================== filter section =======================================*/	

				/*plant name*/
			 	if($petrolPump != 'undefined' && $petrolPump != ''){
					$records = $records->where($dbTables['petrolPumpJournalLaserTable'].'.petrol_pump_id', 'like', $petrolPump);
				}


				/*date range*/
				if($dateRangeValue != 'undefined' && $dateRangeValue != '') {
					$dateValue = explode('-',$dateRangeValue);

					$startDate = date('Y-m-d 00:00:00', strtotime(trim($dateValue[0]))); 
					$endDate = date('Y-m-d 23:59:59', strtotime(trim($dateValue[1])));

					$records = $records->where($dbTables['petrolPumpJournalLaserTable'].'.created_at', '>=', $startDate)
									   ->where($dbTables['petrolPumpJournalLaserTable'].'.created_at', '<=', $endDate);
				}

			/*================================== filter section =======================================*/


			$records = 	$records->orderBy($dbTables['petrolPumpJournalLaserTable'].'.id','ASC')
			            ->get();

			$recordsCount = $records->count();

			return $recordsCount;            
	}
}

?>