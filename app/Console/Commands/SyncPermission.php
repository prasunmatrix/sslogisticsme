<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Permission;
use App\Models\Role;
Use App\User;

class SyncPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Write all permissions to database from app_module file.';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $user;
    protected $hasRole;
    public function __construct()
    {
        parent::__construct();
        $this->hasRole = false;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $role = Role::where('name','Admin')->with('users')->first();
        //$this->info($role->users[0]->username);

        if(empty($role)){
            $email = $this->ask('Enter admin email address:');
            $user = User::where('username',$email)->first();
            if(empty($user)){
                $ans = $this->ask('Invalid user email address. Would you like to create default admin?(y/n):');
                if($ans != 'y'){
                    $this->info('Exit without sync permission. You will not be able to access dashboard properly.');
                    return;
                }
                $user = $this->createDefaultAdmin($email);
                if(empty($user)){
                    $this->info('Exit without sync permission. You will not be able to access dashboard properly.');
                    return;
                }
            }
            $this->user = $user;
            $role = $this->createAdminRole();
        }else{
            $this->hasRole = true;
            $this->user = $role->users[0];
        }
        
        
        $this->comment('truncating data....');
        Permission::truncate();
        $this->comment('completed');

        $this->createPermission($role);
        $permission_name = $role->permissions()->get()->pluck('name');
        $this->info('Assigning permission to Admin');
        $this->user->syncPermissions($permission_name);
        $this->info('Sync permission has been performed successfully..');
    }

    public function createPermission($role){
        $modules = config('app_module.module');
        foreach($modules as $module){
            $index = 0;
            $this->comment('creating '.$module['title'].'....');
            foreach($module['permission'] as $key=>$value){
                $this->info(++$index.'. '.$value.'....'.$this->savePermissionToDb($key,$role));
            }
        }
    }

    public function savePermissionToDb($key, $role){
        $permission = new Permission;
        $permission->name = $key;
        $permission->created_by = $this->user->id;
        $permission->updated_by = $this->user->id;
        $permission->created_at = date("Y-m-d");
        $permission->updated_at = date("Y-m-d");
        $permission->save();
        if(!$this->hasRole){
            $permission->assignRole($role);
        }
        return 'completed';
    }

    public function createAdminRole(){
        $role = new Role;
        $role->name = 'Admin';
        $role->created_by = $this->user->id;
        $role->updated_by = $this->user->id;
        $role->created_at = date("Y-m-d");
        $role->updated_at = date("Y-m-d");
        $role->save();
        $this->user->syncRoles('Admin');
        return $role;
        
    }

    public function createDefaultAdmin($email){
        $user = new User;
        $password = $this->ask('Enter admin password:');
        $user->password = \Hash::make($password);
        $user->full_name = $this->ask('Enter admin name:');
        $user->phone_number = $this->ask('Enter admin phone number:');
        $user->username = $email;
        $user->created_by = 0;
        $user->created_at = date("Y-m-d");
        $user->updated_at = date("Y-m-d");

        $this->info('Name: '.$user->full_name);
        $this->info('Email: '.$user->username);
        $this->info('Password: '.$password);
        $this->info('Phone: '.$user->full_name);
        
        $ans = $this->ask('Are you sure you want to save above data(y/n):');
        if($ans == 'y'){
            $user->save();
            return $user;
        }
        return '';
    }
}
