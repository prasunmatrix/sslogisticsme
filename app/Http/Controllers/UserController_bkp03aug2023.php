<?php

/*****************************************************/
# User Controller             
# Class name : UserController
# Functionality: login, logout, forgot password, change password, profile
# Author : Dilip Kumar Shaw                                   
# Created Date :  26/07/2018                                
# Purpose: Developing the functionality of login, logout,forgot password,change password,profile change
/*****************************************************/

namespace App\Http\Controllers;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Cookie;
use URL;
use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Image;
use App\User;
use Hash;
use Crypt;
use App\Helpers\Helper;
use App\Helpers\Slim;
use App\Models\ResetPassword;
use App\Models\Permission;
use App\Models\Role;
use App\Models\PlantUserRelation;
use App\Models\Plant;


class UserController extends Controller {
 
	/*****************************************************/
	# User Controller             
	# Class name : UserController
	# Functionality: constructor
	# Author : Sanchari Ghosh                                 
	# Created Date : 27/07/2018                                 
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct(Request $request)
	{ 

	}
	


	/*****************************************************/
	# User Controller             
	# Function name : login
	# Functionality: view sign in page
	# Author : Sanchari Ghosh                                 
	# Created Date : 27/07/2018                                 
	# Purpose:  to view sign in page  
	# Params :                                            
	/*****************************************************/
    public function login(){

        /*if user already logged in, redirect to dashboard*/
        if (\Auth::check()) {
            return \Redirect::route('dashboard');
        } 
        return view('userLogin');
    }




    /*****************************************************/
	# User Controller             
	# Function name : doLogin
	# Functionality: login
	# Author : Sanchari Ghosh                                 
	# Created Date : 27/07/2018                                      
	# Purpose:  logging into site  
	# Params : Request $request                                       
	/*****************************************************/
    public function doLogin(Request $request) { 
        /*admin login*/
        $data     = array();
        $flag     = 'false';
        $status   = '';


        $authUserData = [
                'username'      => trim($request->username),
                'password'      => trim($request->password),
                'status'        => 'A'
        ];


        $auth = \Auth::attempt(
            $authUserData
        ); 


        if ($auth) {
        	$userDetails = User::where('username',$request->username)->get()->toArray();

            /*check validity of user*/
            //if ($userDetails[0]['status'] == 'A') {
            	\Session::put('id',$userDetails[0]['id']); 
            	\Session::put('userName',$userDetails[0]['username']); 
            	\Session::put('profilePicture',$userDetails[0]['profile_picture']); 
            	\Session::put('phoneNumber',$userDetails[0]['phone_number']); 
            	\Session::put('password',$request->password); 
            	\Session::put('lastLoginIP',$userDetails[0]['last_login_ip']); 
            	\Session::put('lastLoginDatetime',$userDetails[0]['last_login_datetime']); 

            	//$localIP = getHostByName(getHostName()); 

            	$loc = file_get_contents('https://ipapi.co/json/');
    	    	$obj = json_decode($loc); 
    	    	$localIP = isset($obj->ip) ? $obj->ip : '';

            	/*save current login ip and date time*/
            	User::where('username',$request->username)->update(array('last_login_ip' => $localIP,'last_login_datetime' => date('Y-m-d H:i:s')));

                $flag     = 'true';
                $status   = 'A';

                /****************************************CREATE JSON WEB TOKEN*****************************/

                

                /****************************************CREATE JSON WEB TOKEN*****************************/
           
        } else {

            $userNameCount = 0;
            $passwordCount = 0;

            $userNameCount = User::where('username',$request->username)->count();
            if ($userNameCount > 0) {
                $user = User::where('username',$request->username)->first();
                $passwordCount = Hash::check($request->password, $user->password);
            }


            if (($userNameCount > 0) && ($passwordCount > 0)) {
                $flag     = 'false';
                $status   = 'I';
            } else {
                $flag     = 'false';
            }
        }

        $res                    = ($flag == 'true') ? 'true' : 'false';
        $data['adminLogin'] 	= $authUserData;
        $data['success']    	= $flag;
        $data['userDetails'] 	= ($flag == 'true') ? $userDetails : array();
        $data['userStatus']     = $status;
        
        return $data;
    }




