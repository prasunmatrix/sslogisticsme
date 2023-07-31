<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# PetrolPumpJournalLaser Model             
# Class name : PetrolPumpJournalLaser
# Functionality: 
# Author : Sanchari Ghosh                                 
# Created Date :  04/09/2018                                
# Purpose: 
/*****************************************************/
class PetrolPumpJournalLaser extends Model {
	use SoftDeletes;

	protected $table = 'petrol_pump_journal_lasers';
	protected $guarded 	= ['id'];
    protected $fillable = ['petrol_pump_id','truck_id','type','trip_id','amount','description','entry_by','approved_by','approved_on','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

    protected $dates    = ['deleted_at'];
}

?>