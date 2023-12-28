<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use App\Services\WishlistService;
use Illuminate\Http\Request;
use Modules\Ynotz\EasyAdmin\Traits\HasMVConnector;
use Modules\Ynotz\SmartPages\Http\Controllers\SmartController;
use App\Models\Category;

class WishlistController extends SmartController
{
    use HasMVConnector;

    public function __construct(Request $request, WishlistService $service)
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

    public function wishlistIndex(){
        $categories=Category::all();
        $wishlists=Wishlist::where('user_id',auth()->user()->id)->paginate(8);
        return view('display.wishlist',['wishlists'=>$wishlists,'categories'=>$categories]);
    }
    public function addToWishlist(Request $request){
        $request->validate([
            'product_id'=>'required|exists:products,id',
        ]);
        $exsistingItem=Wishlist::where('user_id',auth()->user()->id)
                        ->where('product_id',$request->product_id)
                        ->first();
        if($exsistingItem){
            return redirect()->back()->with('error','Item already in the Wishlist');

        }
       

        $wishlist=new Wishlist;
        $wishlist->user_id=auth()->user()->id;
        $wishlist->product_id=$request->product_id;
            
        $wishlist->save();
        return redirect()->back()->with('success','Item added to the wishlist');
       
    }
    public function removeWishlist(Product $product){
        $wishlistItem=Wishlist::where('product_id',$product->id)->first();
        $wishlistItem->delete();
        return redirect()->back()->with('success', 'Item removed from Wishlist');
    }

}
