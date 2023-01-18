<?php

namespace App\Traits; 

trait PermissionTrait
{
    public function hasPermission()
    {
        //for department
        if(!isset(auth()->user()->role->permission['name']['department']['can-add']) && \Route('departments.create')){
            return abort(401);
        };
            
        if(!isset(auth()->user()->role->permission['name']['department']['can-list']) && \Route('departments.index')){
            return abort(401);
        };

        //for user
        if(!isset(auth()->user()->role->permission['name']['user']['can-add']) && \Route('users.create')){
            return abort(401);
        };

        if(!isset(auth()->user()->role->permission['name']['user']['can-list']) && \Route('users.index')){
            return abort(401);
        };

        //for role
        if(!isset(auth()->user()->role->permission['name']['role']['can-add']) && \Route('roles.create')){
            return abort(401);
        };

        if(!isset(auth()->user()->role->permission['name']['role']['can-list']) && \Route('roles.index')){
            return abort(401);
        };

        //for permission
        if(!isset(auth()->user()->role->permission['name']['permission']['can-add']) && \Route('permissions.create')){
            return abort(401);
        };

        if(!isset(auth()->user()->role->permission['name']['permission']['can-list']) && \Route('permissions.index')){
            return abort(401);
        };

        //approve-reject staff leave
        if(!isset(auth()->user()->role->permission['name']['leave']['can-add']) && \Route('leaves.create')){
            return abort(401);
        };
        if(!isset(auth()->user()->role->permission['name']['leave']['can-list']) && \Route('leaves.index')){
            return abort(401);
        };

    }
}