<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * @var array|string[] $permissions Default permissions
     */
    private array $permissions = [
        'create',
        'read',
        'update',
        'delete'
    ];

    /**
     * @var array|string[] $roles Default roles
     */
    private array $roles = [
        'admin',
        'writer',
        'user',
        'verifier'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (count($this->permissions) > 0) {
            foreach ($this->permissions as $permissionName)
                Permission::create(['name' => $permissionName]);
        }

        if (count($this->roles) > 0) {
            foreach ($this->roles as $roleName)
                Role::create(['name' => $roleName]);
        }
    }
}
