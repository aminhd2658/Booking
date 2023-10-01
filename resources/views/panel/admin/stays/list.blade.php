<x-panel-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Stays') }}
            </h2>

            <x-primary-link :href="route('admin.stays.create')">{{ __('Create new stay') }}</x-primary-link>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-4">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Address
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->name }}
                                <span>(Rooms: {{ $item->rooms()->count() }})</span>
                            </th>
                            <td class="px-6 py-4">
                                <div>
                                    {{ $item->province->country->name }}
                                    -
                                    {{ $item->province->name }}
                                </div>
                                {{ $item->address }}
                            </td>
                            <td class="px-6 py-4">

                                <x-primary-link
                                    :href="route('admin.stays.edit' , $item->id)">{{ __('Edit') }}</x-primary-link>

                                <x-primary-link
                                    :href="route('admin.rooms.index' , $item->id)">{{ __('Rooms') }}</x-primary-link>

                                <x-danger-button
                                    x-data="{{ $item }}"
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-item-deletion')"
                                >{{ __('Delete') }}</x-danger-button>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>

    @if(count($list) > 0)
    <x-modal name="confirm-item-deletion" focusable>
        <form method="post" action="{{ route('admin.stays.destroy' , $item->id) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete this item?') }}
            </h2>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
    @endif



</x-panel-layout>