   /*****************************************************/
	# User Controller             
	# Function name : doLogout
	# Functionality: logout
	# Author : Sanchari Ghosh                                 
	# Created Date : 30/07/2018                                        
	# Purpose:  logout from site
	# Params :                                      
	/*****************************************************/
    public function doLogout() {
        \Session::flush();
        \Auth::logout();
        return \Redirect::route('login');
    }



    /*****************************************************/
	# User Controller             
	# Function name : viewChangePassword
	# Functionality: view change password
	# Author : Sanchari Ghosh                                 
	# Created Date : 31/07/2018                                 
	# Purpose:  to change password 
	# Params :                                            
	/*****************************************************/
    public function viewChangePassword(){ 		
        return view('changePassword');
    }




    /*****************************************************/
	# User Controller             
	# Function name : changePassword
	# Functionality: change password 
	# Author : Sanchari Ghosh                                 
	# Created Date : 31/07/2018                                 
	# Purpose:  to change password  
	# Params : Request $request                                           
	/*****************************************************/
    public function changePassword(Request $request){

    	$data = array();
        $msg  = '';
    	$res  = '';
    	$user = User::find(\Auth::user()->id);
    	$userDetails = array();

    	/*check the validity of old password*/
    	if (!Hash::check($request->old_password, $user->password)) {
	        $res = 'false';
            $msg = 'Invalid Old Password';
    	} else if (trim($request->password) == ''){
            $res = 'false';
            $msg = 'Password cannot be blank';
        } else {
    		/*for saving data in DB*/
	        $user->password = Hash::make($request->password);
	        $user->save();
	        \Session::put('password',$request->password); 
    		$res = 'true';
    		$userDetails = User::find(\Auth::user()->id)->toArray();
    	}

       	$data['success']      	    = $res;    
        $data['message']            = $msg;     
        $data['userDetails']  	    = ($res == 'true') ? $userDetails : array();
        $data['old_paswd'] 		    = Hash::make(strip_tags($request->old_password));
        $data['actual_old_paswd']   = $user->password;
        $request->session()->flash('alert-success', 'Password Changed Successfully');
        return $data;
    }



    /*****************************************************/
	# User Controller             
	# Function name : viewForgotPassword
	# Functionality: view forgot password
	# Author : Sanchari Ghosh                                 
	# Created Date : 31/07/2018                                 
	# Purpose:  view forgot password page 
	# Params :                                            
	/*****************************************************/
    public function viewForgotPassword(){ 	
        return view('forgotPassword');
    }




    /*****************************************************/
	# User Controller             
	# Function name : forgotPassword
	# Functionality: recover after forgetting password
	# Author : Sanchari Ghosh                                 
	# Created Date : 31/07/2018                                 
	# Purpose:  to recover after forgetting password
	# Params : Request $request                                           
	/*****************************************************/
    public function forgotPassword(Request $request){

    	$data = array();
    	$res  = '';
    	$userDetails = array();

    	$userDetails    = User::where('username',$request->email)->get();

    	/*check the validity of email*/
    	if (count($userDetails) == 0) {
	        $res = 'false';
	        //$request->session()->flash('alert-danger', 'This Email Id does not match with any of our data');
    	} else {
    		/*for saving data in DB*/
    		$token = Helper::generateRandomToken(8);
    		$user = User::find($userDetails[0]['id']);

    		$resetLink = URL::to("/").'/view-reset-password?token='.$token;

	        /*send mail to admin*/
            $mailAttributes = array(
                                'to'        => $userDetails[0]['username'] ,
                                'toName'    => $userDetails[0]['full_name']
                            );
            Mail::send(
                'email_template.admin_forgot_password',
                ['name' => $userDetails[0]['full_name'], 'resetLink' => $resetLink, 'email' => $userDetails[0]['username']],
                function($message) use ($mailAttributes) {
                    $message->subject(\Lang::get('SSLogistics | Password Change'));
                    $message->from(\Config::get('constants.fromEmail'), \Config::get('constants.fromName'));
                    $message->to($mailAttributes['to'],$mailAttributes['toName']);
                }
            );

            /*update token*/
            User::where('id',$userDetails[0]['id'])->update(array('remember_token' => $token, 'token_generated_time' => date('Y-m-d H:i:s')));

    		$res = 'true';
    		$request->session()->flash('alert-success', 'A new password generation link has been sent to the Email Address');
    		
    	}

       	$data['success']      	= $res;     

        return $data;
    }




