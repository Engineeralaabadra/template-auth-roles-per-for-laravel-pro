<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function createToken(string $name, array $abilities = ['*'],$ip=null)
    // {
    //     $token=new PersonalAccessToken();
    //     $token ->forceFill([
    //         'name' => $name,
    //         'token' => hash('sha256', $plainTextToken = Str::random(40)),
    //         'abilities' => $abilities,
    //         'ip'=>$ip,
    //         'tokenable_type'=>static::class,
    //         'tokenable_id'=>$this->id
    //     ])->save();

    //     // return new NewAccessToken($token, $token->getKey().'|'.$plainTextToken);
    //     return $token;
    // }
    public function hasAbility($ability,$pageName){
        // dd(7);
        // dd(77);
        // dd($ability);
        // dd($pageName);
        // dd($this->id);
         $allRolesUser=User::find($this->id)->rolesUser()->get(); //get all roles for a user
        //  dd($allRolesUser);
         foreach($allRolesUser as $role){
            //  dd($role->id);
             $permissionsRoleUser=Role::find($role->id)->permissionsRole()->get();
        //    dd($permissionsRoleUser);
             $flag=false;
             foreach($permissionsRoleUser as $per){

                     if($per->action==$ability&&$per->page_name==$pageName){
                         $flag=true;
                  }
            }
            
            return $flag;
            
        }
    }

    public function rolesUser(){
        return $this->belongsToMany("App\Models\Role",'role_users','user_id','role_id');
    }

}
