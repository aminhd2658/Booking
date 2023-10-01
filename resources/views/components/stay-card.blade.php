@props(['stay'])

<article class="flex max-w-xl flex-col items-start justify-between m-2">
    <div class="group relative">
        <img style="height: 200px;width: 100%"
             src="{{ asset($stay->image) }}"
             alt="" class="rounded bg-gray-50">

        @if($stay->rating > 0)
            <x-rating class="mt-3" :value="$stay->rating"/>
        @endif

        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
            @php echo $stay->name @endphp
        </h3>
        <div class="text-xs">
            {{ $stay->province->country->name . ' - ' . $stay->province->name }}
        </div>
        <div class="flex items-center mt-2 mb-3 gap-x-4 text-xs">
            @foreach($stay->features as $feature)
                <span class="flex rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100"
                      style="font-size: 11px;">
                    @if($feature->icon != null)
                        <img width="10" class="mr-1" src="{{asset($feature->icon)}}" alt="{{$feature->name}}">
                    @endif
                    {{$feature->name}}
                </span>
            @endforeach
        </div>

        <x-primary-link :href="route('stays.show',$stay->id)">
            {{ __('See availability') }}
            <span aria-hidden="true" class="ml-2">&rarr;</span>
        </x-primary-link>

    </div>
</article>
