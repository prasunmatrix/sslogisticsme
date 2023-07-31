<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;


/*****************************************************/
# State Model             
# Class name : State
# Functionality: listing of states
# Author : Sanchari Ghosh                                 
# Created Date :  03/08/2018                                
# Purpose: Developing the functionality of listing of states
/*****************************************************/
class State extends Model {
	use SoftDeletes;
	
	protected $table = 'states';
	protected $guarded 	= ['id'];
    protected $fillable = ['country_id','state_name','state_code','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

	protected $dates    = ['deleted_at'];


    /*****************************************************/
	# State Model             
	# Function name : availableRecords
	# Functionality: view state listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/08/2018                                
	# Purpose:  to view state listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword                    
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {
		
		$records = State::select($dbTables['stateTable'].'.id',$dbTables['stateTable'].'.state_name',$dbTables['stateTable'].'.state_code',$dbTables['stateTable'].'.status',$dbTables['stateTable'].'.updated_at',$dbTables['countryTable'].'.country_name')
			->join($dbTables['countryTable'], $dbTables['stateTable'].'.country_id', '=', $dbTables['countryTable'].'.id');
		if($searchKeyword != ''){
		$records = $records->where($dbTables['stateTable'].'.state_name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['stateTable'].'.state_code', 'like', '%'.$searchKeyword.'%');
		}
		$records = 	$records->orderBy($dbTables['stateTable'].'.'.$orderby,$ordertype)
							->skip(($currentPage-1)*$perPageRecord)
				            ->take($perPageRecord)
				            ->get();

		return $records;
	}



	/*****************************************************/
	# State Model             
	# Function name : totalRecords
	# Functionality: get total count of state
	# Author : Debamala Dey                                
	# Created Date : 22/08/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                                         
	/*****************************************************/
	public static function totalRecords($dbTables,$searchKeyword) {
		
		$records = State::select($dbTables['stateTable'].'.id',$dbTables['stateTable'].'.state_name',$dbTables['stateTable'].'.state_code',$dbTables['stateTable'].'.status',$dbTables['stateTable'].'.updated_at',$dbTables['countryTable'].'.country_name')
			->join($dbTables['countryTable'], $dbTables['stateTable'].'.country_id', '=', $dbTables['countryTable'].'.id');
		if($searchKeyword != ''){
		$records = $records->where($dbTables['stateTable'].'.state_name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['stateTable'].'.state_code', 'like', '%'.$searchKeyword.'%');
		}
		$records = 	$records->orderBy($dbTables['stateTable'].'.id','ASC')
            				->get();

        $recordsCount = $records->count();

		return $recordsCount;
	}



	/*****************************************************/
	# State Model             
	# Function name : validateExistState
	# Functionality: check whether state with same name exists or not
	# Author : Sanchari Ghosh                                 
	# Created Date : 22/08/2018                                
	# Purpose:  check whether state with same name exists or not 
	# Params :  $stateName, $stateId                                          
	/*****************************************************/
    public static function validateExistState($stateName, $stateId = '') {

		$existStateCount = State::whereRaw('LOWER(`state_name`) like "'.$stateName.'"');                    
        if (!empty($stateId)) {
        	$existStateCount->where('id','<>',$stateId);
        }            
    	
    	$data = $existStateCount->count();
    	
    	return $data;
    }

}

?>