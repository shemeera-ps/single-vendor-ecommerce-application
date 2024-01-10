<?php
namespace App\Services;

use Modules\Ynotz\AccessControl\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Modules\Ynotz\EasyAdmin\Services\FormHelper;
use Modules\Ynotz\EasyAdmin\Services\IndexTable;
use Modules\Ynotz\AccessControl\Models\Permission;
use Modules\Ynotz\AuditLog\Events\BusinessActionEvent;
use Modules\Ynotz\EasyAdmin\Traits\IsModelViewConnector;
use Modules\Ynotz\EasyAdmin\Contracts\ModelViewConnector;
use Modules\Ynotz\AccessControl\Services\PermissionService;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\CreatePageData;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\EditPageData;
use Modules\Ynotz\EasyAdmin\Services\TableHelper;

class RoleService implements ModelViewConnector {
    use IsModelViewConnector;
    private $indexTable;

    public function __construct()
    {
        $this->modelClass = Role::class;
        $this->indexTable = new IndexTable();

    }

    protected function relations(): array
    {
        return [
            'permissions' => [
                'search_column' => 'id'
            ]
        ];
    }

    public function rolesPermissionsData()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return TableHelper::buildCrossActionTableData(
            title: 'Role-wise Permissions',
            xItems: $roles,
            yItems: $permissions,
            actionRoute: 'roles.update_permissions',
            xItemName: 'Role',
            yItemName: 'Permission',
            xDisplayKey: 'name',
            yDisplayKey: 'name',
        );
    }

    protected function getPageTitle(): string
    {
        return 'Role';
    }

    protected function getIndexHeaders(): array
    {
        return $this->indexTable->addHeaderColumn(
            title: 'name',
            sort: ['key' => 'name']
        )->addHeaderColumn(
            title: 'Actions'
        )->getHeaderRow();
    }

    protected function getIndexColumns(): array
    {
        return $this->indexTable->addColumn(
            fields: ['name'],
        )->addActionColumn(
            editRoute: $this->getEditRoute(),
            deleteRoute: $this->getDestroyRoute()
        )->getRow();
    }

    public function getDownloadCols(): array
    {
        return [
            'id',
            'name'
        ];
    }

    public function getCreatePageData(): CreatePageData
    {
        return new CreatePageData(
            title: 'Roles',
            form: FormHelper::makeForm(
                title: 'Create Role',
                id: 'form_role_create',
                action_route: 'roles.store',
                success_redirect_route: 'roles.index',
                items: $this->getCreateFormElements(),
                label_position: 'side'
            )
        );
    }

    public function getEditPageData($id): EditPageData
    {
        return new EditPageData(
            title: 'Roles',
            form: FormHelper::makeEditForm(
                title: 'Edit Role',
                id: 'form_role_create',
                action_route: 'roles.update',
                action_route_params: ['id' => $id],
                success_redirect_route: 'roles.index',
                items: $this->getEditFormElements($id),
                label_position: 'side'
            ),
            instance: ($this->modelClass)::find($id)
        );
    }

    private function formElements(): array
    {
        return [
            FormHelper::makeInput(
                inputType: 'text',
                key: 'name',
                label: 'Name',
                properties: ['required' => true],
                fireInputEvent: true
            ),
            FormHelper::makeSelect(
                key: 'permissions',
                label: 'Permissions',
                options: Permission::all(),
                options_type: 'collection',
                options_id_key: 'id',
                options_text_key: 'name',
                options_src: [PermissionService::class, 'suggestList'],
                properties: [
                    'required' => true,
                    'multiple' => true
                ],
            ),
            // FormHelper::makeCheckbox(
            //     key: 'verified',
            //     label: 'Is verified?',
            //     toggle: true,
            //     displayText: ['Yes', 'No']
            // )
        ];
    }

    public function permissionUpdate($data)
    {
        try {
            /**
             * @var Role
             */
            $role = Role::with('permissions')->where('id', $data['x_id'])->get()->first();
            $existing_permissions = $role->permissions()->pluck('id')->toArray();
            switch($data['granted']) {
                case 1:
                    if (!in_array($data['y_id'], $existing_permissions)) {
                        $role->assignPermissions($data['y_id']);
                    }
                    break;
                case 0:
                    if (in_array($data['y_id'], $existing_permissions)) {
                        $role->reomvePermissions($data['y_id']);
                    }
                    break;
            }
            return true;
        } catch (\Throwable $e) {
            info($e->__toString());
            return false;
        }
    }

    public function processAfterStore($instance): void
    {
        BusinessActionEvent::dispatch(
            Role::class,
            $instance->id,
            'Created',
            auth()->user()->id,
            null,
            $instance,
            'Created Role: '.$instance->name.', id: '.$instance->id,
        );
    }

    public function processAfterUpdate($oldInstance, $instance): void
    {
        BusinessActionEvent::dispatch(
            Role::class,
            $instance->id,
            'Updated',
            auth()->user()->id,
            $oldInstance,
            $instance,
            'Updated Role: '.$instance->name.', id: '.$instance->id,
        );
    }

    public function getStoreValidationRules(): array
    {
        return [
            'name' => ['required', 'string'],
            'permissions' => ['required', 'array']
        ];
    }

    public function getUpdateValidationRules(): array
    {
        return [
            'name' => ['required', 'string'],
            'permissions' => ['required', 'array']
        ];
    }
}

?>
