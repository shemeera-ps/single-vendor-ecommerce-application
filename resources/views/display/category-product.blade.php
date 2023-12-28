@extends('display.app')
@section('content')
<x-categories :categories="$categories" />



<section id="products" class="w-full p-24">
    <h3 class="text-center mb-12 text-dark-color text-2xl font-semibold">Currently Popular Items</h3>
    <div class="product grid lg:grid-cols-4 gap-8 md:grid-cols-2 md:gap-x-8 ">
        @foreach($products as $product)
        <div id="product" class="relative transition-transform duration-300 ease-in-out">
            
            <form action="{{ route('addToWishlist') }}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="flex">
                        <li class="text-base mr-4 absolute right-4 top-4 hidden transition-transform duration-300 ease-in-out">
                            <a href="#" id="wishlist" class="transition-transform duration-300 ease-in-out font-light hover:text-dark-color">
                                <i class="ri-heart-add-line text-white  p-2 rounded-full bg-primary-color bg-opacity-15 backdrop-blur-md shadow-md text-center"></i>
                            </a>
                        </li>
                    </button>
            </form>
            
            <li class="text-base mr-4 absolute right-4 top-14 hidden transition-transform duration-300 ease-in-out">
                <a href="#" id="wishlist" class="transition-transform duration-300 ease-in-out font-light hover:text-dark-color">
                    <i class="ri-share-forward-line text-white  p-2 rounded-full bg-primary-color bg-opacity-15 backdrop-blur-md shadow-md text-center"></i>
                </a>
            </li>
            <img src="{{asset('images/product_01.jpg')}}" alt="">
            <div class="cart  hover:bg-green-500 flex justify-center py-2 bg-primary-color text-white transition-transform duration-300 ease-in-out transform translate-y-full absolute left-0 right-0 bottom-0 w-full opacity-0 mt-4">
                <form action="{{ route('addToCart') }}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="flex">
                        <a href=""><i class="ri-shopping-cart-line pr-2 "></i></a>
                        <p class="text-white">ADD TO CART</p>
                    </button>
                </form>
            </div>
            <div class="product_details flex bg-white flex-col hover:shadow-md">
                <div class="tags p-4 flex">
                    @foreach($product->tags as $tag)
                        <a href="" class="bg-light-bg-color p-2 mr-2 rounded-lg ">{{$tag->tag}}</a>
                    @endforeach
                </div>
                <h4 class="p-2 text-lg">{{$product->name}}</h4>
                <p class="p-2 text-base"><i class="fa-solid fa-indian-rupee-sign pr-1"></i>{{$product->price}}</p>
                @if($product->quantity->quantity<=4)

                    <p class="p-2 text-base">Only few left</p>
                @elseif($product->quantity->quantity == 0)
                <p class="p-2 text-base">Out of Stock</p>
                @else
                <p class="p-2 text-base">{{ $product->quantity->quantity }} on stock</p>
                @endif

            </div>
        </div>
        @endforeach
    </div>
</section>


<x-footer />
@endsection('content')