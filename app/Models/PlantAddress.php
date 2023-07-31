<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# PlantAddress Model             
# Class name : PlantAddress
# Functionality: listing of plantAddresses
# Author : Sanchari Ghosh                                 
# Created Date :  16/08/2018                                
# Purpose: Developing the functionality of listing of plantAddresses
/*****************************************************/
class PlantAddress extends Model {
	use SoftDeletes;

	protected $table = 'plant_addresses';
	protected $guarded 	= ['id'];
    protected $fillable = ['plant_id','city_id','state_id','country_id','address','lat','lng','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

    protected $dates    = ['deleted_at'];


    /*****************************************************/
	# PlantAddress Model             
	# Function name : availableRecords
	# Functionality: view plantAddress listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 16/08/2018                                
	# Purpose:  to view plantAddress listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {
		
		$records = PlantAddress::select($dbTables['plantAddressTable'].'.id',$dbTables['plantAddressTable'].'.plant_id',$dbTables['plantAddressTable'].'.city_id',$dbTables['plantAddressTable'].'.state_id',$dbTables['plantAddressTable'].'.country_id',$dbTables['plantAddressTable'].'.address',$dbTables['plantAddressTable'].'.lat',$dbTables['plantAddressTable'].'.lng',$dbTables['plantAddressTable'].'.status',$dbTables['plantAddressTable'].'.updated_at',$dbTables['plantTable'].'.name',$dbTables['countryTable'].'.country_name',$dbTables['stateTable'].'.state_name',$dbTables['cityTable'].'.city_name')
		    ->join($dbTables['plantTable'], $dbTables['plantAddressTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
		    ->join($dbTables['countryTable'], $dbTables['plantAddressTable'].'.country_id', '=', $dbTables['countryTable'].'.id')
			->join($dbTables['stateTable'], $dbTables['plantAddressTable'].'.state_id', '=', $dbTables['stateTable'].'.id')
			->join($dbTables['cityTable'], $dbTables['plantAddressTable'].'.city_id', '=', $dbTables['cityTable'].'.id');

			if (\Auth::user()->user_role_id ==  \Config::get('constants.supervisorRoleId'))	 {
				$records = $records->where($dbTables['plantTable'].'.supervisor_id','=', \Auth::user()->id);
			}

			if($searchKeyword != ''){
				$records = $records->where($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%');
			}
			if($orderby == 'id'){
				$records = $records->orderBy($dbTables['plantAddressTable'].'.'.$orderby,$ordertype);
			}
			if($orderby == 'name'){
				$records = $records->orderBy($dbTables['plantTable'].'.'.$orderby,$ordertype);
			}
			$records = 	$records
			->skip(($currentPage-1)*$perPageRecord)
            ->take($perPageRecord)
            ->get();

		return $records;
	}



	/*****************************************************/
	# PlantAddress Model             
	# Function name : totalRecords
	# Functionality: get total count of plantAddress
	# Author : Debamala Dey                                
	# Created Date : 23/08/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                                         
	/*****************************************************/
	public static function totalRecords($dbTables,$searchKeyword) {
		
		$records = PlantAddress::select($dbTables['plantAddressTable'].'.id',$dbTables['plantAddressTable'].'.plant_id',$dbTables['plantAddressTable'].'.city_id',$dbTables['plantAddressTable'].'.state_id',$dbTables['plantAddressTable'].'.country_id',$dbTables['plantAddressTable'].'.address',$dbTables['plantAddressTable'].'.lat',$dbTables['plantAddressTable'].'.lng',$dbTables['plantAddressTable'].'.status',$dbTables['plantAddressTable'].'.updated_at',$dbTables['plantTable'].'.name',$dbTables['countryTable'].'.country_name',$dbTables['stateTable'].'.state_name',$dbTables['cityTable'].'.city_name')
		    ->join($dbTables['plantTable'], $dbTables['plantAddressTable'].'.plant_id', '=', $dbTables['plantTable'].'.id')
		    ->join($dbTables['countryTable'], $dbTables['plantAddressTable'].'.country_id', '=', $dbTables['countryTable'].'.id')
			->join($dbTables['stateTable'], $dbTables['plantAddressTable'].'.state_id', '=', $dbTables['stateTable'].'.id')
			->join($dbTables['cityTable'], $dbTables['plantAddressTable'].'.city_id', '=', $dbTables['cityTable'].'.id');

		if (\Auth::user()->user_role_id ==  \Config::get('constants.supervisorRoleId'))	 {
			$records = $records->where($dbTables['plantTable'].'.supervisor_id','=', \Auth::user()->id);
		}
		
		if($searchKeyword != ''){
			$records = $records->where($dbTables['plantTable'].'.name', 'like', '%'.$searchKeyword.'%');
		}
		$records = 	$records
			->orderBy($dbTables['plantAddressTable'].'.id','ASC')
            ->get();

        $recordsCount = $records->count();

		return $recordsCount;
	}
}

?>