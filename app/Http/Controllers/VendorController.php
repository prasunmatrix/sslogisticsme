<?php

/*****************************************************/
# Vendor Controller             
# Class name : VendorController
# Functionality: listing, add, edit, deletion of vendors, generating reports
# Author : Sanchari Ghosh                                 
# Created Date :  24/12/2018                                
# Purpose: Developing the functionality of listing, add, edit, deletion of vendors,generating reports
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Models\Vendor;
use App\Models\Truck;
use App\Models\Trip;
use App\Models\Bank;
use App\Models\BankBranch;

class VendorController extends Controller {
 
	/*****************************************************/
	# Vendor Controller             
	# Class name : VendorController
	# Functionality: constructor
	# Author : Sanchari Ghosh                                 
	# Created Date : 24/12/2018                                 
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}
	

	/*****************************************************/
	# Vendor Controller             
	# Function name : index
	# Functionality: view vendor listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 24/12/2018                                
	# Purpose:  to view vendor listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('vendors.vendorList');
	}



	/*****************************************************/
	# Vendor Controller             
	# Function name : getVendorList
	# Functionality: get data of vendor listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 24/12/2018                                
	# Purpose:  to get data of vendor listing page  
	# Params : Request $request                                          
	/*****************************************************/
	public function getVendorList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'vendorTable' => config('dbtables.vendors'),
				);

		/*get available records*/
		$vendorList = Vendor::availableRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$totalVendors = Vendor::totalRecords($dbTables,$request->searchKeyword);
		
		/*customizing final array*/
		$data['vendorList'] 	= $vendorList;
		$data['totalVendors']   = $totalVendors;
		$data['currentPage']    = $request->currentPage;
		$data['success']		= 'true'; 

		return $data;
	}




	/*****************************************************/
	# Vendor Controller             
	# Function name : viewAddVendor
	# Functionality: view add vendor page
	# Author : Sanchari Ghosh                                 
	# Created Date : 24/12/2018                                
	# Purpose:  view add vendor page 
	# Params :                                            
	/*****************************************************/
	public function viewAddVendor(){
		return view('vendors.addForm');
	}



	/*****************************************************/
	# Vendor Controller             
	# Function name : viewEditVendor
	# Functionality: view edit vendor page
	# Author : Sanchari Ghosh                                 
	# Created Date : 24/12/2018                                
	# Purpose:  view edit vendor page 
	# Params :                                            
	/*****************************************************/
	public function viewEditVendor(){
		return view('vendors.editForm');
	}




	/*****************************************************/
	# Vendor Controller             
	# Function name : getEditVendor
	# Functionality: get edit vendor page
	# Author : Sanchari Ghosh                                 
	# Created Date : 24/12/2018                                
	# Purpose:  get edit vendor page 
	# Params :  Request $request                                          
	/*****************************************************/
	public function getEditVendor(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$vendorId = $request->vendorId;

		/*get available records*/
		$vendorDetails = Vendor::find($vendorId);

		/*get the bank_branch id with respect to ifsc code*/
		//$bankBranchDetails = BankBranch::select('ifsc','name')->where('id',$vendorDetails->ifsc_code)->get()->toArray();

		/*get the bank name*/
		$bankDetails = Bank::select('name')->where('id',$vendorDetails->bank_name)->get()->toArray();

		/*customizing final array*/
		$data['vendorDetails'] 	= $vendorDetails;
		//$data['ifsc_display']   = $bankBranchDetails[0]['ifsc'].' ( '.$bankBranchDetails[0]['name'].' )';
		$data['bank_name']		= $bankDetails[0]['name'];
		$data['success'] 		= 'true';

		return $data;
	}






	/*****************************************************/
	# Vendor Controller             
	# Function name : saveVendor
	# Functionality: save vendor
	# Author : Sanchari Ghosh                                 
	# Created Date : 24/12/2018                                
	# Purpose:  save vendor 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveVendor(Request $request){

		$data 	    = array(); /*storing data for listing*/ 
		$subcatId 	= array(); /*storing sub vendor ids for change status*/

		if (isset($request->vendorId) && ($request->vendorId != '')) {
			$vendor 						= Vendor::find($request->vendorId);
			$vendor->updated_by				= \Auth::user()->id;
			$existCount 					= $this->nameExistsCheck('Vendor','name',strtolower($request->vendorName),$request->vendorId);
		} else {
			$vendor 						= new Vendor();
			$existCount 					= $this->nameExistsCheck('Vendor','name',strtolower($request->vendorName),'');
			$vendor->created_by				= \Auth::user()->id;
		}

		/*check the existance of bank branch*/
		// $ifscDetails = explode(" ",$request->ifsc_code);
		// $bankBranchCount = $this->nameExistsCheck('BankBranch','ifsc',strtolower(trim($ifscDetails[0])),'');


		if ($existCount > 0) {
			$data['success'] = 'false';
			$data['count'] 	 = $existCount ;
			$data['msg']	 = 'Vendor already exists';
		} /*else if($bankBranchCount == 0){
			$data['success'] 			 = 'false';
			$data['bankBranchCount'] 	 = $bankBranchCount ;
			$data['msg']	 			 = 'Please choose IFSC Code from auto suggested ifsc code dropdown';
		} */ else {

			/*get the bank_branch id with respect to ifsc code*/
			//$bankBranchDetails = BankBranch::select('id')->where('ifsc',trim($ifscDetails[0]))->get()->toArray();

	    	$vendor->name 				 = strtoupper($request->vendorName);
	    	$vendor->contact_number 	 = ($request->contactNumber == 'undefined' || $request->contactNumber == 'null') ? NULL :($request->contactNumber);
	    	$vendor->contact_email 		 = ($request->contactEmail == 'undefined' || $request->contactEmail == 'null') ? NULL :($request->contactEmail);
	    	$vendor->contact_person 	 = ($request->contact_person == 'undefined' || $request->contact_person == 'null') ? NULL : strtoupper($request->contact_person);
	    	$vendor->pan_number 		 = strtoupper($request->pan_number);
	    	$vendor->bank_name 			 = $request->bank_name;
	    	$vendor->account_no 		 = $request->account_no;
	    	$vendor->ifsc_code 			 = $request->ifsc_code;
	    	$vendor->account_holder_name = strtoupper($request->account_holder_name);
	    	$vendor->status 			 = $request->status;
	    	
	    	
	    	$vendor->save();

	    	$data['vendor']			= $vendor->name;
	 		$data['success'] 		= 'true';
	 		$data['addNew']			= $request->addNew;

	 		if (isset($request->vendorId) && ($request->vendorId != '')) {
				$request->session()->flash('alert-success', 'Vendor Edited Successfully');
			} else {
				$request->session()->flash('alert-success', 'Vendor Added Successfully');
			}
		}
 		
        return $data;
	}


	/*****************************************************/
	# Vendor Controller             
	# Function name : viewRecord
	# Functionality: view vendor details page
	# Author : Sanchari Ghosh                                 
	# Created Date : 26/12/2018                                
	# Purpose:  to view vendor details page  
	# Params :                                           
	/*****************************************************/
	public function viewRecord(){
		return view('vendors.vendorView');
	}



	/*****************************************************/
	# Vendor Controller             
	# Function name : getVendorDetails
	# Functionality: get details of a particular vendor
	# Author : Sanchari Ghosh                                 
	# Created Date : 26/12/2018                                
	# Purpose:  to get details of particular vendor
	# Params : Request $request                                          
	/*****************************************************/
	public function getVendorDetails(Request $request){

		/*get trip id*/
		$vendorId = $request->vendorId;

		$data 	= array(); /*storing data for listing*/ 

		$data = $this->getEditVendor($request);

		return $data;
	}


	/*****************************************************/
	# Vendor Controller             
	# Function name : checkVendorDetails
	# Functionality: check details of a particular vendor
	# Author : Sanchari Ghosh                                 
	# Created Date : 28/12/2018                                
	# Purpose:  to check details of particular vendor
	# Params : Request $request                                          
	/*****************************************************/
	public function checkVendorDetails(Request $request) {
		$data 		= array();
		$vendor 	= $request->vendor;
		$existCount = $this->nameExistsCheck('Vendor','id',strtolower($request->vendor),'');
		if ($existCount > 0) {
			$vendor 		 	= Vendor::find($vendor);
			$data['vendorName'] = $vendor->name;
			$data['success'] 	= 'true';
		} else {
			$data['success'] = 'false';
		}
		return $data;
	}


	/*****************************************************/
	# Vendor Controller             
	# Function name : deleteVendor
	# Functionality: delete vendor
	# Author : Sanchari Ghosh                                 
	# Created Date : 09/01/2019                                
	# Purpose:  delete vendor 
	# Params :  Request $request                                          
	/*****************************************************/
	public function deleteVendor(Request $request){

		$data 		= array(); /*storing data for listing*/ 

		/*check existance of truck under the vendor*/
		$truckDetails = Truck::where('vendor_id',$request->vendorId)->count();


		/*check existance of vendor in trip*/
		$tripVendorDetails = Trip::where('vendor_id',$request->vendorId)->count();


		if(is_numeric($request->vendorId)) {
			if (($truckDetails > 0) || ($tripVendorDetails > 0)) {
				$data['success']	= 'false'; 
			} else {
				/*delete data*/
				$vendor = Vendor::find($request->vendorId);
				$vendor->deleted_by = \Auth::user()->id;/*logged in user id*/
				$vendor->status     = 'D';
				$vendor->is_deleted = 'Y';
				$vendor->save();

				/*soft delete the record*/
				$vendor->delete();

				$data['success']		= 'true'; 
			}
		} else {
			$data['success']		= 'not_numeric'; 
		}
		return $data;
		
	}





	/*****************************************************/
	# Vendor  Controller             
	# Function name : viewVendorList
	# Functionality: get data of vendors for trip
	# Author : Sanchari Ghosh                                 
	# Created Date : 24/01/2019                                
	# Purpose:  get data of vendors for trip
	# Params :                                           
	/*****************************************************/
	public function viewVendorList() {
		$data 	= array(); /*storing data for listing*/ 
		$customizedData = array();

		/*get available records*/
		$vendorList = Vendor::where('status','A')->orderby('name')->get()->toArray();

		for($i=0; $i<sizeof($vendorList); $i++) {
			$customizedData[$i]['id'] = $vendorList[$i]['id'];
			$customizedData[$i]['name'] = $vendorList[$i]['name'];

			if ($vendorList[$i]['contact_person'] != NULL) {
				$customizedData[$i]['name'] .= ' ('.$vendorList[$i]['contact_person'].')';
			}
		}

		/*customizing final array*/
		$data['vendorList'] 			= $vendorList;
		$data['customizedVendorList'] 	= $customizedData;
		$data['success'] 				= 'true';

		return $data;
	}



	/*****************************************************/
	# Vendor Controller             
	# Function name : checkVendorNameDetails
	# Functionality: check details of a particular vendor with respect to its name
	# Author : Sanchari Ghosh                                 
	# Created Date : 15/02/2019                               
	# Purpose:  to check details of particular vendor with respect to its name
	# Params : Request $request                                          
	/*****************************************************/
	public function checkVendorNameDetails(Request $request) {
		$data 		= array();
		$vendor 	= $request->vendor;
		$existCount = $this->nameExistsCheck('Vendor','name',strtolower($request->vendor),'');
		if ($existCount > 0) {
			//$vendor 		 	= Vendor::where('name',$vendor)->get();
			$data['vendorName'] = $vendor;
			$data['success'] 	= 'true';
		} else {
			$data['success'] = 'false';
		}
		return $data;
	}


	/*****************************************************/
	# Vendor Controller             
	# Function name : customerReport
	# Functionality: view customer report page
	# Author : Sanchari Ghosh                                 
	# Created Date : 01/04/2019                               
	# Purpose:  to view customer report page
	# Params : Request $request                                          
	/*****************************************************/
	public function customerReport(Request $request) {
		return view('vendors.customerReport');
	}


	/*****************************************************/
	# Vendor Controller             
	# Function name : getCustomerReport
	# Functionality: get customer report details
	# Author : Sanchari Ghosh                                 
	# Created Date : 01/04/2019                                
	# Purpose:  get customer report details
	# Params : Request $request                                        
	/*****************************************************/
	public function getCustomerReport(Request $request){
		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'tripTable' 				      => config('dbtables.trips'),
					'plantTable' 				      => config('dbtables.plants'),
					'partyTable' 				      => config('dbtables.parties'),
					'truckTable' 				      => config('dbtables.trucks'),
					'petrolPumpTable' 				  => config('dbtables.petrol_pumps'),
					'plantUserRelationTable'		  => config('dbtables.plant_user_relations'),
					'vendorTable'					  => config('dbtables.vendors'),	
					'addressZoneTable'				  => config('dbtables.address_zones'),
					'itemTable'						  => config('dbtables.subcategories'),
					'tripPODTable'					  => config('dbtables.trip_POD'),
					'userTable' 					  => config('dbtables.users'),
				);

		/*get available records*/
		$customerReportList = Vendor::getCustomerReport($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->challanStatus,$request->pendingPeriod,$request->company,$request->dateRangeValue);
		$totalCustomerReports = Vendor::totalCustomerReportRecords($dbTables,$request->challanStatus,$request->pendingPeriod,$request->company,$request->dateRangeValue);


		/*customizing final array*/
		$data['customerReportList'] 	= $customerReportList;
		$data['totalCustomerReports'] 	= $totalCustomerReports;
		$data['success']				= 'true'; 
		$data['currentPage']    		= $request->currentPage;

		return $data;
	}


	/*****************************************************/
	# Vendor Controller             
	# Function name : vendorReport
	# Functionality: view vendor report page
	# Author : Sanchari Ghosh                                 
	# Created Date : 02/04/2019                               
	# Purpose:  to view vendor report page
	# Params : Request $request                                          
	/*****************************************************/
	public function vendorReport(Request $request) {
		return view('vendors.vendorReport');
	}


	/*****************************************************/
	# Vendor Controller             
	# Function name : getVendorReport
	# Functionality: get vendor report details
	# Author : Sanchari Ghosh                                 
	# Created Date : 02/04/2019                                
	# Purpose:  get vendor report details
	# Params : Request $request                                        
	/*****************************************************/
	public function getVendorReport(Request $request){
		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'tripTable' 				      => config('dbtables.trips'),
					'plantTable' 				      => config('dbtables.plants'),
					'partyTable' 				      => config('dbtables.parties'),
					'truckTable' 				      => config('dbtables.trucks'),
					'petrolPumpTable' 				  => config('dbtables.petrol_pumps'),
					'plantUserRelationTable'		  => config('dbtables.plant_user_relations'),
					'vendorTable'					  => config('dbtables.vendors'),	
					'addressZoneTable'				  => config('dbtables.address_zones'),
					'itemTable'						  => config('dbtables.subcategories'),
					'tripPODTable'					  => config('dbtables.trip_POD'),
					'userTable' 					  => config('dbtables.users'),
				);

		/*get available records*/
		$vendorReportList = Vendor::getVendorReport($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->challanStatus,$request->pendingPeriod,$request->plant,$request->dateRangeValue);
		$totalVendorReports = Vendor::totalVendorReportRecords($dbTables,$request->challanStatus,$request->pendingPeriod,$request->plant,$request->dateRangeValue);


		/*customizing final array*/
		$data['vendorReportList'] 		= $vendorReportList;
		$data['totalVendorReports'] 	= $totalVendorReports;
		$data['success']				= 'true'; 
		$data['currentPage']    		= $request->currentPage;

		return $data;
	}



	/*****************************************************/
	# Vendor Controller             
	# Function name : getActiveBankList
	# Functionality: get active bank lists
	# Author : Sanchari Ghosh                                 
	# Created Date : 25/04/2019                                
	# Purpose:  get active bank lists
	# Params :                                         
	/*****************************************************/
	public function getActiveBankList(){
		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'bankTable' => config('dbtables.banks'),
				);

		$bankList = Bank::availableRecords($dbTables);
		
		/*customizing final array*/
		$data['bankList'] 	= $bankList;
		$data['success']	= 'true'; 

		return $data;
	}


	/*****************************************************/
	# Vendor Controller             
	# Function name : getIFSCList
	# Functionality: get bank ifsc list with respect to bank
	# Author : Sanchari Ghosh                                 
	# Created Date : 25/04/2019                                
	# Purpose:  get bank ifsc list with respect to bank
	# Params :  Request $request                                            
	/*****************************************************/
	public function getIFSCList(Request $request){
		$bankId = $request->bankId;

		/*defining db tables for joining*/
		$dbTables = array(
					'bankTable' 		=> config('dbtables.banks'),
					'bankBranchTable'	=> config('dbtables.bank_branches'),
				);

		$ifscList = BankBranch::availableRecords($dbTables,$bankId);
		
		/*customizing final array*/
		$data['ifscList'] 	= $ifscList;
		$data['success']	= 'true'; 

		return $data;
	}
	

}
