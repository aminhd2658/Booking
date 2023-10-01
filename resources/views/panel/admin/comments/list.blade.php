@php use App\Models\Booking;use App\Models\Comment;use App\Models\User;use Carbon\Carbon;use Illuminate\Support\Facades\Auth; @endphp
<x-panel-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comments') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-4">
                            User
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Stay
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Content
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Star
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Status
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
                                class="px-6 py-4">
                                <span
                                    class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->author->name }}</span>
                            </th>
                            <td class="px-6 py-4">
                                {{ $item->stay->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->content }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->star }}
                            </td>
                            <td class="px-6 py-4">
                                {{ Carbon::parse($item->created_at)->format('M, d Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                @switch($item->status)
                                    @case(Comment::PENDING)
                                        <span
                                            class="rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">{{ ucfirst($item->status) }}</span>
                                        @break
                                    @case(Comment::ACCEPTED)
                                        <span
                                            class="rounded-full bg-green-50 px-3 py-1.5 font-medium text-green-600 hover:bg-green-100">{{ ucfirst($item->status) }}</span>
                                        @break
                                    @case(Comment::REJECTED)
                                        <span
                                            class="rounded-full bg-red-50 px-3 py-1.5 font-medium text-red-600 hover:bg-red-100">{{ ucfirst($item->status) }}</span>
                                        @break
                                @endswitch
                            </td>
                            <td class="px-6 py-4">
                                <form method="post" action="{{ route('admin.comments.update',$item->id) }}"
                                      class="space-y-1 mt-4">
                                    @csrf
                                    @method('put')

                                    <div>
                                        <x-select-input id="status" name="status" class="block w-full"
                                                        required>
                                            <option value="{{ Comment::PENDING }}">Pending</option>
                                            <option value="{{ Comment::REJECTED }}">Rejected</option>
                                            <option value="{{ Comment::ACCEPTED }}">Accepted</option>
                                        </x-select-input>
                                    </div>

                                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                                </form>

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
            <form method="post" action="{{ route('admin.comments.destroy' , $item->id) }}" class="p-6">
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
