<?php

use Modules\Ynotz\EasyAdmin\Http\Controllers\DashboardController;
use Modules\Ynotz\EasyAdmin\Services\DashboardService;
use Modules\Ynotz\EasyAdmin\Services\SidebarService;

return [
    'dashboard_sidebar' => [
        [
            'title' => 'Roles',
            'route' => 'roles.index',
            'route_params' => [],
            'icon' => 'easyadmin::icons.users'
        ]
    ],
    'dashboard_service' => DashboardService::class,
    'dashboard_controller' => DashboardController::class,
    'dashboard_method' => 'dashboard',
    'sidebar_services' => [
        SidebarService::class,
        App\Services\SidebarService::class,
    ],
    'dashboard_view' => 'easyadmin::admin.dashboard',
    'enforce_validation' => true
];
