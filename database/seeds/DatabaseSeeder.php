<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        // Disable all mass assignment restrictions
        Model::unguard();
 
        $this->call(RolesSeeder::class);
        $this->call(TicketProritySeeder::class);
        $this->call(TicketSeeder::class);
        $this->call(TicketHeaderSeeder::class);
 
        // Re enable all mass assignment restrictions
        Model::reguard();
    }
}
