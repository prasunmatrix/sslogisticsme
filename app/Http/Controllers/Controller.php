<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    /*****************************************************/
    # Controller             
    # Function name : nameExistsCheck
    # Functionality: check duplicate name
    # Author : Debamala Dey                                
    # Created Date : 23/08/2018                                
    # Purpose:  name exists check
    # Params :  $modelName, $fieldName, $name, $editId                                         
    /*****************************************************/
    function nameExistsCheck($modelName, $fieldName, $name, $editId = '') {

    	$model = "\App\Models\\".$modelName;
    	$model = new $model();

    	$existCount = $model::whereRaw('LOWER('.$fieldName.') = "'.trim($name).'"');                    
        if (!empty($editId)) {
        	$existCount->where('id','<>',$editId);
        }    
        //$data = $existCount->toSql();
    	$data = $existCount->count();
    	
        return $data;
    }

    
    /*****************************************************/
    # Controller             
    # Function name : codeExistsCheck
    # Functionality: check duplicate code
    # Author : Debamala Dey                                
    # Created Date : 23/08/2018                                
    # Purpose:  code exists check
    # Params :  $modelName, $fieldName, $name, $editId                                         
    /*****************************************************/
    function codeExistsCheck($modelName, $fieldName, $code, $editId = '') {

        $model = "\App\Models\\".$modelName;
        $model = new $model();

        $existCount = $model::whereRaw('LOWER('.$fieldName.') = "'.trim($code).'"');                    
        if (!empty($editId)) {
            $existCount->where('id','<>',$editId);
        }    
        //$data = $existCount->toSql();
        $data = $existCount->count();
        
        return $data;
    }


    /*****************************************************/
    # Controller             
    # Function name : getNumberToWords
    # Functionality: convert a number to word
    # Author : Sanchari Ghosh                                
    # Created Date : 04/06/2019                                
    # Purpose:  convert a number to word
    # Params :  $number                                         
    /*****************************************************/
    function getNumberToWords($number) {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
        $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees : '') . $paise ;
    }

}
