<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;


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
        $collections = (new FastExcel)->import('Book12.xlsx');
        foreach ($collections as $collection) {
            $nu = new User();
            $nu->name  = $collection['Name'];
            $nu->userCode  = $collection['Email'];
            $nu->areaCode  = $collection['Code'];
            $nu->password  = Hash::make('123');
            $nu->pass_as_string  = '123';
            $nu->save();
        }
        $this->info("Admin is Created , Still the Super One");
    }
}
