<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;


class ApplicantController extends Controller
{
    public function index(){
        $applicants=Applicant::whereHas('user', function (Builder $query){
            $query->where('role_id', Role::APPLICANT);
        })->orderBy('queued', 'asc')->orderBy('created_at', 'desc')->get();
        
        return view('pages.applicant.index')->with('applicants', $applicants) ;       
    }


    public function employ(Applicant $applicant){
        $applicant->user->role_id = Role::EMPLOYEE;
        $applicant->user->save();
        return back()->with('status', $applicant->user->name.' is hired');
    }


    public function reject(Applicant $applicant){
        $applicant->delete();
        $applicant->user->delete();
        return back()->with('status', $applicant->user->name .' is rejected') ;
    }
    

    public function queue(Applicant $applicant){
        $applicant->queued = true ;
        $applicant->save();
        return back()->with('status', $applicant->user->name .' is queued');   
    }
    
}

