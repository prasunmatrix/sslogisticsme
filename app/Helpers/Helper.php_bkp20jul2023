<?php
namespace App\Helpers;
use Request;

class Helper {

	/*cleaning unwanted space and tags from text*/
	public static function cleanText($text)	{
		$cleanText = strip_tags($text);
		return $cleanText;
	}


    /*Random password generator(alphanumeric)*/
    public static function generateRandomToken($length){
        $alphabet = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $password = '';

        for ($i = 1; $i <= $length; $i += 2) {
            $password .= substr($alphabet, rand(0, strlen($alphabet) - 1), 1);
            $password .= substr($numbers, rand(0, strlen($numbers) - 1), 1);
        }
        
        if ($length % 2 != 0) {
            $password = substr($password, 0, -1);
        }

        return $password;
    }

    /*****************************************************/
    # Controller             
    # Function name : notification
    # Functionality: notification
    # Author : Debamala Dey                                
    # Created Date : 31/08/2018                                
    # Purpose : insurance notification count,permit notification count,tax notification count                                      
    /*****************************************************/
    public static function notification() {

        $curr_date = date('Y-m-d h:i:s');
        $next_date = date('Y-m-d h:i:s', strtotime("+30 days"));

        $insurance_count = \App\Models\TruckInsurance::where('policy_end','<',$next_date)->where('policy_end','>=',$curr_date)->where('read_status', '0')->count();  
        $permit_count = \App\Models\TruckPermit::where('permit_end','<',$next_date)->where('permit_end','>=',$curr_date)->where('read_status','0')->count();  
        $tax_count = \App\Models\TruckTax::where('tax_period_end','<',$next_date)->where('tax_period_end','>=',$curr_date)->where('read_status','0')->count();  
        $pollution_count = \App\Models\TruckPollution::where('pollution_end','<',$next_date)->where('pollution_end','>=',$curr_date)->where('read_status','0')->count();  
        $registration_count = \App\Models\TruckRegistration::where('registration_end','<',$next_date)->where('registration_end','>=',$curr_date)->where('read_status','0')->count();  
        return ['insurance_count'   => $insurance_count,
                'permit_count'      => $permit_count,
                'tax_count'         => $tax_count,
                'pollution_count'   => $pollution_count,
                'registration_count'=> $registration_count];
    }
}


?>