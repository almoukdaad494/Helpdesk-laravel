<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TicketIndexTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        foreach(['x' => 'M', 'y' => 'M', 'a' => 'K', 'b' => 'K'] as $user => $role) {
        $users[$user] = User::create([
        'name' => $role . $user,
        'email' => $role . $user . '@helpdesk.nl',
       'password' => Hash::make('helpdesk'),
        'role_id' => $role == 'M' ? Role::EMPLOYEE : Role::CUSTOMER
        ]);
        if ($role == 'K') {
        foreach ([[], ['x'], ['y'], ['x', 'y']] as $employees) {
        foreach (['', 'c'] as $closed) {
        $ticket = Ticket::create([
        'subject' => 'T' . $user . join('', $employees) . $closed,
       'contents' => 'test',
       'category_id' => 1,
       'customer_user_id' => $users[$user]->id,
       'created_at' => now()->subDays(random_int(1,100)),
        'deleted_at' => $closed ? now() : null
        ]);
       foreach ($employees as $employee) {
        DB::table('ticket_employee_user')->insert([
       87
        'ticket_id' => $ticket->id,
       'employee_user_id' => $users[$employee]->id
        ]);
        }
        }
        }
        }
        }
    }
}
