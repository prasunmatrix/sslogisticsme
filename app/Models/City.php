<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# City Model             
# Class name : City
# Functionality: listing of cities
# Author : Sanchari Ghosh                                 
# Created Date :  07/08/2018                                
# Purpose: Developing the functionality of listing of cities
/*****************************************************/
class City extends Model {
	use SoftDeletes;
	
	protected $table = 'cities';
	protected $guarded 	= ['id'];
    protected $fillable = ['country_id','state_id','city_name','city_code','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

	protected $dates    = ['deleted_at'];


    /*****************************************************/
	# City Model             
	# Function name : availableRecords
	# Functionality: view City listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  to view city listing page  
	# Params: $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {
		
		$records = City::select($dbTables['cityTable'].'.id',$dbTables['cityTable'].'.city_name',$dbTables['cityTable'].'.city_code',$dbTables['cityTable'].'.status',$dbTables['cityTable'].'.updated_at',$dbTables['countryTable'].'.country_name',$dbTables['stateTable'].'.state_name')
			->join($dbTables['countryTable'], $dbTables['cityTable'].'.country_id', '=', $dbTables['countryTable'].'.id')
			->join($dbTables['stateTable'], $dbTables['cityTable'].'.state_id', '=', $dbTables['stateTable'].'.id');

			if($searchKeyword != ''){
				$records = $records->where($dbTables['cityTable'].'.city_name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['cityTable'].'.city_code', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['stateTable'].'.state_name', 'like', '%'.$searchKeyword.'%');
			}
			$records = 	$records->orderBy($dbTables['cityTable'].'.'.$orderby,$ordertype)
								->skip(($currentPage-1)*$perPageRecord)
					            ->take($perPageRecord)
					            ->get();

		return $records;
	}

	/*****************************************************/
	# City Model             
	# Function name : totalRecords
	# Functionality: get total count of City
	# Author : Debamala Dey                                
	# Created Date : 22/08/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                                         
	/*****************************************************/

	public static function totalRecords($dbTables,$searchKeyword) {
		
		$records = City::select($dbTables['cityTable'].'.id',$dbTables['cityTable'].'.city_name',$dbTables['cityTable'].'.city_code',$dbTables['cityTable'].'.status',$dbTables['cityTable'].'.updated_at',$dbTables['countryTable'].'.country_name',$dbTables['stateTable'].'.state_name')
			->join($dbTables['countryTable'], $dbTables['cityTable'].'.country_id', '=', $dbTables['countryTable'].'.id');
			if($searchKeyword != ''){
				$records = $records->where($dbTables['cityTable'].'.city_name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['cityTable'].'.city_code', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['stateTable'].'.state_name', 'like', '%'.$searchKeyword.'%');
			}
			$records = 	$records->join($dbTables['stateTable'], $dbTables['cityTable'].'.state_id', '=', $dbTables['stateTable'].'.id')
						->orderBy($dbTables['cityTable'].'.id','ASC')
			            ->get();

        $recordsCount = $records->count();

		return $recordsCount;
	}



	
	/*****************************************************/
	# City Model             
	# Function name : validateExistCity
	# Functionality: check whether city with same name exists or not
	# Author : Sanchari Ghosh                                 
	# Created Date : 22/08/2018                                
	# Purpose:  check whether city with same name exists or not 
	# Params :  $cityName, $cityId                                          
	/*****************************************************/
    public static function validateExistCity($cityName, $cityId = '') {
        $existCityCount = City::whereRaw('LOWER(`city_name`) like "'.$cityName.'"');                    
        if (!empty($cityId)) {
        	$existCityCount->where('id','<>',$cityId);
        }            
    	
    	$data = $existCityCount->count();
    	
    	return $data;
    }
}

?>