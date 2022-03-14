<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Role;
use App\Models\Applicant;
use App\Models\Ticket;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable=['name','email','password','role_id'];

      /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $primaryKey='id';

    protected $hidden = 
    [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = 
    [
        'email_verified_at' => 'datetime',
    ];


    public function role(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    } 

    public function applicant(){
        return $this->hasOne(Applicant::class);
    }

    public function created_tickets(){        
        return $this->hasMany(Ticket::class,'customer_user_id','id');
    }
    
    public function processed_tickets(){
        return $this->belongsToMany(Ticket::class,'ticket_employee_user','employee_user_id','ticket_id');
    }


}