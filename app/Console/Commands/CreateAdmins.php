<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmins extends Command
{
    protected $signature = 'app:create-admins';
    // $ php artisan app:create-admins

    protected $description = 'Command to Create Admin Users';

    public function handle()
    {
        $admin  = new User();
        $admin->name  = "Kholood";
        $admin->areaCode  = "null";
        $admin->userCode  =  "kholood.emad@2coom.com";
        $admin->userType  =  'normalAdmin';
        $admin->password  =  Hash::make('12345');
        $admin->pass_as_string  =  '12345';
        $admin->save();

        // TODO : superAdmin User ; 
        $this->info("Admin is Created , Still the Super One");
    }
}
