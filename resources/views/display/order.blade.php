@extends('display.app')
@section('content')
<x-categories :categories="$categories" />
<section id="products" class="w-full p-24 mb-20">
    <h3 class="text-center mb-12 text-dark-color text-2xl font-semibold">Your order's are Here</h3>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if($orders->count() > 0)
  


    <div class="">
        @foreach($orders as $order)
        <div class="flex  justify-center items-center gap-10  shadow-sm mb-10">
            @foreach($order->orderItem as $item)
            <div id="product" class="  py-10  relative transition-transform duration-300 ease-in-out">
                <img src="{{  $item->product->getSingleMediaUrl('image') }}" alt="" class="h-40">    
                <h4 class="p-2 text-lg">{{ $item->product->name }}</h4>
                <p>Packet of ({{$item->count}})</p>
                <p class="p-2 text-base"><i class="fa-solid fa-indian-rupee-sign pr-1"></i>{{ $item->price }}</p>
                
            </div>
            @endforeach
           
            <div> 
            <h3>Order Status</h3>
            <p>{{$order->status}}</p>
            <p>Order placed on: {{ $order->created_at->format('F j, Y h:i A') }}</p>
            <p>Total Price : {{$order->total_price}}</p>                   
                <h3>Product Delivered To</h3>
                    <p>{{$order->user->address->first()->address_line1}}</p>
                    <p>{{$order->user->address->first()->address_line2}}</p>
                    <p>{{$order->user->address->first()->city}}</p>
                    <p>{{$order->user->address->first()->state}}</p>
                    <p>{{$order->user->address->first()->pincode}}</p>
                </div>
        </div>
        @endforeach
    </div>
    @else

    <x-empty src="{{ asset('icons/bag.jpg') }}" imageDimensions="w-40" heading="You have no Orders yet" content="We have exsiting offers for you, fill your wardobe with class" buttonContent="Start Shopping" />
    @endif
</section>

<x-footer class="" />

@endsection()