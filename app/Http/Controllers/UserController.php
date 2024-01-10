<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Modules\Ynotz\EasyAdmin\Traits\HasMVConnector;
use Modules\Ynotz\SmartPages\Http\Controllers\SmartController;

class UserController extends SmartController
{
    use HasMVConnector;

    public function __construct(UserService $connectorService, Request $request){
        parent::__construct($request);
        $this->connectorService = $connectorService;
        // $this->itemName = 'districts';
        // $this->indexView = 'admin.index';
        // $this->showView = 'admin.users.show';
        // $this->createView = 'accesscontrol::roles.create';
        // $this->editView = 'accesscontrol::roles.edit';
    }
}
