@props(['name' => 'Test'])

<header class="sticky top-0 z-20 flex w-full h-[86px] py-4 bg-white shadow-lg">
    <div class="flex flex-grow items-center gap-2 justify-between px-8">
        <div class="flex items-center justify-between ">
            <h1 class="text-4xl font-semibold text-primary-base">{{ $slot }}</h1>
        </div>
        <div class="flex flex-row gap-6 justify-end">
            {{-- <img src="/assets/icons/notification.svg" alt="">
            <img src="/assets/icons/message.svg" alt=""> --}}
            <div class="relative w-8 h-8 rounded-full bg-cover bg-center bg-no-repeat bg-[url('/assets/icons/profile-user.png')] cursor-pointer"
                onclick="toggleDropdown()">
                <div id="dropdownMenu"
                    class="absolute w-[120px] top-10 right-0 bg-white border border-gray-300 shadow-lg rounded-md py-2 hidden">
                    <ul>
                        <li class="px-4 py-2 truncate">
                            <a href="{{ route('user.profile.index') }}">{{ $name }}</a>
                        </li>
                        <li class="px-4 py-2">
                            <form action="{{ route('user.logout') }}" method="POST">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </li>
                        {{-- <li class="px-4 py-2">
                            <a href="/fb-auto-post/profile">Profile</a>
                        </li>
                        <li class="px-4 py-2">
                            <a href="/fb-auto-post/invoice">Invoice</a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        function toggleDropdown() {
            var dropdown = document.getElementById('dropdownMenu');
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        }

        // Close the dropdown when clicking outside
        document.addEventListener('click', function(event) {
            var dropdown = document.getElementById('dropdownMenu');
            var avatar = document.querySelector('.relative.w-8.h-8.rounded-full');
            if (!avatar.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</header>
