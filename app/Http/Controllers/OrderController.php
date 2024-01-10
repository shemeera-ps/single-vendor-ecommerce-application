<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Models\Cart;
use Modules\Ynotz\EasyAdmin\Traits\HasMVConnector;
use Modules\Ynotz\SmartPages\Http\Controllers\SmartController;

class OrderController extends SmartController
{
    use HasMVConnector;

    public function __construct(Request $request, OrderService $service)
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
    public function orderIndex()
    {
        $orders = Order::with('user.address')->where('user_id', auth()->user()->id)->get();
        $orderItems = [];
    
        foreach ($orders as $order) {
            $orderItems[$order->id] = $order->orderItem()->with('product')->orderBy('created_at')->get();
        }
        $categories = Category::all();
        return view('display.order', compact('orders', 'categories', 'orderItems'));
    }
    
    public function checkout(Request $request)
    {
        $request->validate([
            'total_price' => 'required'
        ]);
        $order = new Order;
        $order->user_id = auth()->user()->id;
        $order->total_price = $request->total_price;
        $order->status = 'Order Placed';
        $order->save();
        //   dd($order);
        $orderId = $order->id;
        $cartItems = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($cartItems as $item) {
            $orderItem = new OrderItem;
            $orderItem->order_id = $orderId;
            $orderItem->product_id = $item->product->id;
            $orderItem->price = $item->price;
            $orderItem->count = $item->count;
            $orderItem->save();
            $item->delete();
        }

        return redirect('payments');
    }
    public function payments(Request $request){
        $categories = Category::all();
        return view('display.payments',['categories'=>$categories]);
    }
}
