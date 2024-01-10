<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Productvariant;
use Modules\Ynotz\EasyAdmin\Services\FormHelper;
use Modules\Ynotz\EasyAdmin\Services\IndexTable;
use Modules\Ynotz\EasyAdmin\Traits\IsModelViewConnector;
use Modules\Ynotz\EasyAdmin\Contracts\ModelViewConnector;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\CreatePageData;
use Modules\Ynotz\EasyAdmin\RenderDataFormats\EditPageData;
use Modules\Ynotz\EasyAdmin\Services\ColumnLayout;
use Modules\Ynotz\EasyAdmin\Services\RowLayout;
use Modules\Ynotz\MediaManager\Services\EAInputMediaValidator;
use Illuminate\Support\Str;
use Modules\Ynotz\EasyAdmin\InputUpdateResponse;

class ProductvariantService implements ModelViewConnector {
    use IsModelViewConnector;
    private $indexTable;

    public function __construct()
    {
        $this->modelClass = Productvariant::class;
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
            'product' => [
                'search_column' => 'id',
                'filter_column' => 'id',
                'sort_column' => 'id',
            ]
        ];
    }
    protected function getPageTitle(): string
    {
        return "Product Variants";
    }

    protected function getIndexHeaders(): array
    {
        
        return $this->indexTable->addHeaderColumn(
            title: 'Product Name',
            sort: ['key' => 'name'],
        )->addHeaderColumn(
            title: 'Price',
       
        
        )->getHeaderRow();
    }

    protected function getIndexColumns(): array
    {
        
        return $this->indexTable->addColumn(
            fields: ['name', 'image'],
            component: 'custom.product-image'
        )->addColumn(
            fields: ['price'],
            
       
            
        )
        ->addActionColumn(
            editRoute: $this->getEditRoute(),
            deleteRoute: $this->getDestroyRoute(),
        )->getRow();
    }

    public function getAdvanceSearchFields(): array
    {
      return [];
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
            title: 'Create Productvariant',
            form: FormHelper::makeForm(
                title: 'Create Productvariant',
                id: 'form_productvariants_create',
                action_route: 'productvariants.store',
                success_redirect_route: 'productvariants.index',
                items: $this->getCreateFormElements(),
                layout: $this->buildCreateFormLayout(),
                label_position: 'top'
            )
        );
    }

    public function getEditPageData($id): EditPageData
    {
        return new EditPageData(
            title: 'Edit Productvariant',
            form: FormHelper::makeEditForm(
                title: 'Edit Productvariant',
                id: 'form_productvariants_create',
                action_route: 'productvariants.update',
                action_route_params: ['id' => $id],
                success_redirect_route: 'productvariants.index',
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
            'product_id' => FormHelper::makeSelect(
                key: 'product_id',
                label: 'Select Product',
                options:Product::all(),
                options_type: 'collection',
                options_id_key: 'id',
                options_text_key: 'name',
                options_src: [ProductvariantService::class, 'suggestList'],
                properties: [
                    'required' => true,
                    
                ],
            ),
            'name' => FormHelper::makeInput(
                inputType: 'text',
                key: 'name',
                label: 'Product Name',
                properties: ['required' => true],
                fireInputEvent:true
            ),
            'slug' => FormHelper::makeInput(
                inputType: 'text',
                key: 'slug',
                label: 'Product Slug',
                properties: ['required' => true , 'readonly'=>true],
                updateOnEvents: ['name' => [
                    'serviceclass' => ProductvariantService ::class,
                    'method' => 'getslug'
                ]]

            ),
            'price' => FormHelper::makeInput(
                inputType: 'number',
                key: 'price',
                label: 'Price',
                properties: ['required' => true],
                
            ),
            'quantity' => FormHelper::makeInput(
                inputType: 'number',
                key: 'quantity',
                label: 'Quantity',
                properties: ['required' => true]
               
            ),
            
            'image'=>FormHelper::makeImageUploader(
                key:'image',
                label:'Product Image',
                properties:[
                    'required'=>true
                ]

                ),
            'imageSecond'=>FormHelper::makeImageUploader(
                    key:'imageSecond',
                    label:'Product Image 2',
                    properties:[
                        'required'=>true
                    ]
    
                    ),
        ];
    }
    public function getSlug($data)
    {
        return new InputUpdateResponse(
            result: Str::slug($data['value']),
            message: 'success',
            isvalid: true
        );
    }
    public function getFileFields()
    {
        return ['image','imageSecond'];
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
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'product_id' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            
            'image'=>['required'],
            'imageSecond'=>['required'],
        ];
    }

    public function getUpdateValidationRules($id): array
    {
        return [
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'product_id' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
           
            'image'=>['required'],
            'imageSecond'=>['required'],
        ];
    }

    public function processBeforeStore(array $data): array
    {
        // // Example:
        // $data['user_id'] = auth()->user()->id;

        return $data;
    }

    public function processBeforeUpdate(array $data): array
    {
        // // Example:
        // $data['user_id'] = auth()->user()->id;

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
                            (new ColumnLayout(width: '1/2'))->addInputSlot('product_id'),
                            (new ColumnLayout(width: '1/2'))->addInputSlot('price'),
                        ]),
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout(width: '1/2'))->addInputSlot('name'),
                            (new ColumnLayout(width: '1/2'))->addInputSlot('slug'),
                        ]),
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout(width: '1/2'))->addInputSlot('quantity'),
                            
                        ]),
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout(width: '1/2'))->addInputSlot('image'),
                            (new ColumnLayout(width: '1/2'))->addInputSlot('imageSecond'),
                        ]),
                ]
            );
        return $layout->getLayout();
    }
}

?>
