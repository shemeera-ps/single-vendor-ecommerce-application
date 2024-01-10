<?php
namespace App\Services;

use Exception;
use Modules\Ynotz\EasyAdmin\Services\FormHelper;
use Modules\Ynotz\EasyAdmin\Services\IndexTable;
use Modules\Ynotz\AccessControl\Models\Permission;
use Modules\Ynotz\AuditLog\Events\BusinessActionEvent;
use Modules\Ynotz\EasyAdmin\Traits\IsModelViewConnector;
use Modules\Ynotz\EasyAdmin\Contracts\ModelViewConnector;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\CreatePageData;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\EditPageData;

class PermissionService implements ModelViewConnector {
    use IsModelViewConnector;
    private $indexTable;

    public function __construct()
    {
        $this->modelClass = Permission::class;
        $this->indexTable = new IndexTable();
    }
    protected function getPageTitle(): string
    {
        return 'Permission';
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
                title: 'Create Permission',
                id: 'form_permission_create',
                action_route: 'permissions.store',
                success_redirect_route: 'permissions.index',
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
                title: 'Edit Permission',
                id: 'form_permission_create',
                action_route: 'permissions.update',
                action_route_params: ['id' => $id],
                success_redirect_route: 'permissions.index',
                items: $this->getEditFormElements(),
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
            // FormHelper::makeSelect(
            //     key: 'permissions',
            //     label: 'Permissions',
            //     options: Permission::all(),
            //     options_type: 'collection',
            //     options_id_key: 'id',
            //     options_text_key: 'name',
            //     options_src: [PermissionService::class, 'suggestList'],
            //     properties: [
            //         'required' => true,
            //         'multiple' => false
            //     ],
            // ),
        ];
    }

    public function processAfterStore($instance): void
    {
        BusinessActionEvent::dispatch(
            Permission::class,
            $instance->id,
            'Created',
            auth()->user()->id,
            null,
            $instance,
            'Created Permission: '.$instance->name.', id: '.$instance->id,
        );
    }

    public function processAfterUpdate($oldInstance, $instance): void
    {
        BusinessActionEvent::dispatch(
            Permission::class,
            $instance->id,
            'Updated',
            auth()->user()->id,
            $oldInstance,
            $instance,
            'Updated Permission: '.$instance->name.', id: '.$instance->id,
        );
    }

    public function getStoreValidationRules(): array
    {
        return [
            'name' => ['required', 'string']
        ];
    }

    public function getUpdateValidationRules(): array
    {
        return [
            'name' => ['required', 'string']
        ];
    }
}

?>
