<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\Models\TripPaymentManagement;
use Session;

/*****************************************************/
# TripBill Model             
# Class name : TripBill
# Functionality: 
# Author : Sanchari Ghosh                                 
# Created Date :  19/06/2019                                
# Purpose: 
/*****************************************************/
class TripBill extends Model {	
	use SoftDeletes;

	protected $table = 'trip_bills';
	protected $guarded 	= ['id'];
    protected $fillable = ['trip_id','bill_date','vendor_id','bill_no','challan_exps','tds','amount','type','plant_id','petrol_pump_id','truck_id','extra_cash','extra_diesel','vendor_amount','narration','created_at','updated_at','created_by'];

    protected $dates    = ['deleted_at'];



    /*****************************************************/
	# TripBill Model             
	# Function name : getExtraCashList
	# Functionality: view extra cash listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 02/07/2019                                
	# Purpose:  to view extra cash listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword 
	/*****************************************************/
	public static function getExtraCashList($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {
		
		$records = TripBill::select($dbTables['tripBillTable'].'.id',$dbTables['tripBillTable'].'.bill_date',$dbTables['tripBillTable'].'.plant_id',$dbTables['tripBillTable'].'.truck_id',$dbTables['tripBillTable'].'.vendor_id',$dbTables['tripBillTable'].'.amount',$dbTables['tripBillTable'].'.created_at',$dbTables['tripBillTable'].'.narration',$dbTables['tripBillTable'].'.extra_cash',$dbTables['plantTable'].'.name AS plant_name',$dbTables['truckTable'].'.truck_no',$dbTables['vendorTable'].'.name AS vendor_name')
			->join($dbTables['plantTable'], $dbTables['tripBillTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
			->join($dbTables['truckTable'], $dbTables['tripBillTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
			->join($dbTables['vendorTable'], $dbTables['tripBillTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id')
			->whereNotNull($dbTables['tripBillTable'].'.extra_cash');



			if($searchKeyword != ''){

					$records = $records->where($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['truckTable'].'.truck_no', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['vendorTable'].'.name', 'like', '%'.$searchKeyword.'%');
			}

			/*customizing ordering section*/
			if($orderby == 'plant_name') {
				$records = 	$records->orderBy($dbTables['plantTable'].'.name',$ordertype);
			} else if($orderby == 'vendor_name') {
				$records = 	$records->orderBy($dbTables['vendorTable'].'.name',$ordertype);
			} else if($orderby == 'truck_no') {
				$records = 	$records->orderBy($dbTables['truckTable'].'.truck_no',$ordertype);
			} else {
				$records = 	$records->orderBy($dbTables['tripBillTable'].'.'.$orderby,$ordertype);
			}

			

			$records = 	$records->skip(($currentPage-1)*$perPageRecord)
			            ->take($perPageRecord)
			            ->get()->toArray();

		return $records;
	}




	/*****************************************************/
	# TripBill Model             
	# Function name : totalExtraCashListRecords
	# Functionality: get total count of extra cash list
	# Author : Sanchari Ghosh                                
	# Created Date : 02/07/2019                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                               
	/*****************************************************/
	public static function totalExtraCashListRecords($dbTables,$searchKeyword) {
		
        $records = TripBill::select($dbTables['tripBillTable'].'.id',$dbTables['tripBillTable'].'.plant_id',$dbTables['tripBillTable'].'.truck_id',$dbTables['tripBillTable'].'.vendor_id',$dbTables['tripBillTable'].'.amount',$dbTables['tripBillTable'].'.created_at',$dbTables['tripBillTable'].'.narration',$dbTables['tripBillTable'].'.extra_cash',$dbTables['plantTable'].'.name AS plant_name',$dbTables['truckTable'].'.truck_no',$dbTables['vendorTable'].'.name AS vendor_name')
			->join($dbTables['plantTable'], $dbTables['tripBillTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
			->join($dbTables['truckTable'], $dbTables['tripBillTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
			->join($dbTables['vendorTable'], $dbTables['tripBillTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id')
			->whereNotNull($dbTables['tripBillTable'].'.extra_cash');



			if($searchKeyword != ''){

					$records = $records->where($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['truckTable'].'.truck_no', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['vendorTable'].'.name', 'like', '%'.$searchKeyword.'%');
			}	
		
		$records = 	$records->orderBy($dbTables['tripBillTable'].'.id','ASC')
            		->get();
            		
        $recordsCount = $records->count();

		return $recordsCount;
	}


	/*****************************************************/
	# TripBill Model             
	# Function name : getExtraDieselList
	# Functionality: view extra diesel listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 02/07/2019                                
	# Purpose:  to view extra diesel listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword 
	/*****************************************************/
	public static function getExtraDieselList($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {
		
		$records = TripBill::select($dbTables['tripBillTable'].'.id',$dbTables['tripBillTable'].'.bill_date',$dbTables['tripBillTable'].'.plant_id',$dbTables['tripBillTable'].'.truck_id',$dbTables['tripBillTable'].'.vendor_id',$dbTables['tripBillTable'].'.amount',$dbTables['tripBillTable'].'.created_at',$dbTables['tripBillTable'].'.narration',$dbTables['tripBillTable'].'.extra_diesel',$dbTables['plantTable'].'.name AS plant_name',$dbTables['truckTable'].'.truck_no',$dbTables['vendorTable'].'.name AS vendor_name',$dbTables['petrolPumpTable'].'.petrol_pump_name')
			->join($dbTables['plantTable'], $dbTables['tripBillTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
			->join($dbTables['truckTable'], $dbTables['tripBillTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
			->join($dbTables['vendorTable'], $dbTables['tripBillTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id')
			->join($dbTables['petrolPumpTable'], $dbTables['tripBillTable'].'.petrol_pump_id', '=', $dbTables['petrolPumpTable'].'.id')
			->whereNotNull($dbTables['tripBillTable'].'.extra_diesel');



			if($searchKeyword != ''){

					$records = $records->where($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['truckTable'].'.truck_no', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['vendorTable'].'.name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['petrolPumpTable'].'.petrol_pump_name', 'like', '%'.$searchKeyword.'%');
			}

			/*customizing ordering section*/
			if($orderby == 'plant_name') {
				$records = 	$records->orderBy($dbTables['plantTable'].'.name',$ordertype);
			} else if($orderby == 'vendor_name') {
				$records = 	$records->orderBy($dbTables['vendorTable'].'.name',$ordertype);
			} else if($orderby == 'truck_no') {
				$records = 	$records->orderBy($dbTables['truckTable'].'.truck_no',$ordertype);
			} else if($orderby == 'petrol_pump_name') {
				$records = 	$records->orderBy($dbTables['petrolPumpTable'].'.petrol_pump_name',$ordertype);
			} else {
				$records = 	$records->orderBy($dbTables['tripBillTable'].'.'.$orderby,$ordertype);
			}

			

			$records = 	$records->skip(($currentPage-1)*$perPageRecord)
			            ->take($perPageRecord)
			            ->get()->toArray();

		return $records;
	}




	/*****************************************************/
	# TripBill Model             
	# Function name : totalExtraDieselListRecords
	# Functionality: get total count of extra diesel list
	# Author : Sanchari Ghosh                                
	# Created Date : 02/07/2019                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                               
	/*****************************************************/
	public static function totalExtraDieselListRecords($dbTables,$searchKeyword) {
		
        $records = TripBill::select($dbTables['tripBillTable'].'.id',$dbTables['tripBillTable'].'.bill_date',$dbTables['tripBillTable'].'.plant_id',$dbTables['tripBillTable'].'.truck_id',$dbTables['tripBillTable'].'.vendor_id',$dbTables['tripBillTable'].'.amount',$dbTables['tripBillTable'].'.created_at',$dbTables['tripBillTable'].'.narration',$dbTables['tripBillTable'].'.extra_diesel',$dbTables['plantTable'].'.name AS plant_name',$dbTables['truckTable'].'.truck_no',$dbTables['vendorTable'].'.name AS vendor_name',$dbTables['petrolPumpTable'].'.petrol_pump_name')
			->join($dbTables['plantTable'], $dbTables['tripBillTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
			->join($dbTables['truckTable'], $dbTables['tripBillTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
			->join($dbTables['vendorTable'], $dbTables['tripBillTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id')
			->join($dbTables['petrolPumpTable'], $dbTables['tripBillTable'].'.petrol_pump_id', '=', $dbTables['petrolPumpTable'].'.id')
			->whereNotNull($dbTables['tripBillTable'].'.extra_diesel');



			if($searchKeyword != ''){

					$records = $records->where($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['truckTable'].'.truck_no', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['vendorTable'].'.name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['petrolPumpTable'].'.petrol_pump_name', 'like', '%'.$searchKeyword.'%');
			}

		
		$records = 	$records->orderBy($dbTables['tripBillTable'].'.id','ASC')
            		->get();
            		
        $recordsCount = $records->count();

		return $recordsCount;
	}




	/*****************************************************/
	# TripBill Model             
	# Function name : getLedgerReport
	# Functionality: get ledger report
	# Author : Sanchari Ghosh                                 
	# Created Date : 04/07/2019                                
	# Purpose:  to view ledger report  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$company
	/*****************************************************/
	public static function getLedgerReport($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$company) {
			
			$balance = 0; /*for calculating balance*/
			$finalBalance = 0;

			$records = array();
			$finalRecords = array();

			if($company != 'undefined' && $company != ''){
			  $records = TripBill::select($dbTables['tripBillTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['truckTable'].'.truck_no',$dbTables['vendorTable'].'.name AS vendor_name',$dbTables['petrolPumpTable'].'.petrol_pump_name')
				->leftjoin($dbTables['plantTable'], $dbTables['tripBillTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
				->leftjoin($dbTables['truckTable'], $dbTables['tripBillTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
				->join($dbTables['vendorTable'], $dbTables['tripBillTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id')
				->leftjoin($dbTables['petrolPumpTable'], $dbTables['tripBillTable'].'.petrol_pump_id', '=', $dbTables['petrolPumpTable'].'.id')
				->where($dbTables['tripBillTable'].'.vendor_id', 'like', $company);

			  $records = 	//$records->orderBy($dbTables['tripBillTable'].'.'.$orderby,$ordertype)
						$records->orderBy($dbTables['tripBillTable'].'.id','asc')
						->skip(($currentPage-1)*$perPageRecord)
			            ->take($perPageRecord)
			            ->get()->toArray();
			}

			if(sizeof($records) > 0){
				for ($i=0; $i<sizeof($records); $i++) {
					if($records[$i]['extra_cash'] !== null) {
						$records[$i]['amount_given_to'] 		= 'Plant "'. $records[$i]['plant_name'].'" (Advance)';
						$records[$i]['credited_amount'] 		= '-';
						$records[$i]['debited_amount']  		= $records[$i]['extra_cash'];
						$records[$i]['real_credited_amount'] 	= 0;
						$records[$i]['real_debited_amount']  	= $records[$i]['extra_cash'];
						$records[$i]['truck']  					= $records[$i]['truck_no'];
						$records[$i]['display_trip_id'] 		= 'SSLADV000'.$records[$i]['id'];
						$records[$i]['is_consolidated']			= 'N';
					}

					if($records[$i]['extra_diesel'] !== null) {
						$records[$i]['amount_given_to'] 	= 'Pump "'. $records[$i]['petrol_pump_name'].'" (Diesel)';
						$records[$i]['credited_amount'] 	= '-';
						$records[$i]['debited_amount']  	= $records[$i]['extra_diesel'];
						$records[$i]['real_credited_amount']= 0;
						$records[$i]['real_debited_amount'] = $records[$i]['extra_diesel'];
						$records[$i]['truck']  				= $records[$i]['truck_no'];
						$records[$i]['display_trip_id'] 	= 'SSLDSL000'.$records[$i]['id'];
						$records[$i]['is_consolidated']		= 'N';
					}

					if($records[$i]['vendor_amount'] !== null) {
						$records[$i]['amount_given_to'] 	= 'Pay to Vendor "'. $records[$i]['vendor_name'].'"';
						$records[$i]['credited_amount'] 	= '-';
						$records[$i]['debited_amount']  	= $records[$i]['vendor_amount'];
						$records[$i]['real_credited_amount']= 0;
						$records[$i]['real_debited_amount'] = $records[$i]['vendor_amount'];
						$records[$i]['truck']  				= '-';
						$records[$i]['display_trip_id'] 	= 'SSLVENDOR000'.$records[$i]['id'];
						$records[$i]['is_consolidated']		= 'N';
					}

					if($records[$i]['amount'] !== null) {
						$records[$i]['amount_given_to'] 	= 'Consolidated View Data';
						$records[$i]['credited_amount'] 	= $records[$i]['actual_consolidate_amount'];
						$records[$i]['debited_amount']  	= '-';
						$records[$i]['real_credited_amount']= $records[$i]['actual_consolidate_amount'];
						$records[$i]['real_debited_amount'] = 0;
						$records[$i]['truck']  				= '-';
						$records[$i]['display_trip_id'] 	= $records[$i]['bill_no'];
						$records[$i]['is_consolidated']		= 'Y';
					}

					$balance += $records[$i]['real_credited_amount'] - $records[$i]['real_debited_amount'];
					$records[$i]['actual_balance_amount'] = $balance;
					$records[$i]['balance_amount'] = round($balance,2);
				}


				/*specially for consolidated data*/
				for ($j=0; $j<sizeof($records); $j++){
					
					if($currentPage > 1) { /*for carry forward concept*/
						if($j == 0) {
							$finalBalance = Session::get('carryforwardBalanceAmount');
						}
					}
					 
					if ($records[$j]['is_consolidated']	== 'Y'){
						$conRecords = $records[$j];
						$finalBalance += $conRecords['real_credited_amount'] - $conRecords['real_debited_amount'];
						$conRecords['actual_balance_amount'] = $finalBalance;
						$conRecords['balance_amount'] = round($finalBalance,2);
						array_push($finalRecords,$conRecords);

						$dsl = $records[$j];
						$dsl['amount_given_to'] 	= 'DIESEL';
						$dsl['credited_amount'] 	= '-';
						$dsl['debited_amount']  	= $records[$j]['total_diesel_amount'];
						$dsl['real_credited_amount']= 0;
						$dsl['real_debited_amount'] = $records[$j]['total_diesel_amount'];
						$dsl['truck']  				= '-';
						$dsl['display_trip_id'] 	= $records[$j]['bill_no'];
						$dsl['is_consolidated']		= 'N';
						$finalBalance += $dsl['real_credited_amount'] - $dsl['real_debited_amount'];
						$dsl['actual_balance_amount'] = $finalBalance;
						$dsl['balance_amount'] =round($finalBalance,2);
						array_push($finalRecords,$dsl);

						$adv = $records[$j];
						$adv['amount_given_to'] 	= 'ADVANCE';
						$adv['credited_amount'] 	= '-';
						$adv['debited_amount']  	= $records[$j]['total_advance_amount'];
						$adv['real_credited_amount']= 0;
						$adv['real_debited_amount'] = $records[$j]['total_advance_amount'];
						$adv['truck']  				= '-';
						$adv['display_trip_id'] 	= $records[$j]['bill_no'];
						$adv['is_consolidated']		= 'N';
						$finalBalance += $adv['real_credited_amount'] - $adv['real_debited_amount'];
						$adv['actual_balance_amount'] = $finalBalance;
						$adv['balance_amount'] = round($finalBalance,2);
						array_push($finalRecords,$adv);


						$shortBag = $records[$j];
						$shortBag['amount_given_to'] 			= 'Short Bag';
						$shortBag['credited_amount'] 			= '-';
						$shortBag['debited_amount']  			= $records[$j]['total_short_bag_amount'];
						$shortBag['real_credited_amount']		= 0;
						$shortBag['real_debited_amount'] 		= $records[$j]['total_short_bag_amount'];
						$shortBag['truck']  					= '-';
						$shortBag['display_trip_id'] 			= $records[$j]['bill_no'];
						$shortBag['is_consolidated']			= 'N';
						$finalBalance += $shortBag['real_credited_amount'] - $shortBag['real_debited_amount'];
						$shortBag['actual_balance_amount'] = $finalBalance;
						$shortBag['balance_amount'] = round($finalBalance,2);
						array_push($finalRecords,$shortBag);

						$tds = $records[$j];
						$tds['amount_given_to'] 		= 'TDS @ '.$records[$j]['tds'].'%';
						$tds['credited_amount'] 		= '-';
						$tds['debited_amount']  		= ($records[$j]['tds_deduction']);
						$tds['real_credited_amount']	= 0;
						$tds['real_debited_amount'] 	= $records[$j]['tds_deduction'];
						$tds['truck']  					= '-';
						$tds['display_trip_id'] 		= $records[$j]['bill_no'];
						$tds['is_consolidated']			= 'N';
						$finalBalance += $tds['real_credited_amount'] - $tds['real_debited_amount'];
						$tds['actual_balance_amount'] = $finalBalance;
						$tds['balance_amount'] = round($finalBalance,2);
						array_push($finalRecords,$tds);
					} else {
						$otherRecords = $records[$j]; 
						//echo '<pre>'; echo $finalBalance;  print_r($otherRecords);
						$finalBalance = ($finalBalance) + $otherRecords['real_credited_amount'] - $otherRecords['real_debited_amount'];
						//$finalBalance = 1;
						$otherRecords['actual_balance_amount'] = $finalBalance;
						$otherRecords['balance_amount'] = round($finalBalance,2);
						array_push($finalRecords,$otherRecords);
						
					}
				}

				$totalRecordLength = sizeof($finalRecords);

				/*carry forward calculation*/
				if($currentPage == 1) {
					//$finalRecords[0]['remainingBalance'] = $totalPayment - $totalPurchase;
					Session::put('carryforwardBalanceAmount',$finalRecords[$totalRecordLength-1]['balance_amount']) ;
					$finalRecords[0]['carryForwardBalance'] 	= 0 ;
				} else {
					$finalRecords[0]['carryForwardBalance'] 	= Session::get('carryforwardBalanceAmount');
					Session::put('carryforwardBalanceAmount', $finalRecords[$totalRecordLength-1]['balance_amount']);
				}
			}

			//echo '<pre>'; print_r($finalRecords);
			return $finalRecords;
	}



	/*****************************************************/
	# TripBill Model             
	# Function name : totalLedgerReportRecords
	# Functionality: get total count of ledger reports
	# Author : Sanchari Ghosh                                
	# Created Date : 04/07/2019                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$company                        
	/*****************************************************/
	public static function totalLedgerReportRecords($dbTables,$company) {

		$dbPrefix	  = DB::getTablePrefix();
		$recordsCount = 0;
		
		if($company != 'undefined' && $company != ''){
		
	       $records = TripBill::select($dbTables['tripBillTable'].'.*',$dbTables['plantTable'].'.name AS plant_name',$dbTables['truckTable'].'.truck_no',$dbTables['vendorTable'].'.name AS vendor_name',$dbTables['petrolPumpTable'].'.petrol_pump_name')
					->leftjoin($dbTables['plantTable'], $dbTables['tripBillTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
					->leftjoin($dbTables['truckTable'], $dbTables['tripBillTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
					->join($dbTables['vendorTable'], $dbTables['tripBillTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id')
					->leftjoin($dbTables['petrolPumpTable'], $dbTables['tripBillTable'].'.petrol_pump_id', '=', $dbTables['petrolPumpTable'].'.id')
					->where($dbTables['tripBillTable'].'.vendor_id', 'like', $company);;

			
			$records = 	$records->orderBy($dbTables['tripBillTable'].'.id','ASC')
	            		->get();
	            		
	        $recordsCount = $records->count();
    	}

		return $recordsCount;
	}



	/*****************************************************/
	# TripBill Model             
	# Function name : getBillDetails
	# Functionality: get Bill details
	# Author : Sanchari Ghosh                                
	# Created Date : 09/09/2019                                
	# Purpose:  to get bill details
	# Params :  $dbTables                        
	/*****************************************************/
	public static function getBillDetails($dbTables,$billNo){
		$tripIdArray=array();
		$finalTripPayRecords = array();

		$tripBillRecords = TripBill::select($dbTables['tripBillTable'].'.bill_no',$dbTables['tripBillTable'].'.challan_exps',$dbTables['tripBillTable'].'.tds',$dbTables['tripBillTable'].'.trip_id')
				->where($dbTables['tripBillTable'].'.bill_no','like',$billNo)
				->get()->toArray();

		/*storing multiple trip ids in array*/		
		if(!empty($tripBillRecords[0]['trip_id'])) {
			$tripIdArray=explode(',',$tripBillRecords[0]['trip_id']);
		}

		$records = TripPaymentManagement::select($dbTables['tripPaymentManagementTable'].'.trip_id',$dbTables['tripPaymentManagementTable'].'.freight_charge',$dbTables['tripPaymentManagementTable'].'.toll',$dbTables['tripPaymentManagementTable'].'.unloading_charge',$dbTables['tripPaymentManagementTable'].'.tare_charge',$dbTables['tripPaymentManagementTable'].'.rate',$dbTables['tripPaymentManagementTable'].'.short_bag_amount',$dbTables['tripPaymentManagementTable'].'.balance',$dbTables['tripTable'].'.quantity',$dbTables['tripTable'].'.advance_amount',$dbTables['tripTable'].'.diesel_amount')
				->join($dbTables['tripTable'], $dbTables['tripPaymentManagementTable'].'.trip_id', '=', $dbTables['tripTable'].'.id')
				->whereIn($dbTables['tripPaymentManagementTable'].'.trip_id',$tripIdArray)
				->get()->toArray();

		for ($i=0; $i<sizeof($records);$i++){
			$finalTripPayRecords[$i]['trip_id'] 			= $records[$i]['trip_id'];
			$finalTripPayRecords[$i]['freight_charge'] 		= number_format($records[$i]['freight_charge'],2);
			$finalTripPayRecords[$i]['toll'] 				= number_format($records[$i]['toll'],2);
			$finalTripPayRecords[$i]['unloading_charge'] 	= number_format($records[$i]['unloading_charge'],2);
			$finalTripPayRecords[$i]['tare_charge'] 		= number_format($records[$i]['tare_charge'],2);
			$finalTripPayRecords[$i]['rate'] 				= number_format($records[$i]['rate'],2);
			$finalTripPayRecords[$i]['short_bag_amount'] 	= number_format($records[$i]['short_bag_amount'],2);
			$finalTripPayRecords[$i]['balance'] 			= number_format($records[$i]['balance'],2);
			$finalTripPayRecords[$i]['quantity'] 			= $records[$i]['quantity'];
			$finalTripPayRecords[$i]['advance_amount'] 		= number_format($records[$i]['advance_amount'],2);
			$finalTripPayRecords[$i]['diesel_amount'] 		= number_format($records[$i]['diesel_amount'],2);
		}
		
		$data = array();
		$data['trip_bill_records'] = $tripBillRecords;
		$data['trip_pay_records']  = $records;

		return $data;
	}

}

?>