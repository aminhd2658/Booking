<section>
    <form method="post" class="space-y-6"
          action="{{ isset($room) ? route('admin.rooms.update' , [$stay->id,$room->id]) : route('admin.rooms.store',$stay->id) }}">

        @csrf

        @isset($room)
            @method('put')
        @endisset


        <div>
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                          :value="old('name', isset($room) ? $room->name : null)" required autofocus
                          autocomplete="name"/>
        </div>


        <div>
            <x-input-label for="feature" :value="__('Feature')"/>
            <x-select-input id="features" name="features[]" class="mt-1 block w-full" required autocomplete="features"
                            multiple>
                @foreach($features as $feature)
                    @if(isset($stay,$currentFeatures) and in_array($feature->id,$currentFeatures))
                        <option selected value="{{ $feature->id }}">{{ $feature->name }}</option>
                    @else
                        <option value="{{ $feature->id }}">{{ $feature->name }}</option>
                    @endif
                @endforeach
            </x-select-input>
        </div>


        <div>
            <x-input-label for="description" :value="__('Description')"/>

            <x-textarea-input id="description" name="description" type="textarea" class="mt-1 block w-full"
                              required
                              autocomplete="description">
                {{old('description', isset($room) ? $room->description : null)}}
            </x-textarea-input>

        </div>



        <div>
            <x-input-label for="count" :value="__('Count')"/>
            <x-text-input id="count" name="count" type="text" class="mt-1 block w-full"
                          :value="old('count', isset($room) ? $room->count : null)" required
                          autocomplete="count"/>
        </div>



        <div>
            <x-input-label for="max_count_adults" :value="__('Max count adults')"/>
            <x-text-input id="max_count_adults" name="max_count_adults" type="text" class="mt-1 block w-full"
                          :value="old('max_count_adults', isset($room) ? $room->max_count_adults : null)" required
                          autocomplete="max_count_adults"/>
        </div>



        <div>
            <x-input-label for="max_count_children" :value="__('Max count children')"/>
            <x-text-input id="max_count_children" name="max_count_children" type="text" class="mt-1 block w-full"
                          :value="old('max_count_children', isset($room) ? $room->max_count_children : null)" required
                          autocomplete="max_count_children"/>
        </div>



        <div>
            <x-input-label for="price_per_night" :value="__('Price per night')"/>
            <x-text-input id="price_per_night" name="price_per_night" type="text" class="mt-1 block w-full"
                          :value="old('price_per_night', isset($room) ? $room->price_per_night : null)" required
                          autocomplete="price_per_night"/>
        </div>



        <div>
            <x-input-label for="discount_price_per_night" :value="__('Discount price per night')"/>
            <x-text-input id="discount_price_per_night" name="discount_price_per_night" type="text" class="mt-1 block w-full"
                          :value="old('discount_price_per_night', isset($room) ? $room->discount_price_per_night : null)"
                          autocomplete="discount_price_per_night"/>
        </div>




        <div class="flex items-center gap-4">
            @isset($room)
                <x-primary-button>{{ __('Edit') }}</x-primary-button>
            @else
                <x-primary-button>{{ __('Create') }}</x-primary-button>
            @endisset


        </div>


    </form>
</section>
