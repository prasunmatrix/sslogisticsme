<?php

/*****************************************************/
# ConsolidatedTrip  Controller             
# Class name : ConsolidatedTripController
# Functionality: consolidated view of trips
# Author : Sanchari Ghosh                                 
# Created Date :  10/09/2018                                
# Purpose: Developing the functionality of consolidated view of trips
/*****************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Input;
use App\Models\Trip;
use App\Models\Plant;
use App\Models\TripPaymentManagement;
use App\Models\Truck;
use App\Models\PlantAddress;
use App\Models\PartyDestination;
use App\Models\Vendor;
use App\Models\AddressZone;
use App\Models\TripBill;

class ConsolidatedTripController extends Controller {
 
	/*****************************************************/
	# ConsolidatedTrip Controller             
	# Class name : ConsolidatedTripController
	# Functionality: constructor
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/09/2018                                 
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}
	

	/*****************************************************/
	# ConsolidatedTrip Controller             
	# Function name : index
	# Functionality: view trip listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/09/2018                                
	# Purpose:  to view trip listing page  
	# Params :                                           
	/*****************************************************/
	public function index(){
		return view('trips.consolidatedTripList');
	}



	/*****************************************************/
	# ConsolidatedTrip Controller             
	# Function name : searchTrip
	# Functionality: search Trip
	# Author : Sanchari Ghosh                                 
	# Created Date : 10/09/2018                                
	# Purpose:  search trip on the basis of vendor 
	# Params : Request $request                                          
	/*****************************************************/
	public function searchTrip(Request $request){

		$data 	= array(); /*storing data for listing*/ 
		$record = array();

		$vendorList 			= Vendor::where('name','like',$request->vendor_id)->get()->toArray();

		$startDate = date('Y-m-d', strtotime($request->start_date)); 
		$endDate = date('Y-m-d', strtotime($request->end_date)); 


		/*defining db tables for joining*/
		$dbTables = array(
					'tripTable' 				=> config('dbtables.trips'),
					'plantTable' 				=> config('dbtables.plants'),
					'partyTable' 				=> config('dbtables.parties'),
					'truckTable' 				=> config('dbtables.trucks'),
					'truckRegistrationTable'	=> config('dbtables.truck_registrations'),
					'petrolPumpTable' 			=> config('dbtables.petrol_pumps'),
					'tripPaymentManagements'    => config('dbtables.trip_payment_managements'),
					'addressZoneTable'			=> config('dbtables.address_zones'),
					'tripPODTable'				=> config('dbtables.trip_POD'),
				);

		/*get available records*/
		$tripDetails = Trip::getConsolidatedTripDetails($dbTables,$vendorList[0]['id'], $startDate,$endDate);

		//$totalTrips = Trip::totalConsolidatedTripRecords($dbTables,$request->truck_id,$request->year);

		/*Customizing final record*/
		for ($i=0; $i<sizeof($tripDetails); $i++){

			/*get plant address details*/
			$plantAddressDetails =  AddressZone::select('address','title')->where($dbTables['addressZoneTable'].'.id',$tripDetails[$i]['plant_address'])->get()->toArray();
			$startLocation = $plantAddressDetails[0]['title'];


			/*get party destination details*/
			$partyAddressDetails =  AddressZone::select('address','title')->where($dbTables['addressZoneTable'].'.id',$tripDetails[$i]['party_address'])->get()->toArray();
			$endLocation = $partyAddressDetails[0]['title'];


			$tripDetails[$i]['tripName']   = 'SSLT000'.$tripDetails[$i]['id'].' - '.$tripDetails[$i]['party_name']. ' ("'.$startLocation.'" to "'.$endLocation.'") on '.date(\Config::get('constants.dateFormat'),strtotime($tripDetails[$i]['trip_date']));
		}
		
		/*customizing final array*/
		$data['tripDetails'] 	= $tripDetails;
		$data['success']		= 'true'; 

		return $data;
	}





	/*****************************************************/
	# ConsolidatedTrip Controller             
	# Function name : saveTripPayment
	# Functionality: Save Trip Payemnts (Freight, Toll, Unloading, Tare)
	# Author : Sanchari Ghosh                                 
	# Created Date : 11/09/2018                                
	# Purpose:  Save Trip Payemnts (Freight, Toll, Unloading, Tare) 
	# Params : Request $request                                          
	/*****************************************************/
	public function saveTripPayment(Request $request) {
		$data 	= array(); /*storing data for listing*/ 

		/*check whether Trip Payment added or not*/
		$getTripPaymentCount = TripPaymentManagement::where('trip_id',$request->trip_id)->count();

		if ($getTripPaymentCount > 0) { /*edit data*/
			$getTripPaymentManagement = TripPaymentManagement::where('trip_id',$request->trip_id)->get()->toArray();
			$tripPaymentManagement    			= TripPaymentManagement::find($getTripPaymentManagement[0]['id']);
			$tripPaymentManagement->updated_by 	= \Auth::user()->id;
		} else { /*add data*/
			$tripPaymentManagement 				= new TripPaymentManagement();
			$tripPaymentManagement->created_by	= \Auth::user()->id;
		}

		/*calculate balance*/
		/*$balance =  ($request->qty * $request->freight_charge) + $request->toll + ($request->unloading_charge * $request->qty)+ $request->tare_charge - $request->adv - $request->dsl;*/

		$freightCharges = ($request->qty*$request->rate)+$request->unloading_charge+$request->tare_charge+$request->toll;
		$balance = $freightCharges - $request->dsl - $request->adv - $request->short_bag_amount;

		/*save data*/
		$tripPaymentManagement->trip_id 			= $request->trip_id;
		$tripPaymentManagement->freight_charge 		= $freightCharges;
		$tripPaymentManagement->toll 				= $request->toll;
		$tripPaymentManagement->unloading_charge 	= $request->unloading_charge;
		$tripPaymentManagement->tare_charge 		= $request->tare_charge;
		$tripPaymentManagement->rate 				= $request->rate;	
		$tripPaymentManagement->short_bag_amount 	= $request->short_bag_amount;
		$tripPaymentManagement->balance 			= $balance;
		$tripPaymentManagement->save();

		$data['balance']		= $balance;
		$data['freight_charge']	= $freightCharges;
		$data['countData']      = $getTripPaymentCount;
		$data['success']		= 'true'; 

		return $data;
	}


	/*****************************************************/
	# ConsolidatedTrip Controller             
	# Function name : generateBill
	# Functionality: Save Bill Information
	# Author : Sanchari Ghosh                                 
	# Created Date : 18/06/2019                                
	# Purpose:  Save Bill Information
	# Params : Request $request                                          
	/*****************************************************/
	public function generateBill(Request $request){
		$data 	 = array(); /*storing data for listing*/ 
		$records = array(); /*for inserting data*/
		$tripIdArray = explode(',',$request->tripIds);
		$totalBalance = 0;
		$actualBalance = 0;
		$narration = 'The actual total balance : ';
		$challan = '';
		$tds = '';
		$actualConsolidateAmount = 0;
		$totalDieselAmount = 0;
		$totalAdvanceAmount = 0;
		$totalShortBagAmount = 0;
		$tdsDeduction = 0;
		$totalFreightCharge = 0;

		$existCount = $this->nameExistsCheck('TripBill','bill_no',strtolower($request->bill_no),'');

		if ($existCount > 0) {
			$data['success']		= 'false';
			$data['msg']			= 'Bill Number already exists';
		} else {
			for($i=0; $i<sizeof($tripIdArray); $i++) {

			  /*get amount for editing*/
		      $getTripPaymentManagement = TripPaymentManagement::select('balance','freight_charge','tare_charge','toll','short_bag_amount')->where('trip_id',$tripIdArray[$i])->get()->toArray(); 

		      $getTripDetails = Trip::select('advance_amount','diesel_amount')->where('id',$tripIdArray[$i])->get()->toArray(); 

		      $totalBalance += $getTripPaymentManagement[0]['freight_charge'] - $getTripPaymentManagement[0]['tare_charge'] - $getTripPaymentManagement[0]['toll'];
		      $actualBalance += $getTripPaymentManagement[0]['balance'];


		      $totalDieselAmount += $getTripDetails[0]['diesel_amount'];
			  $totalAdvanceAmount +=  $getTripDetails[0]['advance_amount'];
		      $totalShortBagAmount += $getTripPaymentManagement[0]['short_bag_amount'];
		      $totalFreightCharge += $getTripPaymentManagement[0]['freight_charge'];

		      if (sizeof($tripIdArray) > 1) {
			      if ($i == sizeof($tripIdArray) - 1) {
			      	$narration .= '('.$getTripPaymentManagement[0]['balance'].')';
			      } else {
			      	$narration .= '('.$getTripPaymentManagement[0]['balance'].') +';
			      }
		  	  } 

		     /*update Trip table*/      
			 Trip::where('id',$tripIdArray[$i])->update(array('updated_by' => \Auth::user()->id,'bill_status'=>'Y'));   
		    }

		   $challan = (isset($request->challan_exps) && !empty($request->challan_exps)) ? $request->challan_exps : 0;
		   $tds = (isset($request->tds) && !empty($request->tds)) ? $request->tds : 0;

		   $tdsDeduction = (($totalBalance - $challan)*$tds)/100;
		   $balanceAfterDeduction = $actualBalance - $tdsDeduction;
		   $actualConsolidateAmount = $totalFreightCharge - $challan; 

		   //$balanceAfterDeduction = $totalBalance - (($challan) + (($totalBalance*$tds)/100));

		   $narration .=  '=  '.$totalBalance.'. The Challan exps is = '.$challan.'. The TDS is = '.$tds;

		    $vendorList = Vendor::where('name','like',$request->vendor)->get()->toArray();
			$company = $vendorList[0]['id'];

		  	$trip 	= new TripBill();
		  	$trip->trip_id		= $request->tripIds;
			$trip->bill_no		= $request->bill_no;

			$trip->total_diesel_amount = $totalDieselAmount;
			$trip->total_advance_amount = $totalAdvanceAmount;
			$trip->total_short_bag_amount = $totalShortBagAmount;
			$trip->tds_deduction = $tdsDeduction;
			$trip->actual_consolidate_amount = $actualConsolidateAmount;
			$trip->challan_exps	= (isset($request->challan_exps) && !empty($request->challan_exps)) ? $request->challan_exps : NULL;
			$trip->tds			= (isset($request->tds) && !empty($request->tds)) ? $request->tds : NULL;
			$trip->amount		= $balanceAfterDeduction;
			$trip->created_by	= \Auth::user()->id;
			$trip->narration	= '';
			$trip->vendor_id	= $company;
			$trip->type			= 'C';
			$trip->save();
		    
			$data['success']		= 'true'; 
			$data['billNo']			= $request->bill_no;
		}
		
		return $data;
	}
}
