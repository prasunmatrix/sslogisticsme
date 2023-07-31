<?php

/*****************************************************/
# Petrolpump Pay Controller             
# Class name : PetrolpumpPayController
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
use App\Models\PetrolPump,App\Models\PetrolPumpJournalLaser;


class PetrolpumpPayController extends Controller {
 
	/*****************************************************/
	# Petrolpump Pay Controller             
	# Class name : PetrolpumpPayController
	# Functionality: constructor
	# Author : Debamala Dey                               
	# Created Date :  05/09/2018                                  
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}
	

	/*****************************************************/
	# Petrolpump Pay Controller             
	# Class name : PetrolpumpPayController         
	# Function name : index
	# Functionality: view Petrolpump pay add page
	# Author : Debamala Dey                               
	# Created Date :  05/09/2018                             
	# Purpose:  to view Petrolpump pay add page
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('petrol_pumps.petrolPumpPayment');
	}

	/*****************************************************/
	# Petrolpump Pay Controller             
	# Class name : PetrolpumpPayController         
	# Function name : savePetrolPumpPayment
	# Functionality: view Petrolpump payment save
	# Author : Debamala Dey                               
	# Created Date :  05/09/2018                             
	# Purpose:  to view Petrolpump payment save
	# Params :  Request $request                                          
	/*****************************************************/
	public function savePetrolPumpPayment(Request $request){

		$data 	= array(); /*storing data for listing*/ 
		
		$PetrolPumpJournalLaser 				= new PetrolPumpJournalLaser();
		$PetrolPumpJournalLaser->petrol_pump_id	= $request->petrolpump_id;
		$PetrolPumpJournalLaser->type			= 'C';
		$PetrolPumpJournalLaser->amount			= $request->amount;
		$PetrolPumpJournalLaser->description	= $request->description;
		$PetrolPumpJournalLaser->entry_by		= \Auth::user()->id;
		$PetrolPumpJournalLaser->created_at		= date('Y-m-d h:i:s');
		$PetrolPumpJournalLaser->updated_at		= date('Y-m-d h:i:s');
		$PetrolPumpJournalLaser->created_by		= \Auth::user()->id;
		$save = $PetrolPumpJournalLaser->save();
		if($save)
	 	$data['success'] 		= 'true';
	 	$request->session()->flash('alert-success', 'PetrolPump Payment Added Successfully');
        return $data;
	}

}
