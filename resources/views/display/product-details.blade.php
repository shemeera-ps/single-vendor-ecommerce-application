@extends('display.app')
@section('content')
<x-categories :categories="$categories" />



<section id="products" class="w-full p-24 flex flex-col">
    <h3 class="text-center mb-12 text-dark-color text-2xl font-semibold">{{ $product->name }}</h3>
       
        <div id="product" class="relative transition-transform duration-300 ease-in-out flex">
            
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
    <div class="flex justify-center items-center">
    <div class="flex group w-1/2 h-2/3">
                <div class="w-full relative transition-opacity duration-500 ease-in-out">
                   
                        <img alt="{{asset('images/product_01.jpg')}}" src="{{  $product->getSingleMediaUrl('image') }}" class="w-full group-hover:hidden">
                        <img alt="{{asset('images/product_01.jpg')}}" src="{{  $product->getSingleMediaUrl('imageSecond') }}" class="w-full hidden group-hover:flex">
                    </a>
                </div>
            </div>
    </div>
    <div class="product_details flex bg-white w-1/2 ">
                <!-- <div class="tags p-4 flex">
                    @foreach($product->tags as $tag)
                        <a href="" class="bg-light-bg-color p-2 mr-2 rounded-lg ">{{$tag->tag}}</a>
                    @endforeach
                </div> -->
                <div class="">
                    <h2 class="text-xl hover:text-green-500 mb-2 font-bold">{{ $product->name }}</h2>
                    <h2 class="text-base mb-2">Product Description</h2>
                    @foreach (explode("\n", $product->description) as $line)
                        @if (!empty($line))
                            <p class="mb-1"><i class="fa-solid fa-tag text-red-600 text-lg"></i> {!! nl2br(e($line)) !!}</p>
                        @endif
                    @endforeach
                    <p class="p-2 text-base"><i class="fa-solid fa-indian-rupee-sign pr-1"></i>{{$product->price}}</p>
                    @if($product->quantity<=4)

                        <p class="p-2 text-base">Only few left</p>
                    @elseif($product->quantity == 0)
                        <p class="p-2 text-base">Out of Stock</p>
                    @else
                        <p class="p-2 text-base">{{ $product->quantity }} on stock</p>
                    @endif
                    <p class="font-semibold">Availbale Sizes</p>
                    <div class="my-2 flex">
                    
                    
                    @foreach($product->sizes as $size)
                    <input type="radio" name="size" id="{{$size->size}}" value="{{ $size->id}}" class="mr-4">
                        <label for="{{$size->size}}" class="pl-1 pt-1 mr-10">{{$size->size}}</label>
                    
                    @endforeach
                    </div>
                    <div class="cart  hover:bg-green-500 flex justify-center py-2 bg-primary-color text-white   mt-4 w-40">
                        <form action="{{ route('addToCart') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="flex">
                                <a href=""><i class="ri-shopping-cart-line pr-2 "></i></a>
                                <p class="text-white">ADD TO CART</p>
                            </button>
                        </form>
                    </div>
                </div>
               
                

            </div>
           
            
            
            
        </div>
</section>


<x-footer />
@endsection('content')