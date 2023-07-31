<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# TruckRegistration Model             
# Class name : TruckRegistration
# Functionality: 
# Author : Sanchari Ghosh                                 
# Created Date :  21/08/2018                                
# Purpose: 
/*****************************************************/
class TruckRegistration extends Model {
	use SoftDeletes;

	protected $table = 'truck_registrations';
	protected $guarded 	= ['id'];
    protected $fillable = ['truck_id','registration_no','name','registered_on','registration_start','registration_end','registration_file','status','read_status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

    protected $dates    = ['deleted_at'];

    /*****************************************************/
	# TruckRegistration Model             
	# Function name : availableRecords
	# Functionality: view TruckRegistration listing page
	# Author : Debamala Dey                                
    # Created Date : 03/09/2018                                
	# Purpose:  to view TruckRegistration listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {

		$curr_date = date('Y-m-d h:i:s');
        $next_date = date('Y-m-d h:i:s', strtotime("+30 days"));
		
		$records = TruckRegistration::select($dbTables['TruckRegistrationTable'].'.id',$dbTables['TruckRegistrationTable'].'.registration_no',$dbTables['TruckRegistrationTable'].'.registered_on',$dbTables['TruckRegistrationTable'].'.registration_end',$dbTables['TruckRegistrationTable'].'.status',$dbTables['TruckRegistrationTable'].'.updated_at',$dbTables['TruckTable'].'.truck_no')
			->join($dbTables['TruckTable'], $dbTables['TruckRegistrationTable'].'.truck_id', '=', $dbTables['TruckTable'].'.id')
			->where($dbTables['TruckRegistrationTable'].'.registration_end','<',$next_date);
		if($searchKeyword != ''){
		$records = $records->where(function ($query) use ($dbTables,$searchKeyword) {
                $query->where($dbTables['TruckTable'].'.truck_no', 'like', '%'.$searchKeyword.'%');
            });
		}
		$records = 	$records
			->orderBy($dbTables['TruckRegistrationTable'].'.'.$orderby,$ordertype)
			->skip(($currentPage-1)*$perPageRecord)
            ->take($perPageRecord)
            ->get();

		return $records;
	}

	/*****************************************************/
	# TruckRegistration Model             
	# Function name : totalRecords
	# Functionality: get total TruckRegistration notification
	# Author : Debamala Dey                                
	# Created Date : 03/09/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                                        
	/*****************************************************/

	public static function totalRecords($dbTables,$searchKeyword) {
		
		$curr_date = date('Y-m-d h:i:s');
        $next_date = date('Y-m-d h:i:s', strtotime("+30 days"));

		$records = TruckRegistration::select($dbTables['TruckRegistrationTable'].'.id',$dbTables['TruckRegistrationTable'].'.registration_no',$dbTables['TruckRegistrationTable'].'.registered_on',$dbTables['TruckRegistrationTable'].'.registration_end',$dbTables['TruckRegistrationTable'].'.status',$dbTables['TruckRegistrationTable'].'.updated_at',$dbTables['TruckTable'].'.truck_no')
			->join($dbTables['TruckTable'], $dbTables['TruckRegistrationTable'].'.truck_id', '=', $dbTables['TruckTable'].'.id')
			->where($dbTables['TruckRegistrationTable'].'.registration_end','<',$next_date);
		if($searchKeyword != ''){
		$records = $records->where(function ($query) use ($dbTables,$searchKeyword) {
                $query->where($dbTables['TruckRegistrationTable'].'.registration_no', 'like', '%'.$searchKeyword.'%');
            });
		}
		$records = $records->orderBy($dbTables['TruckRegistrationTable'].'.id','ASC')->get();

        $recordsCount = $records->count();

		return $recordsCount;
	}

}

?>