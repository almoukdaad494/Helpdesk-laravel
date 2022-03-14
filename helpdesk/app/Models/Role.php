<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model{
    use HasFactory;

    protected $primaryKey='id' ;

    const BOSS=11;
    const EMPLOYEE=21;
    const APPLICANT=31;
    const CUSTOMER= 41;

    public function users(){
        return $this->hasMany(User::class, 'role_id', 'id');
    }







}