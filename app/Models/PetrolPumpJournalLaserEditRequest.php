<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# PetrolPumpJournalLaserEditRequest Model             
# Class name : PetrolPumpJournalLaserEditRequest
# Functionality: 
# Author : Sanchari Ghosh                                 
# Created Date :  05/09/2018                                
# Purpose: 
/*****************************************************/
class PetrolPumpJournalLaserEditRequest extends Model {
	use SoftDeletes;

	protected $table = 'petrol_pump_journal_lasers_edit_requests';
	protected $guarded 	= ['id'];
    protected $fillable = ['petrol_pump_id','trip_id','petrol_pump_journal_laser_id','truck_id','request_by','approved_by','approved_on','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by','requested_amount','approval_reason','actual_amount'];

    protected $dates    = ['deleted_at'];


   /*****************************************************/
	# PetrolPumpJournalLaserEditRequest Model             
	# Function name : availableDSLRecords
	# Author : Debamala Dey                                 
    # Created Date : 10/09/2018                                
	# Purpose:  to view Diesel listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword,$reqby
	/*****************************************************/
	public static function availableDSLRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword,$reqby='') {
		
		$records = PetrolPumpJournalLaserEditRequest::select($dbTables['petrolPumpJournalLasersEditRequestTable'].'.id',$dbTables['petrolPumpJournalLasersEditRequestTable'].'.actual_amount',$dbTables['petrolPumpJournalLasersEditRequestTable'].'.requested_amount',$dbTables['petrolPumpJournalLasersEditRequestTable'].'.approval_reason',$dbTables['petrolPumpJournalLasersEditRequestTable'].'.trip_id',$dbTables['petrolPumpJournalLasersEditRequestTable'].'.approval_status',$dbTables['truckTable'].'.truck_no',$dbTables['tripTable'].'.diesel_amount',$dbTables['petrolPumpJournalLasersEditRequestTable'].'.updated_at',$dbTables['userTable'].'.full_name AS supervisor_name',$dbTables['petrolpumpTable'].'.petrol_pump_name')
			->join($dbTables['userTable'], $dbTables['petrolPumpJournalLasersEditRequestTable'].'.request_by', '=', $dbTables['userTable'].'.id')
			->join($dbTables['petrolpumpTable'], $dbTables['petrolPumpJournalLasersEditRequestTable'].'.petrol_pump_id', '=', $dbTables['petrolpumpTable'].'.id')
			->join($dbTables['truckTable'], $dbTables['petrolPumpJournalLasersEditRequestTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
			->join($dbTables['tripTable'], $dbTables['petrolPumpJournalLasersEditRequestTable'].'.trip_id', '=', $dbTables['tripTable'].'.id');
		//$records = 	$records->where($dbTables['petrolPumpJournalLasersEditRequestTable'].'.status','A');
		if($reqby != ''){
			$records = 	$records->where($dbTables['petrolPumpJournalLasersEditRequestTable'].'.request_by',$reqby);	
		}
		if($searchKeyword != ''){
		$records = $records->where(function ($query) use ($dbTables,$searchKeyword) {

				/*check for trip id only*/
				if (substr_count($searchKeyword,"SSLT000") > 0) {
				 	$newSearchKeyword = str_replace("SSLT000", '', $searchKeyword);
				 	$tripIdSearchKeyword = $newSearchKeyword;
				} else {
					$tripIdSearchKeyword = $searchKeyword;
				}

                $query->where($dbTables['petrolpumpTable'].'.petrol_pump_name', 'like', '%'.$searchKeyword.'%')
                      ->orWhere($dbTables['userTable'].'.full_name', 'like', '%'.$searchKeyword.'%')
                      ->orWhere($dbTables['petrolPumpJournalLasersEditRequestTable'].'.trip_id', 'like', '%'.$tripIdSearchKeyword.'%')
                      ->orWhere($dbTables['truckTable'].'.truck_no', 'like', '%'.$searchKeyword.'%');
            });
		}
		
		if($orderby != ''){
			if($orderby == 'petrol_pump_name'){
			$records = 	$records->orderBy($dbTables['petrolpumpTable'].'.'.$orderby,$ordertype);
			}
			else if($orderby == 'full_name'){
			$records = 	$records->orderBy($dbTables['userTable'].'.'.$orderby,$ordertype);
			}
			else if($orderby == 'truck_no'){
			$records = 	$records->orderBy($dbTables['truckTable'].'.'.$orderby,$ordertype);
			}
			else{
			$records = 	$records->orderBy($dbTables['petrolPumpJournalLasersEditRequestTable'].'.'.$orderby,$ordertype);	
			}
		}
		$records = 	$records->skip(($currentPage-1)*$perPageRecord)
            ->take($perPageRecord)
            ->get();

		return $records;
	}



	/*****************************************************/
	# PlantJournalLaserEditRequest Model          
	# Function name : totalDSLRecords
	# Functionality: get total count of Diesel
	# Author : Debamala Dey                                
	# Created Date : 10/09/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword,$reqby                                       
	/*****************************************************/
	public static function totalDSLRecords($dbTables,$searchKeyword,$reqby='') {
		
		$records = PetrolPumpJournalLaserEditRequest::select($dbTables['petrolPumpJournalLasersEditRequestTable'].'.id',$dbTables['truckTable'].'.truck_no',$dbTables['tripTable'].'.diesel_amount',$dbTables['petrolPumpJournalLasersEditRequestTable'].'.updated_at',$dbTables['userTable'].'.full_name AS supervisor_name',$dbTables['petrolpumpTable'].'.petrol_pump_name')
			->join($dbTables['userTable'], $dbTables['petrolPumpJournalLasersEditRequestTable'].'.request_by', '=', $dbTables['userTable'].'.id')
			->join($dbTables['petrolpumpTable'], $dbTables['petrolPumpJournalLasersEditRequestTable'].'.petrol_pump_id', '=', $dbTables['petrolpumpTable'].'.id')
			->join($dbTables['truckTable'], $dbTables['petrolPumpJournalLasersEditRequestTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
			->join($dbTables['tripTable'], $dbTables['petrolPumpJournalLasersEditRequestTable'].'.trip_id', '=', $dbTables['tripTable'].'.id');
		//$records = 	$records->where($dbTables['petrolPumpJournalLasersEditRequestTable'].'.status','A');
		if($reqby != ''){
			$records = 	$records->where($dbTables['petrolPumpJournalLasersEditRequestTable'].'.request_by',$reqby);	
		}
		if($searchKeyword != ''){
		$records = $records->where(function ($query) use ($dbTables,$searchKeyword) {
				/*check for trip id only*/
				if (substr_count($searchKeyword,"SSLT000") > 0) {
				 	$newSearchKeyword = str_replace("SSLT000", '', $searchKeyword);
				 	$tripIdSearchKeyword = $newSearchKeyword;
				} else {
					$tripIdSearchKeyword = $searchKeyword;
				}

                $query->where($dbTables['petrolpumpTable'].'.petrol_pump_name', 'like', '%'.$searchKeyword.'%')
                	  ->orWhere($dbTables['petrolPumpJournalLasersEditRequestTable'].'.trip_id', 'like', '%'.$tripIdSearchKeyword.'%')
                      ->orWhere($dbTables['userTable'].'.full_name', 'like', '%'.$searchKeyword.'%')
                      ->orWhere($dbTables['truckTable'].'.truck_no', 'like', '%'.$searchKeyword.'%');
            });
		}
        $records = 	$records->get();

        $recordsCount = $records->count();

		return $recordsCount;
	}
}

?>