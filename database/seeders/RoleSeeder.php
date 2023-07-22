<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'usuario']);

        Permission::create(['name' => 'empleados.index'])->syncRoles($role1,$role2);
        Permission::create(['name' => 'empleados.create'])->syncRoles($role1);
        Permission::create(['name' => 'empleados.edit'])->syncRoles($role1);
        Permission::create(['name' => 'empleados.delete'])->syncRoles($role1);
    }
}
