<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Services\CartService;
use Illuminate\Http\Request;
use Modules\Ynotz\EasyAdmin\Traits\HasMVConnector;
use Modules\Ynotz\SmartPages\Http\Controllers\SmartController;
use App\Models\Cart;
use App\Models\Quantity;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Category;

class CartController extends SmartController
{
    use HasMVConnector;

    public function __construct(Request $request, CartService $service)
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
    public function addToCart(Request $request){
        if(auth()->user()){
            $request->validate([
                'product_id'=>'required|exists:products,id',
            ]);
            $exsistingItem=Cart::where('user_id',auth()->user()->id)
                            ->where('product_id',$request->product_id)
                            ->first();
            if($exsistingItem && $exsistingItem->count > 0){
                return redirect()->back()->with('error','Item already in the  cart');
    
            }
            
            
            $product = Product::find($request->product_id);
            $totalQuantity=$product->quantity;
            if($totalQuantity){
                $cart=new Cart;
                $cart->user_id=auth()->user()->id;
                $cart->product_id=$product->id;
                $cart->count=1;
                $cart->price = $product->price;
                $totalQuantity-=1;
                $cart->save();
                Wishlist::where('product_id',$cart->product_id)->delete();
    
                return redirect()->back()->with('success',"{$cart->product->name } added to the cart");
            }
            else{
                return redirect()->back()->with('error','Out of Stock');
            }
        }
       
        

    }
    public function cartIndex(){
        if(auth()->user()){
            $categories=Category::all();
        $addresses= Address::where('user_id',auth()->user()->id)->with('tag')->get();
        $cartItems=Cart::where('user_id',auth()->user()->id)->paginate(3);
        return view('display.cart',['cartItems'=>$cartItems,'categories'=>$categories,'addresses'=>$addresses]);
        }
        
    }

    public function plusCart(Product $product){
        
        $totalQuantity = $product->quantity;

        if ($totalQuantity > 0){
            // Retrieve the cart item and update the count
            $cartItem = Cart::where('product_id', $product->id)->first();
   
            if ($cartItem) {
                $cartItem->count += 1;
                $cartItem->price =$cartItem->price * $cartItem->count;
                $totalQuantity-=1;
                $cartItem->save();
   
                return redirect()->back()->with('success', "Cart has {$cartItem->count} of {$cartItem->product->name }");
            }
        } 
        else {
            return redirect()->back()->with('error', 'Out of Stock');
        }
    }
    public function minusCart(Product $product){
        $totalQuantity = $product->quantity;

        
            $cartItem = Cart::where('product_id', $product->id)->first();
   
            if ($cartItem) {
                $cartItem->count -= 1;
                $cartItem->price =$cartItem->price * $cartItem->count;
                $totalQuantity+=1;
                if($cartItem->count == 0){
                    $cartItem->delete();
                }
                else{
                    $cartItem->save();
                }
                
                
   
                return redirect()->back()->with('success',  "Cart has {$cartItem->count} of {$cartItem->product->name }");
            }
        
    }
    public function deleteCart(Product $product){
        $totalQuantity = $product->quantity;

        
            $cartItem = Cart::where('product_id', $product->id)->first();
            $totalQuantity+=$cartItem->count;
            $cartItem->delete();
            return redirect()->back()->with('success', 'Item deleted from  cart');
       
    }

}
