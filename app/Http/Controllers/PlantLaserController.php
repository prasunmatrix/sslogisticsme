<?php

/*****************************************************/
# PlantLaser Controller             
# Class name : PlantLaserController
# Functionality: listing
# Author : Debamala Dey                               
# Created Date :  03/09/2018                                
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
use App\Models\Plant;
use App\Models\PlantJournalLaser;
use App\Models\PlantUserRelation;
use App\User;



class PlantLaserController extends Controller {
 
	/*****************************************************/
	# PlantLaser Controller             
	# Class name : PlantLaserController
	# Functionality: constructor
	# Author : Debamala Dey                               
	# Created Date :  03/09/2018                                  
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}
	

	/*****************************************************/
	# PlantLaser Controller             
	# Class name : PlantLaserController         
	# Function name : index
	# Functionality: view plant laser listing page
	# Author : Debamala Dey                               
	# Created Date :  03/09/2018                             
	# Purpose:  to view plant laser listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('plants.plantLaser');
	}

	/*****************************************************/
	# PlantLaser Controller             
	# Function name : all_plan_list
	# Functionality: get data of plant listing page
	# Author : Debamala Dey                               
	# Created Date :  03/09/2018                                
	# Purpose:  to get data of plant listing page  
	# Params :                                           
	/*****************************************************/
	public function all_plan_list(){

		$data 					= array(); /*storing data for listing*/ 
		if(\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')){
			$plantUserData 	= PlantUserRelation::where('user_id',\Auth::user()->id)->get();
        	$plantId 		= $plantUserData[0]->plant_id;
        	$plantList 		= Plant::where('status','A')->where('id',$plantId)->orderBy('name','asc')->get();
		}else{
			$plantList 		= Plant::where('status','A')->orderBy('name','asc')->get();
		}
		
		$data['plantList'] 		= $plantList;
		$data['success']		= 'true'; 
		return $data;
	}



	/*****************************************************/
	# PlantLaser Controller             
	# Function name : plant_laser_list
	# Functionality: get data of plant laser listing page
	# Author : Debamala Dey                               
	# Created Date :  04/09/2018                                
	# Purpose:  to get data of plant laser listing page  
	# Params : Request $request                                          
	/*****************************************************/
	public function plant_laser_list(Request $request){

		$data 					= array(); /*storing data for listing*/ 
		$year 					= array();
		$plantList 				= Plant::where('id',$request->plan_id)->first();
		$data['plantName'] 		= $plantList->name;

		$currentYear 			= (int)date('Y');

		/*get the minimum year*/
		if ($plantLaserMinYear 		= PlantJournalLaser::select(DB::raw('MIN(YEAR(created_at)) year'))->where('plant_id',$request->plan_id)->where('approval_status','Approved')->count() > 0) {
			$plantLaserMinYear 		= PlantJournalLaser::select(DB::raw('MIN(YEAR(created_at)) year'))->where('plant_id',$request->plan_id)->where('approval_status','Approved')->get()->toArray();
			for($i=$plantLaserMinYear[0]['year']; $i<=$currentYear; $i++) {
				array_push($year, $i);
			}
		} else {
			array_push($year, $currentYear);
		}
		
			
		$laserYear = array_unique($year);
		
		
		$plantLaserList 		= PlantJournalLaser::where('plant_id',$request->plan_id)
													->whereYear('created_at', '=', $request->year)
													->where('approval_status','Approved')
													->get();

		$plantLaserCredit 		= PlantJournalLaser::where('plant_id',$request->plan_id)
													->whereYear('created_at', '=', $request->year)
													->where('type', '=', 'C')
													->where('approval_status','Approved')
													->sum('amount');	
		$plantLaserDebit 		= PlantJournalLaser::where('plant_id',$request->plan_id)
													->whereYear('created_at', '=', $request->year)
													->where('type', '=', 'D')
													->where('approval_status','Approved')
													->sum('amount');	
		$balance 				= $plantLaserCredit - $plantLaserDebit;
		$data['totalDebit']		= $plantLaserDebit;
		$data['totalCredit']	= $plantLaserCredit;
		$data['balance'] 		= $balance;		
		$data['plantLaserList'] = $plantLaserList;
		$data['laserYear'] 		= $laserYear;
		$data['success']		= 'true'; 
		return $data;
	}



	/*****************************************************/
	# PlantLaser Controller             
	# Function name : selected_plant_laser_view
	# Functionality: get data of plant laser listing page
	# Author : Debamala Dey                               
	# Created Date :  04/09/2018                                
	# Purpose:  to get data of plant laser listing page  
	# Params : Request $request,$id,$year                                          
	/*****************************************************/
	public function selected_plant_laser_view(Request $request,$id,$year){
		return view('plants.plantLaserView' , ['plant_id' => $id,'year' => $year]);  
	}

}