    /*****************************************************/
	# User Controller             
	# Function name : viewResetPassword
	# Functionality: view reset password
	# Author : Sanchari Ghosh                                 
	# Created Date : 01/08/2018                                 
	# Purpose:  view reset password page 
	# Params :                                            
	/*****************************************************/
    public function viewResetPassword(Request $request){ 
    	$token = $request->token; /*token*/

    	$data  = array();

    	$tokenDetails = User::where('remember_token',$token)->get(); /*get token details*/

    	if (count($tokenDetails) == 0) { /*for expired token*/
    		$request->session()->flash('alert-danger', 'Token Expired');
    		return \Redirect::route('login');
    	} else {
    		/*get token expiry time*/
	    	$currentDateTime 	=  date('Y-m-d H:i:s'); 
	    	$tokenDateTime		=  $tokenDetails[0]['token_generated_time'];

	    	$timediff 			= (strtotime($currentDateTime) - strtotime($tokenDateTime)) / 60;

	    	/*token expiress in 30 minute*/
	    	if ($timediff > \Config::get('constants.passwordTokenExpiryTime')) { 
	    		$request->session()->flash('alert-danger', 'Token Expired');
    			return \Redirect::route('login');
	    	}
    	}

    	$data['user_id'] = $tokenDetails[0]['user_id'];

        return view('resetPassword',$data);
    }



   /*****************************************************/
	# User Controller             
	# Function name : resetPassword
	# Functionality: Reset Password
	# Author : Sanchari Ghosh                                 
	# Created Date : 01/08/2018                                 
	# Purpose:  reset password
	# Params : Request $request                                           
	/*****************************************************/
    public function resetPassword(Request $request){

    	$data 	= array() ;
    	$res 	= 'true';

    	$password 	= $request->password; 
    	$token 		= $request->token;

        if (trim($request->password) == ''){
            $res = 'false';
            $msg = 'Password cannot be blank';
            $data['msg'] = $msg;
        } else {
            $queryString = explode('?',$token);
            $tokenValue  = explode('=',$queryString[1]);
            User::where('remember_token',$tokenValue[1])->update(array('password' => Hash::make($password)));  
            $res    = 'true';
        }

    	$data['success']  	= $res;
    	$request->session()->flash('alert-success', 'Password Changed Successfully');
    	return $data;
    }
  


    /*****************************************************/
	# User Controller             
	# Function name : getProfileData
	# Functionality: get  profile data
	# Author : Sanchari Ghosh                                 
	# Created Date : 31/07/2018                                 
	# Purpose:  to get profile  data
	# Params :                                            
	/*****************************************************/
    public function getProfileData(){
    	$data = array();
    	$userDetails = User::find(\Auth::user()->id)->toArray();
    	$data['success']      	= 'true'; 
    	$data['userDetails']    = $userDetails; 
        return $data;
    }




    /*****************************************************/
	# User Controller             
	# Function name : viewProfile
	# Functionality: view profile page
	# Author : Sanchari Ghosh                                 
	# Created Date : 30/07/2018                                 
	# Purpose:  to view profile  
	# Params :                                            
	/*****************************************************/
    public function viewProfile(){
        return view('profile');
    }



    /*****************************************************/
    # User Controller             
    # Function name : uploadProfileImage
    # Functionality: upload profile page
    # Author : Sanchari Ghosh                                 
    # Created Date : 14/01/2019                                 
    # Purpose:  to upload profile page 
    # Params : Request $request                                           
    /*****************************************************/
    public function uploadProfileImage(Request $request){
        ini_set('memory_limit', '2048M');  
        $data = array();
        
        $fileType = explode('/', $_FILES["file"]["type"]);
        $actualFileType = $fileType[0];

        if ($_FILES["file"]["error"] == 1 || $actualFileType != 'image') {
            $data['imageName']  = '';
            $data['success']    = 'false';
        } else {
            $target_dir             = public_path().'/'.\Config::get('constants.profileImagePath');
            $fileExtension          = explode('.', $_FILES["file"]["name"]);
            $fileName               = 'image_'.time().'.'.$fileExtension[count($fileExtension) - 1];
            $target_file            = $target_dir . $fileName ;
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
            $data['imageName']      = $fileName;
            $data['success']        = 'true';
        }

        return $data;
    }




