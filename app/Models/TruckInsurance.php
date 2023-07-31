<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# TruckInsurance Model             
# Class name : TruckInsurance
# Functionality: 
# Author : Sanchari Ghosh                                 
# Created Date :  13/08/2018                                
# Purpose: 
/*****************************************************/
class TruckInsurance extends Model {
	use SoftDeletes;

	protected $table = 'truck_insurances';
	protected $guarded 	= ['id'];
    protected $fillable = ['truck_id','policy_no','name','policy_on','policy_start','policy_end','policy_file','status','read_status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

    protected $dates    = ['deleted_at'];


    /*****************************************************/
	# TruckInsurance Model             
	# Function name : availableRecords
	# Functionality: view TruckInsurance listing page
	# Author : Debamala Dey                                
    # Created Date : 03/09/2018                                
	# Purpose:  to view TruckInsurance listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {

		$curr_date = date('Y-m-d h:i:s');
        $next_date = date('Y-m-d h:i:s', strtotime("+30 days"));
		
		$records = TruckInsurance::select($dbTables['TruckInsuranceTable'].'.id',$dbTables['TruckInsuranceTable'].'.policy_no',$dbTables['TruckInsuranceTable'].'.policy_on',$dbTables['TruckInsuranceTable'].'.policy_end',$dbTables['TruckInsuranceTable'].'.status',$dbTables['TruckInsuranceTable'].'.updated_at',$dbTables['TruckTable'].'.truck_no')
			->join($dbTables['TruckTable'], $dbTables['TruckInsuranceTable'].'.truck_id', '=', $dbTables['TruckTable'].'.id')
			->where($dbTables['TruckInsuranceTable'].'.policy_end','<',$next_date);
		if($searchKeyword != ''){
			$records = $records->where(function ($query) use ($dbTables,$searchKeyword) {
                $query->where($dbTables['TruckInsuranceTable'].'.policy_no', 'like', '%'.$searchKeyword.'%');
                	 
            });
		}
		$records = 	$records
			->orderBy($dbTables['TruckInsuranceTable'].'.'.$orderby,$ordertype)
			->skip(($currentPage-1)*$perPageRecord)
            ->take($perPageRecord)
            ->get();

		return $records;
	}




	/*****************************************************/
	# TruckInsurance Model             
	# Function name : totalRecords
	# Functionality: get total Truck Insurance notification
	# Author : Debamala Dey                                
	# Created Date : 03/09/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                                         
	/*****************************************************/
	public static function totalRecords($dbTables,$searchKeyword) {
		
		$curr_date = date('Y-m-d h:i:s');
        $next_date = date('Y-m-d h:i:s', strtotime("+30 days"));

		$records = TruckInsurance::select($dbTables['TruckInsuranceTable'].'.id',$dbTables['TruckInsuranceTable'].'.policy_no',$dbTables['TruckInsuranceTable'].'.policy_on',$dbTables['TruckInsuranceTable'].'.policy_end',$dbTables['TruckInsuranceTable'].'.status',$dbTables['TruckInsuranceTable'].'.updated_at',$dbTables['TruckTable'].'.truck_no')
			->join($dbTables['TruckTable'], $dbTables['TruckInsuranceTable'].'.truck_id', '=', $dbTables['TruckTable'].'.id')
			->where($dbTables['TruckInsuranceTable'].'.policy_end','<',$next_date);
		if($searchKeyword != ''){
			$records = $records->where(function ($query) use ($dbTables,$searchKeyword) {
                $query->where($dbTables['TruckInsuranceTable'].'.policy_no', 'like', '%'.$searchKeyword.'%');
            });
		}
		$records = 	$records
			->orderBy($dbTables['TruckInsuranceTable'].'.id','ASC')
            ->get();

        $recordsCount = $records->count();

		return $recordsCount;
	}


}

?>