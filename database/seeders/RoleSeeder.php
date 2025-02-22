<?php

namespace Database\Seeders;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::flushEventListeners();
        // Create Roles
        $admin = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $user = Role::create(['name' => 'user', 'guard_name' => 'web']);

        // Create Permissions
        Permission::create(['name' => 'manage-users', 'guard_name' => 'web']);
        Permission::create(['name' => 'users', 'guard_name' => 'web']);

        //Asign perms to roles
        $admin->givePermissionTo(['manage-users']);
        $user->givePermissionTo(['users']);

        // Crear un usuario administrativo si no existe
        $adminUser = User::firstOrCreate([
            'email' => 'admin@dominio.com', // Cambia al email que desees
        ], [
            'name' => 'Admin User',
            'password' => bcrypt('123456789'), // Cambia la contraseña según sea necesario
        ]);

        // Asignar el rol administrativo (asegúrate de que el rol exista)
        $role = Role::firstOrCreate(['name' => 'admin']); // Cambia 'admin' por el rol que prefieras
        $adminUser->assignRole($role);
        User::observe(UserObserver::class);
    }
}
