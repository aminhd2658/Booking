<section>
    <form method="post" class="space-y-6"
          action="{{ route('admin.disable-days.store',$room->id) }}">
        @csrf


        <div>
            <x-input-label for="date" :value="__('Date')"/>
            <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" required autofocus
                          autocomplete="date"/>
        </div>




        <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Create') }}</x-primary-button>
        </div>


    </form>
</section>
