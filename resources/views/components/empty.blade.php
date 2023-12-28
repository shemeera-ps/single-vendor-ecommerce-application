    <div class="flex justify-center items-center flex-col">
        <img src="{{ $src }}" alt="" class="{{ $imageDimensions}}">
        <h3>{{ $heading }}</h3>
        <p>{{ $content }}</p>
        <a href="{{ route('productIndex') }}" class="w-60 h-20 bg-white shadow text-center py-4 my-4 rounded-3xl text-primary-color">{{ $buttonContent }}</a>
    </div>
   
    