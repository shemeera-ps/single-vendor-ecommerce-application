<x-easyadmin::partials.adminpanel>
    <div class="flex flex-col h-full">
        <div class="text-2xl text-base-content text-opacity-50 w-full">
            Unable to display the page.
            @if (config('app.debug'))
                <div class="text-sm p-4 max-w-2/3">Error:<br>{{$error}}</div>
            @else
                <div class="text-sm p-4 max-w-2/3">Unexpected error</div>
            @endif
        </div>
        <div></div>
    </div>
</x-easyadmin::partials.adminpanel>
