<section>
    <form method="post" class="space-y-6"
          action="{{ isset($feature) ? route('admin.features.update' , $feature->id) : route('admin.features.store') }}"
          enctype="multipart/form-data">

        @csrf

        @isset($feature)
            @method('put')
        @endisset


        <div>
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                          :value="old('name', isset($feature) ? $feature->name : null)" required autofocus
                          autocomplete="name"/>
        </div>





        <div>
            <x-input-label for="icon" :value="__('Icon')"/>
            <x-text-input id="icon" name="icon" type="file" class="mt-1 block w-full"
                          autocomplete="icon"/>
        </div>



        <div>
            <x-input-label for="description" :value="__('Description')"/>

            <x-textarea-input id="description" name="description" type="textarea" class="mt-1 block w-full"
                              required
                              autocomplete="description">
                {{old('description', isset($feature) ? $feature->description : null)}}
            </x-textarea-input>

        </div>


        <div class="flex items-center gap-4">
            @isset($feature)
                <x-primary-button>{{ __('Edit') }}</x-primary-button>
            @else
                <x-primary-button>{{ __('Create') }}</x-primary-button>
            @endisset

        </div>


    </form>
</section>
