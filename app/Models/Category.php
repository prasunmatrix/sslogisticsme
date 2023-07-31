<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# Category Model             
# Class name : Category
# Functionality: listing of categories
# Author : Sanchari Ghosh                                 
# Created Date :  07/08/2018                                
# Purpose: Developing the functionality of listing of categories
/*****************************************************/
class Category extends Model {
	use SoftDeletes;

	protected $table = 'categories';
	protected $guarded 	= ['id'];
    protected $fillable = ['category_name','category_description','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

    protected $dates    = ['deleted_at'];


    /*****************************************************/
	# Category Model             
	# Function name : availableRecords
	# Functionality: view category listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  to view category listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword                    
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {
		
		$records = Category::select($dbTables['categoryTable'].'.id',$dbTables['categoryTable'].'.category_name',$dbTables['categoryTable'].'.category_description',$dbTables['categoryTable'].'.status',$dbTables['categoryTable'].'.updated_at');

			if($searchKeyword != ''){
				$records = $records->where($dbTables['categoryTable'].'.category_name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['categoryTable'].'.category_description', 'like', '%'.$searchKeyword.'%');
				$currentPage = 1;
			}
			$records = 	$records->orderBy($dbTables['categoryTable'].'.'.$orderby,$ordertype)
						->skip(($currentPage-1)*$perPageRecord)
			            ->take($perPageRecord)
						->get();

		return $records;
	}



	/*****************************************************/
	# Category Model             
	# Function name : totalRecords
	# Functionality: get total count of category
	# Author : Debamala Dey                                
	# Created Date : 22/08/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                                         
	/*****************************************************/
	public static function totalRecords($dbTables,$searchKeyword) {
		
		$records = Category::select($dbTables['categoryTable'].'.id',$dbTables['categoryTable'].'.category_name',$dbTables['categoryTable'].'.category_description',$dbTables['categoryTable'].'.status',$dbTables['categoryTable'].'.updated_at');

			if($searchKeyword != ''){
				$records = $records->where($dbTables['categoryTable'].'.category_name', 'like', '%'.$searchKeyword.'%')->orWhere($dbTables['categoryTable'].'.category_description', 'like', '%'.$searchKeyword.'%');
			}

			$records = 	$records->orderBy($dbTables['categoryTable'].'.id','ASC')
						->get();

		$recordsCount = $records->count();

		return $recordsCount;
	}
}

?>