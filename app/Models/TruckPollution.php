<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# TruckPollution Model             
# Class name : TruckPollution
# Functionality: 
# Author : Debamala Dey                                 
# Created Date :  31/08/2018                                
# Purpose: 
/*****************************************************/
class TruckPollution extends Model {
	use SoftDeletes;

	protected $table = 'truck_pollutions';
	protected $guarded 	= ['id'];
    protected $fillable = ['truck_id','pollution_no','name','pollution_on','pollution_start','pollution_end','pollution_file','status','read_status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

    protected $dates    = ['deleted_at'];

    /*****************************************************/
	# TruckPollution Model             
	# Function name : availableRecords
	# Functionality: view TruckPollution listing page
	# Author : Debamala Dey                                
    # Created Date : 03/09/2018                                
	# Purpose:  to view TruckPollution listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {

		$curr_date = date('Y-m-d h:i:s');
        $next_date = date('Y-m-d h:i:s', strtotime("+30 days"));
		
		$records = TruckPollution::select($dbTables['TruckPollutionTable'].'.id',$dbTables['TruckPollutionTable'].'.pollution_no',$dbTables['TruckPollutionTable'].'.pollution_on',$dbTables['TruckPollutionTable'].'.pollution_end',$dbTables['TruckPollutionTable'].'.status',$dbTables['TruckPollutionTable'].'.updated_at',$dbTables['TruckTable'].'.truck_no')
			->join($dbTables['TruckTable'], $dbTables['TruckPollutionTable'].'.truck_id', '=', $dbTables['TruckTable'].'.id')
			->where($dbTables['TruckPollutionTable'].'.pollution_end','<',$next_date);
		if($searchKeyword != ''){
		$records = $records->where(function ($query) use ($dbTables,$searchKeyword) {
                $query->where($dbTables['TruckPollutionTable'].'.pollution_no', 'like', '%'.$searchKeyword.'%');
            });
		}
		$records = 	$records
			->orderBy($dbTables['TruckPollutionTable'].'.'.$orderby,$ordertype)
			->skip(($currentPage-1)*$perPageRecord)
            ->take($perPageRecord)
            ->get();

		return $records;
	}

	/*****************************************************/
	# TruckPollution Model             
	# Function name : totalRecords
	# Functionality: get total TruckPollution notification
	# Author : Debamala Dey                                
	# Created Date : 03/09/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                                         
	/*****************************************************/

	public static function totalRecords($dbTables,$searchKeyword) {
		
		$curr_date = date('Y-m-d h:i:s');
        $next_date = date('Y-m-d h:i:s', strtotime("+30 days"));

		$records = TruckPollution::select($dbTables['TruckPollutionTable'].'.id',$dbTables['TruckPollutionTable'].'.pollution_no',$dbTables['TruckPollutionTable'].'.pollution_on',$dbTables['TruckPollutionTable'].'.pollution_end',$dbTables['TruckPollutionTable'].'.status',$dbTables['TruckPollutionTable'].'.updated_at',$dbTables['TruckTable'].'.truck_no')
			->join($dbTables['TruckTable'], $dbTables['TruckPollutionTable'].'.truck_id', '=', $dbTables['TruckTable'].'.id')
			->where($dbTables['TruckPollutionTable'].'.pollution_end','<',$next_date);
		if($searchKeyword != ''){
		$records = $records->where(function ($query) use ($dbTables,$searchKeyword) {
                $query->where($dbTables['TruckPollutionTable'].'.pollution_no', 'like', '%'.$searchKeyword.'%');
            });
		}
		$records = 	$records
			->orderBy($dbTables['TruckPollutionTable'].'.id','ASC')
            ->get();

        $recordsCount = $records->count();

		return $recordsCount;
	}

}

?>