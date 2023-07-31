<?php

/*****************************************************/
# ExtraCashDiesel Controller             
# Class name : ExtraCashDieselController
# Functionality: listing, add, edit, delete data
# Author : Sanchari Ghosh                                 
# Created Date :  02/07/2019                                
# Purpose: Developing the functionality of listing, add, edit, delete data
/*****************************************************/

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Models\TripBill;
use App\User;
use App;


class ExtraCashDieselController extends Controller {
 
	/*****************************************************/
	# ExtraCashDiesel Controller             
	# Class name : ExtraCashDieselController
	# Functionality: constructor
	# Author : Sanchari Ghosh                                 
	# Created Date : 02/07/2019                                 
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}


	/*****************************************************/
	# ExtraCashDiesel Controller             
	# Function name : extraCashList
	# Functionality: view extra cash listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 02/07/2019                                
	# Purpose:  to view extra cash listing page  
	# Params :                                           
	/*****************************************************/
	public function extraCashList(){
		return view('trips.extraCashList');
	}


	/*****************************************************/
	# ExtraCashDiesel Controller             
	# Function name : getExtraCashList
	# Functionality: get data of extra cash listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 02/07/2019                                
	# Purpose:  to get data of extra cash listing page  
	# Params : Request $request                                          
	/*****************************************************/
	public function getExtraCashList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'tripBillTable' => config('dbtables.trip_bills'),
					'truckTable' 	=> config('dbtables.trucks'),
					'vendorTable' 	=> config('dbtables.vendors'),
					'plantTable' 	=> config('dbtables.plants'),
				);

		/*get available records*/
		$extraCashList = TripBill::getExtraCashList($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$totalExtraCashList = TripBill::totalExtraCashListRecords($dbTables,$request->searchKeyword);


		/*customizing final array*/
		$data['extraCashList'] 			= $extraCashList;
		$data['totalExtraCashList'] 	= $totalExtraCashList;
		$data['success']				= 'true';
		$data['currentPage']    		= $request->currentPage;

		return $data;
	}




	/*****************************************************/
	# ExtraCashDiesel Controller             
	# Function name : viewAddExtraCash
	# Functionality: view add extra cash page
	# Author : Sanchari Ghosh                                 
	# Created Date : 02/07/2019                                
	# Purpose:  view add extra cash page 
	# Params :                                            
	/*****************************************************/
	public function viewAddExtraCash(){
		return view('trips.addExtraCashForm');
	}



	/*****************************************************/
	# ExtraCashDiesel Controller             
	# Function name : viewEditExtraCash
	# Functionality: view edit extra cash page
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/07/2019                                
	# Purpose:  view edit extra cash page 
	# Params :                                            
	/*****************************************************/
	public function viewEditExtraCash(){
		return view('trips.editExtraCashForm');
	}




	/*****************************************************/
	# ExtraCashDiesel Controller             
	# Function name : getEditExtraCash
	# Functionality: get edit extra cash page
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/07/2019                                
	# Purpose:  get edit extra cash page 
	# Params :  Request $request                                          
	/*****************************************************/
	public function getEditExtraCash(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$extraCashId = $request->extraCashId;

		/*get available records*/
		$extraCashDetails = TripBill::select('id','bill_date','plant_id','vendor_id','truck_id','extra_cash','narration')->where('id',$extraCashId)->get();

		/*customizing final array*/
		$data['extraCashDetails'] 	= $extraCashDetails;
		$data['success'] 			= 'true';

		return $data;
	}






	/*****************************************************/
	# ExtraCashDiesel Controller             
	# Function name : saveExtraCash
	# Functionality: save extra cash
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/07/2019                                
	# Purpose:  save extra cash 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveExtraCash(Request $request){

		$data 	    = array(); /*storing data for listing*/ 
		
		if (isset($request->extraCashId) && ($request->extraCashId != '')) {
			$extraCash 					= TripBill::find($request->extraCashId);
			$extraCash->updated_by		= \Auth::user()->id;
			$extraCash->updated_at		= date(\Config::get('constants.DBdateFormat'));
		} else {
			$extraCash 					= new TripBill();
			$extraCash->created_by		= \Auth::user()->id;
		}

		$extraCash->bill_date 	= date(\Config::get('constants.onlyDateFormat'),strtotime($request->bill_date)).' '.date('H:i:s');
	    $extraCash->plant_id 	= $request->plant_id;
	    $extraCash->vendor_id 	= $request->vendor_id;
	    $extraCash->truck_id 	= $request->truck_id;
	    $extraCash->extra_cash	= $request->amount;
	    $extraCash->narration	= $request->narration;
	    $extraCash->type		= 'D';

	    $extraCash->save();

	    $data['extraCash']      = $extraCash->id;
 		$data['success'] 		= 'true';

 		if (isset($request->extraCashId) && ($request->extraCashId != '')) {
			$request->session()->flash('alert-success', 'Extra Cash data Edited Successfully');
		} else {
			$request->session()->flash('alert-success', 'Extra Cash data Added Successfully');
		}

        return $data;
	}




	/*****************************************************/
	# ExtraCashDiesel Controller             
	# Function name : deleteExtraCash
	# Functionality: delete extra cash
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/07/2019                                
	# Purpose:  delete extra cash 
	# Params :  Request $request                                          
	/*****************************************************/
	public function deleteExtraCash(Request $request){

		$data = array(); /*storing data for listing*/ 

		if(is_numeric($request->extraCashId)) {
			/*delete data*/
			$extraCash = TripBill::find($request->extraCashId); 
			
			$extraCash->deleted_by = \Auth::user()->id;/*logged in user id*/
			$extraCash->save();

			/*soft delete the record*/
			$extraCash->delete();

			$data['success']		= 'true'; 
		} else {
			$data['success']		= 'not_numeric'; 
		}

		return $data;	
	}



	/*****************************************************/
	# ExtraCashDiesel Controller             
	# Function name : extraDieselList
	# Functionality: view extra diesel listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 02/07/2019                                
	# Purpose:  to view extra diesel listing page  
	# Params :                                           
	/*****************************************************/
	public function extraDieselList(){
		return view('trips.extraDieselList');
	}


	/*****************************************************/
	# ExtraCashDiesel Controller             
	# Function name : getExtraDieselList
	# Functionality: get data of extra diesel listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 02/07/2019                                
	# Purpose:  to get data of extra diesel listing page  
	# Params : Request $request                                          
	/*****************************************************/
	public function getExtraDieselList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'tripBillTable' 	=> config('dbtables.trip_bills'),
					'truckTable' 		=> config('dbtables.trucks'),
					'vendorTable' 		=> config('dbtables.vendors'),
					'plantTable' 		=> config('dbtables.plants'),
					'petrolPumpTable' 	=> config('dbtables.petrol_pumps'),
				);

		/*get available records*/
		$extraDieselList = TripBill::getExtraDieselList($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$totalExtraDieselList = TripBill::totalExtraDieselListRecords($dbTables,$request->searchKeyword);


		/*customizing final array*/
		$data['extraDieselList'] 		= $extraDieselList;
		$data['totalExtraDieselList'] 	= $totalExtraDieselList;
		$data['success']				= 'true';
		$data['currentPage']    		= $request->currentPage;

		return $data;
	}


	/*****************************************************/
	# ExtraCashDiesel Controller             
	# Function name : viewAddExtraDiesel
	# Functionality: view add extra diesel page
	# Author : Sanchari Ghosh                                 
	# Created Date : 02/07/2019                                
	# Purpose:  view add extra diesel page 
	# Params :                                            
	/*****************************************************/
	public function viewAddExtraDiesel(){
		return view('trips.addExtraDieselForm');
	}



	/*****************************************************/
	# ExtraCashDiesel Controller             
	# Function name : viewEditExtraDiesel
	# Functionality: view edit extra diesel page
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/07/2019                                
	# Purpose:  view edit extra diesel page 
	# Params :                                            
	/*****************************************************/
	public function viewEditExtraDiesel(){
		return view('trips.editExtraDieselForm');
	}




	/*****************************************************/
	# ExtraCashDiesel Controller             
	# Function name : getEditExtraDiesel
	# Functionality: get edit extra diesel page
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/07/2019                                
	# Purpose:  get edit extra diesel page 
	# Params :  Request $request                                          
	/*****************************************************/
	public function getEditExtraDiesel(Request $request){
		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$extraDieselId = $request->extraDieselId;

		/*get available records*/
		$extraDieselDetails = TripBill::select('id','bill_date','plant_id','vendor_id','truck_id','petrol_pump_id','extra_diesel','narration')->where('id',$extraDieselId)->get();

		/*customizing final array*/
		$data['extraDieselDetails'] 	= $extraDieselDetails;
		$data['success'] 				= 'true';

		return $data;
	}






	/*****************************************************/
	# ExtraCashDiesel Controller             
	# Function name : saveExtraDiesel
	# Functionality: save extra diesel
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/07/2019                                
	# Purpose:  save extra diesel 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveExtraDiesel(Request $request){
		$data 	    = array(); /*storing data for listing*/ 
		
		if (isset($request->extraDieselId) && ($request->extraDieselId != '')) {
			$extraDiesel 				= TripBill::find($request->extraDieselId);
			$extraDiesel->updated_by	= \Auth::user()->id;
			$extraDiesel->updated_at	= date(\Config::get('constants.DBdateFormat'));
		} else {
			$extraDiesel 				= new TripBill();
			$extraDiesel->created_by	= \Auth::user()->id;
		}

		$extraDiesel->bill_date 	= date(\Config::get('constants.onlyDateFormat'),strtotime($request->bill_date)).' '.date('H:i:s');
	    $extraDiesel->plant_id 			= $request->plant_id;
	    $extraDiesel->vendor_id 		= $request->vendor_id;
	    $extraDiesel->truck_id 			= $request->truck_id;
	    $extraDiesel->petrol_pump_id 	= $request->petrol_pump_id;
	    $extraDiesel->extra_diesel		= $request->amount;
	    $extraDiesel->narration			= $request->narration;
	    $extraDiesel->type				= 'D';

	    $extraDiesel->save();

	    $data['extraDiesel']    = $extraDiesel->id;
 		$data['success'] 		= 'true';

 		if (isset($request->extraDieselId) && ($request->extraDieselId != '')) {
			$request->session()->flash('alert-success', 'Extra Diesel data Edited Successfully');
		} else {
			$request->session()->flash('alert-success', 'Extra Diesel data Added Successfully');
		}

        return $data;
	}




	/*****************************************************/
	# ExtraCashDiesel Controller             
	# Function name : deleteExtraDiesel
	# Functionality: delete extra diesel
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/07/2019                                
	# Purpose:  delete extra diesel 
	# Params :  Request $request                                          
	/*****************************************************/
	public function deleteExtraDiesel(Request $request){

		$data = array(); /*storing data for listing*/ 

		if(is_numeric($request->extraDieselId)) {

			/*delete data*/
			$extraDiesel = TripBill::find($request->extraDieselId); 
			
			$extraDiesel->deleted_by = \Auth::user()->id;/*logged in user id*/
			$extraDiesel->save();

			/*soft delete the record*/
			$extraDiesel->delete();

			$data['success']		= 'true'; 
		} else {
			$data['success']		= 'not_numeric'; 
		}

		return $data;	
	}

}


