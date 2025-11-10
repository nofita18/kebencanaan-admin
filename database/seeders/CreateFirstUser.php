<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data['name'] = 'nopi';
        $data['email'] = 'nopi18@gmail.com';
        $data['password'] = Hash::make('nopi1234');
        User::create($data);
    }
}
