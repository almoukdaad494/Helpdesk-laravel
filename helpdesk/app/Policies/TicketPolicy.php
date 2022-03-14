<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(){
    }

        public function create(User $auth_user){
            return $auth_user->role_id==Role::CUSTOMER;
        }

        public function store(){
            return true;
        }


        public function list(User $auth_user){
            $allowed_role_id=[Role::BOSS, Role::EMPLOYEE, Role::CUSTOMER];
            return in_array($auth_user->role_id, $allowed_role_id) ;
        }


        public function click_list($auth_user, $status){
            switch ($auth_user->role_id){
                case Role::BOSS:
                case Role::EMPLOYEE:
                    return in_array($status, ['waiting', 'processed', 'closed']);
                case Role::CUSTOMER:
                    return in_array($status, ['open', 'closed']);
                default: return false;
            }
        }


        public function read_employee_names(User $auth_user){
            $allowed_role_id=[Role::BOSS, Role::EMPLOYEE];
            return in_array($auth_user->role_id, $allowed_role_id);
        }


        public function read(User $auth_user, Ticket $ticket){
        
            return $auth_user->role_id == Role::BOSS ;
            $auth_user->role_id == Role::EMPLOYEE ||
            $auth_user->is($ticket->creating_user) ;
        }
    }
