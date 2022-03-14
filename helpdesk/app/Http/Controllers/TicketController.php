<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;







class TicketController extends Controller
{
    public function create(){ 

        return view('pages.ticket.create')->with('categories', Category::all());
    }

    public function store(Request $request){
        $request->validate([
            'subject' => 'required|max:40',
            'contents' => 'required',
            'category' => 'required|exists:categories,id'
        ]);


        $ticket=new Ticket();
        $ticket->subject= $request->subject;
        $ticket->contents=$request->contents;
        $ticket->category_id=$request->category;
        $request->user()->created_tickets()->save($ticket);
        
        
        return redirect('/dashboard')->with('status', 'Your ticket is saved!');
    }


    public function index(Request $request, $status){

        $user = $request->user();
        switch($status){
            case 'open':
                switch($user->role_id){
                    case Role::BOSS:
                    case Role::EMPLOYEE:
                        //q 1
                        $tickets=Ticket::all();     
                        break;
                    case Role::CUSTOMER:
                        //q3
                        $tickets=$user->created_tickets()->orderBy('created_at', 'desc')->get();
                        break;
                    }
                break;        
            case 'waiting':
                switch($user->role_id){
                    case Role::BOSS:
                    case Role::EMPLOYEE:
                        //q 8
                        $tickets=Ticket::doesntHave('proccessing_users')->orderBy('created_at', 'asc')->get();           
                        break;
                    case Role::CUSTOMER:
                        // q 10
                        $tickets=$user->created_tickets()->doesntHave('proccessing_users')->get(); 
                        break;
                }
                break;
            case 'processed':
                switch ($user->role_id){
                    case Role::BOSS:
                        // q 7
                        $tickets=Ticket::has('proccessing_users')->orderBy('created_at', 'desc')->get(); 
                        break;
                    case Role::EMPLOYEE:
                        // q 5
                        $tickets= $user->processed_tickets()->orderBy('created_at', 'desc')->get();        
                        break;
                    case Role::CUSTOMER:
                        // q 9
                        $tickets=$user->created_tickets()->has('proccessing_users')->get();
                        break;
                }
                break;
            case 'closed':
                switch($user->role_id){
                    case Role::BOSS:
                        // q 2
                        $tickets=Ticket::onlyTrashed()->orderBy('created_at', 'desc')->get();           
                        break;
                    case Role::EMPLOYEE:
                        // q 6
                        $tickets=$user->processed_tickets()->onlyTrashed()->orderBy('created_at', 'desc')->get(); 
                        break;
                    case Role::CUSTOMER:
                        // q 4
                        $tickets=$user->created_tickets()->onlyTrashed()->orderBy('created_at', 'desc')->get();   
                        break;
                }
                break;
            };

        return view('pages.ticket.index')->with('status', $status.' ticket')->with('tickets',$tickets) ;
    }


    public function show(Ticket $ticket){
        return view('pages.ticket.show')->with('ticket', $ticket);
    }

    

}