    /*****************************************************/
	# User Controller             
	# Function name : saveProfile
	# Functionality: save profile page
	# Author : Sanchari Ghosh                                 
	# Created Date : 01/08/2018                                 
	# Purpose:  to save profile  
	# Params : Request $request                                           
	/*****************************************************/
    public function saveProfile(Request $request){
        //print_r($_FILES['profilePicture']['tmp_name']); die;
    	$data = array();
    	$user 		  = User::find(\Auth::user()->id);
    	// $imageDetails = base64_decode($request->profilePicture);
     //    //print_r($imageDetails);exit;
     //    $name = $request->image_name;
     //    $ext = pathinfo($name, PATHINFO_EXTENSION);
     //    $imageName  = time().'.' . $ext;
     //    $file = Slim::saveFile($imageDetails, $imageName, public_path().'/uploads/user_profile_picture/', false);
        //print_r($file); exit;

    	/*update data*/

        if ($request->imageError == 1) {
            $data['success']        = 'false';
        } else {
        	$user->full_name 		= $request->full_name;
        	$user->phone_number 	= $request->phoneNumber;
        	$user->profile_picture 	= $request->profile_picture;
        	$user->save();

        	$userDetails 			= User::find(\Auth::user()->id)->toArray();
     		$data['userDetails'] 	= $userDetails;
     		$data['success'] 		= 'true';
     		$request->session()->flash('alert-success', 'Profile Changed Successfully');
        }
        return $data;
    }


    /*****************************************************/
    # User Controller             
    # Function name : user
    # Functionality: get user role name
    # Author : Rahul Sarkar                                 
    # Created Date : 21/08/2018                                 
    # Purpose:  to get user role name 
    # Params :  $user_id = ''                                          
    /*****************************************************/
    public function user($user_id = '') {
        $url = $_SERVER['REDIRECT_URL'];
        $urlArray = explode('/',$url);
        $pageNo = end($urlArray);

        $roles = Role::orderBy('name')->get();
        $user = '';
        $user_role = [];
        if($user_id != ''){
            $user = User::find(dnc($user_id));
            $user_role = $user->getRoleNames()->toArray();
            $roleDetails = Role::select('name')->where('id',$user['user_role_id'])->get()->toArray();
            $user['role_name'] = $roleDetails[0]['name'];
            $user['page'] = $pageNo;
        } else {
            //$user['page'] = 1;
        }
        return view('user.add-user')->with(compact('roles','user','user_role'));
    } 




