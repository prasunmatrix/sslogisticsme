<?php

/*****************************************************/
# Country Controller             
# Class name : CountryController
# Functionality: listing, add, edit, deletion of countries
# Author : Sanchari Ghosh                                 
# Created Date :  07/08/2018                                
# Purpose: Developing the functionality of listing, add, edit, deletion of countries
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Models\Country;

class CountryController extends Controller {
 
	/*****************************************************/
	# Country Controller             
	# Class name : CountryController
	# Functionality: constructor
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                 
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}
	

	/*****************************************************/
	# Country Controller             
	# Function name : index
	# Functionality: view country listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  to view country listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		
		return view('countries.countryList');
	}



	/*****************************************************/
	# Country Controller             
	# Function name : getCountryList
	# Functionality: get data of country listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  to get data of country listing page  
	# Params :                                           
	/*****************************************************/
	public function getCountryList(){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'countryTable' 	=> config('dbtables.countries'),
				);

		/*get available records*/
		$countryList = Country::availableRecords($dbTables,\Config::get('constants.adminPerPageRecord'));

		/*customizing final array*/
		$data['countryList'] 	= $countryList;
		$data['success']		= 'true'; 

		return $data;
	}
}
