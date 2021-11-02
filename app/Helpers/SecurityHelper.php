<?php
namespace App\Helpers;


class SecurityHelper
{
    public static function hasAccess($route)
    {
        $user = auth()->user();

        if(!$user){
            return false;
        }

        if($user->hasRole('admin')){
            return true;
        }

        if($user->hasRole('super-user')){
            return $user->can($route);
        }

        return false;
    }
}
