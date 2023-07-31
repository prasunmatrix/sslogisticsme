<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# Party Model             
# Class name : Party
# Functionality: listing of parties
# Author : Sanchari Ghosh                                 
# Created Date :  10/08/2018                                
# Purpose: Developing the functionality of listing of parties
/*****************************************************/
class Party extends Model {
	use SoftDeletes;

	protected $table = 'parties';
	protected $guarded 	= ['id'];
    protected $fillable = ['address_zone_id','party_name','party_description','phone_number','email','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

    protected $dates    = ['deleted_at'];


    /*****************************************************/
	# Party Model             
	# Function name : availableRecords
	# Functionality: view party listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  to view party listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword                    
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {
		
		$records = Party::select($dbTables['partyTable'].'.id',$dbTables['partyTable'].'.party_name',$dbTables['partyTable'].'.party_description',$dbTables['partyTable'].'.phone_number',$dbTables['partyTable'].'.email',$dbTables['partyTable'].'.status',$dbTables['partyTable'].'.updated_at',$dbTables['addressZoneTable'].'.address')
			->join($dbTables['addressZoneTable'], $dbTables['partyTable'].'.address_zone_id', '=', $dbTables['addressZoneTable'].'.id');


	    if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) { /*for supervisor*/
		    	//$records = $records->where($dbTables['partyTable'].'.created_by', \Auth::user()->id);
		} 	

		if($searchKeyword != ''){
			// if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) {
		 //    	$records = $records->where($dbTables['partyTable'].'.created_by', \Auth::user()->id)
		 //    					   ->where(function ($query) use ($dbTables,$searchKeyword) {
			// 				                $query->where($dbTables['partyTable'].'.party_name', 'like', '%'.$searchKeyword.'%')
			// 				   					  ->orWhere($dbTables['addressZoneTable'].'.address','like', '%'.$searchKeyword.'%');
			// 				        });
			// } else {
			// 	$records = $records->where($dbTables['partyTable'].'.party_name', 'like', '%'.$searchKeyword.'%')
			// 				   ->orWhere($dbTables['addressZoneTable'].'.address','like', '%'.$searchKeyword.'%');
			// }
			$records = $records->where($dbTables['partyTable'].'.party_name', 'like', '%'.$searchKeyword.'%')
							   ->orWhere($dbTables['addressZoneTable'].'.address','like', '%'.$searchKeyword.'%');								   
			$currentPage = 1;
		}
		$records = 	$records->orderBy($dbTables['partyTable'].'.'.$orderby,$ordertype)
							->skip(($currentPage-1)*$perPageRecord)
				            ->take($perPageRecord)
				            ->get();
		return $records;
	}


	/*****************************************************/
	# Party Model             
	# Function name : totalRecords
	# Functionality: get total count of party
	# Author : Debamala Dey                                
	# Created Date : 22/08/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                                         
	/*****************************************************/
	public static function totalRecords($dbTables,$searchKeyword) {
		
		$records = Party::select($dbTables['partyTable'].'.id',$dbTables['partyTable'].'.party_name',$dbTables['partyTable'].'.party_description',$dbTables['partyTable'].'.phone_number',$dbTables['partyTable'].'.email',$dbTables['partyTable'].'.status',$dbTables['partyTable'].'.updated_at',$dbTables['addressZoneTable'].'.address')
			->join($dbTables['addressZoneTable'], $dbTables['partyTable'].'.address_zone_id', '=', $dbTables['addressZoneTable'].'.id');
			
		if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) { /*for supervisor*/
		    	//$records = $records->where($dbTables['partyTable'].'.created_by', \Auth::user()->id);
		}
		 	
		if($searchKeyword != ''){
		// 	if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) {
		//     	$records = $records->where($dbTables['partyTable'].'.created_by', \Auth::user()->id)
		//     					   ->where(function ($query) use ($dbTables,$searchKeyword) {
		// 					                $query->where($dbTables['partyTable'].'.party_name', 'like', '%'.$searchKeyword.'%')
		// 					   					  ->orWhere($dbTables['addressZoneTable'].'.address','like', '%'.$searchKeyword.'%');
		// 					        });
		// 	} else {
		// 		$records = $records->where($dbTables['partyTable'].'.party_name', 'like', '%'.$searchKeyword.'%')
		// 					   ->orWhere($dbTables['addressZoneTable'].'.address','like', '%'.$searchKeyword.'%');
		// 	}	
			$records = $records->where($dbTables['partyTable'].'.party_name', 'like', '%'.$searchKeyword.'%')
							   ->orWhere($dbTables['addressZoneTable'].'.address','like', '%'.$searchKeyword.'%');				   
		}
		$records = 	$records->orderBy($dbTables['partyTable'].'.id','ASC')
            				->get();

        $recordsCount = $records->count();

		return $recordsCount;
	}

}

?>