    /*****************************************************/
    # User Controller             
    # Function name : addUser
    # Functionality: add/edit user
    # Author : Rahul Sarkar                                 
    # Created Date : 21/08/2018                                 
    # Purpose:  add/edit user
    # Params :  Request $req                                          
    /*****************************************************/
    public function addUser(Request $req) {


        $existCustomerCount = 0; /*existing user count*/
        if(empty($req->user_id)){
            $user = new User;
            $user->password = Hash::make($req->pwd);
        }else{
           // echo '1';
            $user = User::find(dnc($req->user_id));
            $page = $req->page; 
           

            $existingPlantUser  = PlantUserRelation::where('user_id',dnc($req->user_id))->count();
            if ($existingPlantUser > 0) {
                $plantUserData = PlantUserRelation::where('user_id',dnc($req->user_id))->get();
                //echo '<pre>'; print_r($plantUserData); die;
                $plantUser = PlantUserRelation::find($plantUserData[0]->id);
                $plantUser->deleted_by = \Auth::user()->id;/*logged in user id*/
                $plantUser->is_deleted = 'Y';
                $plantUser->save();
                $plantUser->delete();
            } 
        }



        if(!empty($req->user_id)){
            $id = dnc($req->user_id);
        /*validating email*/
            $validator = Validator::make($req->all(), [
                    'email'  => 'required|email|unique:users,username,'.$id,
            ]);
        } else {
            $validator = Validator::make($req->all(), [
                    'email'  => 'required|email|unique:users,username'
            ]);
        }  

        /*get existing user count*/
        if (!empty($req->user_id)) {
            $existCustomerCount = User::where('username',$req->email)->where('id','<>',dnc($req->user_id))->count();
        } else {
            $existCustomerCount = User::where('username',$req->email)->count();
        }

        if ($existCustomerCount > 0) {
            $errorsRequired = $validator->errors(); 
            // $req->session()->flash('userFullName', filter_var(strip_tags(preg_replace('#<script(.*?)>(.*?)</script>#is', '', $req->userFullname))),FILTER_SANITIZE_STRING);
            // $req->session()->flash('userPhoneNumber', filter_var(strip_tags(preg_replace('#<script(.*?)>(.*?)</script>#is', '', $req->phoneNumber))),FILTER_SANITIZE_STRING));
            // $req->session()->flash('userEmail', filter_var(strip_tags(preg_replace('#<script(.*?)>(.*?)</script>#is', '', $req->email))),FILTER_SANITIZE_STRING);
            // $req->session()->flash('userRole', $req->role);

            $req->session()->flash('userFullName',  htmlspecialchars_decode($req->userFullname));
            $req->session()->flash('userPhoneNumber', $req->phoneNumber);
            $req->session()->flash('userEmail', $req->email);
            $req->session()->flash('userRole', $req->role);

            $req->session()->flash('alert-danger', 'Email Already Exists');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // $user->full_name = filter_var(strip_tags(preg_replace('#<script(.*?)>(.*?)</script>#is', '', $req->userFullname)),FILTER_SANITIZE_STRING);
            // $user->phone_number = filter_var(strip_tags(preg_replace('#<script(.*?)>(.*?)</script>#is', '', $req->phoneNumber)),FILTER_SANITIZE_STRING);
            // $user->username = filter_var(strip_tags(preg_replace('#<script(.*?)>(.*?)</script>#is', '', $req->email)),FILTER_SANITIZE_STRING);
            // $user->user_role_id = $req->role;

            $user->full_name = addslashes($req->userFullname);
            $user->phone_number = $req->phoneNumber;
            $user->username = $req->email;
            $user->user_role_id = $req->role;
            $user->save();


            /*add new plant data*/
            $plantUser = new PlantUserRelation();
            if ($req->role == \Config::get('constants.supervisorRoleId')) { /*for supervisor*/
              $plantUser->user_id = $user->id;
              $plantUser->plant_id = $req->plant;
              $plantUser->created_by = \Auth::user()->id;
              $plantUser->save();
            }

            $user->syncRoles($req->role);
            $permissions = $user->getPermissionsViaRoles()->pluck('name');
            $user->syncPermissions($permissions);



            /*send mail to newly added user*/

            if (filter_var($req->email, FILTER_VALIDATE_EMAIL)) {
                if(empty($req->user_id)){
                    $mailAttributes = array(
                                        'to'        => $req->email ,
                                        'toName'    => $req->userFullname
                                    );
                    Mail::send(
                        'email_template.user_registration',
                        ['name' => $req->userFullname, 'password' => $req->pwd, 'email' => $req->email],
                        function($message) use ($mailAttributes) {
                            $message->subject(\Lang::get('SSLogistics | User Registration'));
                            $message->from(\Config::get('constants.fromEmail'), \Config::get('constants.fromName'));
                            $message->to($mailAttributes['to'],$mailAttributes['toName']);
                        }
                    );
                }
            }


            if(empty($req->user_id)){
                \Session::flash('alert-success', 'User Added Successfully'); 
            }else{
                \Session::flash('alert-success', 'User Updated Successfully'); 
            }

            if(empty($req->user_id)){
                return redirect('user/user-list');
            } else {
               return redirect('user/user-list?page='.$page); 
            }
            
            //return redirect()->back();
        }
    }



