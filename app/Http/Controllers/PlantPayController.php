<?php

/*****************************************************/
# PlantPay Controller             
# Class name : PlantPayController
# Functionality: listing
# Author : Debamala Dey                               
# Created Date :  05/09/2018                                
# Purpose: Developing the functionality of listing
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Hash;
use Illuminate\Support\Facades\Input;
use App\Models\Plant;
use App\Models\PlantJournalLaser;
use App\Models\PlantAddress;
use App\User;



class PlantPayController extends Controller {
 
	/*****************************************************/
	# Plant Pay Controller             
	# Class name : PlantPayController
	# Functionality: constructor
	# Author : Debamala Dey                               
	# Created Date : 05/09/2018                                  
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}
	

	/*****************************************************/
	# Plant Pay Controller             
	# Class name : PlantPayController         
	# Function name : index
	# Functionality: view Plant pay add page
	# Author : Debamala Dey                               
	# Created Date :  05/09/2018                             
	# Purpose:  to view Plant pay add page
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('plants.plantPayment');
	}



	/*****************************************************/
	# Plant Pay Controller             
	# Class name : PlantPayController         
	# Function name : savePlantPayment
	# Functionality: view Plant payment save
	# Author : Debamala Dey                               
	# Created Date :  05/09/2018                             
	# Purpose:  to view Plant payment save
	# Params :  Request $request                                          
	/*****************************************************/
	public function savePlantPayment(Request $request){

		$data 	= array(); /*storing data for listing*/ 
		if(\Auth::user()->user_role_id == 3 && $request->entry_type == 'M'){
			$status = 'A';
			$approvalStatus = 'Pending';
		}else{
			$status = 'A';
			$approvalStatus = 'Approved';
		}
		$PlantLaser 				= new PlantJournalLaser();
		$PlantLaser->plant_id		= $request->plant_id;
		$PlantLaser->type			= ($request->entry_type == 'M') ? 'D' : 'C';
		$PlantLaser->amount			= $request->amount;
		$PlantLaser->description	= $request->description;
		$PlantLaser->entry_type		= $request->entry_type;
		$PlantLaser->entry_by		= \Auth::user()->id;
		$PlantLaser->status			= $status;
		$PlantLaser->approval_status= $approvalStatus;
		$PlantLaser->created_at		= date('Y-m-d h:i:s');
		$PlantLaser->updated_at		= date('Y-m-d h:i:s');
		$PlantLaser->created_by		= \Auth::user()->id;
		$save = $PlantLaser->save();
		if($save)
	 	$data['success'] 		= 'true';
	 	$request->session()->flash('alert-success', 'Plant Payment Added Successfully');
        return $data;
	}

}
