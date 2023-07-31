<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# TruckTax Model             
# Class name : TruckTax
# Functionality: 
# Author : Sanchari Ghosh                                 
# Created Date :  21/08/2018                                
# Purpose: 
/*****************************************************/
class TruckTax extends Model {
	use SoftDeletes;

	protected $table = 'truck_taxes';
	protected $guarded 	= ['id'];
    protected $fillable = ['truck_id','invoice_no','name','tax_paid_date','tax_period_start','tax_period_end','tax_file','status','read_status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

    protected $dates    = ['deleted_at'];

    /*****************************************************/
	# TruckTax Model             
	# Function name : availableRecords
	# Functionality: view TruckTax listing page
	# Author : Debamala Dey                                
    # Created Date : 03/09/2018                                
	# Purpose:  to view TruckTax listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {

		$curr_date = date('Y-m-d h:i:s');
        $next_date = date('Y-m-d h:i:s', strtotime("+30 days"));
		
		$records = TruckTax::select($dbTables['TruckTaxTable'].'.id',$dbTables['TruckTaxTable'].'.invoice_no',$dbTables['TruckTaxTable'].'.tax_paid_date',$dbTables['TruckTaxTable'].'.tax_period_end',$dbTables['TruckTaxTable'].'.status',$dbTables['TruckTaxTable'].'.updated_at',$dbTables['TruckTable'].'.truck_no')
			->join($dbTables['TruckTable'], $dbTables['TruckTaxTable'].'.truck_id', '=', $dbTables['TruckTable'].'.id')
			->where($dbTables['TruckTaxTable'].'.tax_period_end','<',$next_date);
		if($searchKeyword != ''){
		$records = $records->where(function ($query) use ($dbTables,$searchKeyword) {
                $query->where($dbTables['TruckTaxTable'].'.invoice_no', 'like', '%'.$searchKeyword.'%');
            });
		}
		$records = 	$records
			->orderBy($dbTables['TruckTaxTable'].'.'.$orderby,$ordertype)
			->skip(($currentPage-1)*$perPageRecord)
            ->take($perPageRecord)
            ->get();

		return $records;
	}

	/*****************************************************/
	# TruckTax Model             
	# Function name : totalRecords
	# Functionality: get total TruckTax notification
	# Author : Debamala Dey                                
	# Created Date : 03/09/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                                        
	/*****************************************************/

	public static function totalRecords($dbTables,$searchKeyword) {
		
		$curr_date = date('Y-m-d h:i:s');
        $next_date = date('Y-m-d h:i:s', strtotime("+30 days"));

		$records = TruckTax::select($dbTables['TruckTaxTable'].'.id',$dbTables['TruckTaxTable'].'.invoice_no',$dbTables['TruckTaxTable'].'.tax_paid_date',$dbTables['TruckTaxTable'].'.tax_period_end',$dbTables['TruckTaxTable'].'.status',$dbTables['TruckTaxTable'].'.updated_at',$dbTables['TruckTable'].'.truck_no')
			->join($dbTables['TruckTable'], $dbTables['TruckTaxTable'].'.truck_id', '=', $dbTables['TruckTable'].'.id')
			->where($dbTables['TruckTaxTable'].'.tax_period_end','<',$next_date);
		if($searchKeyword != ''){
		$records = $records->where(function ($query) use ($dbTables,$searchKeyword) {
                $query->where($dbTables['TruckTaxTable'].'.invoice_no', 'like', '%'.$searchKeyword.'%');
            });
		}
		$records = 	$records
			->orderBy($dbTables['TruckTaxTable'].'.id','ASC')
            ->get();

        $recordsCount = $records->count();

		return $recordsCount;
	}

}

?>