    /*****************************************************/
    # User Controller             
    # Function name : userDetails
    # Functionality: get user details
    # Author : Rahul Sarkar                                 
    # Created Date : 21/08/2018                                 
    # Purpose: to get user details 
    # Params :  Request $req                                          
    /*****************************************************/
    public function userDetails(Request $req) {
        $roles = Role::orderBy('name')->get();
        $user = '';
        $user_role = [];
        if(!empty($req->user_id)){
            $user = User::find(dnc($req->user_id)); 
            $user_role = $user->getRoleNames()->toArray(); 

            $roleDetails = Role::select('name')->where('id',$user['user_role_id'])->get()->toArray();
            $user['role_name'] = $roleDetails[0]['name'];

            /*get plant name if supervisor*/
            if ($user['user_role_id'] == \Config::get('constants.supervisorRoleId')) {
                $plantUserData      = PlantUserRelation::where('user_id',dnc($req->user_id))->get();
                $plantId            = $plantUserData[0]->plant_id;
                $plantDetails       = Plant::select('name')->where('id',$plantId)->get()->toArray();
                $user['plant_name'] = $plantDetails[0]['name'];
            }
            
        }
        return view('user.user-details')->with(compact('roles','user','user_role'));
    }



    /*****************************************************/
    # User Controller             
    # Function name : removeUser
    # Functionality: remove user 
    # Author : Rahul Sarkar                                 
    # Created Date : 21/08/2018                                 
    # Purpose: to remove user 
    # Params : $user_id                                         
    /*****************************************************/
    public function removeUser($user_id){
        $user = User::find(dnc($user_id));
        $user->delete();
        \Session::flash('alert-success', 'User Deleted Successfully');
        return redirect()->back();
    }




    /*****************************************************/
    # User Controller             
    # Function name : userList
    # Functionality: get user list
    # Author : Rahul Sarkar                                 
    # Created Date : 21/08/2018                                 
    # Purpose:  to get user list
    # Params :                                         
    /*****************************************************/
    public function userList() {
        $page = isset($_SERVER['REDIRECT_QUERY_STRING']) ? $_SERVER['REDIRECT_QUERY_STRING'] : 'page=1'; 
        $user = User::find(1);
        $users = User::with('created_user')->orderBy('id','desc')->paginate(\Config::get('constants.perPageRecord'));
        
        for ($i=0; $i<count($users); $i++) {
            $roleDetails = Role::select('name')->where('id',$users[$i]['user_role_id'])->get()->toArray();
            $users[$i]['role_name'] = $roleDetails[0]['name'];
            $pageNo = explode('=',$page);
            $users[$i]['page'] = $pageNo[1];
        }
        return view('user.user-list')->with(compact('users'));
    }



    /*****************************************************/
    # User Controller             
    # Function name : userRole
    # Functionality: user role
    # Author : Rahul Sarkar                                 
    # Created Date : 21/08/2018                                 
    # Purpose:  userRole
    # Params : Request $req                                         
    /*****************************************************/
    public function userRole(Request $req) {
        $roles = Role::with('created_by')
                     ->with('assigned_user')
                     ->orderBy('name')->get();
        $permissions = Permission::all();
        return view('user.role')->with('roles', $roles)
                                ->with('permissions', $permissions);
    }




    /*****************************************************/
    # User Controller             
    # Function name : addUserRole
    # Functionality: to add user role
    # Author : Rahul Sarkar                                 
    # Created Date : 21/08/2018                                 
    # Purpose:  to add user role
    # Params :  Request $req                                       
    /*****************************************************/
    public function addUserRole(Request $req) {
        if($req->uid != '0'){
            $role = Role::find($req->uid);
            $role->name = $req->role;
            $role->save();
            return redirect()->back();
        }

        if(!Role::where('name', $req->role)->count()){
            $role = new Role;
            $role->name = $req->role;
            $role->save();
            return redirect()->back();    
        }
    }




    /*****************************************************/
    # User Controller             
    # Function name : removeUserRole
    # Functionality: remove user role
    # Author : Rahul Sarkar                                 
    # Created Date : 21/08/2018                                 
    # Purpose:  to remove user role
    # Params : $role_id                                        
    /*****************************************************/
    public function removeUserRole($role_id){
        Role::find(dnc($role_id))->delete();
        return redirect()->back();
    }



    /*****************************************************/
    # User Controller             
    # Function name : userPermission
    # Functionality: get user permission
    # Author : Rahul Sarkar                                 
    # Created Date : 21/08/2018                                 
    # Purpose:  to get user permission
    # Params : Request $req                                        
    /*****************************************************/
    public function userPermission(Request $req){
        $permissions = Permission::with('user')->get();
        return view('user.permission')->with('permissions', $permissions);
    }



