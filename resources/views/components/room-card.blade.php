@props(['room'])

<article class="flex max-w-xl flex-col items-start justify-between p-5 m-2 border rounded">
    <div class="group relative">
        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
            @php echo $room->name @endphp
        </h3>
        <p class="text-justifuy">
            @php echo $room->description @endphp
        </p>
        <hr class="my-2">
        <div class="items-center mt-2 mb-3 text-xs">
            @foreach($room->features as $feature)
                <div
                    class="inline-flex rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100"
                    style="font-size: 11px;">
                    @if($feature->icon != null)
                        <img width="10" class="mr-1" src="{{asset($feature->icon)}}" alt="{{$feature->name}}">
                    @endif
                    {{$feature->name}}
                </div>
            @endforeach
        </div>

        <div>
            @if($room->discount_price_per_night > 0)
                <div>
                    <span style="visibility: hidden">Price per night:</span>
                    <span style="text-decoration: line-through;">{{ number_format($room->price_per_night) }}</span>
                    <span style="background: #f30000;border-radius: 30%;padding: 0 3px;color: white;font-size: 12px">{{ $room->discount_percent }} %</span>
                </div>
                <div>
                    <span>Price per night:</span>
                    <span>{{ number_format($room->final_price_per_night) }}</span>
                </div>
            @else
                <span>Price per night:</span>
                <span>{{ number_format($room->price_per_night) }}</span>
            @endif
        </div>
        <br>

        @auth
            <form method="POST" action="{{ route('booking.store', [$room->stay_id,$room->id]) }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="start_at" :value="__('Start at') "/>
                    <x-text-input id="start_at" name="start_at" type="date" class="mt-1 block w-full"  required/>
                </div>

                <div>
                    <x-input-label for="end_at" :value="__('End at') "/>
                    <x-text-input id="end_at" name="end_at" type="date" class="mt-1 block w-full"  required/>
                </div>



                <div>
                    <x-input-label for="count_adults"
                                   :value="__('Count adults (max: ') . $room->max_count_adults  .  __(')') "/>
                    <x-text-input id="count_adults" name="count_adults" type="number" class="mt-1 block w-full"
                                  :max="$room->max_count_adults" required/>
                </div>


                @if($room->max_count_children > 0)
                    <div>
                        <x-input-label for="count_children"
                                       :value="__('Count children (max: ') . $room->max_count_children  .  __(')') "/>
                        <x-text-input id="count_children" name="count_children" type="number" class="mt-1 block w-full"
                                      :max="$room->max_count_children" required/>
                    </div>
                @endif


                <x-primary-button>
                    {{ __('Reserve') }}
                    <span aria-hidden="true" class="ml-2">&check;</span>
                </x-primary-button>
            </form>
        @else

            <x-primary-link :href="route('login')">
                {{ __('Login to reserve') }}
            </x-primary-link>
        @endauth
    </div>
</article>
