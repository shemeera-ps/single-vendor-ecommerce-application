<?php

namespace App\Http\Controllers;

use App\Services\PermissionService;
use Illuminate\Http\Request;
use Modules\Ynotz\EasyAdmin\Traits\HasMVConnector;
use Modules\Ynotz\SmartPages\Http\Controllers\SmartController;

class PermissionController extends SmartController
{
    use HasMVConnector;

    public function __construct(PermissionService $connectorService, Request $request){
        parent::__construct($request);
        $this->connectorService = $connectorService;
        // $this->itemName = 'districts';
        // $this->indexView = 'easyadmin::admin.indexpanel';
        // $this->createView = 'accesscontrol::roles.create';
        // $this->editView = 'accesscontrol::roles.edit';
    }
}
