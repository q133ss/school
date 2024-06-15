<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ['Ученик' => 'student', 'Преподаватель' => 'teacher','Админ' => 'admin'];
        foreach ($roles as $name => $slug){
            Role::create(['name' => $name, 'slug' => $slug]);
        }

        User::create([
            'name'     => 'Учитель',
            'phone'    => '+7(111)111-11-11',
            'password' => Hash::make('password'),
            'role_id'  => Role::where('slug', 'teacher')->pluck('id')->first()
        ]);
    }
}
