<?php

namespace Database\Seeders;

use App\Common\Helpers\JsonParser;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new JsonParser('permissions.json');
        $array = $data->toArray();
        $roles = $array['roles'];
        $permissions = $array['permissions'];
        foreach ($permissions as $permission){
            Permission::updateOrCreate(['name'=>$permission]);
        }
        foreach ($roles as $role){
            $role  = Role::updateOrCreate(['name'=>$role['name']]);
        }
    }
}
