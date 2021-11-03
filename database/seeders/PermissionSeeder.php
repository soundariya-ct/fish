<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use App\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        $routeCollection = Route::getRoutes();

        foreach ($routeCollection->getRoutes() as $route) {
            $action = $route->action;

            if($action['prefix'] == '/rrkadminmanager'){
                if($name = @$action['as']){

                    Permission::firstOrcreate(['name' => $name, 'guard_name' => 'admin']);
                }
            }
        }
    }
}
