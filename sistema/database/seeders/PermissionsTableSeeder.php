<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Categories;


class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Permission Users
        Permission::create(['title' => 'Ver Usuarios', 'name' => 'users.index']);
        Permission::create(['title' => 'Editar Usuarios', 'name' => 'users.update']);
        Permission::create(['title' => 'Borrar Usuarios', 'name' => 'users.destroy']);

        // Create Permission Client
         Permission::create(['title' => 'Ver Clientes', 'name' => 'client.index']);
         Permission::create(['title' => 'Editar Clientes', 'name' => 'client.update']);
         Permission::create(['title' => 'Crear Clientes', 'name' => 'client.create']);
         Permission::create(['title' => 'Borrar Clientes', 'name' => 'client.destroy']);

        // Create Permission Alquileres
        Permission::create(['title' => 'Ver Alquileres', 'name' => 'rentals.index']);
        Permission::create(['title' => 'Editar Alquileres', 'name' => 'rentals.update']);
        Permission::create(['title' => 'Crear Alquileres', 'name' => 'rentals.create']);
        Permission::create(['title' => 'Borrar Alquileres', 'name' => 'rentals.destroy']);

        // Create Permission Peliculas
        Permission::create(['title' => 'Ver Peliculas', 'name' => 'movies.index']);
        Permission::create(['title' => 'Editar Peliculas', 'name' => 'movies.update']);
        Permission::create(['title' => 'Crear Peliculas', 'name' => 'movies.create']);
        Permission::create(['title' => 'Borrar Peliculas', 'name' => 'movies.destroy']);

        //Create Roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'charge']);

        //User Admin
        $userAdmin = User::find(1);
        $userAdmin->assignRole('admin');

        //User Charge
        $userCharge = User::create([
            'name' => 'charge',
            'email' => 'charge@test.dev',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        //User Charge
        $newcategorie1 = Categories::create([
            'name' => 'categoria1',
        ]);

        $newcategorie2 = Categories::create([
            'name' => 'categoria2',
        ]);

        $userCharge->assignRole('charge');
    }
}
