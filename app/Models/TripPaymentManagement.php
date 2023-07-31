<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;


/*****************************************************/
# Trip Model             
# Class name : TripPaymentManagement
# Functionality: 
# Author : Sanchari Ghosh                                 
# Created Date :  11/09/2018                                
# Purpose: 
/*****************************************************/
class TripPaymentManagement extends Model {
	use SoftDeletes;
	
	protected $table = 'trip_payment_managements';
	protected $guarded 	= ['id'];
    protected $fillable = ['trip_id','rate','freight_charge','toll','unloading_charge','tare_charge','short_bag_amount','balance','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

	protected $dates    = ['deleted_at'];

}

?>