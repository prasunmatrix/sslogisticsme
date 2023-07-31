<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PlantJournalLaser;
use Auth;
use Session;


/*****************************************************/
# Plant Model             
# Class name : Plant
# Functionality: listing of plants
# Author : Sanchari Ghosh                                 
# Created Date :  08/08/2018                                
# Purpose: Developing the functionality of listing of plants
/*****************************************************/
class Plant extends Model {
	use SoftDeletes;

	protected $table = 'plants';
	protected $guarded 	= ['id'];
    protected $fillable = ['address_zone_id','type','name','description','contact_number','contact_email','contact_person','balance_amount','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

    protected $dates    = ['deleted_at'];


    /*****************************************************/
	# Plant Model             
	# Function name : availableRecords
	# Functionality: view plant listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 08/08/2018                                
	# Purpose:  to view plant listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword                    
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {
		
		$records = Plant::select($dbTables['plantTable'].'.id',$dbTables['plantTable'].'.type',$dbTables['plantTable'].'.name',$dbTables['plantTable'].'.description',$dbTables['plantTable'].'.contact_number',$dbTables['plantTable'].'.contact_email',$dbTables['plantTable'].'.contact_person',$dbTables['plantTable'].'.balance_amount',$dbTables['plantTable'].'.status',$dbTables['plantTable'].'.updated_at',$dbTables['addressZoneTable'].'.address',$dbTables['plantTable'].'.created_by')
			->join($dbTables['addressZoneTable'], $dbTables['plantTable'].'.address_zone_id', '=', $dbTables['addressZoneTable'].'.id');

	    /*for supervisor show only his/her plant*/		
		//if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId'))	 {
			// $records->join($dbTables['plantUserRelationTable'], $dbTables['plantTable'].'.id', '=', $dbTables['plantUserRelationTable'].'.plant_id');
			// $records = $records->where($dbTables['plantUserRelationTable'].'.user_id', '=', \Auth::user()->id)
			// 				   ->where($dbTables['plantUserRelationTable'].'.is_deleted','N');
		//}

		if($searchKeyword != ''){
			/*if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) {
				$records = $records->where($dbTables['plantUserRelationTable'].'.user_id', '=', \Auth::user()->id)
								   ->where($dbTables['plantUserRelationTable'].'.is_deleted','N')
								   ->where(function ($query) use ($dbTables,$searchKeyword) {
							                $query->where($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%')
							   					  ->orWhere($dbTables['addressZoneTable'].'.address','like', '%'.$searchKeyword.'%');
							        });
			} else {*/
				$records = $records->where($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%')
							   ->orWhere($dbTables['addressZoneTable'].'.address','like', '%'.$searchKeyword.'%');
			//}	
			
			$currentPage = 1;				   
		}
		$records = 	$records->orderBy($dbTables['plantTable'].'.'.$orderby,$ordertype)
			->skip(($currentPage-1)*$perPageRecord)
            ->take($perPageRecord)
            ->get()->toArray();

        /*calculate balance*/
        for($i=0; $i<sizeof($records); $i++) {
        	$plantLaserCredit 	= PlantJournalLaser::where('plant_id',$records[$i]['id'])
													->where('created_at', '<=', date('Y-m-d 23:59:59'))
													->where('type', '=', 'C')
													->where('approval_status','Approved')
													->sum('amount');	
			$plantLaserDebit 	= PlantJournalLaser::where('plant_id',$records[$i]['id'])
													->where('created_at', '<=', date('Y-m-d 23:59:59'))
													->where('type', '=', 'D')
													->where('approval_status','Approved')
													->sum('amount');	

			$balance = $plantLaserCredit - $plantLaserDebit;  
			$records[$i]['actualBalance'] = $balance;
        }
		  
		return $records;
	}



	/*****************************************************/
	# Plant Model             
	# Function name : totalRecords
	# Functionality: get total count of plant
	# Author : Debamala Dey                                
	# Created Date : 23/08/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                                       
	/*****************************************************/
	public static function totalRecords($dbTables,$searchKeyword) {
		
		$records = Plant::select($dbTables['plantTable'].'.id',$dbTables['plantTable'].'.type',$dbTables['plantTable'].'.name',$dbTables['plantTable'].'.description',$dbTables['plantTable'].'.contact_number',$dbTables['plantTable'].'.contact_email',$dbTables['plantTable'].'.contact_person',$dbTables['plantTable'].'.balance_amount',$dbTables['plantTable'].'.status',$dbTables['plantTable'].'.updated_at',$dbTables['addressZoneTable'].'.address',$dbTables['plantTable'].'.created_by')
			->join($dbTables['addressZoneTable'], $dbTables['plantTable'].'.address_zone_id', '=', $dbTables['addressZoneTable'].'.id');

		/*for supervisor show only his/her plant*/		
		/*if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId'))	 {
			$records->join($dbTables['plantUserRelationTable'], $dbTables['plantTable'].'.id', '=', $dbTables['plantUserRelationTable'].'.plant_id');
			$records = $records->where($dbTables['plantUserRelationTable'].'.user_id', '=', \Auth::user()->id)
							   ->where($dbTables['plantUserRelationTable'].'.is_deleted','N');
		}*/

		if($searchKeyword != ''){
			/*if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) {
				$records = $records->where($dbTables['plantUserRelationTable'].'.user_id', '=', \Auth::user()->id)
								   ->where($dbTables['plantUserRelationTable'].'.is_deleted','N')
								   ->where(function ($query) use ($dbTables,$searchKeyword) {
							                $query->where($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%')
							   					  ->orWhere($dbTables['addressZoneTable'].'.address','like', '%'.$searchKeyword.'%');
							        });
			} else { */
				$records = $records->where($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%')
							   ->orWhere($dbTables['addressZoneTable'].'.address','like', '%'.$searchKeyword.'%');
			//}	
						   
		}
		$records = 	$records
			->orderBy($dbTables['plantTable'].'.id','ASC')
            ->get();
           
        $recordsCount = $records->count();

		return $recordsCount;
	}



	/*****************************************************/
	# Plant Model             
	# Function name : getCashReport
	# Functionality: get cash report
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/04/2019                                
	# Purpose:  to view cash report  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$plant,$dateRangeValue,$searchKeyword
	/*****************************************************/
	public static function getCashReport($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$plant,$dateRangeValue,$searchKeyword) {
			$balance = 0; /*for calculating balance*/
			$totalPayment = 0; /*for calculating total payment*/
			$totalPurchase = 0; /*for calculating total purchase*/
			$balanceFirstDay = '';
			$balanceLastDay = '';

		    $records = PlantJournalLaser::select($dbTables['plantJournalLaserTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['truckTable'].'.truck_no',$dbTables['tripTable'].'.id AS trip_id',$dbTables['truckTable'].'.truck_no',$dbTables['vendorTable'].'.name AS vendor_name',$dbTables['vendorTable'].'.account_holder_name')
				->join($dbTables['plantTable'], $dbTables['plantJournalLaserTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
				->leftjoin($dbTables['truckTable'], $dbTables['plantJournalLaserTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
				->leftjoin($dbTables['tripTable'], $dbTables['plantJournalLaserTable'].'.trip_id', '=', $dbTables['tripTable'].'.id')
				->leftjoin($dbTables['vendorTable'], $dbTables['tripTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id');


			if (\Auth::user()->user_role_id ==  \Config::get('constants.supervisorRoleId'))	 {
				$records = $records->join($dbTables['plantUserRelationTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantUserRelationTable'].'.plant_id')
				->where($dbTables['plantUserRelationTable'].'.user_id','=',\Auth::user()->id)
				->where($dbTables['plantUserRelationTable'].'.deleted_by','=',NULL);
			}

			/*================================== filter section =======================================*/	

				/*plant name*/
			 	if($plant != 'undefined' && $plant != ''){
					$records = $records->where($dbTables['plantJournalLaserTable'].'.plant_id', 'like', $plant);
				}


				/*date range*/
				if($dateRangeValue != 'undefined' && $dateRangeValue != '') {
					$dateValue = explode('-',$dateRangeValue);

					$startDate = date('Y-m-d 00:00:00', strtotime(trim($dateValue[0]))); 
					$endDate = date('Y-m-d 23:59:59', strtotime(trim($dateValue[1]))); 

					/*get the previous date*/
					$date = trim($dateValue[0]);
					$dayBefore = date('Y-m-d 23:59:59', strtotime( $date . ' -1 day' ) );

					$records = $records->where($dbTables['plantJournalLaserTable'].'.created_at','>=', $startDate)
									   ->where($dbTables['plantJournalLaserTable'].'.created_at', '<=', $endDate);
	
								   

				   /*opening and closing balance of specific period*/	

				   /*calculate opening balance*/
					$plantLaserCreditFirstDay 	= PlantJournalLaser::where('plant_id',$plant)
																->where('created_at', '<=', $startDate)
																->where('type', '=', 'C')
																->where('approval_status','Approved')
																->sum('amount');	
					$plantLaserDebitFirstDay 	= PlantJournalLaser::where('plant_id',$plant)
																->where('created_at', '<=', $startDate)
																->where('type', '=', 'D')
																->where('approval_status','Approved')
																->sum('amount');	

					$balanceFirstDay = $plantLaserCreditFirstDay - $plantLaserDebitFirstDay;

					/*calculate closing balance*/
					$plantLaserCreditLastDay 	= PlantJournalLaser::where('plant_id',$plant)
																->where('created_at', '<=', $endDate)
																->where('type', '=', 'C')
																->where('approval_status','Approved')
																->sum('amount');	
					$plantLaserDebitLastDay 	= PlantJournalLaser::where('plant_id',$plant)
																->where('created_at', '<=', $endDate)
																->where('type', '=', 'D')
																->where('approval_status','Approved')
																->sum('amount');														
					$balanceLastDay = $plantLaserCreditLastDay - $plantLaserDebitLastDay;

				}

				/*search keyword*/
				if($searchKeyword != '' && $searchKeyword != 'undefined'){
					$records = $records->where($dbTables['plantJournalLaserTable'].'.id', 'like', '%'.$searchKeyword.'%')
									   ->orWhere($dbTables['plantJournalLaserTable'].'.amount','like', '%'.$searchKeyword.'%')
									   ->orWhere($dbTables['plantJournalLaserTable'].'.created_at','like','%'.$searchKeyword.'%')
									   ->orWhere($dbTables['vendorTable'].'.account_holder_name','like', '%'.$searchKeyword.'%');
				}

			/*================================== filter section =======================================*/


			/*customizing ordering section*/
			if($orderby == 'id' || $orderby == 'created_at' || $orderby == 'amount') {
				$records = 	$records->orderBy($dbTables['plantJournalLaserTable'].'.'.$orderby,$ordertype);
			}

			if($orderby == 'account_holder_name') {
				$records = 	$records->orderBy($dbTables['vendorTable'].'.'.$orderby,$ordertype);
			}

			if($orderby == 'plant_name') {
				$records = 	$records->orderBy($dbTables['plantTable'].'.name',$ordertype);
			}

			/**
			 * undocumented constant
			 **/
			//dd($records->toSql());
			
			$records = 	$records->skip(($currentPage-1)*$perPageRecord)
			            ->take($perPageRecord)
			            ->get()->toArray();


			for ($i=0; $i<sizeof($records); $i++) {

				/*Fund Transfer and Expenses*/
				if ($records[$i]['entry_type'] == 'BG') {
					$records[$i]['actual_fund_transfer'] = $records[$i]['amount'];
					$records[$i]['actual_expenses'] = 0;
					$records[$i]['fund_transfer_text'] = $records[$i]['amount'];
					$records[$i]['expenses_text'] = '-';
				} else {
					$records[$i]['actual_fund_transfer'] = 0;
					$records[$i]['actual_expenses'] = $records[$i]['amount'];
					$records[$i]['fund_transfer_text'] = '-';
					$records[$i]['expenses_text'] = $records[$i]['amount'];
				}

				/*calculate balance for each row*/
				if($currentPage > 1) { /*for carry forward concept*/
					if($i == 0) {
						$balance = Session::get('carryforwardBalanceAmount');
					}
				}
				$balance += $records[$i]['actual_fund_transfer'] - $records[$i]['actual_expenses'];
				$records[$i]['balance'] = $balance;
				$totalPayment += $records[$i]['actual_fund_transfer'];
				$totalPurchase += $records[$i]['actual_expenses'];

				/*description details*/
				if($records[$i]['entry_type'] == 'BG') {
					$records[$i]['descriptionText'] = 'FUND TRANSFER';
				} else if ($records[$i]['entry_type'] == 'A') {
					$records[$i]['descriptionText'] = 'TRIP ADV';
				} else {
					$records[$i]['descriptionText'] = $records[$i]['description'];
				}

				/*VCH No*/
				$records[$i]['vch_no'] = 'UT/'.$records[$i]['id'];
			}

			$totalRecordLength = sizeof($records);

			$records[0]['totalPayment'] 		= $totalPayment;
			$records[0]['totalPurchase'] 		= $totalPurchase;
			//$records[0]['remainingBalance'] 	= $totalPayment - $totalPurchase;
			$records[0]['balanceFirstDay'] 		= $balanceFirstDay;
			$records[0]['balanceLastDay'] 		= $balanceLastDay;
			//$records[0]['carryForwardBalance'] 	= ($balanceFirstDay == '') ? '0' :$balanceFirstDay ;
			$records[0]['plantName'] 			= isset($records[0]['plant_name'])?$records[0]['plant_name']:'' ;


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
	# Plant Model             
	# Function name : totalCashReportRecords
	# Functionality: get count of cash report
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/04/2019                                
	# Purpose:  to view count of cash report  
	# Params :  $dbTables,plant,$dateRangeValue,$searchKeyword
	/*****************************************************/
	public static function totalCashReportRecords($dbTables,$plant,$dateRangeValue,$searchKeyword) {

			$records = PlantJournalLaser::select($dbTables['plantJournalLaserTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['truckTable'].'.truck_no',$dbTables['tripTable'].'.id AS trip_id',$dbTables['truckTable'].'.truck_no',$dbTables['vendorTable'].'.name AS vendor_name',$dbTables['vendorTable'].'.account_holder_name')
				->join($dbTables['plantTable'], $dbTables['plantJournalLaserTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
				->leftjoin($dbTables['truckTable'], $dbTables['plantJournalLaserTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
				->leftjoin($dbTables['tripTable'], $dbTables['plantJournalLaserTable'].'.trip_id', '=', $dbTables['tripTable'].'.id')
				->leftjoin($dbTables['vendorTable'], $dbTables['tripTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id');


				if (\Auth::user()->user_role_id ==  \Config::get('constants.supervisorRoleId'))	 {
					$records = $records->join($dbTables['plantUserRelationTable'], $dbTables['tripTable'].'.plant_id', '=', $dbTables['plantUserRelationTable'].'.plant_id')
					->where($dbTables['plantUserRelationTable'].'.user_id','=',\Auth::user()->id)
					->where($dbTables['plantUserRelationTable'].'.deleted_by','=',NULL);
				}

			/*================================== filter section =======================================*/	

				/*plant name*/
			 	if($plant != 'undefined' && $plant != ''){
					$records = $records->where($dbTables['plantJournalLaserTable'].'.plant_id', 'like', $plant);
				}


				/*date range*/
				if($dateRangeValue != 'undefined' && $dateRangeValue != '') {
					$dateValue = explode('-',$dateRangeValue);

					$startDate = date('Y-m-d 00:00:00', strtotime(trim($dateValue[0]))); 
					$endDate = date('Y-m-d 23:59:59', strtotime(trim($dateValue[1])));

					$records = $records->where($dbTables['plantJournalLaserTable'].'.created_at', '>=', $startDate)
									   ->where($dbTables['plantJournalLaserTable'].'.created_at', '<=', $endDate);
				}

				/*search keyword*/
				if($searchKeyword != ''  && $searchKeyword != 'undefined'){
					$records = $records->where($dbTables['plantJournalLaserTable'].'.id', 'like', '%'.$searchKeyword.'%')
									   ->orWhere($dbTables['plantJournalLaserTable'].'.amount','like', '%'.$searchKeyword.'%')
									   ->orWhere($dbTables['vendorTable'].'.account_holder_name','like', '%'.$searchKeyword.'%');
				}

			/*================================== filter section =======================================*/


			$records = 	$records->orderBy($dbTables['plantJournalLaserTable'].'.id','ASC')
			            ->get();

			$recordsCount = $records->count();

			return $recordsCount;            
	}
}

?>