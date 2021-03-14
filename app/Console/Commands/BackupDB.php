<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'takeBackup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get a daily backup';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('backup:run');
        return 1;
    }
}
