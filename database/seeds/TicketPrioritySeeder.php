<?php

use App\TicketPriority;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketProritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketPriority::create(['priority_level' => 'NOTICE', 'priority_description' => 'description']);
        TicketPriority::create(['priority_level' => 'MINOR', 'priority_description' => 'description']);
        TicketPriority::create(['priority_level' => 'MAJOR', 'priority_description' => 'description']);
        TicketPriority::create(['priority_level' => 'CRITICAL', 'priority_description' => 'description']);
    }
}
