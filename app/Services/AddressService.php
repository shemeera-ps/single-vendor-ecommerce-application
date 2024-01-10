<?php
namespace App\Services;

use App\Models\Address;
use App\Models\AddressTag;
use Modules\Ynotz\EasyAdmin\Services\FormHelper;
use Modules\Ynotz\EasyAdmin\Services\IndexTable;
use Modules\Ynotz\EasyAdmin\Traits\IsModelViewConnector;
use Modules\Ynotz\EasyAdmin\Contracts\ModelViewConnector;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\CreatePageData;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\EditPageData;
use Modules\Ynotz\EasyAdmin\Services\ColumnLayout;
use Modules\Ynotz\EasyAdmin\Services\RowLayout;

class AddressService implements ModelViewConnector {
    use IsModelViewConnector;
    private $indexTable;

    public function __construct()
    {
        $this->modelClass = Address::class;
        $this->indexTable = new IndexTable();
        $this->selectionEnabled = true;

        // $this->idKey = 'id';
        // $this->selects = '*';
        // $this->selIdsKey = 'id';
        // $this->searchesMap = [];
        // $this->sortsMap = [];
        // $this->filtersMap = [
        //     'author' => 'user_id' // Example
        // ];
        // $this->orderBy = ['created_at', 'desc'];
        // $this->sqlOnlyFullGroupBy = true;
        // $this->defaultSearchColumn = 'name';
        // $this->defaultSearchMode = 'startswith';
        // $this->relations = [];
        // $this->selectionEnabled = false;
        // $this->downloadFileName = 'results';
    }

    protected function relations()
    {
       
        return [
            'user' => [
                'search_column' => 'id',
                'filter_column' => 'id',
                'sort_column' => 'id',
            ],
            'tag' => [
                'search_column' => 'id',
                'filter_column' => 'id',
                'sort_column' => 'id',
            ],
        ];
    }
    protected function getPageTitle(): string
    {
        return "Addresses";
    }

    protected function getIndexHeaders(): array
    {
        return $this->indexTable->addHeaderColumn(
            title: 'User Name',
            sort: ['key' => 'name'],
        )->addHeaderColumn(
                title: 'Tag',
                
        )->addHeaderColumn(
            title: 'Address Line 1',
            
        )->addHeaderColumn(
            title: 'Address Line 2',
        )->addHeaderColumn(
            title: 'City',
        )->addHeaderColumn(
            title: 'State',
        )->addHeaderColumn(
            title: 'Pincode',
        )->addHeaderColumn(
            title: 'Actions'
        )->getHeaderRow();
    }

    protected function getIndexColumns(): array
    {
        
        return $this->indexTable->addColumn(
            fields: ['name'],
            relation:'user'
        )->addColumn(
                fields: ['tag_id'],
        )->addColumn(
            fields: ['address_line1'],
           
        )->addColumn(
            fields: ['address_line2'],
        )->addColumn(
            fields: ['city'],
        )->addColumn(
            fields: ['state'],
        )->addColumn(
            fields: ['pincode'],
        )
        ->addActionColumn(
            editRoute: $this->getEditRoute(),
            deleteRoute: $this->getDestroyRoute(),
        )->getRow();
    }

    public function getAdvanceSearchFields(): array
    {
        return [];
        // // Example:
        // return $this->indexTable->addSearchField(
        //     key: 'title',
        //     displayText: 'Title',
        //     valueType: 'string',
        // )
        // ->addSearchField(
        //     key: 'author',
        //     displayText: 'Author',
        //     valueType: 'list_string',
        //     options: User::all()->pluck('name', 'id')->toArray(),
        //     optionsType: 'key_value'
        // )
        // ->addSearchField(
        //     key: 'reviewScore',
        //     displayText: 'Review Score',
        //     valueType: 'numeric',
        // )
        // ->getAdvSearchFields();
    }

    public function getDownloadCols(): array
    {
        return [];
        // // Example
        // return [
        //     'title',
        //     'author.name'
        // ];
    }

    public function getDownloadColTitles(): array
    {
        return [
            'title' => 'Title',
            'author.name' => 'Author'
        ];
    }

