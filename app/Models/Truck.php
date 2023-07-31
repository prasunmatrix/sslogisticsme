<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# Truck Model             
# Class name : Truck
# Functionality: listing of trucks
# Author : Sanchari Ghosh                                 
# Created Date :  10/08/2018                                
# Purpose: Developing the functionality of listing of trucks
/*****************************************************/
class Truck extends Model {
	use SoftDeletes;

	protected $table = 'trucks';
	protected $guarded 	= ['id'];
    protected $fillable = ['type','truck_no','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

    protected $dates    = ['deleted_at'];




    /*****************************************************/
	# Truck Model             
	# Function name : availableRecords
	# Functionality: view truck listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  to view truck listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword       
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {
		
		$records = Truck::select($dbTables['truckTable'].'.id',$dbTables['truckTable'].'.type',$dbTables['truckTable'].'.truck_no',$dbTables['truckTable'].'.updated_at',$dbTables['truckTable'].'.status',$dbTables['vendorTable'].'.name AS vendor_name',$dbTables['truckTable'].'.created_by')
		    ->join($dbTables['vendorTable'], $dbTables['truckTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id');

		    // if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) { /*for supervisor*/
		    // 	$records = $records->where($dbTables['truckTable'].'.created_by', \Auth::user()->id);
		    // }

			if($searchKeyword != ''){
				/*if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) {
			    	$records = $records->where($dbTables['truckTable'].'.created_by', \Auth::user()->id)
			    					   ->where(function ($query) use ($dbTables,$searchKeyword) {
							                $query->where($dbTables['truckTable'].'.type', 'like', '%'.$searchKeyword.'%')
							                     ->orWhere($dbTables['truckTable'].'.truck_no', 'like', '%'.$searchKeyword.'%')
							                     ->orWhere($dbTables['vendorTable'].'.name', 'like', '%'.$searchKeyword.'%');
							            });
			    } else { */
			    	$records = $records->where($dbTables['truckTable'].'.type', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['truckTable'].'.truck_no', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['vendorTable'].'.name', 'like', '%'.$searchKeyword.'%');
			    //}
				
				

				$currentPage = 1;
			}

			$records = 	$records->orderBy($dbTables['truckTable'].'.'.$orderby,$ordertype)
						->skip(($currentPage-1)*$perPageRecord)
            			->take($perPageRecord)
						->get()->toArray();

			for ($i=0; $i<sizeof($records); $i++) {			
				if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')){	/*for supervisor*/
					if ($records[$i]['created_by'] == \Auth::user()->id) { /*for records created by current user*/
						$records[$i]['canEditDelete'] = true;
					} else {
						$records[$i]['canEditDelete'] = false;
					}
				} else {
					$records[$i]['canEditDelete'] = true;
				}		
			} 				

		return $records;
	}




	/*****************************************************/
	# Truck Model             
	# Function name : validateExistTruck
	# Functionality: check whether truck with same number exists or not
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  check whether truck with same number exists or not 
	# Params :  $truckNo, $truckId                                          
	/*****************************************************/
    public static function validateExistTruck($truckNo, $truckId = '') {
        $where = 	[
                        ['truck_no', $truckNo],
                    ];
        if (!empty($truckId)) {
            $where[] = ['id','<>',$truckId];
        }            
    	$existTruckCount = Truck::where($where)->count();
    	return $existTruckCount;
    }


    
	/*****************************************************/
	# Truck Model             
	# Function name : totalRecords
	# Functionality: get total count of truck
	# Author : Debamala Dey                                
	# Created Date : 22/08/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                                         
	/*****************************************************/
	public static function totalRecords($dbTables,$searchKeyword) {
		
		$records = Truck::select($dbTables['truckTable'].'.id',$dbTables['truckTable'].'.type',$dbTables['truckTable'].'.truck_no',$dbTables['truckTable'].'.updated_at',$dbTables['truckTable'].'.status',$dbTables['vendorTable'].'.name AS vendor_name',$dbTables['truckTable'].'.created_by')
		    ->join($dbTables['vendorTable'], $dbTables['truckTable'].'.vendor_id', '=', $dbTables['vendorTable'].'.id');

		// if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) {
		//     	$records = $records->where($dbTables['truckTable'].'.created_by', \Auth::user()->id);
		// }    
		    
		if($searchKeyword != ''){
				/*if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) {
			    	$records = $records->where($dbTables['truckTable'].'.created_by', \Auth::user()->id)
			    					   ->where(function ($query) use ($dbTables,$searchKeyword) {
							                $query->where($dbTables['truckTable'].'.type', 'like', '%'.$searchKeyword.'%')
							                     ->orWhere($dbTables['truckTable'].'.truck_no', 'like', '%'.$searchKeyword.'%')
							                     ->orWhere($dbTables['vendorTable'].'.name', 'like', '%'.$searchKeyword.'%');
							            });
			    } else { */
			    	$records = $records->where($dbTables['truckTable'].'.type', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['truckTable'].'.truck_no', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['vendorTable'].'.name', 'like', '%'.$searchKeyword.'%');
			    //}
		}

		$records =	$records->orderBy($dbTables['truckTable'].'.id','ASC')
            ->get();

        $recordsCount = $records->count();

		return $recordsCount;
	}
}

?>