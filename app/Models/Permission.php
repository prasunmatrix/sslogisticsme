<?php


namespace App\Models;

use Spatie\Permission\Models\Permission as ParentPermission;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;


/*****************************************************/
# Permission Model             
# Class name : Permission
# Functionality: listing of permissions
# Author : Rahul Sarkar                                 
# Created Date :  14/08/2018                                
# Purpose: Developing the functionality of listing of partyDestinations
/*****************************************************/
class Permission Extends ParentPermission {

	use Userstamps;
	use SoftDeletes;

	public function __construct(){
		parent::__construct();
	}


	/*****************************************************/
	# Permission Model             
	# Function name : user
	# Functionality: creating relation
	# Author : Rahul Sarkar                                  
	# Created Date : 14/08/2018                                
	# Purpose:  creating relation 
	# Params :               
	/*****************************************************/
	public function user(){
		return $this->belongsTo('App\User','created_by', 'id');
	}
}