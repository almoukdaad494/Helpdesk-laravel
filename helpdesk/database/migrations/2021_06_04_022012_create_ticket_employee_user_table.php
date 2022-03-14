<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketEmployeeUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_employee_user', function (Blueprint $table) {
            $table->primary( ['ticket_id', 'employee_user_id'] );
            
            
            $table->foreignId('ticket_id')->constrained('tickets')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('employee_user_id')->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_employee_user');
    }
}
