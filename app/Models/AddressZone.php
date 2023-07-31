<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# AddressZone Model             
# Class name : AddressZone
# Functionality: listing of addressZones
# Author : Sanchari Ghosh                                 
# Created Date :  21/12/2018                                
# Purpose: Developing the functionality of listing of addressZones
/*****************************************************/
class AddressZone extends Model {
	use SoftDeletes;

	protected $table = 'address_zones';
	protected $guarded 	= ['id'];
    protected $fillable = ['latitude','longitude','address','title','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

    protected $dates    = ['deleted_at'];


    /*****************************************************/
	# AddressZone Model             
	# Function name : availableRecords
	# Functionality: view addressZone listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 21/12/2018                                
	# Purpose:  to view addressZone listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword                    
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {
		
		$records = AddressZone::select($dbTables['addressZoneTable'].'.id',$dbTables['addressZoneTable'].'.latitude',$dbTables['addressZoneTable'].'.longitude',$dbTables['addressZoneTable'].'.title',$dbTables['addressZoneTable'].'.address',$dbTables['addressZoneTable'].'.status',$dbTables['addressZoneTable'].'.updated_at');

			if($searchKeyword != ''){
				$records = $records->where($dbTables['addressZoneTable'].'.address','like','%'.$searchKeyword.'%')->orWhere($dbTables['addressZoneTable'].'.latitude', 'like', '%'.$searchKeyword.'%')
					->orWhere($dbTables['addressZoneTable'].'.longitude', 'like', '%'.$searchKeyword.'%')
					->orWhere($dbTables['addressZoneTable'].'.title', 'like', '%'.$searchKeyword.'%');

				$currentPage = 1;
			}
			$records = 	$records->orderBy($dbTables['addressZoneTable'].'.'.$orderby,$ordertype)
						->skip(($currentPage-1)*$perPageRecord)
			            ->take($perPageRecord)
						->get();

		return $records;
	}



	/*****************************************************/
	# AddressZone Model             
	# Function name : totalRecords
	# Functionality: get total count of addressZone
	# Author : Debamala Dey                                
	# Created Date : 22/08/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                                         
	/*****************************************************/
	public static function totalRecords($dbTables,$searchKeyword) {
		
		$records = AddressZone::select($dbTables['addressZoneTable'].'.id',$dbTables['addressZoneTable'].'.latitude',$dbTables['addressZoneTable'].'.longitude',$dbTables['addressZoneTable'].'.address',$dbTables['addressZoneTable'].'.status',$dbTables['addressZoneTable'].'.updated_at');

			if($searchKeyword != ''){
				$records = $records->where($dbTables['addressZoneTable'].'.address', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['addressZoneTable'].'.latitude', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['addressZoneTable'].'.longitude', 'like', '%'.$searchKeyword.'%');
			}

			$records = 	$records->orderBy($dbTables['addressZoneTable'].'.id','ASC')
						->get();

		$recordsCount = $records->count();

		return $recordsCount;
	}




    /*****************************************************/
	# AddressZone Model             
	# Function name : getAddressZoneListing
	# Functionality: get addressZone listing for other modules
	# Author : Sanchari Ghosh                                 
	# Created Date : 31/12/2018                                
	# Purpose:  to get addressZone listing for other modules
	# Params :  $dbTables                   
	/*****************************************************/
	public static function getAddressZoneListing($dbTables) {
		
		$records = AddressZone::select($dbTables['addressZoneTable'].'.id',$dbTables['addressZoneTable'].'.latitude',$dbTables['addressZoneTable'].'.longitude',$dbTables['addressZoneTable'].'.address',$dbTables['addressZoneTable'].'.title',$dbTables['addressZoneTable'].'.status',$dbTables['addressZoneTable'].'.updated_at');

			$records = 	$records->orderBy($dbTables['addressZoneTable'].'.title')
						->get();

		return $records;
	}
}

?>