<nav class="fixed w-full h-24 z-50">
    {{-- <nav class="fixed w-full h-24 z-50 {{ $navbarClass }}"> --}}
    <div class="flex justify-between items-center h-full w-full px-24 2xl:px-16">
        <a href="{{ url('/') }}">
            <div class="flex flex-row items-center justify-center gap-2">
                <div
                    class="flex items-center justify-center h-9 bg-gradient-to-b from-primary-base to-secondary-base rounded-lg w-9 cursor-pointer">
                    <img src="{{ asset('assets/images/logo-white.png') }}" width="21" height="23" />
                </div>
                <p class="font-bold text-[32px] text-primary-base">Sharein</p>
            </div>
        </a>
        <div class="hidden sm:flex">
            <ul class="hidden sm:flex items-center justify-center">
                <a href="#hero">
                    <li class="ml-10 text-xl font-semibold">
                        {{-- <li class="ml-10 text-xl font-semibold" style="{{ $textStyles }}"> --}}
                        Why us
                    </li>
                </a>
                <a href="#features">
                    <li class="ml-10 text-xl font-semibold">
                        Features
                    </li>
                </a>
                <a href="{{ url('/pricing') }}">
                    <li class="ml-10 text-xl font-semibold">
                        Pricing
                    </li>
                </a>
                <a href="{{ url('/resources') }}">
                    <li class="ml-10 text-xl font-semibold">
                        Resources
                    </li>
                </a>
                <a href="{{ url('/register') }}">
                    <li>
                        <button class="px-6 py-1 ml-10 rounded-xl text-xl font-semibold border-2 border-neutral-10">
                            {{-- <button class="px-6 py-1 ml-10 rounded-xl text-xl font-semibold border-2 border-neutral-10 style="{{ $buttonRegisterStyles }}"> --}}
                            Register
                        </button>
                    </li>
                </a>
                <a href="{{ url('/login') }}">
                    <li>
                        <button
                            class="px-6 py-2 ml-10 rounded-xl text-xl font-semibold bg-neutral-10 text-primary-base">
                            {{-- <button class="px-6 py-2 ml-10 rounded-xl text-xl font-semibold bg-neutral-10 text-primary-base" style="{{ $buttonLoginStyles }}"> --}}
                            Login
                        </button>
                    </li>
                </a>
            </ul>
        </div>
        <div onclick="handleNav()" class="md:hidden cursor-pointer pl-24">
            <img src="{{ asset('assets/icons/google.png') }}" width="25" height="25" />
        </div>
    </div>
</nav>
