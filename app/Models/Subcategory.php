<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# Subcategory Model             
# Class name : Subcategory
# Functionality: listing of subcategories
# Author : Sanchari Ghosh                                 
# Created Date :  07/08/2018                                
# Purpose: Developing the functionality of listing of subcategories
/*****************************************************/
class Subcategory extends Model {
	use SoftDeletes;

	protected $table = 'items';
	protected $guarded 	= ['id'];
    protected $fillable = ['category_id','item_name','item_description','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

    protected $dates    = ['deleted_at'];


    /*****************************************************/
	# Subcategory Model             
	# Function name : availableRecords
	# Functionality: view subcategory listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  to view subcategory listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword                    
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {
		
		$records = Subcategory::select($dbTables['subcategoryTable'].'.id',$dbTables['subcategoryTable'].'.item_name',$dbTables['subcategoryTable'].'.item_description',$dbTables['subcategoryTable'].'.status',$dbTables['subcategoryTable'].'.updated_at',$dbTables['categoryTable'].'.category_name')
		    ->join($dbTables['categoryTable'], $dbTables['subcategoryTable'].'.category_id', '=', $dbTables['categoryTable'].'.id');

			if($searchKeyword != ''){
				$records = $records->where($dbTables['subcategoryTable'].'.item_name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['subcategoryTable'].'.item_description', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['categoryTable'].'.category_name', 'like', '%'.$searchKeyword.'%');

				$currentPage = 1;
			}

			$records = 	$records->orderBy($dbTables['subcategoryTable'].'.'.$orderby,$ordertype)
						->skip(($currentPage-1)*$perPageRecord)
			            ->take($perPageRecord)
			            ->get();

		return $records;
	}



	/*****************************************************/
	# Subcategory Model             
	# Function name : totalRecords
	# Functionality: get total count of subcategory
	# Author : Debamala Dey                                
	# Created Date : 22/08/2018                                
	# Purpose:  to get pagination
	# Params : $dbTables,$searchKeyword                                         
	/*****************************************************/
	public static function totalRecords($dbTables,$searchKeyword) {
		
		$records = Subcategory::select($dbTables['subcategoryTable'].'.id',$dbTables['subcategoryTable'].'.item_name',$dbTables['subcategoryTable'].'.item_description',$dbTables['subcategoryTable'].'.status',$dbTables['subcategoryTable'].'.updated_at',$dbTables['categoryTable'].'.category_name')
		    ->join($dbTables['categoryTable'], $dbTables['subcategoryTable'].'.category_id', '=', $dbTables['categoryTable'].'.id');

		   if($searchKeyword != ''){
				$records = $records->where($dbTables['subcategoryTable'].'.item_name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['subcategoryTable'].'.item_description', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['categoryTable'].'.category_name', 'like', '%'.$searchKeyword.'%');
			}

			$records = 	$records->orderBy($dbTables['subcategoryTable'].'.id','ASC')
            			->get();

        $recordsCount = $records->count();

		return $recordsCount;
	}
}

?>