<?php

/*****************************************************/
# Dashboard Controller             
# Class name : DashboardController
# Functionality: 
# Author : Sanchari Ghosh                                   
# Created Date :  07/08/2018                                  
# Purpose: Developing the functionality of dashboard                              
/*****************************************************/
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Input;
use Image;
use App\User;
use App\Models\Plant;
use App\Models\Party;
use App\Models\PetrolPump;
use App\Models\Truck;
use App\Models\Trip;
use App\Models\PlantJournalLaserEditRequest;
use App\Models\PetrolPumpJournalLaserEditRequest;
use App\Models\PlantJournalLaser;
use App\Models\Vendor;
use App\Models\PlantUserRelation;


class DashboardController extends Controller {
 
	/*****************************************************/
	# Dashboard Controller             
	# Class name : DashboardController
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
	# Dashboard Controller             
	# Function name : index
	# Functionality: view dashboard page
	# Author : Sanchari Ghosh                                 
	# Created Date : 07/08/2018                                
	# Purpose:  to view dashboard page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('dashboard');
	}



	/*****************************************************/
	# Dashboard Controller             
	# Function name : dashboardList
	# Functionality: get data of dashboard page
	# Author : Sanchari Ghosh                                 
	# Created Date : 14/04/2019                                
	# Purpose:  to view the content dashboard page  
	# Params :                                           
	/*****************************************************/
	public function dashboardList(){
		$data 	= array(); /*storing data for listing*/ 


		if (\Auth::user()->user_role_id == \Config::get('constants.supervisorRoleId')) { /*for supervisor*/
			$pendingAdvRequest  = PlantJournalLaserEditRequest::where('created_by',\Auth::user()->id)->where('status','A')->count();
			$pendingDslRequest  = PetrolPumpJournalLaserEditRequest::where('created_by',\Auth::user()->id)->where('status','A')->count();
			$pendingMiscRequest = PlantJournalLaser::where('created_by',\Auth::user()->id)->where('status','A')->where('entry_type','M')->count();
		} else {
			
			
			$pendingAdvRequest  = PlantJournalLaserEditRequest::where('approval_status','Pending')->where('status','A')->count();
			$pendingDslRequest  = PetrolPumpJournalLaserEditRequest::where('approval_status','Pending')->where('status','A')->count();
			$pendingMiscRequest = PlantJournalLaser::where('approval_status','Pending')->where('status','A')->count();
		}

		$completedTripCount = Trip::where('trip_status','Completed')->where('status','A')->count();
		$runningTripCount   = Trip::where('trip_status','Running')->where('status','A')->count();
		$awaitingTripCount  = Trip::where('trip_status','Awaiting')->where('status','A')->count();
		$settledTripCount   = Trip::where('trip_status','Settled')->where('status','A')->count();
		$supervisorCount	= User::where('user_role_id',\Config::get('constants.supervisorRoleId'))->where('status','A')->count();
		$accountantCount	= User::where('user_role_id',\Config::get('constants.accountantRoleId'))->where('status','A')->count();
		$vendorCount 		= Vendor::where('status','A')->count();
		$plantCount 		= Plant::where('status','A')->count();
		$partyCount 		= Party::where('status','A')->count();
		$pumpCount  		= PetrolPump::where('status','A')->count();
		$truckCount 		= Truck::where('status','A')->count();


		$data['plantCount']     	= $plantCount;
		$data['partyCount']     	= $partyCount;
		$data['pumpCount']      	= $pumpCount;
		$data['truckCount']     	= $truckCount;
		$data['superVisorCount']	= $supervisorCount;
		$data['accountantCount']	= $accountantCount;
		$data['completedTripCount'] = $completedTripCount;
		$data['runningTripCount']   = $runningTripCount;
		$data['awaitingTripCount']  = $awaitingTripCount;
		$data['settledTripCount']   = $settledTripCount;
		$data['pendingAdvRequest']	= $pendingAdvRequest;
		$data['pendingDslRequest']	= $pendingDslRequest;
		$data['pendingMiscRequest']	= $pendingMiscRequest;
		$data['vendorCount'] 		= $vendorCount;
		$data['success']			= 'true'; 

		return $data;
	}

}
