@php use App\Models\Booking;use App\Models\User;use Carbon\Carbon;use Illuminate\Support\Facades\Auth; @endphp
<x-panel-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bookings history') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-4">
                            Stay
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Counts
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Dates
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Tracking code
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Booking date
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Status
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($list !=  null)
                        @foreach($list as $item)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4">
                                    <div class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->room->stay->name }}</div>
                                    <div>
                                        <span>Room: </span>
                                        <span class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->room->name }}</span>
                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    <div>
                                        <span>Adults:</span>
                                        <span class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->count_adults }}</span>
                                    </div>
                                    <div>
                                        <span>Children:</span>
                                        <span class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->count_children }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->start_at }}</div>
                                    <div>TO</div>
                                    <div class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->end_at }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    {{ number_format($item->payment->price) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->payment->ref_num }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ Carbon::parse($item->payment->date)->format('M, d Y H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    @switch($item->status)
                                        @case(Booking::PENDING)
                                            <span
                                                class="rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">{{ ucfirst($item->status) }}</span>
                                            @break
                                        @case(Booking::ACCEPTED)
                                            <span
                                                class="rounded-full bg-green-50 px-3 py-1.5 font-medium text-green-600 hover:bg-green-100">{{ ucfirst($item->status) }}</span>
                                            @break
                                        @case(Booking::REJECTED)
                                            <span
                                                class="rounded-full bg-red-50 px-3 py-1.5 font-medium text-red-600 hover:bg-red-100">{{ ucfirst($item->status) }}</span>
                                            @break
                                    @endswitch
                                    @if(Auth::user()->role == User::ADMIN and $item->status == Booking::PENDING)

                                        <form method="post" action="{{ route('admin.bookings.update',$item->id) }}"
                                              class="space-y-1 mt-4">
                                            @csrf
                                            @method('put')

                                            <div>
                                                <x-select-input id="status" name="status" class="block w-full"
                                                                required>
                                                    <option value="{{ Booking::REJECTED }}">Rejected</option>
                                                    <option value="{{ Booking::ACCEPTED }}">Accepted</option>
                                                </x-select-input>
                                            </div>

                                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                                        </form>

                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>


        </div>
    </div>


</x-panel-layout>
