<?php

function setMenu($prefix){
	return \Route::getCurrentRoute()->getPrefix()=="/$prefix" ? 'active' : '';
}

function setSubMenu($prefix, $name) {
	if(\Route::getCurrentRoute()->getPrefix()=="/$prefix"){
		if(Route::currentRouteName() == $name){
			return 'class = active';
		}
	}
	return '';
}

function enc($string){
    $output = '';
    $skey = config('default.id_encrpt');
    $encrypt_method = "AES-256-CBC";
    $secret_key = $skey['sec_key'];
    $secret_iv = $skey['secret_iv'];

    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    return base64_encode($output);
}

function dnc($string){
	$output = '';
    $skey = config('default.id_encrpt');
    $encrypt_method = "AES-256-CBC";
    
    $secret_key = $skey['sec_key'];
    $secret_iv = $skey['secret_iv'];

    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    return openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
}

function permissions($key){
    return array_keys(config("app_module.module.$key.permission"));
}