<?php

namespace App\Services;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Tag;

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

class ProductService implements ModelViewConnector
{
    use IsModelViewConnector;
    private $indexTable;

    public function __construct()
    {
        $this->modelClass = Product::class;
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
            'category' => [
                'search_column' => 'id',
                'filter_column' => 'id',
                'sort_column' => 'id',
            ],
            'tags' => [
                'search_column' => 'id',
                'filter_column' => 'id',
                'sort_column' => 'id',
            ],
            
        ];
    }
    protected function getPageTitle(): string
    {
        return "Products";
    }

    protected function getIndexHeaders(): array
    {
        return $this->indexTable->addHeaderColumn(
            title: 'Product',
            sort: ['key' => 'name'],
        )->addHeaderColumn(
            title: 'Category',
        )->addHeaderColumn(
            title: 'Actions'
        )->getHeaderRow();
    }

    protected function getIndexColumns(): array
    {

        return $this->indexTable->addColumn(
            fields: ['name', 'image'],
            component: 'custom.product-image'
        )->addColumn(
            fields: ['name'],
            relation: 'category'
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
            title: 'Create Product',
            form: FormHelper::makeForm(
                title: 'Create Product',
                id: 'form_products_create',
                action_route: 'products.store',
                success_redirect_route: 'products.index',
                items: $this->getCreateFormElements(),
                layout: $this->buildCreateFormLayout(),
                label_position: 'top'
            )
        );
    }

    public function getEditPageData($id): EditPageData
    {
        return new EditPageData(
            title: 'Edit Product',
            form: FormHelper::makeEditForm(
                title: 'Edit Product',
                id: 'form_products_create',
                action_route: 'products.update',
                action_route_params: ['id' => $id],
                success_redirect_route: 'products.index',
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
            'name' => FormHelper::makeInput(
                inputType: 'text',
                key: 'name',
                label: 'Product Name',
                properties: ['required' => true],
                fireInputEvent: true
            ),
            'slug' => FormHelper::makeInput(
                inputType: 'text',
                key: 'slug',
                label: 'Product Slug',
                properties: ['required' => true, 'readonly' => true],
                updateOnEvents: ['name' => [
                    'serviceclass' => ProductService::class,
                    'method' => 'getslug'
                ]]

            ),
            'category_id' => FormHelper::makeSelect(
                key: 'category_id',
                label: 'Select Category',
                options: Category::all(),
                options_type: 'collection',
                options_id_key: 'id',
                options_text_key: 'name',
                options_src: [CategoryService::class, 'suggestList'],
                properties: [
                    'required' => true,

                ],
            ),
            'tags' => FormHelper::makeSelect(
                key: 'tags',
                label: 'Choose Tags',
                options: Tag::all(),
                options_type: 'collection',
                options_id_key: 'id',
                options_text_key: 'tag',
                options_src: [SizeService::class, 'suggestList'],
                properties: [
                    'required' => true,
                    'multiple' => true

                ],
            ),

            // 'attribute' => FormHelper::makeSelect(
            //     key: 'attribute',
            //     label: 'Select All Available Attribute',
            //     options: Attribute::all(),
            //     options_type: 'collection',
            //     options_id_key: 'id',
            //     options_text_key: 'attribute',
            //     options_src: [AttributeService::class, 'suggestList'],
            //     properties: [

            //         'multiple' => true

            //     ],
            // ),
            // 'value' => FormHelper::makeSelect(
            //     key: 'value',
            //     label: 'Select All Available values',
            //     options: AttributeValue::all(),
            //     options_type: 'collection',
            //     options_id_key: 'id',
            //     options_text_key: 'value',
            //     options_src: [AttributevalueService::class, 'suggestList'],
            //     properties: [

            //         'multiple' => true

            //     ],
            // ),
            'description' => FormHelper::makeTextarea(
                key: 'description',
                label: 'Product Description'
            ),
            'image' => FormHelper::makeImageUploader(
                key: 'image',
                label: 'Product Image',
                properties: [
                    'required' => true
                ]

            ),
            'imageSecond' => FormHelper::makeImageUploader(
                key: 'imageSecond',
                label: 'Product Image Second',
                properties: [
                    'required' => true
                ]

            )
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
        return ['image', 'imageSecond'];
    }
    public function getStoreValidationRules(): array
    {

        return [
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'tags' => ['required', 'array'],
            'description' => ['required', 'string'],
            'category_id' => ['required'],
           
            'image' => ['required'],
            'imageSecond' => ['required']
        ];
    }

    public function getUpdateValidationRules($id): array
    {
        return [
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'tags' => ['required', 'array'],
            'description' => ['required', 'string'],
            'category_id' => ['required'],
           
            'image' => ['required'],
            'imageSecond' => ['required']
        ];
    }

    public function processBeforeStore(array $data): array
    {
        //dd($data);
        return $data;
    }

    public function processBeforeUpdate(array $data): array
    {
        //    dd($data);
        //    $attributes = $data['attribute'];
        //    dd($attributes);

        return $data;
    }

    public function processAfterStore($instance): void
    {
    }

    public function processAfterUpdate($oldInstance, $instance): void
    {
        //Do something with the updated $instance
    }

    public function buildCreateFormLayout(): array
    {

        $layout = (new ColumnLayout())
            ->addElements(
                [
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout(width: 'grow'))->addInputSlot('name'),
                            (new ColumnLayout(width: 'grow'))->addInputSlot('slug'),
                        ]),
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout())->addInputSlot('category_id'),
                            (new ColumnLayout())->addInputSlot('tags'),


                        ]),
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout())->addInputSlot('description'),

                        ]),
                    (new RowLayout())
                        ->addElements([
                            (new ColumnLayout())->addInputSlot('image'),
                            (new ColumnLayout())->addInputSlot('imageSecond'),
                        ])
                ]
            );
        return $layout->getLayout();
    }
}
