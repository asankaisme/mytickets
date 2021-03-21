<?php

use App\TicketHeader;
use Illuminate\Database\Seeder;

class TicketHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketHeader::create(['hTitle' => 'Page not found', 'hDescription' => 'Description']);
        TicketHeader::create(['hTitle' => 'Page not loading', 'hDescription' => 'Description']);
        TicketHeader::create(['hTitle' => 'Server not found', 'hDescription' => 'Description']);
        TicketHeader::create(['hTitle' => 'Connection failed', 'hDescription' => 'Description']);
        TicketHeader::create(['hTitle' => 'Cerificate error occured', 'hDescription' => 'Description']);
    }
}
