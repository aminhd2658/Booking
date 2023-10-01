<section>
    <form method="post" class="space-y-6"
          action="{{ isset($stay) ? route('admin.stays.update' , $stay->id) : route('admin.stays.store') }}"
          enctype="multipart/form-data">
        @csrf

        @isset($stay)
            @method('put')
        @endisset


        <div>
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                          :value="old('name', isset($stay) ? $stay->name : null)" required autofocus
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
            <x-input-label for="image" :value="__('Image')"/>
            <x-text-input id="image" name="image" type="file" class="mt-1 block w-full"
                          autocomplete="image"/>
        </div>


        <div>
            <x-input-label for="country" :value="__('Country')"/>

            <x-select-input id="country" name="country" class="mt-1 block w-full" required autocomplete="country">
                @foreach($countries as $country)
                    @if(isset($stay) and $stay->province->country_id == $country->id)
                        <option selected value="{{ $country->id }}">{{ $country->name }}</option>
                    @else
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endif
                @endforeach
            </x-select-input>
        </div>

        <div>
            <x-input-label for="province" :value="__('Province')"/>

            <x-select-input id="province" name="province" class="mt-1 block w-full" required autocomplete="province">
                @foreach($provinces as $province)
                    @if(isset($stay) and $stay->province_id == $province->id)
                        <option selected value="{{ $province->id }}">{{ $province->name }}</option>
                    @else
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                    @endif
                @endforeach
            </x-select-input>

        </div>

        <div>
            <x-input-label for="address" :value="__('Address')"/>
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                          :value="old('address', isset($stay) ? $stay->address : null)" required autofocus
                          autocomplete="address"/>
        </div>


        <div>Map</div>

        <div>
            <x-input-label for="map_lat" :value="__('Lat')"/>
            <x-text-input id="map_lat" name="map_lat" type="text" class="mt-1 block w-full"
                          :value="old('map_lat', isset($stay) ? $stay->map_lat : null)" required
                          autocomplete="map_lat"/>
        </div>

        <div>
            <x-input-label for="map_lng" :value="__('Lng')"/>
            <x-text-input id="map_lng" name="map_lng" type="text" class="mt-1 block w-full"
                          :value="old('map_lng', isset($stay) ? $stay->map_lng : null)" required
                          autocomplete="map_lng"/>
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')"/>
            <x-textarea-input id="description" name="description" type="textarea" class="mt-1 block w-full"
                           required
                          autocomplete="description">
                {{old('description', isset($stay) ? $stay->description : null)}}
            </x-textarea-input>
        </div>

        <div class="flex items-center gap-4">
            @isset($stay)
                <x-primary-button>{{ __('Edit') }}</x-primary-button>
            @else
                <x-primary-button>{{ __('Create') }}</x-primary-button>
            @endisset


        </div>


    </form>
</section>