    /*****************************************************/
    # User Controller             
    # Function name : addUserPermission
    # Functionality: add user permission
    # Author : Rahul Sarkar                                 
    # Created Date : 21/08/2018                                 
    # Purpose:  to add user permission
    # Params :  Request $req                                       
    /*****************************************************/
    public function addUserPermission(Request $req) {
        if($req->uid != '0'){
            Permission::where('id', $req->uid)->update(['name'=>$req->role]);
            return redirect()->back();
        }

        if(!Permission::where('name', $req->role)->count()){
            $role = new Permission;
            $role->name = $req->role;
            $role->save();
            return redirect()->back();    
        }
    }   



    /*****************************************************/
    # User Controller             
    # Function name : roleModuleShow
    # Functionality: show role wise module
    # Author : Rahul Sarkar                                 
    # Created Date : 21/08/2018                                 
    # Purpose:  to show role wise module
    # Params : $role_id                                        
    /*****************************************************/
    public function roleModuleShow($role_id){
        $role_id1 = dnc($role_id);
        $role = Role::find(dnc($role_id));
        $permissions = $role->permissions()->get();
        return view('user.assign-role-permission')->with(compact('role','permissions','role_id1'));
    }



    /*****************************************************/
    # User Controller             
    # Function name : assignRolePermission
    # Functionality: assign role wise permission
    # Author : Rahul Sarkar                                 
    # Created Date : 21/08/2018                                 
    # Purpose:  to assign role wise permission
    # Params : Request $req                                        
    /*****************************************************/
    public function assignRolePermission(Request $req){

        $permission_arr = [];
        $role_id = dnc($req->role_id);
        $role = Role::find($role_id);
        $permission = $role->permissions()->get();
        if($permission->count()){
            $role->revokePermissionTo($permission);    
        }
        //\Session::flash('alert-success', 'User deleted successfully');
        if($req->permission){
            foreach($req->permission as $permission){
                if(!Permission::where('name', $req->role)->count()){
                    $prs = new Permission;
                    $prs->name = $permission;
                    $prs->save();
                    $permission_arr[] = $prs; 
                }else{
                    $permission_arr[] = Permission::where('name', $req->role)->first();
                }
            }
        }
        
        if(count($permission_arr)){
            $role->syncPermissions($permission_arr);
            $permission_name = $role->permissions()->get()->pluck('name');
            foreach(User::all() as $user){
                if($user->hasRole($role->name)){
                    $user->syncPermissions($permission_name);
                    //dd($permission_name);
                }
            }
            \Session::flash('alert-success', 'Role Assigned Successfully');
            return redirect('user/role');
        } else {
            \Session::flash('alert-danger', 'Please Select Role to Assign');
            return redirect()->back(); 
        }
        
    }



    /*****************************************************/
    # User Controller             
    # Function name : showAppModule
    # Functionality: show AppModule
    # Author : Rahul Sarkar                                 
    # Created Date : 21/08/2018                                 
    # Purpose:  to show AppModule
    # Params : Request $req                                        
    /*****************************************************/
    public function showAppModule(Request $req){
        return view('modules.module-list');
    }



    /*****************************************************/
    # User Controller             
    # Function name : showAppModulefunctions
    # Functionality: show AppModule functions
    # Author : Rahul Sarkar                                 
    # Created Date : 21/08/2018                                 
    # Purpose:  to show AppModule functions
    # Params :  Request $req                                       
    /*****************************************************/
    public function showAppModulefunctions(Request $req){
        return view('modules.functionalities');
    }



    /*****************************************************/
    # User Controller             
    # Function name : userStatus
    # Functionality: change user status
    # Author : Rahul Sarkar                                 
    # Created Date : 21/08/2018                                 
    # Purpose:  change user status
    # Params :  Request $req                                       
    /*****************************************************/
    public function userStatus(Request $req){

        $user = User::find(dnc($req->user_id));
        /*change the status*/
        if ($user->status == 'A') {
        $user->status = 'I';
        } else {
        $user->status = 'A';
        }
        $user->updated_by = \Auth::user()->id;
        $user->save();
        /*update status*/
        \Session::flash('alert-success', 'Status Changed Successfully');
        return redirect('user/user-list');
        
    }
}

