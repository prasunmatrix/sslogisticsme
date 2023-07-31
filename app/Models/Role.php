<?php 

namespace App\Models;

use Spatie\Permission\Models\Role as ParentRole;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use App\Traits\EncLogic;
use App\Models\ModelHasRole;


/*****************************************************/
# Role Model             
# Class name : Role
# Functionality: 
# Author : Rahul Sarkar                                 
# Created Date :  21/08/2018                                
# Purpose: 
/*****************************************************/
class Role Extends ParentRole {

	use Userstamps;
	use SoftDeletes;
	use EncLogic;

	protected $dates = ['deleted_at'];
	public function __construct(){
		parent::__construct();
	}



	/*****************************************************/
	# Role Model             
	# Function name : created_by
	# Functionality: get created_by data
	# Author : Rahul Sarkar                                
    # Created Date : 21/08/2018                                
	# Purpose:  get created_by data  
	# Params :  
	/*****************************************************/
	public function created_by(){
		if(isset($this->attributes['created_by'])){
			return $this->belongsTo('App\User','created_by', 'id');
		}
		return $this->belongsTo('App\User');
	}




	/*****************************************************/
	# Role Model             
	# Function name : assigned_user
	# Functionality: get assigned user
	# Author : Rahul Sarkar                                
    # Created Date : 21/08/2018                                
	# Purpose:  get assigned user  
	# Params :  
	/*****************************************************/
	public function assigned_user() {
		return $this->hasMany(ModelHasRole::class);
	}	




	/*****************************************************/
	# Role Model             
	# Function name : getPermissionByIdString
	# Functionality: get permission by Id
	# Author : Rahul Sarkar                                
    # Created Date : 21/08/2018                                
	# Purpose:  get permission by Id  
	# Params :  
	/*****************************************************/
	public function getPermissionByIdString(){
		$str = [];
		foreach ($this->permissions()->get() as $item) {
			$str[] = $item->id;
		}
		return '['.implode(',', $str).']';
	}
}