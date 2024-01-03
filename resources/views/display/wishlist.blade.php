@extends('display.app')
@section('content')
<x-categories :categories="$categories" />

<section id="products" class="w-full p-24 mb-20 ">
    <h3 class="text-center mb-12 text-dark-color text-2xl font-semibold">Your Wishlist is Here</h3>
    
    @if( $wishlists->count() > 0 )
    <div class="product grid lg:grid-cols-4 gap-8 md:grid-cols-2  sm:grid-cols-2">
        @foreach($wishlists as $wishlist)
        <div id="product" class="relative transition-transform duration-300 ease-in-out">
           
            <form action="{{ route('removeWishlist' ,['product' => $wishlist->product->id ])}}" method="post">  
                 @csrf
                <input type="hidden" name="product_id" value="{{ $wishlist->product->id }}">
                <button type="submit" class="flex">
                    <li class="text-base mr-4 absolute right-4 top-4 hidden transition-transform duration-300 ease-in-out">
                        <a href="#" id="wishlist" class="transition-transform duration-300 ease-in-out font-light hover:text-dark-color">
                            <i class="ri-delete-bin-line text-white  p-2 rounded-full bg-primary-color bg-opacity-15 backdrop-blur-md shadow-md text-center"></i>
                        </a>
                    </li>        
                </button>
            </form>
            
            
            <li class="text-base mr-4 absolute right-4 top-14 hidden transition-transform duration-300 ease-in-out z-10">
                <a href="#" id="wishlist" class="transition-transform duration-300 ease-in-out font-light hover:text-dark-color">
                    <i class="ri-share-forward-line text-white  p-2 rounded-full bg-primary-color bg-opacity-15 backdrop-blur-md shadow-md text-center"></i>
                </a>
            </li>
            
            <div class="cart  hover:bg-green-500 flex justify-center py-2 bg-primary-color text-white transition-transform duration-300 ease-in-out transform translate-y-full absolute left-0 right-0 bottom-0 w-full opacity-0 mt-4">
                <form action="{{ route('addToCart') }}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $wishlist->product->id }}">
                    <button type="submit" class="flex">
                        <a href=""><i class="ri-shopping-cart-line pr-2 "></i></a>
                        <p>ADD TO CART</p>
                    </button>
                </form>
            </div>
            <div class="flex group">
                <div class="w-full relative transition-opacity duration-500 ease-in-out h-96">
                   
                        <img alt="{{asset('images/product_01.jpg')}}" src="{{  $wishlist->product->getSingleMediaUrl('image') }}" class="w-full group-hover:hidden">
                        <img alt="{{asset('images/product_01.jpg')}}" src="{{  $wishlist->product->getSingleMediaUrl('imageSecond') }}" class="w-full hidden group-hover:flex">
                    </a>
                </div>
            </div>
            <div class="product_details flex bg-white flex-col hover:shadow-md">
                <div class="tags p-4 flex">
                    @foreach($wishlist->product->tags as $tag)
                        <a href="" class="bg-light-bg-color p-2 mr-2 rounded-lg ">{{$tag->tag}}</a>
                    @endforeach
                </div>
                <h4 class="p-2 text-lg">{{$wishlist->product->name}}</h4>
                <p class="p-2 text-base">{{$wishlist->product->price}}</p>
            </div>

          
        </div>
        @endforeach
    </div>
    @else
    <x-empty 
    src="{{ asset('icons/wishlist.webp') }}"
     imageDimensions="h-96"
     heading="Your Wishlist is Empty"
     content="Looks like you haven't added anything to your wishlist yet"
     buttonContent="Add Items"/>
    @endif

    <x-paginator :products="$wishlists" />
</section>
<x-footer  class=""/>

@endsection()