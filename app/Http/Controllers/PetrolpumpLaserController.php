<?php

/*****************************************************/
# PetrolpumpLaser Controller             
# Class name : PetrolpumpLaserController
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
use DB;
use Illuminate\Support\Facades\Input;
use App\Models\PetrolPump,App\Models\PetrolPumpJournalLaser;


class PetrolpumpLaserController extends Controller {
 
	/*****************************************************/
	# PetrolpumpLaser Controller             
	# Class name : PetrolpumpLaserController
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
	# PetrolpumpLaser Controller             
	# Class name : PetrolpumpLaserController         
	# Function name : index
	# Functionality: view Petrolpump laser listing page
	# Author : Debamala Dey                               
	# Created Date :  05/09/2018                             
	# Purpose:  to view Petrolpump laser listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('petrol_pumps.petrolPumpLaser');
	}


	/*****************************************************/
	# PetrolpumpLaser Controller             
	# Function name : all_petrolpump_list
	# Functionality: get data of Petrolpump listing page
	# Author : Debamala Dey                               
	# Created Date :  05/09/2018                                
	# Purpose:  to get data of Petrolpump listing page  
	# Params :                                           
	/*****************************************************/
	public function all_petrolpump_list(){

		$data 					= array(); /*storing data for listing*/ 
		$petrolpumpList 		= PetrolPump::where('status','A')->orderBy('petrol_pump_name','asc')->get();
		$data['petrolpumpList'] = $petrolpumpList;
		$data['success']		= 'true'; 
		return $data;
	}


	/*****************************************************/
	# PetrolpumpLaser Controller             
	# Function name : petrolpump_laser_list
	# Functionality: get data of Petrolpump laser listing page
	# Author : Debamala Dey                               
	# Created Date :  05/09/2018                                
	# Purpose:  to get data of Petrolpump laser listing page  
	# Params : Request $request                                          
	/*****************************************************/
	public function petrolpump_laser_list(Request $request){

		$data 					= array(); /*storing data for listing*/ 
		$year 					= array();
		$petrolpumpList 		= PetrolPump::where('id',$request->petrolpump_id)->first();
		$data['petrolPumpName'] = $petrolpumpList->petrol_pump_name;

		$currentYear 			= (int)date('Y');
		
		/*get the minimum year*/
		if (PetrolPumpJournalLaser::select(DB::raw('MIN(YEAR(created_at)) year'))->where('petrol_pump_id',$request->petrolpump_id)->count() > 0) {
			$petrolpumpLaserMinYear = PetrolPumpJournalLaser::select(DB::raw('MIN(YEAR(created_at)) year'))->where('petrol_pump_id',$request->petrolpump_id)->get()->toArray();
			for($i=$petrolpumpLaserMinYear[0]['year']; $i<=$currentYear; $i++) {
				array_push($year, $i);
			}
			
		} else {
			array_push($year, $currentYear);
		}
		$laserYear = array_unique($year);
		
		


		$petrolpumpLaserList 	= PetrolPumpJournalLaser::where('petrol_pump_id',$request->petrolpump_id)
													->whereYear('created_at', '=', $request->year)
													->get();

		$petrolpumpLaserCredit 	= PetrolPumpJournalLaser::where('petrol_pump_id',$request->petrolpump_id)
													->whereYear('created_at', '=', $request->year)
													->where('type', '=', 'C')
													->sum('amount');	
		$petrolpumpLaserDebit 	= PetrolPumpJournalLaser::where('petrol_pump_id',$request->petrolpump_id)
													->whereYear('created_at', '=', $request->year)
													->where('type', '=', 'D')
													->sum('amount');	
		$balance 				= $petrolpumpLaserCredit - $petrolpumpLaserDebit;	
		$data['totalDebit']		= $petrolpumpLaserDebit;
		$data['totalCredit']	= $petrolpumpLaserCredit;	
		$data['balance'] 		= $balance;		
		$data['petrolpumpLaserList'] = $petrolpumpLaserList;
		$data['laserYear'] 		= $laserYear;
		$data['success']		= 'true'; 
		return $data;
	}




	/*****************************************************/
	# PetrolpumpLaser Controller             
	# Function name : selected_petrolpump_laser_view
	# Functionality: get data of selected Petrolpump laser listing page
	# Author : Debamala Dey                               
	# Created Date :  05/09/2018                                
	# Purpose:  to get data of selected Petrolpump laser listing page  
	# Params :  Request $request,$id,$year                                         
	/*****************************************************/
	public function selected_petrolpump_laser_view(Request $request,$id,$year){
		return view('petrol_pumps.petrolPumpLaserView' , ['petrolpump_id' => $id,'year' => $year]);  
	}

}
