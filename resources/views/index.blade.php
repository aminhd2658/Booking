<x-main-layout :pageTitle="$pageTitle" :pageDescription="$pageDescription">

    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div
            class="mx-auto grid max-w-2xl gap-x-8 gap-y-16 border-gray-200 lg:mx-0 lg:max-w-none lg:grid-cols-4">

            @foreach($stays as $stay)
                <x-stay-card :stay="$stay"/>
            @endforeach

        </div>
    </div>

</x-main-layout>
