<?php
$context_path = 'base/User/Applicant/';
$context_namespace = 'Base\User\Applicant';
return [
    'path' => [
        'migration'         => database_path('migrations/'),

        'model'             => base_path($context_path.'Domain/Models/'),

        'datatables'        => app_path('DataTables/'),

        'repository'        => base_path($context_path.'Domain/Repositories/'),

        'routes'            => base_path($context_path.'Application/Http/Routes/web.php'),

        'api_routes'        => base_path($context_path.'Application/Http/Routes/api.php'),

        'request'           => base_path($context_path.'Application/Http/Requests/'),

        'api_request'       => base_path($context_path.'Application/Http/Requests/Api/V1/'),

        'controller'        => base_path($context_path.'Application/Http/Controllers/'),

        'api_controller'    => base_path($context_path.'Application/Http/Controllers/Api/V1/'),

        'api_resource'      => base_path($context_path.'Application/Http/Resources/Api/V1/'),

        'repository_test'   => base_path('tests/Repositories/'),

        'api_test'          => base_path('tests/APIs/'),

        'tests'             => base_path('tests/'),

        'views'             => resource_path('views/'),

        'schema_files'      => app_path('Setup/Schemas/'),

        'templates_dir'     => resource_path('infyom/infyom-generator-templates/'),

        'seeder'            => base_path($context_path.'Infrastructure/Seeders'),

        'database_seeder'   => base_path($context_path.'Infrastructure/Seeders/DatabaseSeeder.php'),

        'factory'           => base_path($context_path.'Infrastructure/Factories'),

        'view_provider'     => app_path('Providers/ViewServiceProvider.php'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Namespaces
    |--------------------------------------------------------------------------
    |
    */

    'namespace' => [

        'model'             => $context_namespace.'\Domain\Models',

        'datatables'        => 'App\DataTables',

        'repository'        => $context_namespace.'\Domain\Repositories',

        'controller'        => $context_namespace.'\Application\Http\Controllers',

        'api_controller'    => $context_namespace.'\Application\Http\Controllers\Api\V1',

        'api_resource'      => $context_namespace.'\Application\Http\Resources\Api\V1',

        'request'           => $context_namespace.'\Application\Http\Requests',

        'api_request'       => $context_namespace.'\Application\Http\Requests\Api\V1',

        'seeder'            => $context_namespace.'\Infrastructure\Seeders',

        'factory'           => $context_namespace.'\Infrastructure\Factories',

        'repository_test'   => 'Tests\Repositories',

        'api_test'          => 'Tests\APIs',

        'tests'             => 'Tests',
    ],
];
