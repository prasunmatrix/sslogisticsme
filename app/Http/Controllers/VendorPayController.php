<?php

/*****************************************************/
# VendorPay Controller             
# Class name : VendorPayController
# Functionality: add payment to Vendor
# Author : Sanchari Ghosh                                 
# Created Date :  03/07/2019                                
# Purpose: Developing the functionality of adding payment to Vendor
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


class VendorPayController extends Controller {
 
	/*****************************************************/
	# VendorPay Controller             
	# Class name : VendorPayController
	# Functionality: constructor
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/07/2019                                 
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}




	/*****************************************************/
	# VendorPay Controller             
	# Function name : viewAddVendorPay
	# Functionality: view add vendorPay page
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/07/2019                                
	# Purpose:  view add vendorPay page 
	# Params :                                            
	/*****************************************************/
	public function viewAddVendorPay(){
		return view('vendors.addVendorPayForm');
	}



	/*****************************************************/
	# VendorPay Controller             
	# Function name : saveVendorPay
	# Functionality: save vendorPay
	# Author : Sanchari Ghosh                                 
	# Created Date : 03/07/2019                                
	# Purpose:  save vendorPay 
	# Params :  Request $request                                          
	/*****************************************************/
	public function saveVendorPay(Request $request){

		$data 	    = array(); /*storing data for listing*/ 
		
		
		$vendorPay 					= new TripBill();
		$vendorPay->created_by		= \Auth::user()->id;
		
		$vendorPay->bill_date 		= date(\Config::get('constants.onlyDateFormat'),strtotime($request->bill_date)).' '.date('H:i:s');
	    $vendorPay->vendor_id 		= $request->vendor_id;
	    $vendorPay->vendor_amount	= $request->amount;
	    $vendorPay->narration		= $request->narration;

	    $vendorPay->save();

	    $data['vendorPay']      = $vendorPay->id;
 		$data['success'] 		= 'true';

 		if (isset($request->vendorPayId) && ($request->vendorPayId != '')) {
			$request->session()->flash('alert-success', 'Vendor Pay Edited Successfully');
		} else {
			$request->session()->flash('alert-success', 'Vendor Pay Added Successfully');
		}

        return $data;
	}
}