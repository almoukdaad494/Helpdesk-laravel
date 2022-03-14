<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;
use App\Models\Applicant;


use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicantPolicy
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
    }

    public function list(User $auth_user){
        return $auth_user->role_id === Role::BOSS;
    }

    public function employ(User $auth_user, Applicant $applicant){
        return $auth_user->role_id == Role::BOSS && $applicant->user->role_id == Role::APPLICANT;
    }

    public function reject(User $auth_user, Applicant $applicant){
        return $auth_user->role_id == Role::BOSS && $applicant->user->role_id == Role::APPLICANT;
    }

    public function queue(User $auth_user, Applicant $applicant){
        return $auth_user->role_id == Role::BOSS &&
        $applicant->user->role_id == Role::APPLICANT &&
        !$applicant->queued ;
    }



}






