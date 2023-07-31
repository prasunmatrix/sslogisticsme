<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


/*****************************************************/
# Country Model             
# Class name : Country
# Functionality: 
# Author : Sanchari Ghosh                                 
# Created Date :  06/08/2018                                
# Purpose: 
/*****************************************************/
class Country extends Model {
	protected $table = 'countries';
	protected $guarded 	= ['id'];
    protected $fillable = ['country_name','country_code','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];






    /*****************************************************/
	# Country Model             
	# Function name : availableRecords
	# Functionality: view country listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  to view country listing page  
	# Params :  $dbTables,$recordPerPage                                          
	/*****************************************************/
	public static function availableRecords($dbTables,$perPageRecord) {
		
		$records = Country::select($dbTables['countryTable'].'.id',$dbTables['countryTable'].'.country_name',$dbTables['countryTable'].'.country_code',$dbTables['countryTable'].'.status',$dbTables['countryTable'].'.updated_at')
			->orderBy($dbTables['countryTable'].'.id','ASC')->get();


		return $records;
	}
}

?>