<x-panel-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create feature') }}
            </h2>

            <x-primary-link :href="route('admin.features.index')">{{ __('List') }}</x-primary-link>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('panel.admin.stays.features.partials.form')
                </div>
            </div>
        </div>
    </div>

</x-panel-layout>
