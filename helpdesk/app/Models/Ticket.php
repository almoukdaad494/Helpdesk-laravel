<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Category;




class Ticket extends Model
{
    use HasFactory;
    use SoftDeletes;



    public function proccessing_users(){
        return $this->belongsToMany(User::class,'ticket_employee_user','ticket_id','employee_user_id');
    }


    public function status(){
        $status="";

        if($this -> trashed() ){
            $status='closed';
        }elseif( $this->proccessing_users->isEmpty()  ){
            $status='waiting';
        }else {
            $status='processed';
        };
        return $status;
    }


    public function creating_user(){
        return $this->belongsTo(User::class, 'customer_user_id', 'id');
    }


    public function category(){
        return $this->belongsTo(Category::class, 'category_id','id');
    }






    
}
