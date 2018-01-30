<?php

namespace App;
use Auth;
use \App\Models\Role;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';


    // 关联权限模型
    public function role()
    {
        return $this->hasOne('App\Models\UserRole');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    # 关联权限
    public function roles()
    {
        dd("声明所属关系");
    }

    # 查看当前用户的权限是否是超级管理员(当前id为1的是超级管理员)
    public function checkAdmin()
    {
       return Auth::user()->role->role_id == 1; 
    }


    # 返回当前登录用户的权限名称
    public function role_name()
    {
        return Role::find(Auth::user()->role->role_id)->name;
    }
}
