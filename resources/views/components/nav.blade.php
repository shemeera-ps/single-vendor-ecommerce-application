<header class="w-full lg:shadow-sm ">
    <div class="section1 w-full px-[0.8vw] py-2 bg-light-bg-color">
        <div class="section1_container flex justify-between items-center sm:flex-col lg:flex-row md:flex-row">
            <div class="left-section flex items-center sm:border-b sm:border-light-bg-color sm:mb-1">
                <div class="ml-10 flex text-xs">
                    <img src="{{asset('icons/flag1.png')}}" alt="" class="w-4 h-4 mr-1">
                    <span>IND</span>
                    <i class="ri-arrow-down-s-line"></i>
                </div>
                <div class="ml-10 text-xs">Free Shipping on all orders. No minimum purchases*</div>
            </div>
            <ul class="right-section flex items-center">
                <li class=" pr-4 text-xs">Need Help?</li>
                <li class=" pr-4 text-xs">Theme FAQs</li>
                <li class=" pr-4 text-xs">Blog</li>
                <li class="pr-4 text-xs">Gift Certificates</li>
                <li></li>
            </ul>
        </div>
    </div>


    <div class="menu-bar lg:hidden md:border-b sm:border-b md:flex sm:flex sm:pl-2 md:pl-2">
        <i class="ri-menu-line" id="menu"></i>
    </div>

<div class="section2 sm:w-1/2 sm:flex-col lg:w-full md:h-2/3 sm:h-2/3 md:bg-white sm:bg-white sm:border-none md:border-none sm:fixed md:fixed md:flex sm:flex sm:left-[-28px]  md:left-[-28px] md:pl-20 sm:pl-20 md:pr-10 sm:pr-10 sm:top-0 md:top-0 sm:z-50 md:z-50  md:w-1/2  md:flex-col md:justify-center md:items-center lg:flex lg:flex-row lg:justify-between lg:items-start lg:my-0 lg:px-20  sm:mx-0  lg:py-8  lg:border-light-bg-color lg:relative">
    <i class="ri-close-line lg:hidden sm:flex md:flex absolute md:left-96 sm:left-64 md:top-8 sm:top-8 text-2xl text-secondary-color cursor-pointer" id="close"></i>
    
    <div class="logo sm:flex lg:flex lg:relative md:flex sm:absolute md:absolute md:left-20 md:top-16 sm:top-20 lg:top-0 lg:justify-center lg:items-center sm:justify-center sm:items-center md:justify-center md:items-centerlg:flex-col md:flex-col sm:flex-col md:pl-10 sm:pl-10 ">
        <h1 class="text-secondary-color text-lg md:text-xl lg:text-2xl">Shop With Us</h1>
        <p class="text-center text-stone-600 text-sm md:text-base">Everything You Need</p>
    </div>

    <div class="search lg:relative  lg:flex md:flex sm:absolute md:absolute md:left-20 md:top-36 sm:top-36 md:pl-4 sm:pl-4 lg:pl-0 lg:top-0">
        <form action="{{ route('search') }}" method="post">
            @csrf
            <input type="text" name="search" id="" placeholder="Search for a product..." class="p-2 md:p-[1vw]  md:w-96 rounded-xl">
            <button type="submit" class="absolute right-0 bg-transparent border-b cursor-pointer p-2 md:p-[1vw]"><i class="ri-search-line text-2xl text-center text-dark-color"></i></button>
        </form>
    </div>

    <div class="nav-links  lg:flex lg:flex-row md:flex sm:absolute md:absolute md:left-20 md:top-56 sm:top-56 sm:flex sm:flex-col md:flex-col md:pl-20 sm:pl-20 lg:pl-0 lg:relative lg:top-0">
        <ul class="flex sm:flex justify-center items-center md:flex-col sm:flex-col lg:flex-row">
            <li class="text-sm md:text-base lg:text-lg lg:mr-4 md:mr-0 sm:mr-0 md:pb-4 sm:pb-4"><a href="{{ route('productIndex') }}" class="lg:text-base lg:transition-transform lg:duration-300 lg:ease-in-out lg:font-light lg:hover:text-dark-color">Home</a></li>
            <li class="text-sm md:text-base lg:text-lg lg:mr-4 md:mr-0 sm:mr-0 md:pb-4 sm:pb-4"><a href="{{ route('orderIndex') }}" class="lg:text-base lg:transition-transform lg:duration-300 lg:ease-in-out lg:font-light lg:hover:text-dark-color">Orders</a></li>
            <!-- Wishlist -->
            @php
                $wishlistItemsCount = 0; // Default value
                if(auth()->user()) {
                    $wishlistItemsCount = auth()->user()->wishlist()->count();
                }
            @endphp
            <div >
                <li class="text-sm md:text-base lg:text-lg lg:mr-4 md:mr-0 sm:mr-0 md:pb-4 sm:pb-4 relative">
                    <a href="{{ route('wishlistIndex') }}" id="wishlist" class="lg:mr-2 transition-transform duration-300 ease-in-out font-light hover:text-dark-color">
                        <i class="ri-heart-add-line text-secondary-color p-2 rounded-full bg-opacity-15 backdrop-blur-md shadow-md text-center"></i>

                    </a>
                    <span class="absolute left-6 right-2 bottom-8 text-white w-6 rounded bg-opacity-15 bg-primary-color backdrop-blur-md shadow-md text-center">{{ $wishlistItemsCount }}</span>
                </li>
            </div>
            @php
                $itemCount=0;
                if(auth()->user()){
                   $cartItems=auth()->user()->cart;
                   if($cartItems){
                    foreach($cartItems as $item){
                        $itemCount+=$item->count;
                    }
                    
                   }
                }
            @endphp
            <div >
                <li class="text-sm md:text-base lg:text-lg lg:mr-4 md:mr-0 sm:mr-0 md:pb-4 sm:pb-4 relative">
                    <a href="{{ route('cartIndex') }}" class="transition-transform duration-300 ease-in-out font-light hover:text-dark-color lg:mr-2">
                        <i class="ri-shopping-cart-line text-secondary-color p-2 rounded-full bg-opacity-15 backdrop-blur-md shadow-md text-center"></i>
                        
                    </a>
                    <span class="absolute left-6 right-2 bottom-8 text-white w-6 rounded bg-opacity-15 bg-primary-color backdrop-blur-md shadow-md text-center">{{ $itemCount}}</span>   
                </li>
            </div>
           
            <!-- User -->
            <li class="text-sm md:text-base lg:text-lg lg:mr-4 md:mr-0 sm:mr-0 md:pb-4 sm:pb-4">
                <a href="{{ route('login') }}" class="transition-transform duration-300 ease-in-out font-light hover:text-dark-color">
                    <i class="ri-user-line text-secondary-color p-2 rounded-full bg-opacity-15 backdrop-blur-md shadow-md text-center"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
{{$slot}}
</header>



            