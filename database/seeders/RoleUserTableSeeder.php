<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        User::findOrFail(1)->roles()->sync(1);
        User::where('id', '>', 1)->each(function ($user) {
            $randomRoleIds = Role::inRandomOrder()->limit(rand(1, 2))->pluck('id')->toArray();
            $user->roles()->sync($randomRoleIds);
        });
    }
}
