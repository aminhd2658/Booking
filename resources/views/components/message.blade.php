@if (session('status') === 'successfully')
    <p {{ $attributes->merge(['class' => 'text-sm text-green-600 bg-green-100']) }}>{{ __(session('message')) }}</p>
@endif

@if (session('status') === 'error')
    <p {{ $attributes->merge(['class' => 'text-sm text-red-600 bg-red-100']) }}>{{ __(session('message')) }}</p>
@endif


@if(session()->get('errors'))


    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>

        @foreach ($errors->all() as $message)
            <li>{{$message}}</li>
        @endforeach
    </ul>


@endif
