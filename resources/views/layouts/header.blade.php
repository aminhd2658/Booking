@php use App\Models\User;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Route; @endphp
<header class="bg-white">
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="{{ route('index') }}" class="font-bold text-gray-900 ">
                <span>Booking</span>
            </a>
        </div>

            @if (Route::has('login'))
                <div class=" p-6 text-right z-10">
                    @auth
                        @if(Auth::user()->role == User::ADMIN)
                            <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold leading-6 text-gray-900 mr-5">Dashboard</a>
                        @endif

                        <a href="{{ route('account.edit') }}" class="text-sm font-semibold leading-6 text-gray-900">Account</a>

                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-gray-900">Log in
                            <span aria-hidden="true">&rarr;</span></a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-semibold leading-6 text-gray-900 ml-5">Register
                                <span aria-hidden="true">&rarr;</span></a>
                        @endif
                    @endauth
                </div>
            @endif
    </nav>
</header>
