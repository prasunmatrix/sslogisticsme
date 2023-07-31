<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# TruckPermit Model             
# Class name : TruckPermit
# Functionality: 
# Author : Sanchari Ghosh                                 
# Created Date :  21/08/2018                                
# Purpose: 
/*****************************************************/
class TruckPermit extends Model {
	use SoftDeletes;

	protected $table = 'truck_permits';
	protected $guarded 	= ['id'];
    protected $fillable = ['truck_id','permit_no','name','permit_on','permit_start','permit_end','permit_file','status','read_status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

    protected $dates    = ['deleted_at'];

    
    /*****************************************************/
	# TruckPermit Model             
	# Function name : availableRecords
	# Functionality: view TruckPermit listing page
	# Author : Debamala Dey                                
    # Created Date : 03/09/2018                                
	# Purpose:  to view TruckPermit listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {

		$curr_date = date('Y-m-d h:i:s');
        $next_date = date('Y-m-d h:i:s', strtotime("+30 days"));
		
		$records = TruckPermit::select($dbTables['TruckPermitTable'].'.id',$dbTables['TruckPermitTable'].'.permit_no',$dbTables['TruckPermitTable'].'.permit_on',$dbTables['TruckPermitTable'].'.permit_end',$dbTables['TruckPermitTable'].'.status',$dbTables['TruckPermitTable'].'.updated_at',$dbTables['TruckTable'].'.truck_no')
			->join($dbTables['TruckTable'], $dbTables['TruckPermitTable'].'.truck_id', '=', $dbTables['TruckTable'].'.id')
			->where($dbTables['TruckPermitTable'].'.permit_end','<',$next_date);
		if($searchKeyword != ''){
			$records = $records->where(function ($query) use ($dbTables,$searchKeyword) {
                $query->where($dbTables['TruckPermitTable'].'.permit_no', 'like', '%'.$searchKeyword.'%');
            });
		}
		$records = 	$records
			->orderBy($dbTables['TruckPermitTable'].'.'.$orderby,$ordertype)
			->skip(($currentPage-1)*$perPageRecord)
            ->take($perPageRecord)
            ->get();

		return $records;
	}

	/*****************************************************/
	# TruckPermit Model             
	# Function name : totalRecords
	# Functionality: get total TruckPermit notification
	# Author : Debamala Dey                                
	# Created Date : 03/09/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                                         
	/*****************************************************/

	public static function totalRecords($dbTables,$searchKeyword) {
		
		$curr_date = date('Y-m-d h:i:s');
        $next_date = date('Y-m-d h:i:s', strtotime("+30 days"));

		$records = TruckPermit::select($dbTables['TruckPermitTable'].'.id',$dbTables['TruckPermitTable'].'.permit_no',$dbTables['TruckPermitTable'].'.permit_on',$dbTables['TruckPermitTable'].'.permit_end',$dbTables['TruckPermitTable'].'.status',$dbTables['TruckPermitTable'].'.updated_at',$dbTables['TruckTable'].'.truck_no')
			->join($dbTables['TruckTable'], $dbTables['TruckPermitTable'].'.truck_id', '=', $dbTables['TruckTable'].'.id')
			->where($dbTables['TruckPermitTable'].'.permit_end','<',$next_date);
		if($searchKeyword != ''){
			$records = $records->where(function ($query) use ($dbTables,$searchKeyword) {
                $query->where($dbTables['TruckPermitTable'].'.permit_no', 'like', '%'.$searchKeyword.'%');
            });
		}
		$records = 	$records
			->orderBy($dbTables['TruckPermitTable'].'.id','ASC')
            ->get();

        $recordsCount = $records->count();

		return $recordsCount;
	}

}

?>