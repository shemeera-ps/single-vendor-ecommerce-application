<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Order;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Modules\Ynotz\EasyAdmin\Traits\HasMVConnector;
use Modules\Ynotz\SmartPages\Http\Controllers\SmartController;

class InvoiceController extends SmartController
{
    use HasMVConnector;

    public function __construct(Request $request, InvoiceService $service)
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

    public function checkout(Request $request){
        $totalPrice=0;
        $cartItems=Cart::where('user_id',auth()->user()->id)->get();
        foreach($cartItems as $item){
            $itemPrice = $item->product->price * $item->count;
            $totalPrice += $itemPrice;
        }
       $order=new Order;
       $order->user_id=auth()->user()->id;
       $order->total_price=$totalPrice;
       $order->status='Order Confirmed';
       $order->save();
       return redirect()->back()->with('success','Order Placed');
    }
}
