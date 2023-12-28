<img src="{{ $src }}" alt="">
    <div class="product_details flex bg-white flex-col hover:shadow-md">
    <div class="tags p-4 flex">
        @foreach( $tags as $tag)
            <a href="" class="bg-light-bg-color p-2 mr-2 rounded-lg ">{{$tag->tag}}</a>
         @endforeach
    </div>
    <h4 class="p-2 text-lg">{{ $productName }}</h4>
    <p class="p-2 text-base">{{ $productPrice }}</p>
</div>