    public function getCreatePageData(): CreatePageData
    {
        return new CreatePageData(
            title: 'Create Address',
            form: FormHelper::makeForm(
                title: 'Create Address',
                id: 'form_addresses_create',
                action_route: 'addresses.store',
                success_redirect_route: 'addresses.index',
                items: $this->getCreateFormElements(),
                layout: $this->buildCreateFormLayout(),
                label_position: 'top'
            )
        );
    }

    public function getEditPageData($id): EditPageData
    {
        return new EditPageData(
            title: 'Edit Address',
            form: FormHelper::makeEditForm(
                title: 'Edit Address',
                id: 'form_addresses_create',
                action_route: 'addresses.update',
                action_route_params: ['id' => $id],
                success_redirect_route: 'addresses.index',
                items: $this->getEditFormElements(),
                label_position: 'top'
            ),
            instance: $this->getQuery()->where('id', $id)->get()->first()
        );
    }

    /*
    public function getShowPageData($id): ShowPageData
    {
        return new ShowPageData(
            Str::ucfirst($this->getModelShortName()),
            $this->getQuery()->where($this->key, $id)->get()->first()
        );
    }
    */

    private function formElements(): array
    {
        
        return [
            'address_line1' => FormHelper::makeInput(
                inputType: 'text',
                key: 'address_line1',
                label: 'Address Line 1',
                properties: ['required' => true],
            ),
            'address_line2' => FormHelper::makeInput(
                inputType: 'text',
                key: 'address_line2',
                label: 'Address Line 2',
                properties: ['required' => true],
            ),
            'city' => FormHelper::makeInput(
                inputType: 'text',
                key: 'city',
                label: 'City',
                properties: ['required' => true],
            ),
            'state' => FormHelper::makeInput(
                inputType: 'text',
                key: 'state',
                label: 'State',
                properties: ['required' => true],
            ),
            'pincode' => FormHelper::makeInput(
                inputType: 'text',
                key: 'pincode',
                label: 'Pincode',
                properties: ['required' => true],
            ),
            'tag_id'=>FormHelper::makeSelect(
                key: 'tag_id',
                label: 'Choose Tags',
                options:AddressTag::all(),
                options_type: 'collection',
                options_id_key: 'id',
                options_text_key: 'tag',
                options_src: [TagService::class, 'suggestList'],
                properties: [
                    'required' => true,
                
                    
                ],
            ),
           
        ];
    }

    private function getQuery()
    {
        return $this->modelClass::query();
        // // Example:
        // return $this->modelClass::query()->with([
        //     'author' => function ($query) {
        //         $query->select('id', 'name');
        //     }
        // ]);
    }

    public function getStoreValidationRules(): array
    {
       
        return [
            'address_line1' => ['required', 'string'],
            'address_line2' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'pincode' => ['required', 'string'],
            'tag_id'=>['required']
            
        ];
    }

    public function getUpdateValidationRules($id): array
    {
        return [
            'address_line1' => ['required', 'string'],
            'address_line2' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'pincode' => ['required', 'string'],
            'tag_id'=>['required']
           
        ];
    }

    public function processBeforeStore(array $data): array
    {
        
        $data['user_id'] = auth()->user()->id;

        return $data;
    }

    public function processBeforeUpdate(array $data): array
    {
        $data['user_id'] = auth()->user()->id;
        return $data;
    }

    public function processAfterStore($instance): void
    {
        //Do something with the created $instance
    }

    public function processAfterUpdate($oldInstance, $instance): void
    {
        //Do something with the updated $instance
    }

    public function buildCreateFormLayout(): array
    {
        
         $layout = (new ColumnLayout())
            ->addElements([
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout())->addInputSlot('address_line1')
                        ]),
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout())->addInputSlot('address_line2')
                        ]),
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout(width: '1/2'))->addInputSlot('city'),
                            (new ColumnLayout(width: '1/2'))->addInputSlot('state')
                        ]),
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout(width: '1/2'))->addInputSlot('pincode'),
                            (new ColumnLayout(width: '1/2'))->addInputSlot('tag_id'),
                            
                        ])
                ]
            );
        return $layout->getLayout();
    }
}

?>
