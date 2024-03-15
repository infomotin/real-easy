<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  DB;
use Illuminate\Support\Facades\Hash;

class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('users')->insert([
        //admin
        [
            'name'=>'Admin',
            'username'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('111'),
            'role'=>'admin',
            'status'=>'active'
        ],
        [
            'name'=>'User',
            'username'=>'user',
            'email'=>'user@gmail.com',
            'password'=>Hash::make('111'),
            'role'=>'user',
            'status'=>'active'
        ],[
            'name'=>'Developer',
            'username'=>'developer',
            'email'=>'developer@gmail.com',
            'password'=>Hash::make('111'),
            'role'=>'developer',
            'status'=>'active'
        ],[
            'name'=>'Agent',
            'username'=>'agent',
            'email'=>'agent@gmail.com',
            'password'=>Hash::make('111'),
            'role'=>'agent',
            'status'=>'active'
        ],[
            'name'=>'Audit',
            'username'=>'audit',
            'email'=>'audit@gmail.com',
            'password'=>Hash::make('111'),
            'role'=>'audit',
            'status'=>'active'
        ],
        [
            'name'=>'Super_user',
            'username'=>'super_user',
            'email'=>'super_user@gmail.com',
            'password'=>Hash::make('111'),
            'role'=>'super_user',
            'status'=>'active'
        ],
        [
            'name'=>'Tranner',
            'username'=>'tranner',
            'email'=>'tranner@gmail.com',
            'password'=>Hash::make('111'),
            'role'=>'tranner',
            'status'=>'active'
        ],
        [
            'name'=>'Bank',
            'username'=>'bank',
            'email'=>'bank@gmail.com',
            'password'=>Hash::make('111'),
            'role'=>'bank',
            'status'=>'active'
        ],
        [
            'name'=>'Administrator',
            'username'=>'administrator',
            'email'=>'administrator@gmail.com',
            'password'=>Hash::make('111'),
            'role'=>'administrator',
            'status'=>'active'
        ]
       ]);
    }
}
