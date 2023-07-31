<?php

/*****************************************************/
# City Controller             
# Class name : CityController
# Functionality: listing, add, edit, deletion of cities
# Author : Sanchari Ghosh                                 
# Created Date :  07/08/2018                                
# Purpose: Developing the functionality of listing, add, edit, deletion of cities
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\PlantAddress;
use App\Models\PartyDestination;
use App\Models\PetrolPump;

class CityController extends Controller {
 
	/*****************************************************/
	# City Controller             
	# Class name : CityController
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
	# City Controller             
	# Function name : index
	# Functionality: view city listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  to view city listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('cities.cityList');
	}



	/*****************************************************/
	# City Controller             
	# Function name : getCityList
	# Functionality: get data of city listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  to get data of city listing page  
	# Params : Request $request                                          
	/*****************************************************/
	public function getCityList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'cityTable' 				=> config('dbtables.cities'),
					'countryTable' 				=> config('dbtables.countries'),
					'stateTable' 				=> config('dbtables.states'),
				);

		/*get available records*/
		$cityList = City::availableRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$totalCities = City::totalRecords($dbTables,$request->searchKeyword);
		
		/*customizing final array*/
		$data['cityList'] 		= $cityList;
		$data['totalCities'] 	= $totalCities;
		$data['success']		= 'true'; 

		return $data;
	}




	/*****************************************************/
	# City Controller             
	# Function name : viewStateList
	# Functionality: get state lists
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  get state lists
	# Params : Request $request                                          
	/*****************************************************/
	public function viewStateList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$stateList = State::where('country_id',$request->country_id)->where('status','A')->orderBy('state_name','asc')->get();

		/*customizing final array*/
		$data['stateList'] 		= $stateList;
		$data['success'] 		= 'true';

		return $data;
	}





	/*****************************************************/
	# City Controller             
	# Function name : viewAddCity
	# Functionality: view add city page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  view add city page 
	# Params :                                            
	/*****************************************************/
	public function viewAddCity(){
		return view('cities.addForm');
	}



	/*****************************************************/
	# City Controller             
	# Function name : viewEditCity
	# Functionality: view edit city page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  view edit city page 
	# Params :                                            
	/*****************************************************/
	public function viewEditCity(){
		return view('cities.editForm');
	}




	/*****************************************************/
	# City Controller             
	# Function name : getEditCity
	# Functionality: get edit city page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  get edit city page 
	# Params :  Request $request                                          
	/*****************************************************/
	public function getEditCity(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$cityId = $request->cityId;

		/*get available records*/
		$cityDetails = City::find($cityId);

		/*customizing final array*/
		$data['cityDetails'] 		= $cityDetails;
		$data['success'] 			= 'true';

		return $data;
	}






	/*****************************************************/
	# City Controller             
	# Function name : saveCity
	# Functionality: save city
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  save city 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveCity(Request $request){

		$data 				= array(); /*storing data for listing*/ 
		$existCount 		= 0; /*count whether same name city exists or not*/
		$existCode 			= 0; /*count whether same code city exists or not*/
		
		if (isset($request->cityId) && ($request->cityId != '')) {
			$city 					= City::find($request->cityId);
			//$existCityCount 		= City::validateExistCity($request->city_name,$request->cityId);
			$existCount 			= $this->nameExistsCheck('City','city_name',strtolower($request->city_name),$request->cityId);
			$existCode 				= $this->codeExistsCheck('City','city_code',strtolower($request->city_code),$request->cityId);
			$city->updated_by		= \Auth::user()->id;
		} else {
			$city 					= new City();
			//$existCityCount 		= City::validateExistCity($request->city_name);
			$existCount 			= $this->nameExistsCheck('City','city_name',strtolower($request->city_name),'');
			$existCode 				= $this->codeExistsCheck('City','city_code',strtolower($request->city_code),'');
			$city->created_by		= \Auth::user()->id;
		}

		if ($existCount > 0 || $existCode > 0) {
			$data['success'] = 'false';
			$data['namecount'] 	 	=  $existCount ;
			$data['codecount'] 	 	=  $existCode ;
		} else {
			$city->country_id 		= $request->country_id;
			$city->state_id 		= $request->state_id;
	    	$city->city_name 		= $request->city_name;
	    	$city->city_code 		= $request->city_code;
	    	$city->status 			= $request->status;
	    	
	    	
	    	$city->save();

	 		$data['success'] 		= 'true';
			$data['namecount'] 	 	=  $existCount ;
			$data['codecount'] 	 	=  $existCode ;

	 		if (isset($request->cityId) && ($request->cityId != '')) {
				$request->session()->flash('alert-success', 'City Edited Successfully');
			} else {
				$request->session()->flash('alert-success', 'City Added Successfully');
			}
		}
 		
        return $data;
	}




	/*****************************************************/
	# City Controller             
	# Function name : deleteCity
	# Functionality: delete city
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  delete city 
	# Params :  Request $request                                          
	/*****************************************************/
	public function deleteCity(Request $request){

		$data 	= array(); /*storing data for listing*/

		//Plant,Party,Petrol Pump 
		$platAddressDetails 		= PlantAddress::where('city_id',$request->cityId)->count();
		$partyDestinationDetails 	= PartyDestination::where('city_id',$request->cityId)->count();
		$petrolPumpDetails 			= PetrolPump::where('city_id',$request->cityId)->count();

		if (($platAddressDetails > 0) || ($partyDestinationDetails > 0) || ($petrolPumpDetails > 0)) {
        	$data['success']		= 'false'; 
        } else {
			/*delete data*/
			$city = City::find($request->cityId);
			$city->deleted_by = \Auth::user()->id;/*logged in user id*/
			$city->status     = 'D';
			$city->is_deleted = 'Y';
			$city->save();

			/*soft delete the record*/
			$city->delete();

			$data['success']		= 'true'; 
		}

		return $data;
		
	}
	

}
