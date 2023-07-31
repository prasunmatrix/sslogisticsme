<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


/*****************************************************/
# Bank Model             
# Class name : Bank
# Functionality: 
# Author : Sanchari Ghosh                                 
# Created Date :  25/04/2019                                
# Purpose: 
/*****************************************************/
class Bank extends Model {
	protected $table = 'banks';
	protected $guarded 	= ['id'];
    protected $fillable = ['name','createdOn','modifiedOn','ip','status','delflag'];



    /*****************************************************/
	# Bank Model             
	# Function name : availableRecords
	# Functionality: view bank listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 25/04/2019                                
	# Purpose:  to view bank listing page  
	# Params :  $dbTables                                       
	/*****************************************************/
	public static function availableRecords($dbTables) {
		
		$records = Bank::select($dbTables['bankTable'].'.id',$dbTables['bankTable'].'.name')
					->where($dbTables['bankTable'].'.delflag',0)
					->orderBy($dbTables['bankTable'].'.name','ASC')->get();

		return $records;
	}
}

?>