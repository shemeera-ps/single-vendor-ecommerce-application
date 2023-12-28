<div class="category_container">
    <div class="slider">
        <div class="flex-center slide-track">
            @foreach($categories as $category)
                <div class="slide flex-center">
                    <img src="{{ asset('assets/products/shoe1-1.jpg')}}" alt="" >
                    <a href="{{$category->id}}">{{$category->name}}</a>
                </div>
            @endforeach
        </div>
    </div>
</div>