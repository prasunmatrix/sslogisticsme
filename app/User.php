<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Wildside\Userstamps\Userstamps;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\EncLogic;

class User extends Authenticatable
{
    use Notifiable;
    use Userstamps;
    use HasRoles;
    use EncLogic;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;
    protected $table = 'users';
    protected $guarded  = ['id'];
    protected $fillable = ['user_role_id','username','password','full_name','phone_number','profile_picture','last_login_ip','last_login_datetime','remember_token','token_generated_time','slug','status','is_deleted', 'created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'];
    protected $dates = ['deleted_at','last_login_datetime'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function created_user() {
        return $this->belongsTo('App\User','created_by','id')->select('id','full_name');
    }
}
