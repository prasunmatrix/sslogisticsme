<?php

/*****************************************************/
# Truck Controller             
# Class name : TruckController
# Functionality: listing, add, edit, deletion of trucks
# Author : Sanchari Ghosh                                 
# Created Date :  10/08/2018                                
# Purpose: Developing the functionality of listing, add, edit, deletion of trucks
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Models\Truck;
use App\Models\TruckRegistration;
use App\Models\TruckInsurance;
use App\Models\TruckPermit;
use App\Models\TruckTax;
use App\Models\TruckPollution;
use App\Models\Trip;
use App\Models\Vendor;
use DB;

class TruckController extends Controller {
 
	/*****************************************************/
	# Truck Controller             
	# Class name : TruckController
	# Functionality: constructor
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                 
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}
	

	/*****************************************************/
	# Truck Controller             
	# Function name : index
	# Functionality: view truck listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  to view truck listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('trucks.truckList');
	}



	/*****************************************************/
	# Truck Controller             
	# Function name : getTruckList
	# Functionality: get data of truck listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  to get data of truck listing page  
	# Params :                                           
	/*****************************************************/
	public function getTruckList(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'truckTable' 				=> config('dbtables.trucks'),
					'truckRegistrationTable' 	=> config('dbtables.truck_registrations'),
					'truckPermitTable' 			=> config('dbtables.truck_permits'),
					'truckInsuranceTable' 		=> config('dbtables.truck_insurances'),
					'truckTaxTable' 			=> config('dbtables.truck_taxes'),
					'vendorTable'				=> config('dbtables.vendors'),
				);

		/*get available records*/
		$truckList = Truck::availableRecords($dbTables,$request->currentPage,$request->perPageRecord,$request->orderby,$request->ordertype,$request->searchKeyword);
		$total = Truck::totalRecords($dbTables,$request->searchKeyword);
		/*customizing final array*/
		$data['truckList'] 		= $truckList;
		$data['currentPage']    = $request->currentPage;
		$data['total'] 			= $total;
		$data['success']		= 'true'; 

		return $data;
	}




	/*****************************************************/
	# Truck Controller             
	# Function name : viewAddTruck
	# Functionality: view add truck page
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  view add truck page 
	# Params :                                            
	/*****************************************************/
	public function viewAddTruck(){
		return view('trucks.addForm');
	}



	/*****************************************************/
	# Truck Controller             
	# Function name : viewEditTruck
	# Functionality: view edit truck page
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  view edit truck page 
	# Params :                                            
	/*****************************************************/
	public function viewEditTruck(){
		return view('trucks.editForm');
	}




	/*****************************************************/
	# Truck Controller             
	# Function name : getEditTruck
	# Functionality: get edit truck page
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  get edit truck page 
	# Params :  Request $request                                          
	/*****************************************************/
	public function getEditTruck(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*get available records*/
		$truckId = $request->truckId;

		/*get available records*/
		$truckDetails = Truck::find($truckId);

		/*get truck registration records*/
		$truckRegDetails 	    		= TruckRegistration::where('truck_id',$request->truckId)->get()->toArray();

		/*get truck insurance records*/
		$truckInsuranceDetails 			= TruckInsurance::where('truck_id',$request->truckId)->get()->toArray();

		/*get truck permit records*/
		$truckPermitDetails 			= TruckPermit::where('truck_id',$request->truckId)->get()->toArray();

		/*get truck tax records*/
		$truckTaxDetails 				= TruckTax::where('truck_id',$request->truckId)->get()->toArray();


		/*get truck pollution record*/
		$truckPollutionDetails 			= TruckPollution::where('truck_id',$request->truckId)->get()->toArray();


		/*customizing final array*/
		$data['truckDetails'] 		   = $truckDetails; //echo $truckDetails->vendor_id;
		$data['truckRegDetails']       = $truckRegDetails[0];

		/*get vendor name*/
		$vendor 		 	= Vendor::find($truckDetails->vendor_id);

		$data['vendorName'] = $vendor->name;

		if ($truckDetails['type'] == 'C') {
			$data['truckInsuranceDetails'] = $truckInsuranceDetails[0];
			$data['truckPermitDetails']    = $truckPermitDetails[0];
			$data['truckTaxDetails'] 	   = $truckTaxDetails[0];
			$data['truckPollutionDetails'] = $truckPollutionDetails[0];
		}
		

		$data['success']   = 'true';

		return $data;
	}






	/*****************************************************/
	# Truck Controller             
	# Function name : saveTruck
	# Functionality: save truck
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  save truck 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveTruck(Request $request){

		$data 			= array(); /*storing data for listing*/ 
		$existCount 	= 0; /*count whether same number truck exists or not*/

		/*find id of vendor*/
		$vendorIdDetails = Vendor::select('id')->where('name',$request->company)->get();

		if (isset($vendorIdDetails[0])) {
			if (isset($request->truckId) && ($request->truckId != '')) {
				$truck 							= Truck::find($request->truckId);

				$truckRegDetails 	    		= TruckRegistration::where('truck_id',$request->truckId)->get()->toArray();
				$truckRegistration 				= TruckRegistration::find($truckRegDetails[0]['id']);
				$truckRegistration->updated_by	= \Auth::user()->id;
				$existCount 					= $this->nameExistsCheck('Truck','truck_no',strtolower($request->truck_no),$request->truckId);

				$truck->status 					= $request->status;
				$truck->updated_by				= \Auth::user()->id;

				if ($request->company == 'SSLogistics') { /*for company type truck*/
					$truckInsuranceDetails 			= TruckInsurance::where('truck_id',$request->truckId)->get()->toArray();

					if(!empty($truckInsuranceDetails)) {
						$truckInsurance 			= TruckInsurance::find($truckInsuranceDetails[0]['id']);
						$truckInsurance->updated_by	= \Auth::user()->id;

					} else {
						$truckInsurance 			= new TruckInsurance();
						$truckInsurance->created_by	= \Auth::user()->id;
					}
					
					
					$truckPermitDetails 			= TruckPermit::where('truck_id',$request->truckId)->get()->toArray();
					if (!empty($truckPermitDetails)){
						$truckPermit 	 			= TruckPermit::find($truckPermitDetails[0]['id']);
						$truckPermit->updated_by 	= \Auth::user()->id;
					} else {
						$truckPermit 				= new TruckPermit();
						$truckPermit->created_by 	= \Auth::user()->id;
					}
					

					$truckTaxDetails 				= TruckTax::where('truck_id',$request->truckId)->get()->toArray();
					if (!empty($truckTaxDetails)) {
						$truckTax 		 			= TruckTax::find($truckTaxDetails[0]['id']);
						$truckTax->updated_by		= \Auth::user()->id;
					} else {
						$truckTax 		 			= new TruckTax();
						$truckTax->created_by		= \Auth::user()->id;
					}
					

					$truckPollutionDetails 			= TruckPollution::where('truck_id',$request->truckId)->get()->toArray();
					if(!empty($truckPollutionDetails)) {
						$truckPollution     		= TruckPollution::find($truckPollutionDetails[0]['id']);
						$truckPollution->updated_by	= \Auth::user()->id;
					} else {
						$truckPollution     		= new TruckPollution();
						$truckPollution->created_by	= \Auth::user()->id;
					}
				}
			} else {
				$truck 							= new Truck();
				$truckInsurance 				= new TruckInsurance();
				$truckRegistration 				= new TruckRegistration();
				$truckPermit 	 				= new TruckPermit();
				$truckTax 		 				= new TruckTax();
				$truckPollution	 				= new TruckPollution();
				
				if ($request->truck_no != 'undefined') {
					$existCount = $this->nameExistsCheck('Truck','truck_no',strtolower($request->truck_no),'');
				}

				$truck->status 					= $request->status;
				$truck->created_by				= \Auth::user()->id;
				$truckInsurance->created_by		= \Auth::user()->id;
				$truckRegistration->created_by	= \Auth::user()->id;
				$truckPermit->created_by		= \Auth::user()->id;
				$truckTax->created_by			= \Auth::user()->id;
				$truckPollution->created_by		= \Auth::user()->id;
			}
			
			if ($existCount > 0) {
				$data['success'] = 'false';
				$data['count'] 	 =  $existCount ;
				$data['msg']	 = 'Truck Number already exists';
			} else {
				$truck->vendor_id 			= $vendorIdDetails[0]->id;
				$truck->type 				= ($request->company == 'SSLogistics') ? 'C' : 'M' ;
				$truck->truck_no 			= ($request->truck_no == 'undefined' || $request->truck_no == 'null') ? NULL : strtoupper($request->truck_no);
		    	
		    	$truck->save();

		    	$lastInsertedId = $truck->id;

		    	/*save truck registration data*/
		    	$truckRegistration->truck_id 			= $lastInsertedId;
		    	//$truckRegistration->registration_no 	= ($request->registration_no == 'undefined' || $request->registration_no == 'null') ? NULL : strtoupper($request->registration_no);
		    	$truckRegistration->registration_file 	= isset($request->registration_file)?$request->registration_file:'';
		    	$truckRegistration->save();


		    	/*for company type truck*/
		    	if ($request->company == 'SSLogistics')	{

		    		$newRegistrationEndDate = date(\Config::get('constants.DBdateFormat'),strtotime($request->registration_end));
		    		$newPolicyEndDate = date(\Config::get('constants.DBdateFormat'),strtotime($request->policy_end));
		    		$newPermitEndDate = date(\Config::get('constants.DBdateFormat'),strtotime($request->permit_end));
		    		$newTaxEndDate = date(\Config::get('constants.DBdateFormat'),strtotime($request->tax_period_end));
		    		$newPollutionEndDate = date(\Config::get('constants.DBdateFormat'),strtotime($request->pollution_end));



		    		/*save truck registration data*/
		    		$truckRegistration->registered_on 		= date(\Config::get('constants.DBdateFormat'),strtotime($request->registered_on));
		    		$truckRegistration->read_status    = ($truckRegistration->registration_end == $newRegistrationEndDate) ? $truckRegistration->read_status : '0';
		    		$truckRegistration->registration_end 	= date(\Config::get('constants.DBdateFormat'),strtotime($request->registration_end));
		    		$truckRegistration->save();

			    	/*save truck insurance data*/
			    	$truckInsurance->truck_id 		= $lastInsertedId;
			    	$truckInsurance->policy_no 		= strtoupper($request->policy_no);
			    	$truckInsurance->policy_on 		= date(\Config::get('constants.DBdateFormat'),strtotime($request->policy_on));
			    	$truckInsurance->read_status    = ($truckInsurance->policy_end == $newPolicyEndDate) ? $truckInsurance->read_status : '0';
			    	$truckInsurance->policy_end 	= date(\Config::get('constants.DBdateFormat'),strtotime($request->policy_end));
			    	$truckInsurance->policy_file 	= isset($request->policy_file)?$request->policy_file:'';
			    	$truckInsurance->save();


			    	/*save truck permit data*/
			    	$truckPermit->truck_id 		= $lastInsertedId;
			    	$truckPermit->permit_no 	= strtoupper($request->permit_no);
			    	$truckPermit->permit_on 	= date(\Config::get('constants.DBdateFormat'),strtotime($request->permit_on));
			    	$truckPermit->read_status    = ($truckPermit->permit_end == $newPermitEndDate) ? $truckPermit->read_status : '0';
			    	$truckPermit->permit_end 	= date(\Config::get('constants.DBdateFormat'),strtotime($request->permit_end));
			    	$truckPermit->permit_file 	= isset($request->permit_file)?$request->permit_file:'';
			    	$truckPermit->save();


			    	/*save truck tax data*/
			    	$truckTax->truck_id 		= $lastInsertedId;
			    	$truckTax->invoice_no 		= strtoupper($request->invoice_no);
			    	$truckTax->tax_paid_date 	= date(\Config::get('constants.DBdateFormat'),strtotime($request->tax_paid_date));
			    	$truckTax->read_status    = ($truckTax->tax_period_end == $newTaxEndDate) ? $truckTax->read_status : '0';
			    	$truckTax->tax_period_end 	= date(\Config::get('constants.DBdateFormat'),strtotime($request->tax_period_end));
			    	$truckTax->tax_file 		= isset($request->tax_file)?$request->tax_file:'';
			    	$truckTax->save();



			    	/*save truck pollution data*/
			    	$truckPollution->truck_id 		 = $lastInsertedId;
			    	$truckPollution->pollution_no 	 = strtoupper($request->pollution_no);
			    	$truckPollution->pollution_on 	 = date(\Config::get('constants.DBdateFormat'),strtotime($request->pollution_on));
			    	$truckPollution->read_status     = ($truckPollution->pollution_end == $newPollutionEndDate) ? $truckPollution->read_status : '0';
			    	$truckPollution->pollution_end 	 = date(\Config::get('constants.DBdateFormat'),strtotime($request->pollution_end));
			    	$truckPollution->pollution_file  = isset($request->pollution_file)?$request->pollution_file:'';
			    	$truckPollution->save();
			    }
			    $data['truck'] 		= $lastInsertedId;
			    $data['reg'] 		= $truckRegistration;
			    $data['details'] 	= $truck;
		 		$data['success'] 	= 'true';

		 		if (isset($request->truckId) && ($request->truckId != '')) {
					$request->session()->flash('alert-success', 'Truck Edited Successfully');
				} else {
					$request->session()->flash('alert-success', 'Truck Added Successfully');
				}
			}
		} else {
			$data['success'] = 'false';
			$data['msg']	 = 'Please select proper Vendor or create new';
		}

		
 		
        return $data;
	}




	/*****************************************************/
	# Truck Controller             
	# Function name : deleteTruck
	# Functionality: delete truck
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/08/2018                                
	# Purpose:  delete truck 
	# Params :  Request $request                                          
	/*****************************************************/
	public function deleteTruck(Request $request){

		$data 	= array(); /*storing data for listing*/ 

		/*check existance of truck under Trip*/
		$truckDetails = Trip::where('truck_id',$request->truckId)->count();

		if(is_numeric($request->truckId)) {
			if ($truckDetails > 0) {
				$data['success']		= 'false'; 
			} else {

				/*delete data*/
				$truck = Truck::find($request->truckId);
				$truck->deleted_by = \Auth::user()->id;/*logged in user id*/
				$truck->status     = 'D';
				$truck->is_deleted = 'Y';
				$truck->save();


				/*soft delete truck registration record*/
				$truckRegDetails 	 = TruckRegistration::where('truck_id',$request->truckId)->get()->toArray();
				TruckRegistration::where('id',$truckRegDetails[0]['id'])->update(array('deleted_by' => \Auth::user()->id,'status'=>'D','is_deleted'=>'Y')); 
				TruckRegistration::where('id',$truckRegDetails[0]['id'])->delete(); /*Soft Deletion of data*/

				if ($truck->type == 'C')	{ /*for company type truck*/

					/*soft delete truck insurance record*/
					$truckInsuranceDetails 	= TruckInsurance::where('truck_id',$request->truckId)->get()->toArray();
					TruckInsurance::where('id',$truckInsuranceDetails[0]['id'])->update(array('deleted_by' => \Auth::user()->id,'status'=>'D','is_deleted'=>'Y')); 
					TruckInsurance::where('id',$truckInsuranceDetails[0]['id'])->delete(); /*Soft Deletion of data*/



					/*soft delete truck permit record*/
					$truckPermitDetails = TruckPermit::where('truck_id',$request->truckId)->get()->toArray();
					TruckPermit::where('id',$truckPermitDetails[0]['id'])->update(array('deleted_by' => \Auth::user()->id,'status'=>'D','is_deleted'=>'Y')); 
					TruckPermit::where('id',$truckPermitDetails[0]['id'])->delete(); /*Soft Deletion of data*/



					/*soft delete truck tax record*/
					$truckTaxDetails 	= TruckTax::where('truck_id',$request->truckId)->get()->toArray();
					TruckTax::where('id',$truckTaxDetails[0]['id'])->update(array('deleted_by' => \Auth::user()->id,'status'=>'D','is_deleted'=>'Y')); 
					TruckTax::where('id',$truckTaxDetails[0]['id'])->delete(); /*Soft Deletion of data*/




					/*soft delete truck pollution record*/
					$truckPollutionDetails 	= TruckPollution::where('truck_id',$request->truckId)->get()->toArray();
					TruckPollution::where('id',$truckPollutionDetails[0]['id'])->update(array('deleted_by' => \Auth::user()->id,'status'=>'D','is_deleted'=>'Y')); 
					TruckPollution::where('id',$truckPollutionDetails[0]['id'])->delete(); /*Soft Deletion of data*/
		        }


				/*soft delete the record*/
				$truck->delete();

				$data['success']		= 'true'; 
			}
		} else {
			$data['success']		= 'not_numeric'; 
		}

		return $data;
		
	}




	/*****************************************************/
	# Truck Controller             
	# Function name : uploadRegistrationFile
	# Functionality: Upload Registration File for truck
	# Author : Sanchari Ghosh                                 
	# Created Date : 21/08/2018                                
	# Purpose:  Upload Registration File for truck
	# Params :  Request $request                                          
	/*****************************************************/
	public function uploadRegistrationFile(Request $request){
		$data = array();
        
        $fileType = explode('/', $_FILES["file"]["type"]);
        $actualFileType = $fileType[0];

        if ($_FILES["file"]["error"] == 1 || ($fileType[0] != 'image' && $fileType[1] != 'pdf')) {
            $data['fileName']   = ''; 
            $data['success']    = 'false';
            $data['msg']    	= 'Please upload proper image/pdf file';
        } else {
			$target_dir  	= public_path().'/'.\Config::get('constants.truckRegistrationPath');
			$fileExtension  = explode('.', $_FILES["file"]["name"]);
			$fileName 		= 'registration_'.time().'.'.$fileExtension[count($fileExtension) - 1];
		    $target_file 	= $target_dir . $fileName ;
		    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
		    $data['fileName']       = $fileName;
            $data['success']        = 'true';
		}
		return $data;
	}





	/*****************************************************/
	# Truck Controller             
	# Function name : uploadInsuranceFile
	# Functionality: Upload Insurance File for truck
	# Author : Sanchari Ghosh                                 
	# Created Date : 21/08/2018                                
	# Purpose:  Upload Insurance File for truck
	# Params :  Request $request                                          
	/*****************************************************/
	public function uploadInsuranceFile(Request $request){
		$data = array();
        
        $fileType = explode('/', $_FILES["file"]["type"]);
        $actualFileType = $fileType[0];

        if ($_FILES["file"]["error"] == 1 || ($fileType[0] != 'image' && $fileType[1] != 'pdf')) {
            $data['fileName']   = '';
            $data['success']    = 'false';
            $data['msg']    	= 'Please upload proper image/pdf file';
        } else {
			$target_dir  	= public_path().'/'.\Config::get('constants.truckInsurancePath');
		    $fileExtension  = explode('.', $_FILES["file"]["name"]);
			$fileName 		= 'insurance_'.time().'.'.$fileExtension[count($fileExtension) - 1];
		    $target_file 	= $target_dir . $fileName ;
		    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
		    $data['fileName']       = $fileName;
            $data['success']        = 'true';
		}
		return $data;
	}



	/*****************************************************/
	# Truck Controller             
	# Function name : uploadPermitFile
	# Functionality: Upload Permit File for truck
	# Author : Sanchari Ghosh                                 
	# Created Date : 21/08/2018                                
	# Purpose:  Upload Permit File for truck
	# Params :  Request $request                                          
	/*****************************************************/
	public function uploadPermitFile(Request $request){
		$data = array();
        
        $fileType = explode('/', $_FILES["file"]["type"]);
        $actualFileType = $fileType[0];

        if ($_FILES["file"]["error"] == 1 || ($fileType[0] != 'image' && $fileType[1] != 'pdf')) {
            $data['fileName']   = '';
            $data['success']    = 'false';
            $data['msg']    	= 'Please upload proper image/pdf file';
        } else {
			$target_dir  	= public_path().'/'.\Config::get('constants.truckPermitPath');
		    $fileExtension  = explode('.', $_FILES["file"]["name"]);
			$fileName 		= 'permit_'.time().'.'.$fileExtension[count($fileExtension) - 1];
		    $target_file 	= $target_dir . $fileName ;
		    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
		    $data['fileName']       = $fileName;
            $data['success']        = 'true';
		}
		return $data;
	}



	/*****************************************************/
	# Truck Controller             
	# Function name : uploadTaxFile
	# Functionality: Upload Tax File for truck
	# Author : Sanchari Ghosh                                 
	# Created Date : 21/08/2018                                
	# Purpose:  Upload Tax File for truck
	# Params :  Request $request                                          
	/*****************************************************/
	public function uploadTaxFile(Request $request){
		$data = array();
        
        $fileType = explode('/', $_FILES["file"]["type"]);
        $actualFileType = $fileType[0];

        if ($_FILES["file"]["error"] == 1 || ($fileType[0] != 'image' && $fileType[1] != 'pdf')) {
            $data['fileName']   = '';
            $data['success']    = 'false';
            $data['msg']    	= 'Please upload proper image/pdf file';
        } else {
			$target_dir  	= public_path().'/'.\Config::get('constants.trucktaxPath');
		    $fileExtension  = explode('.', $_FILES["file"]["name"]);
			$fileName 		= 'tax_'.time().'.'.$fileExtension[count($fileExtension) - 1];
		    $target_file 	= $target_dir . $fileName ;
		    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
		    $data['fileName']       = $fileName;
            $data['success']        = 'true';
		}
		return $data;
	}



	/*****************************************************/
	# Truck Controller             
	# Function name : uploadPollutionFile
	# Functionality: Upload Pollution File for truck
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/09/2018                                
	# Purpose:  Upload Pollution File for truck
	# Params :  Request $request                                          
	/*****************************************************/
	public function uploadPollutionFile(Request $request){
		$data = array();
        
        $fileType = explode('/', $_FILES["file"]["type"]);
        $actualFileType = $fileType[0];
        
        if ($_FILES["file"]["error"] == 1 || ($fileType[0] != 'image' && $fileType[1] != 'pdf')) {
            $data['fileName']   = '';
            $data['success']    = 'false';
            $data['msg']    	= 'Please upload proper image/pdf file';
        } else {
			$target_dir  	= public_path().'/'.\Config::get('constants.truckPollutionPath');
		    $fileExtension  = explode('.', $_FILES["file"]["name"]);
			$fileName 		= 'pollution_'.time().'.'.$fileExtension[count($fileExtension) - 1];
		    $target_file 	= $target_dir . $fileName ;
		    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
		    $data['fileName']       = $fileName;
            $data['success']        = 'true';
		}
		return $data;
	}





	/*****************************************************/
	# Truck Controller             
	# Function name : viewRecord
	# Functionality: view truck details page
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/09/2018                                
	# Purpose:  to view truck details page  
	# Params :                                           
	/*****************************************************/
	public function viewRecord(){
		return view('trucks.truckView');
	}



	/*****************************************************/
	# Truck Controller             
	# Function name : getTruckDetails
	# Functionality: get details of a particular truck
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/09/2018                                
	# Purpose:  to get details of particular truck
	# Params : Request $request                                          
	/*****************************************************/
	public function getTruckDetails(Request $request){

		/*get trip id*/
		$truckId = $request->truckId;

		$data 	= array(); /*storing data for listing*/ 

		$data = $this->getEditTruck($request);

		return $data;
	}




	/*****************************************************/
	# Truck Controller             
	# Function name : viewTruckList
	# Functionality: get data of trucks for trip
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/09/2018                                
	# Purpose:  get data of trucks for trip
	# Params :  Request $request                                         
	/*****************************************************/
	public function viewTruckList(Request $request) {
		$data 				= array(); /*storing data for listing*/ 
		$truckIdDetails 	= array(); /*storing truck id*/
		$tripTruckIdDetails = array(); /*get the truck id currently availing a trip*/
		$regTruckIdDetails  = array(); /*get the truck id having registration*/
		$resultIds 			= array(); /*array of final truck ids*/
		$year           	= array(); /*store year lists*/

		/*get truck ids having registration number*/
		$truckRegDetails = TruckRegistration::select('truck_id')->get()->toArray();
		foreach ($truckRegDetails as $t) {
			array_push($regTruckIdDetails, $t['truck_id']); 
		}

		/*get available truck records having registration number*/
		$truckDetails = Truck::select('id')->where('status','A')->whereIn('id',$regTruckIdDetails)->get()->toArray();
		foreach ($truckDetails as $t) {
			array_push($truckIdDetails, $t['id']); 
		}


		/*get truck records currently availing a trip*/
		$tripDetails = Trip::select('truck_id')->where('trip_status','Running')->orWhere('trip_status','Awaiting')->get()->toArray();
		foreach ($tripDetails as $t) {
			array_push($tripTruckIdDetails, $t['truck_id']); 
		}

		/*get truck ids which has not taken any trip and which has no running/awaiting trip status */
		$resultIds = array_diff($truckIdDetails,$tripTruckIdDetails);


		/*for Edit Trip get the respected truck id*/
		if (isset($request->tripId) && ($request->tripId != '')) {
			$tripDetails  = Trip::find($request->tripId);
			array_push($resultIds, $tripDetails->truck_id);
			array_unique($resultIds);
		}
		
		$truckList = Truck::whereIn('id',$resultIds)->where('status','A')->get();



		/*get year lists*/
		$truckMinYear 		= Truck::select(DB::raw('MIN(YEAR(created_at)) year'))->where('status','A')->get()->toArray();
		$currentYear 		= date('Y');


		for($i=$truckMinYear[0]['year']; $i<=$currentYear; $i++) {
			array_push($year, $i);
		}
		$yearList = array_unique($year);


		/*customizing final array*/
		$data['truckList'] = $truckList;
		$data['yearList']  = $yearList;
		$data['success']   = 'true';

		return $data;
	}



	/*****************************************************/
	# Truck Controller             
	# Function name : gpsTruckList
	# Functionality: view gps trucklist page
	# Author : Sanchari Ghosh                                 
	# Created Date : 29/10/2018                                
	# Purpose:  to view gps trucklist page  
	# Params :                                           
	/*****************************************************/
	public function gpsTruckList(){
		return view('trucks.gpsTruckList');
	}



	/*****************************************************/
	# Truck Controller             
	# Function name : viewGPSTruckList
	# Functionality: get data of trucks for GPS Tracking
	# Author : Sanchari Ghosh                                 
	# Created Date : 29/10/2018                                
	# Purpose:  get data of trucks for GPS Tracking
	# Params :  Request $request                                         
	/*****************************************************/
	public function viewGPSTruckList(Request $request) {
		$data 				= array(); /*storing data for listing*/ 
		$truckIdDetails 	= array(); /*storing truck id*/
		$tripTruckIdDetails = array(); /*get the truck id currently availing a trip*/
		$regTruckIdDetails  = array(); /*get the truck id having registration*/
		$resultIds 			= array(); /*array of final truck ids*/

		/*get truck ids having registration number*/
		$truckRegDetails = TruckRegistration::select('truck_id')->get()->toArray();
		foreach ($truckRegDetails as $t) {
			array_push($regTruckIdDetails, $t['truck_id']); 
		}

		/*get available truck records having registration number*/
		$truckDetails = Truck::select('id')->where('status','A')->whereIn('id',$regTruckIdDetails)->get()->toArray();
		foreach ($truckDetails as $t) {
			array_push($truckIdDetails, $t['id']); 
		}


		/*get truck records currently availing a trip*/
		$tripDetails = Trip::select('truck_id')->where('trip_status','Running')->orWhere('trip_status','Awaiting')->get()->toArray();
		foreach ($tripDetails as $t) {
			array_push($tripTruckIdDetails, $t['truck_id']); 
		}

		/*get truck ids which has not taken any trip and which has no running/awaiting trip status */
		$resultIds = array_diff($truckIdDetails,$tripTruckIdDetails);

		$truckList = Truck::whereIn('id',$resultIds)->where('status','A')->get()->toArray();

		for ($i=0; $i<sizeof($truckList); $i++) {
			$truckList[$i]['optionData'] = 'SSLV000'.$truckList[$i]['id'].' ( '.$truckList[$i]['truck_no'].' ) ';
		}


		/*customizing final array*/
		$data['truckList'] = $truckList;
		$data['success']   = 'true';

		return $data;
	}



	/*****************************************************/
	# Truck Controller             
	# Function name : getVendorList
	# Functionality: get data of all the vendors
	# Author : Sanchari Ghosh                                 
	# Created Date : 27/12/2018                                
	# Purpose:  to get data of all the vendors 
	# Params : Request $request                                          
	/*****************************************************/
	public function getAllVendorList(Request $request){
		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'vendorTable' => config('dbtables.vendors'),
				);

		/*get available records*/
		$vendorList = Vendor::getAllVendorList($dbTables);
		
		/*customizing final array*/
		$data['vendorList'] 	= $vendorList;
		$data['success']		= 'true'; 

		return $data;
	}



	/*****************************************************/
	# Truck Controller             
	# Function name : viewTripTruckList
	# Functionality: get data of all the trucks with respect to vendors
	# Author : Sanchari Ghosh                                 
	# Created Date : 25/01/2019                                
	# Purpose:  to get data of all the trucks with respect to vendors
	# Params : Request $request                                          
	/*****************************************************/
	public function viewTripTruckList(Request $request) {
		$vendorTruckId = array();
		$vendortripTruckId = array();
		$vendorName = $request->vendorName;
		$tripType 	= $request->tripType;

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'tripTable'  => config('dbtables.trips'),
					'truckTable' => config('dbtables.trucks'),
				);

		/*find id of vendor*/
		$vendorIdDetails = Vendor::select('id')->where('name',$vendorName)->get();


		/*get truck ids of corresponding vendor which is running and single trip*/
		if ($tripType != 'Multiple') {
			if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) {
				$tripDetails = Trip::select('truck_id','vendor_id')->where('status','A')->where('trip_status','Running')->where('vendor_id',$vendorIdDetails[0]['id'])->where('created_by',\Auth::user()->id)->get()->toArray();
			} else {
				$tripDetails = Trip::select('truck_id','vendor_id')->where('status','A')->where('trip_status','Running')->where('vendor_id',$vendorIdDetails[0]['id'])->get()->toArray();
			}
		} else {
			if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) {
				$tripDetails = Trip::select('truck_id','vendor_id')->where('status','A')->where('trip_status','Running')->where('vendor_id',$vendorIdDetails[0]['id'])->where('trip_type','Single')->where('created_by',\Auth::user()->id)->get()->toArray();
			} else {
				$tripDetails = Trip::select('truck_id','vendor_id')->where('status','A')->where('trip_status','Running')->where('trip_type','Single')->where('vendor_id',$vendorIdDetails[0]['id'])->get()->toArray();
			}
		}
		

		foreach($tripDetails as $t) {
			array_push($vendortripTruckId,$t['truck_id']); /*storing the running truck ids with respect to vendor*/
		}

		/*get available records*/
		if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) {
			$truckList = Truck::select('id','truck_no')->where('created_by',\Auth::user()->id)->where('vendor_id',$vendorIdDetails[0]['id'])->where('status','A')->whereNotIn('id',$vendortripTruckId)->get()->toArray();
		} else {
			$truckList = Truck::select('id','truck_no')->where('vendor_id',$vendorIdDetails[0]['id'])->where('status','A')->whereNotIn('id',$vendortripTruckId)->get()->toArray();
		}
		


		/*customizing final array*/
		$data['truckList'] 	= $truckList;
		$data['success'] 	= 'true';

		return $data;
	}



	/*****************************************************/
	# Truck Controller             
	# Function name : getEditTripTruckList
	# Functionality: get data of all the trucks with respect to vendors for trip edit page
	# Author : Sanchari Ghosh                                 
	# Created Date : 18/02/2019                                
	# Purpose:  to get data of all the trucks with respect to vendors for trip edit page
	# Params : Request $request                                          
	/*****************************************************/
	public function getEditTripTruckList(Request $request) {
		$vendorTruckId = array();
		$vendortripTruckId = array();
		$vendorName = $request->vendor;
		$truckId = $request->truck;
		$tripType = $request->tripType;

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'tripTable'  => config('dbtables.trips'),
					'truckTable' => config('dbtables.trucks'),
				);

		/*find id of vendor*/
		$vendorIdDetails = Vendor::select('id')->where('name',$vendorName)->get();


		/*get truck ids(except the given truck id which is being edited)of corresponding vendor which is running for single trip*/

		if ($tripType != 'Multiple') {
			$tripDetails = Trip::select('truck_id','vendor_id')->where('status','A')->where('trip_status','Running')->where('vendor_id',$vendorIdDetails[0]['id'])->get()->toArray();
		} else {
			$tripDetails = Trip::select('truck_id','vendor_id')->where('status','A')->where('trip_status','Running')->where('trip_type','Single')->where('vendor_id',$vendorIdDetails[0]['id'])->get()->toArray();
		}

		foreach($tripDetails as $t) {
		  array_push($vendortripTruckId,$t['truck_id']); /*storing the running truck ids with respect to vendor*/
		}

		/*remove the truck id which is there in edit trip page*/
		foreach (array_keys($vendortripTruckId,$truckId) as $key) {
		    unset($vendortripTruckId[$key]);
		}

		/*get available records*/
		if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) {
			$truckList = Truck::select('id','truck_no')->where('vendor_id',$vendorIdDetails[0]['id'])->whereNotIn('id',$vendortripTruckId)->where('status','A')->where('created_by',\Auth::user()->id)->get()->toArray();
		} else {
			$truckList = Truck::select('id','truck_no')->where('vendor_id',$vendorIdDetails[0]['id'])->whereNotIn('id',$vendortripTruckId)->where('status','A')->get()->toArray();
		}
		


		/*customizing final array*/
		$data['truckList'] 	= $truckList;
		$data['success'] 	= 'true';

		return $data;
	}



	/*****************************************************/
	# Truck Controller             
	# Function name : getPlantWiseActiveTruckList
	# Functionality: get active truck list plant wise
	# Author : Sanchari Ghosh                                 
	# Created Date : 15/05/2019                                
	# Purpose:  to get active truck list plant wise
	# Params : Request $request                                        
	/*****************************************************/
	public function getPlantWiseActiveTruckList(Request $request) {
		$data = array();
		$truckIds = array(); /*for storing plant wise truck id */

		$plantId = $request->plantId;
		$tripDetails = Trip::select('truck_id')->where('plant_id',$plantId)->get()->toArray();

		foreach($tripDetails as $t) {
			array_push($truckIds,$t['truck_id']);
		}

		$truckDetails = Truck::select('id','truck_no')->whereIn('id',$truckIds)->get()->toArray();
		$data['success'] =  'true';
		$data['truckList'] = $truckDetails;

		return $data;
	}



	/*****************************************************/
	# Truck Controller             
	# Function name : viewCashTruckList
	# Functionality: get active truck list vendor wise
	# Author : Sanchari Ghosh                                 
	# Created Date : 02/07/2019                                
	# Purpose:  to get active truck list vendor wise
	# Params : Request $request                                        
	/*****************************************************/
	public function viewCashTruckList(Request $request) {
		$data = array();
		$truckIds = array(); /*for storing plant wise truck id */

		$vendorId = $request->vendorId;
		$truckDetails = Truck::select('id','truck_no')->where('vendor_id',$vendorId)->get()->toArray();

		$data['success'] =  'true';
		$data['truckList'] = $truckDetails;

		return $data;
	}


	/*****************************************************/
	# Truck Controller             
	# Function name : getEditTruckList
	# Functionality: get data of all the trucks with respect to vendors for extra cash edit page
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/07/2019                                
	# Purpose:  to get data of all the trucks with respect to vendors for extra cash edit page
	# Params : Request $request                                          
	/*****************************************************/
	public function getEditTruckList(Request $request) {
		
		$vendorid = $request->vendor;
		$truckId = $request->truck;
		

		$data 	= array(); /*storing data for listing*/ 

		/*defining db tables for joining*/
		$dbTables = array(
					'tripTable'  => config('dbtables.trips'),
					'truckTable' => config('dbtables.trucks'),
				);

		$truckList = Truck::select('id','truck_no')->where('vendor_id',$vendorid)->get()->toArray();
		
		/*customizing final array*/
		$data['truckList'] 	= $truckList;
		$data['success'] 	= 'true';

		return $data;
	}
}
