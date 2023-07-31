<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*****************************************************/
# PartyDestination Model             
# Class name : PartyDestination
# Functionality: listing of partyDestinations
# Author : Sanchari Ghosh                                 
# Created Date :  13/08/2018                                
# Purpose: Developing the functionality of listing of partyDestinations
/*****************************************************/
class PartyDestination extends Model {
	use SoftDeletes;

	protected $table = 'party_destinations';
	protected $guarded 	= ['id'];
    protected $fillable = ['party_id','city_id','state_id','country_id','address','contact_number','contact_email','contact_person','lat','lng','status','is_deleted','created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];

    protected $dates    = ['deleted_at'];


    /*****************************************************/
	# PartyDestination Model             
	# Function name : availableRecords
	# Functionality: view partyDestination listing page
	# Author : Sanchari Ghosh                                 
	# Created Date : 13/08/2018                                
	# Purpose:  to view partyDestination listing page  
	# Params :  $dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword                    
	/*****************************************************/
	public static function availableRecords($dbTables,$currentPage,$perPageRecord,$orderby,$ordertype,$searchKeyword) {
		
		$records = PartyDestination::select($dbTables['partyDestinationTable'].'.id',$dbTables['partyDestinationTable'].'.party_id',$dbTables['partyDestinationTable'].'.city_id',$dbTables['partyDestinationTable'].'.state_id',$dbTables['partyDestinationTable'].'.country_id',$dbTables['partyDestinationTable'].'.address',$dbTables['partyDestinationTable'].'.contact_number',$dbTables['partyDestinationTable'].'.contact_email',$dbTables['partyDestinationTable'].'.contact_person',$dbTables['partyDestinationTable'].'.lat',$dbTables['partyDestinationTable'].'.lng',$dbTables['partyDestinationTable'].'.status',$dbTables['partyDestinationTable'].'.updated_at',$dbTables['partyTable'].'.party_name',$dbTables['countryTable'].'.country_name',$dbTables['stateTable'].'.state_name',$dbTables['cityTable'].'.city_name')
		    ->join($dbTables['partyTable'], $dbTables['partyDestinationTable'].'.party_id', '=', $dbTables['partyTable'].'.id')
		    ->join($dbTables['countryTable'], $dbTables['partyDestinationTable'].'.country_id', '=', $dbTables['countryTable'].'.id')
			->join($dbTables['stateTable'], $dbTables['partyDestinationTable'].'.state_id', '=', $dbTables['stateTable'].'.id')
			->join($dbTables['cityTable'], $dbTables['partyDestinationTable'].'.city_id', '=', $dbTables['cityTable'].'.id');
		if($searchKeyword != ''){
		$records = $records->where($dbTables['partyTable'].'.party_name', 'like', '%'.$searchKeyword.'%');
		}
		if($orderby == 'id'){
		$records = $records->orderBy($dbTables['partyDestinationTable'].'.'.$orderby,$ordertype);
		}
		if($orderby == 'party_name'){
		$records = $records->orderBy($dbTables['partyTable'].'.'.$orderby,$ordertype);
		}
		$records = $records
			->skip(($currentPage-1)*$perPageRecord)
            ->take($perPageRecord)
			->get();

		return $records;
	}

	/*****************************************************/
	# PartyDestination Model             
	# Function name : totalRecords
	# Functionality: get total count of partyDestination
	# Author : Debamala Dey                                
	# Created Date : 22/08/2018                                
	# Purpose:  to get pagination
	# Params :  $dbTables,$searchKeyword                                         
	/*****************************************************/
	public static function totalRecords($dbTables,$searchKeyword) {
		
		$records = PartyDestination::select($dbTables['partyDestinationTable'].'.id',$dbTables['partyDestinationTable'].'.party_id',$dbTables['partyDestinationTable'].'.city_id',$dbTables['partyDestinationTable'].'.state_id',$dbTables['partyDestinationTable'].'.country_id',$dbTables['partyDestinationTable'].'.address',$dbTables['partyDestinationTable'].'.contact_number',$dbTables['partyDestinationTable'].'.contact_email',$dbTables['partyDestinationTable'].'.contact_person',$dbTables['partyDestinationTable'].'.lat',$dbTables['partyDestinationTable'].'.lng',$dbTables['partyDestinationTable'].'.status',$dbTables['partyDestinationTable'].'.updated_at',$dbTables['partyTable'].'.party_name',$dbTables['countryTable'].'.country_name',$dbTables['stateTable'].'.state_name',$dbTables['cityTable'].'.city_name')
		    ->join($dbTables['partyTable'], $dbTables['partyDestinationTable'].'.party_id', '=', $dbTables['partyTable'].'.id')
		    ->join($dbTables['countryTable'], $dbTables['partyDestinationTable'].'.country_id', '=', $dbTables['countryTable'].'.id')
			->join($dbTables['stateTable'], $dbTables['partyDestinationTable'].'.state_id', '=', $dbTables['stateTable'].'.id')
			->join($dbTables['cityTable'], $dbTables['partyDestinationTable'].'.city_id', '=', $dbTables['cityTable'].'.id');
		if($searchKeyword != ''){
		$records = $records->where($dbTables['partyTable'].'.party_name', 'like', '%'.$searchKeyword.'%');
		}
		$records = 	$records->orderBy($dbTables['partyDestinationTable'].'.id','ASC')
            				->get();

        $recordsCount = $records->count();

		return $recordsCount;
	}
}

?>