<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# PlantJournalLaserEditRequest Model             
# Class name : PlantJournalLaserEditRequest
# Functionality: 
# Author : Sanchari Ghosh                                 
# Created Date :  05/09/2018                                
# Purpose: 
/*****************************************************/
class PlantJournalLaserEditRequest extends Model {
	use SoftDeletes;

	protected $table = 'plant_journal_lasers_edit_requests';
	protected $guarded 	= ['id'];
    protected $fillable = ['plant_id','trip_id','plant_journal_laser_id','truck_id','request_by','approved_by','approved_on','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by','requested_amount','approval_reason','actual_amount'];

    protected $dates    = ['deleted_at'];

    /*****************************************************/
	# PlantJournalLaserEditRequest Model             
	# Function name : availableAdvRecords
	# Author : Debamala Dey                                 
    # Created Date : 10/09/2018                                
	# Purpose:  to view Advance listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword,$reqby 
	/*****************************************************/
	public static function availableAdvRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword,$reqby='') {
		
		$records = PlantJournalLaserEditRequest::select($dbTables['plantJournalLasersEditRequestTable'].'.id',$dbTables['plantJournalLasersEditRequestTable'].'.actual_amount',$dbTables['plantJournalLasersEditRequestTable'].'.requested_amount',$dbTables['plantJournalLasersEditRequestTable'].'.approval_reason',$dbTables['plantJournalLasersEditRequestTable'].'.trip_id',$dbTables['plantJournalLasersEditRequestTable'].'.approval_status',$dbTables['truckTable'].'.truck_no',$dbTables['tripTable'].'.advance_amount',$dbTables['plantJournalLasersEditRequestTable'].'.updated_at',$dbTables['userTable'].'.full_name AS supervisor_name',$dbTables['plantTable'].'.name')
			->join($dbTables['userTable'], $dbTables['plantJournalLasersEditRequestTable'].'.request_by', '=', $dbTables['userTable'].'.id')
			->join($dbTables['plantTable'], $dbTables['plantJournalLasersEditRequestTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
			->join($dbTables['truckTable'], $dbTables['plantJournalLasersEditRequestTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
			->join($dbTables['tripTable'], $dbTables['plantJournalLasersEditRequestTable'].'.trip_id', '=', $dbTables['tripTable'].'.id');
		//$records = 	$records->where($dbTables['plantJournalLasersEditRequestTable'].'.status','A');
		if($reqby != ''){
			$records = 	$records->where($dbTables['plantJournalLasersEditRequestTable'].'.request_by',$reqby);	
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

                $query->where($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%')
                      ->orWhere($dbTables['userTable'].'.full_name', 'like', '%'.$searchKeyword.'%')
                      ->orWhere($dbTables['plantJournalLasersEditRequestTable'].'.trip_id', 'like', '%'.$tripIdSearchKeyword.'%')
                      ->orWhere($dbTables['truckTable'].'.truck_no', 'like', '%'.$searchKeyword.'%');
            });
		}
		
		if($orderby != ''){
			if($orderby == 'name'){
				$records = 	$records->orderBy($dbTables['plantTable'].'.'.$orderby,$ordertype);
			}
			else if($orderby == 'full_name'){
				$records = 	$records->orderBy($dbTables['userTable'].'.'.$orderby,$ordertype);
			}
			else if($orderby == 'truck_no'){
				$records = 	$records->orderBy($dbTables['truckTable'].'.'.$orderby,$ordertype);
			}
			else{
				$records = 	$records->orderBy($dbTables['plantJournalLasersEditRequestTable'].'.'.$orderby,$ordertype);	
			}
		}
		$records = 	$records->skip(($currentPage-1)*$perPageRecord)
            ->take($perPageRecord)
            ->get();

		return $records;
	}



	/*****************************************************/
	# PlantJournalLaserEditRequest Model          
	# Function name : totalAdvRecords
	# Functionality: get total count of Advance
	# Author : Debamala Dey                                
	# Created Date : 10/09/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword,$reqby                                       
	/*****************************************************/
	public static function totalAdvRecords($dbTables,$searchKeyword,$reqby='') {
		
		$records = PlantJournalLaserEditRequest::select($dbTables['plantJournalLasersEditRequestTable'].'.id',$dbTables['truckTable'].'.truck_no',$dbTables['tripTable'].'.advance_amount',$dbTables['plantJournalLasersEditRequestTable'].'.updated_at',$dbTables['userTable'].'.full_name AS supervisor_name',$dbTables['plantTable'].'.name')
			->join($dbTables['userTable'], $dbTables['plantJournalLasersEditRequestTable'].'.request_by', '=', $dbTables['userTable'].'.id')
			->join($dbTables['plantTable'], $dbTables['plantJournalLasersEditRequestTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
			->join($dbTables['truckTable'], $dbTables['plantJournalLasersEditRequestTable'].'.truck_id', '=', $dbTables['truckTable'].'.id')
			->join($dbTables['tripTable'], $dbTables['plantJournalLasersEditRequestTable'].'.trip_id', '=', $dbTables['tripTable'].'.id');
		//$records = 	$records->where($dbTables['plantJournalLasersEditRequestTable'].'.status','A');
		if($reqby != ''){
			$records = 	$records->where($dbTables['plantJournalLasersEditRequestTable'].'.request_by',$reqby);	
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

                $query->where($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%')
                      ->orWhere($dbTables['userTable'].'.full_name', 'like', '%'.$searchKeyword.'%')
                      ->orWhere($dbTables['plantJournalLasersEditRequestTable'].'.trip_id', 'like', '%'.$tripIdSearchKeyword.'%')
                      ->orWhere($dbTables['truckTable'].'.truck_no', 'like', '%'.$searchKeyword.'%');
            });
		}
        $records = 	$records->get();

        $recordsCount = $records->count();

		return $recordsCount;
	}
}

?>