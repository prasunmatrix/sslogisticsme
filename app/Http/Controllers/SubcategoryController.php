<?php

/*****************************************************/
# Subcategory Controller             
# Class name : SubcategoryController
# Functionality: listing, add, edit, deletion subcategories
# Author : Sanchari Ghosh                                 
# Created Date :  07/08/2018                                
# Purpose: Developing the functionality of listing, add, edit, deletion of subcategories
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Trip;


class SubcategoryController extends Controller {
 
	/*****************************************************/
	# Subcategory Controller             
	# Class name : SubcategoryController
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
	# Subcategory Controller             
	# Function name : index
	# Functionality: view subcategory listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  to view subcategory listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('subcategories.subcategoryList');
	}



	/*****************************************************/
	# Subcategory Controller             
	# Function name : getSubcategoryList
	# Functionality: get data of subcategory listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  to get data of subcategory listing page  
	# Params : Request $request                                           
	/*****************************************************/
	public function getSubcategoryList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'categoryTable'    => config('dbtables.categories'),
					'subcategoryTable' => config('dbtables.subcategories'),
				);
		
		/*get available records*/
		$subcategoryList = Subcategory::availableRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$totalSubcategory = Subcategory::totalRecords($dbTables,$request->searchKeyword);
		
		/*customizing final array*/
		$data['subcategoryList'] 	= $subcategoryList;
		$data['totalSubcategory'] 	= $totalSubcategory;
		$data['currentPage']    	= $request->currentPage;
		$data['orderBy'] 			= $request->orderby;
		$data['success']			= 'true'; 

		return $data;
	}



	/*****************************************************/
	# Subcategory Controller             
	# Function name : viewCategoryList
	# Functionality: get category lists
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  get category lists
	# Params :                                           
	/*****************************************************/
	public function viewCategoryList(){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$categoryList = Category::where('status','A')->orderby('category_name')->get()->toArray();

		/*customizing final array*/
		$data['categoryList'] 		= $categoryList;
		$data['success'] 			= 'true';

		return $data;
	}



	/*****************************************************/
	# Subcategory Controller             
	# Function name : viewAddSubcategory
	# Functionality: view add subcategory page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  view add subcategory page 
	# Params :                                            
	/*****************************************************/
	public function viewAddSubcategory(){
		return view('subcategories.addForm');
	}



	/*****************************************************/
	# Subcategory Controller             
	# Function name : viewEditSubcategory
	# Functionality: view edit subcategory page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  view edit subcategory page 
	# Params :                                            
	/*****************************************************/
	public function viewEditSubcategory(){
		return view('subcategories.editForm');
	}




	/*****************************************************/
	# Subcategory Controller             
	# Function name : getEditSubcategory
	# Functionality: get edit subcategory page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  get edit subcategory page 
	# Params :  Request $request                                          
	/*****************************************************/
	public function getEditSubcategory(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$subcategoryId = $request->subcategoryId;

		/*get available records*/
		$subcategoryDetails = Subcategory::find($subcategoryId);

		/*customizing final array*/
		$data['subcategoryDetails'] 	= $subcategoryDetails;
		$data['success'] 			= 'true';

		return $data;
	}






	/*****************************************************/
	# Subcategory Controller             
	# Function name : saveSubcategory
	# Functionality: save subcategory
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  save subcategory 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveSubcategory(Request $request){

		$data 	= array(); /*storing data for listing*/ 
		$existCount = 0;
		
		if (isset($request->subcategoryId) && ($request->subcategoryId != '')) {
			$subcategory 					= Subcategory::find($request->subcategoryId);
			$existCount 					= $this->nameExistsCheck('Subcategory','item_name',strtolower($request->subcategoryName),$request->subcategoryId);
			$subcategory->updated_by		= \Auth::user()->id;
		} else {
			$subcategory 					= new Subcategory();
			$existCount 					= $this->nameExistsCheck('Subcategory','item_name',strtolower($request->subcategoryName),'');
			$subcategory->created_by		= \Auth::user()->id;
		}

		if(is_numeric($request->categoryId)) {
			if ($existCount > 0) {
				$data['success'] = 'false';
				$data['count'] 	 =  $existCount ;
			} else {

				$subcategory->category_id 		= $request->categoryId;
		    	$subcategory->item_name 		= $request->subcategoryName;
		    	$subcategory->item_description  = ($request->subcategoryDesc == 'undefined' || $request->subcategoryDesc == 'null') ? NULL :($request->subcategoryDesc);

		    	$subcategory->status 			= $request->status;
		    	
		    	
		    	$subcategory->save();

		    	$data['subcategory']    = $subcategory->id;
		 		$data['success'] 		= 'true';

		 		if (isset($request->subcategoryId) && ($request->subcategoryId != '')) {
					$request->session()->flash('alert-success', 'Subcategory Edited Successfully');
				} else {
					$request->session()->flash('alert-success', 'Subcategory Added Successfully');
				}

			}
		} else {
			$data['success']		= 'not_numeric'; 
		}

 		
        return $data;
	}




	/*****************************************************/
	# Subcategory Controller             
	# Function name : deleteSubcategory
	# Functionality: delete subcategory
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  delete subcategory 
	# Params :  Request $request                                          
	/*****************************************************/
	public function deleteSubcategory(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*check existance of subcategory in trip*/
		$tripSubcategoryDetails = Trip::where('subcategory_id',$request->subcategoryId)->count();

		if(is_numeric($request->subcategoryId)) {
			if ($tripSubcategoryDetails > 0) {
				$data['success']		= 'false'; 
			} else {

				/*delete data*/
				$subcategory = Subcategory::find($request->subcategoryId);
				$subcategory->deleted_by = \Auth::user()->id;/*logged in user id*/
				$subcategory->status     = 'D';
				$subcategory->is_deleted = 'Y';
				$subcategory->save();

				/*soft delete the record*/
				$subcategory->delete();

				$data['success']		= 'true'; 
			}
		} else {
			$data['success']		= 'not_numeric'; 
		}

		return $data;
		
	}






	/*****************************************************/
	# Subcategory Controller             
	# Function name : saveCSVSubcategory
	# Functionality: save subcategory after importing csv
	# Author : Sanchari Ghosh                                 
	# Created Date : 27/08/2018                                
	# Purpose:  save subcategory after importing csv 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveCSVSubcategory(Request $request){

		$data 		 		= array(); /*storing data for listing*/ 
		$existingData		= ''; /*collect the existing data*/
		$contentdata 		= json_decode($request->subcatDetailsData);
		$existingDataText 	= '';
		$blankDataErr 		= 0;
		$flag 				= 0;
		$rowNo 				= 0;


		if(isset($contentdata) && count($contentdata)>0){
			for($i=1; $i<(count($contentdata) - 1); $i++) {
				$singleColumnData = explode(',',$contentdata[$i]);

				/*check duplicate subcategory name*/
				$existCount = $this->nameExistsCheck('Subcategory','item_name',strtolower($singleColumnData[2]),'');
				$data['existCount'.$i] = $existCount;
				if ($existCount > 0) { /*if duplicate subcategory exists*/
				 	$data['success'] = 'false';
				 	$data['count'] 	 =  $existCount ;
				 	$existingData   .=  '"'.$singleColumnData[2].'", ';
				} else {


					/*for checking blank data*/
					if(trim($singleColumnData[0]) == '' || trim($singleColumnData[1]) == '' || trim($singleColumnData[2]) == '' || trim($singleColumnData[3]) == ''){
						$data['success'] = 'false';
				 		$blankDataErr    =  1;
				 		$rowNo 			 =  $i;
				 		$flag 			 =  0;
					} else {

					 	/*check the existance of category*/
						$categoryDetails = $this->nameExistsCheck('Category','category_name',strtolower($singleColumnData[0]),'');

						if ($categoryDetails > 0) { /*if supervisor exists get id*/
							$category  =  Category::whereRaw('LOWER(`category_name`) = "'.strtolower($singleColumnData[0]).'"')->get()->toArray();

							$catId 	   = $category[0]['id'];
						} else { /*if category doesnot exist add new data*/
							$cat 						= new Category();
							$cat->category_name    		= $singleColumnData[0];
							$cat->category_description 	= $singleColumnData[1];
							$cat->created_by   			= \Auth::user()->id;
							$cat->save();
							$catId 						= $cat->id;
						}

					 	$subcat 					= new Subcategory();
						$subcat->created_by			= \Auth::user()->id;
						$subcat->category_id 		= $catId;
						$subcat->item_name 			= $singleColumnData[2];
				    	$subcat->item_description 	= $singleColumnData[3];
				    	
				    	$subcat->save();

				 		$data['success'] 		= 'true';
			 		}

				}
			}
		}

		if ($existingData != '') {
			$existingDataText  = ' Subcategory named '.$existingData.' already exists. So these data are not added.';
		}

		if ($blankDataErr == 1) {
			$existingDataText  .= ' Data is not imported of row number :- '.$rowNo.', as some of the fields are blank.';
		}


		$data['success'] 	 = 'true';

		if ($data['success'] == 'true') {
			$request->session()->flash('alert-success', 'Subcategory Imported Successfully. '.$existingDataText);
		}

        return $data;

	}




	/*****************************************************/
	# Subcategory Controller             
	# Function name : viewTripSubcatList
	# Functionality: get subcategory lists with respect to category
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/10/2018                                
	# Purpose:  save subcategory lists with respect to category
	# Params :  Request $request                                          
	/*****************************************************/
	public function viewTripSubcatList(Request $request) {
		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$subcategoryList = Subcategory::select('item_name AS name','id')->where('status','A')->where('category_id',$request->catId)->orderby('item_name')->get()->toArray();

		/*customizing final array*/
		$data['subcategoryList'] 	= $subcategoryList;
		$data['success'] 			= 'true';

		return $data;
	}
	

}
