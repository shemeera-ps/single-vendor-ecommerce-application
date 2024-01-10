<x-easyadmin::partials.adminpanel>
    <div class="pb-4">
        <h3 class="text-xl font-bold pb-3"><span>{{ $title }}</span>&nbsp;</h3>
        <div class="flex flex-row justify-center">
            <x-dynamic-component :component="$form['type']"
                :form="$form"
                :tabs="$tabs ?? []"
                :errors="$errors"
                :_old="$_old ?? []"
                 />
        </div>
    </div>
</x-easyadmin::partials.adminpanel>
