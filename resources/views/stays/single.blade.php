<x-main-layout :pageTitle="$pageTitle" :pageDescription="$stay->address">

    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="flex items-center mt-2 mb-3 text-xs">
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
            <x-rating class="my-3" :value="$stay->rating"/>

            <div
                class="mx-auto grid max-w-2xl gap-x-8 gap-y-16 border-gray-200 lg:mx-0 lg:max-w-none lg:grid-cols-2">


                <p class="text-justify">
                    @php echo $stay->description @endphp
                </p>


                <img style="height: auto;width: 100%"
                     src="{{ asset($stay->image) }}"
                     alt="" class="rounded bg-gray-50">

            </div>


            <div class="mx-auto max-w-7xl px-6 lg:px-8 my-5">
                <div
                    class="mx-auto grid max-w-2xl gap-x-8 gap-y-16 border-gray-200 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                    @foreach($stay->rooms as $room)
                        <x-room-card :room="$room"/>
                    @endforeach

                </div>
            </div>



            <h3 class="text-5xl font-bold text-gray-900 sm:text-4xl">Comments</h3>

            @auth

                <section>
                    <form method="post" class="space-y-6"
                          action="{{ route('stays.comment.store' , $stay->id) }}">
                        @csrf


                        <div>
                            <x-input-label for="star" :value="__('Star')"/>

                            <x-select-input id="star" name="star" class="mt-1 block w-full" required
                                            autocomplete="star">
                                <option>5</option>
                                <option>4</option>
                                <option>3</option>
                                <option>2</option>
                                <option>1</option>
                            </x-select-input>
                        </div>


                        <div>
                            <x-input-label for="content" :value="__('Content')"/>
                            <x-textarea-input id="content" name="content" type="textarea"
                                              class="mt-1 block w-full"
                                              required
                                              autocomplete="content">
                            </x-textarea-input>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Send') }}</x-primary-button>
                        </div>


                    </form>
                </section>

            @else
                <p class="my-3">Login to comment</p>
            @endauth

            @if($stay->comments()->isAccepted()->count() <1)
                <p class="my-3">Write first comment.</p>
            @endif
            <section>
                @foreach($stay->comments()->isAccepted()->get() as $comment)
                    <article class="max-w-xl items-start p-5 m-2 border rounded">
                        Author : {{ $comment->author->name }}
                        @if($stay->rating > 0)
                            <x-rating class="my-3" :value="$comment->star"/>
                        @endif
                        <p><?php echo $comment->content ?></p>
                    </article>
                @endforeach
            </section>

        </div>
    </div>

</x-main-layout>
