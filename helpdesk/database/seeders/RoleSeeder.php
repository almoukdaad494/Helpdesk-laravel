<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->createMany([ 
            ['id'=>Role::BOSS, 'name'=>"baas"], 
            ['id'=>Role::EMPLOYEE, 'name'=>"medewerker"],
            ['id'=>Role::APPLICANT, 'name'=>"sollicitant"], 
            ['id'=>Role::CUSTOMER, 'name'=>"klant"]
        ]);
    }
}
