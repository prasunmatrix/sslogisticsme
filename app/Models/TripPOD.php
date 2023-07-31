<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# TripPOD Model             
# Class name : TripPOD
# Functionality: 
# Author : Sanchari Ghosh                                 
# Created Date :  13/03/2019                                
# Purpose: 
/*****************************************************/
class TripPOD extends Model {
	use SoftDeletes;
	protected $table = 'trip_POD';
	protected $guarded 	= ['id'];
    protected $fillable = ['trip_id','pod_file','status','is_active','approved_by','reason','created_at','updated_at','is_deleted','deleted_at','deleted_by'];

    protected $dates    = ['deleted_at'];
}

?>