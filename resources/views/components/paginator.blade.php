
@if ($products->hasPages())
<div class="flex items-center justify-center w-full mt-20">
  <ul class="flex">
    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
      <a href="{{ $url }}"  class="mr-10 bg-gray-100 rounded-full bg-opacity-15 backdrop-blur-md shadow-md text-center p-2"></a>
    @endforeach
  </ul>
</div>
@endif
