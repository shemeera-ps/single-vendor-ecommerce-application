@extends('display.app')
@section('content')
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
@endsection