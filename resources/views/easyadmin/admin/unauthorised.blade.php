<x-easyadmin::partials.adminpanel>
    <div class="flex flex-col justify-center space-y-20 items-center h-full">
        <div class="text-2xl text-base-content text-opacity-50">
            {{ $message ?? 'You are not authorised to view this page.'}}
        </div>
        <div class="text-center">
            <button type="button" class="btn btn-sm btn-warning"
                @click.prevent.stop="window.history.back();">
                Go Back
            </button>
        </div>
    </div>
</x-easyadmin::partials.adminpanel>
