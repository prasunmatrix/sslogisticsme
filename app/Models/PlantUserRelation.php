<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# PlantUserRelation Model             
# Class name : PlantUserRelation
# Functionality: 
# Author : Sanchari Ghosh                                 
# Created Date :  02/01/2019                                
# Purpose: 
/*****************************************************/
class PlantUserRelation extends Model {
	use SoftDeletes;
	
	protected $table 	= 'plant_user_relations';
	protected $guarded 	= ['id'];
    protected $fillable = ['plant_id','user_id','is_deleted','created_at','created_by','updated_at','deleted_at','deleted_by'];
	protected $dates    = ['deleted_at'];
}

?>