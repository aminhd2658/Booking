<x-panel-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Rooms: ') . $stay->name }}
                </h2>

                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   href="{{ route('admin.stays.index') }}">
                    {{ __('Back to stays') }}
                </a>
            </div>


            <x-primary-link
                :href="route('admin.rooms.create',$stay->id)">{{ __('Create new room') }}</x-primary-link>


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
                            Count
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Max count adults
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Max count children
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Price per night
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
                            </th>
                            <td class="px-6 py-4">
                                {{ $item->count }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->max_count_adults }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->max_count_children }}
                            </td>
                            <td class="px-6 py-4">
                                @if($item->discount_price_per_night > 0)
                                    <div>
                                        <span>{{ number_format($item->final_price_per_night) }}</span>
                                    </div>
                                    <div>
                                        <span
                                            style="text-decoration: line-through;">{{ number_format($item->price_per_night) }}</span>
                                        <span
                                            style="background: #f30000;border-radius: 30%;padding: 0 3px;color: white;font-size: 12px">{{ $item->discount_percent }} %</span>
                                    </div>
                                @else
                                    {{ number_format($item->price_per_night) }}
                                @endif
                            </td>
                            <td class="px-6 py-4">


                                <x-primary-link
                                    :href="route('admin.disable-days.index' , [$item->id])">{{ __('Disabled days') }}</x-primary-link>


                                <x-primary-link
                                    :href="route('admin.rooms.edit' , [$item->stay_id , $item->id])">{{ __('Edit') }}</x-primary-link>


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
            <form method="post" action="{{ route('admin.rooms.destroy' , [$item->stay_id , $item->id]) }}" class="p-6">
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
