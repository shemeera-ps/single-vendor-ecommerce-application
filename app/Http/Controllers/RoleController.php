<?php

namespace App\Http\Controllers;

use App\Services\RoleService;
use Illuminate\Http\Request;
use Modules\Ynotz\EasyAdmin\Traits\HasMVConnector;
use Modules\Ynotz\SmartPages\Http\Controllers\SmartController;

class RoleController extends SmartController
{
    use HasMVConnector;

    public function __construct(RoleService $connectorService, Request $request){
        parent::__construct($request);
        $this->connectorService = $connectorService;
    }

    public function rolesPermissions()
    {
        return $this->buildResponse(
            'easyadmin::admin.crossaction',
            $this->connectorService->rolesPermissionsData()
        );
    }

    public function permissionUpdate(Request $request)
    {
        $result = $this->connectorService->permissionUpdate($request->all());
        return response()->json(['success' => $result]);
    }
}
