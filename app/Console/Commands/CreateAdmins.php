<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateAdmins extends Command
{
    protected $signature = 'app:create-admins';
    // $ php artisan app:create-admins

    protected $description = 'Command to Create Admin Users';

    public function handle()
    {
        $this->info("Command is Run & Done");
    }
}
