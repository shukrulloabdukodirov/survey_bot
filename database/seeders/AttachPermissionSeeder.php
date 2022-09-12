<?php

namespace Database\Seeders;

use App\Common\Helpers\JsonParser;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AttachPermissionSeeder extends Seeder
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
        foreach ($roles as $role){
            $data = Role::where('name',$role['name'])->first();
            if(isset($role['permissions'])&&!empty($role['permissions'])){
                foreach ($role['permissions'] as $permission){
                    $data->givePermissionTo($permission);
                }
            }

        }
    }
}
