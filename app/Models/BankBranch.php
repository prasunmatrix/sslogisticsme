<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


/*****************************************************/
# Bank Model             
# Class name : BankBranch
# Functionality: 
# Author : Sanchari Ghosh                                 
# Created Date :  25/04/2019                                
# Purpose: 
/*****************************************************/
class BankBranch extends Model {
	protected $table = 'bank_branches';
	protected $guarded 	= ['id'];
    protected $fillable = ['bank_id','name','ifsc','micr','contact','address','city','district','state','createdOn','modifiedOn','ip','status','delflag'];



    /*****************************************************/
	# Banl Model             
	# Function name : availableRecords
	# Functionality: view bank branch listing page along with bank name
	# Author : Sanchari Ghosh                                 
	# Created Date : 25/04/2019                                
	# Purpose:  to view bank branch listing page along with bank name  
	# Params :  $dbTables,$bankId                                          
	/*****************************************************/
	public static function availableRecords($dbTables,$bankId) {
		
		$records = BankBranch::select($dbTables['bankBranchTable'].'.id',$dbTables['bankBranchTable'].'.name',$dbTables['bankBranchTable'].'.ifsc')
		            ->join($dbTables['bankTable'], $dbTables['bankBranchTable'].'.bank_id', '=', $dbTables['bankTable'].'.id')
					->where($dbTables['bankBranchTable'].'.delflag',0)
					->where($dbTables['bankTable'].'.id',$bankId)
					->orderBy($dbTables['bankBranchTable'].'.name','ASC')->get()->toArray();

		/*customizing display name*/			
		for($i=0; $i<sizeof($records); $i++) {
			$records[$i]['display_name'] = $records[$i]['ifsc'].' ( '.$records[$i]['name'].' )';
		}

		return $records;
	}
}

?>