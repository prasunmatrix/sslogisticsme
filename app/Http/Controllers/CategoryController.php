<?php

/*****************************************************/
# Category Controller             
# Class name : CategoryController
# Functionality: listing, add, edit, deletion of categories
# Author : Sanchari Ghosh                                 
# Created Date :  07/08/2018                                
# Purpose: Developing the functionality of listing, add, edit, deletion of categories
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Trip;

class CategoryController extends Controller {
 
	/*****************************************************/
	# Category Controller             
	# Class name : CategoryController
	# Functionality: constructor
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                 
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}
	

	/*****************************************************/
	# Category Controller             
	# Function name : index
	# Functionality: view category listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  to view category listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('categories.categoryList');
	}



	/*****************************************************/
	# Category Controller             
	# Function name : getCategoryList
	# Functionality: get data of category listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  to get data of category listing page  
	# Params : Request $request                                          
	/*****************************************************/
	public function getCategoryList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'categoryTable' => config('dbtables.categories'),
				);

		/*get available records*/
		$categoryList = Category::availableRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$totalCategories = Category::totalRecords($dbTables,$request->searchKeyword);
		
		/*customizing final array*/
		$data['categoryList'] 	= $categoryList;
		$data['currentPage']    = $request->currentPage;
		$data['totalCategories']= $totalCategories;
		$data['success']		= 'true'; 

		return $data;
	}




	/*****************************************************/
	# Category Controller             
	# Function name : viewAddCategory
	# Functionality: view add category page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  view add category page 
	# Params :                                            
	/*****************************************************/
	public function viewAddCategory(){
		return view('categories.addForm');
	}



	/*****************************************************/
	# Category Controller             
	# Function name : viewEditCategory
	# Functionality: view edit category page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  view edit category page 
	# Params :                                            
	/*****************************************************/
	public function viewEditCategory(){
		return view('categories.editForm');
	}




	/*****************************************************/
	# Category Controller             
	# Function name : getEditCategory
	# Functionality: get edit category page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  get edit category page 
	# Params :  Request $request                                          
	/*****************************************************/
	public function getEditCategory(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$categoryId = $request->categoryId;

		/*get available records*/
		$categoryDetails = Category::find($categoryId);

		/*customizing final array*/
		$data['categoryDetails'] 	= $categoryDetails;
		$data['success'] 			= 'true';

		return $data;
	}






	/*****************************************************/
	# Category Controller             
	# Function name : saveCategory
	# Functionality: save category
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  save category 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveCategory(Request $request){

		$data 	    = array(); /*storing data for listing*/ 
		$subcatId 	= array(); /*storing sub category ids for change status*/

		
		if (isset($request->categoryId) && ($request->categoryId != '')) {
			$category 						= Category::find($request->categoryId);
			$category->updated_by			= \Auth::user()->id;
			$existCount 					= $this->nameExistsCheck('Category','category_name',strtolower($request->categoryName),$request->categoryId);
		} else {
			$category 						= new Category();
			$existCount 					= $this->nameExistsCheck('Category','category_name',strtolower($request->categoryName),'');
			$category->created_by			= \Auth::user()->id;
		}


		if ($existCount > 0) {
			$data['success'] = 'false';
			$data['count'] 	 =  $existCount ;
		} else {
	    	$category->category_name 		= $request->categoryName;
	    	$category->category_description = ($request->categoryDesc == 'undefined' || $request->categoryDesc == 'null') ? NULL :($request->categoryDesc);
	    	$category->status 				= $request->status;
	    	
	    	
	    	$category->save();


	    	/*change the status of subcategory while category status is being changed*/
	    	if (isset($request->categoryId) && ($request->categoryId != '') && ($category->status == 'I')) {
		    	
				$subcategoryDetails = Subcategory::where('category_id',$request->categoryId)->get()->toArray();

				if (!empty($subcategoryDetails)) {
					foreach ($subcategoryDetails as $subcat) {
						array_push($subcatId, $subcat['id']);
					}
					Subcategory::whereIn('id',$subcatId)->update(array('updated_by' => \Auth::user()->id,'status'=>$category->status)); 
				}
		    }


		    $data['category']       = $category->id;
	 		$data['success'] 		= 'true';

	 		if (isset($request->categoryId) && ($request->categoryId != '')) {
				$request->session()->flash('alert-success', 'Category Edited Successfully');
			} else {
				$request->session()->flash('alert-success', 'Category Added Successfully');
			}
		}
 		
        return $data;
	}




	/*****************************************************/
	# Category Controller             
	# Function name : deleteCategory
	# Functionality: delete category
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  delete category 
	# Params :  Request $request                                          
	/*****************************************************/
	public function deleteCategory(Request $request){

		$data 		= array(); /*storing data for listing*/ 

		/*check existance of subcategory under the category*/
		$subcategoryDetails = Subcategory::where('category_id',$request->categoryId)->count();


		/*check existance of category in trip*/
		$tripCategoryDetails = Trip::where('category_id',$request->categoryId)->count();

		if(is_numeric($request->categoryId)) {
			if (($subcategoryDetails > 0) || ($tripCategoryDetails > 0)) {
				$data['success']		= 'false'; 
			} else {
				/*delete data*/
				$category = Category::find($request->categoryId); 
				$data['catname'] = $category->category_name;
				$data['catid'] = $category->id;
				$category->deleted_by = \Auth::user()->id;/*logged in user id*/
				$category->status     = 'D';
				$category->is_deleted = 'Y';
				$category->save();

				/*soft delete the record*/
				$category->delete();

				$data['success']		= 'true'; 
			}
		} else {
			$data['success']		= 'not_numeric'; 
		}

		
		$data['count'] = $tripCategoryDetails;
		return $data;
		
	}
	

}
