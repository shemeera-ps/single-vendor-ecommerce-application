<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductsTags;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Modules\Ynotz\EasyAdmin\Traits\HasMVConnector;
use Modules\Ynotz\SmartPages\Http\Controllers\SmartController;

class CategoryController extends SmartController
{
    use HasMVConnector;

    public function __construct(Request $request, CategoryService $service)
    {
        parent::__construct($request);
        $this->connectorService = $service;
        // $this->itemName = null;
        // $this->unauthorisedView = 'easyadmin::admin.unauthorised';
        // $this->errorView = 'easyadmin::admin.error';
        // $this->indexView = 'easyadmin::admin.indexpanel';
        // $this->showView = 'easyadmin::admin.show';
        // $this->createView = 'easyadmin::admin.form';
        // $this->editView = 'easyadmin::admin.form';
        // $this->itemsCount = 10;
        // $this->resultsName = 'results';
    }
    
    public function categoryIndex(){
        $categories=Category::all();
        return view('display.app',['categories'=>$categories]);
    }

    public function showProducts(Category $category){
        $categories=Category::all();
        $products=$category->products()->with('tags')->get();
        return view('display.category-product',['products'=>$products,'categories'=>$categories]);
    }
}
