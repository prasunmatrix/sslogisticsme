<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# PlantJournalLaser Model             
# Class name : PlantJournalLaser
# Functionality: 
# Author : Sanchari Ghosh                                 
# Created Date :  16/08/2018                                
# Purpose: 
/*****************************************************/
class PlantJournalLaser extends Model {
	use SoftDeletes;

	protected $table = 'plant_journal_lasers';
	protected $guarded 	= ['id'];
    protected $fillable = ['plant_id','type','trip_id','amount','truck_id','description','entry_type','entry_by','approval_status','reason','approved_by','approved_on','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

    protected $dates    = ['deleted_at'];

    /*****************************************************/
	# PlantJournalLaser Model             
	# Function name : availableMisclleneousRecords
	# Author : Debamala Dey                                 
    # Created Date : 10/09/2018                                
	# Purpose:  to view Misclleneous listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword,$reqby
	/*****************************************************/
	public static function availableMisclleneousRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword,$reqby) {
		
		$records = PlantJournalLaser::select($dbTables['plantJournalLaserTable'].'.id',$dbTables['plantJournalLaserTable'].'.approval_status',$dbTables['plantJournalLaserTable'].'.reason',$dbTables['plantJournalLaserTable'].'.entry_type',$dbTables['plantJournalLaserTable'].'.status',$dbTables['plantJournalLaserTable'].'.type',$dbTables['plantJournalLaserTable'].'.amount',$dbTables['plantJournalLaserTable'].'.updated_at',$dbTables['userTable'].'.full_name AS supervisor_name',$dbTables['plantTable'].'.name')
			->join($dbTables['userTable'], $dbTables['plantJournalLaserTable'].'.entry_by', '=', $dbTables['userTable'].'.id')
			->join($dbTables['plantTable'], $dbTables['plantJournalLaserTable'].'.plant_id', '=', $dbTables['plantTable'].'.id');
		$records = 	$records->where($dbTables['plantJournalLaserTable'].'.entry_type','M');
		if($reqby != ''){
			$records = 	$records->where($dbTables['plantJournalLaserTable'].'.entry_by',$reqby);	
		}
		if($searchKeyword != ''){
		$records = $records->where(function ($query) use ($dbTables,$searchKeyword) {
                $query->where($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%')
                      ->orWhere($dbTables['userTable'].'.full_name', 'like', '%'.$searchKeyword.'%');
            });
		}
		
		if($orderby != ''){
			if($orderby == 'name'){
				$records = 	$records->orderBy($dbTables['plantTable'].'.'.$orderby,$ordertype);
			}
			else if($orderby == 'full_name'){
				$records = 	$records->orderBy($dbTables['userTable'].'.'.$orderby,$ordertype);
			}
			else{
				$records = 	$records->orderBy($dbTables['plantJournalLaserTable'].'.'.$orderby,$ordertype);	
			}
		}
		$records = 	$records->skip(($currentPage-1)*$perPageRecord)
            ->take($perPageRecord)
            ->get();

		return $records;
	}



	/*****************************************************/
	# PlantJournalLaser Model          
	# Function name : totalMisclleneousRecords
	# Functionality: get total count of Misclleneous
	# Author : Debamala Dey                                
	# Created Date : 10/09/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword,$reqby                                 
	/*****************************************************/
	public static function totalMisclleneousRecords($dbTables,$searchKeyword,$reqby) {
		
		$records = PlantJournalLaser::select($dbTables['plantJournalLaserTable'].'.id',$dbTables['plantJournalLaserTable'].'.entry_type',$dbTables['plantJournalLaserTable'].'.status',$dbTables['plantJournalLaserTable'].'.type',$dbTables['plantJournalLaserTable'].'.amount',$dbTables['plantJournalLaserTable'].'.updated_at',$dbTables['userTable'].'.full_name AS supervisor_name',$dbTables['plantTable'].'.name')
			->join($dbTables['userTable'], $dbTables['plantJournalLaserTable'].'.entry_by', '=', $dbTables['userTable'].'.id')
			->join($dbTables['plantTable'], $dbTables['plantJournalLaserTable'].'.plant_id', '=', $dbTables['plantTable'].'.id');
		
		/*for supervisor show only his/her plant*/		
		if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId'))	 {
			$records->join($dbTables['plantUserRelationTable'], $dbTables['plantTable'].'.id', '=', $dbTables['plantUserRelationTable'].'.plant_id');
			$records = $records->where($dbTables['plantUserRelationTable'].'.user_id', '=', \Auth::user()->id)
							   ->where($dbTables['plantUserRelationTable'].'.is_deleted','N');
		}

		$records = 	$records->where($dbTables['plantJournalLaserTable'].'.entry_type','M');

		if($reqby != ''){
			$records = 	$records->where($dbTables['plantJournalLaserTable'].'.entry_by',$reqby);	
		}
		if($searchKeyword != ''){
			$records = $records->where(function ($query) use ($dbTables,$searchKeyword) {
                $query->where($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%')
                      ->orWhere($dbTables['userTable'].'.full_name', 'like', '%'.$searchKeyword.'%');
            });
		}
        $records = 	$records->get();

        $recordsCount = $records->count();

		return $recordsCount;
	}
}

?>