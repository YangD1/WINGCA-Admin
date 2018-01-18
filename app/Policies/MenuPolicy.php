<?php
/**
 * menu 策略名称
 */
namespace App\Policies;

use App\User;
use App\Models\Menu;

use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        return "12313";
    }

    # 相关操作策略
    public function update(User $user,Menu $menu){
        return true;
    }
}
