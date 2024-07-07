<nav id="sidebar" class="sidebar js-sidebar">

    <aside id="sm-logo-sidebar"
        class="fixed top-0 left-0 z-10 w-15 h-screen transition-transform md:-translate-x-full translate-x-0">

        <button id="sidebarToggle" type="button"
            class="inline-flex items-center p-2 mt-[25px] ms-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                </path>
            </svg>
        </button>

        <div class="h-full px-1 mt-5 bg-white shadow-xl">
            <a href="{{ route('user.dashboard') }}" class="flex items-center ps-2 mb-5">
                <div
                    class="w-9 h-9 rounded-lg bg-gradient-to-b from-[#2E6AFF] to-[#4D2DED] flex items-center justify-center mr-2">
                    <img src="/assets/images/logo-white.png" class="w-6 h-7" />
                </div>
            </a>
            <ul class="mt-7 ms-4 space-y-5 font-normal">
                <li>
                    <a href="{{ route('user.dashboard') }}">
                        <label
                            class="relative cursor-pointer flex items-center gap-4 text-sm font-normal text-neutral-80 duration-300 ease-in-out hover:text-primary-base false {{ $active === 'dashboard' ? 'text-primary-base' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" fill="currentColor">
                                <path
                                    d="M14.578 0h3.386a2.549 2.549 0 0 1 2.538 2.56v3.415a2.549 2.549 0 0 1-2.538 2.56h-3.386a2.549 2.549 0 0 1-2.539-2.56V2.56A2.549 2.549 0 0 1 14.578 0Z"
                                    opacity="0.4"></path>
                                <path fill-rule="evenodd"
                                    d="M3.039 0h3.385a2.549 2.549 0 0 1 2.539 2.56v3.415a2.549 2.549 0 0 1-2.539 2.56H3.04A2.549 2.549 0 0 1 .5 5.974V2.56A2.549 2.549 0 0 1 3.039 0Zm0 11.466h3.385a2.549 2.549 0 0 1 2.539 2.56v3.414A2.55 2.55 0 0 1 6.424 20H3.04A2.55 2.55 0 0 1 .5 17.44v-3.415a2.549 2.549 0 0 1 2.539-2.56Zm14.923 0h-3.386a2.549 2.549 0 0 0-2.539 2.56v3.414A2.55 2.55 0 0 0 14.575 20h3.387a2.55 2.55 0 0 0 2.538-2.56v-3.415a2.549 2.549 0 0 0-2.538-2.56Z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </label>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('user.group-post') }}">
                        <label
                            class="relative cursor-pointer flex items-center gap-4 text-sm font-normal text-neutral-80 duration-300 ease-in-out hover:text-primary-base false {{ $active === 'group-post' ? 'text-primary-base' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="none"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-width="1.5"
                                    d="M16.512 8.502c2.175.012 3.353.109 4.12.877.88.879.88 2.293.88 5.121v1c0 2.829 0 4.243-.88 5.122-.877.878-2.292.878-5.12.878h-8c-2.828 0-4.243 0-5.121-.878-.88-.88-.88-2.293-.88-5.122v-1c0-2.828 0-4.242.88-5.121.768-.768 1.946-.865 4.12-.877">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M11.512 14.5v-13m0 0 3 3.5m-3-3.5-3 3.5"></path>
                            </svg>
                        </label>
                    </a>
                </li> --}}
                <li>
                    <a href="{{ route('user.auto-post.index') }}">
                        <label
                            class="relative cursor-pointer flex items-center gap-4 text-sm font-normal text-neutral-80 duration-300 ease-in-out hover:text-primary-base false {{ $active === 'auto-post' ? 'text-primary-base' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="none"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-width="1.5"
                                    d="M16.512 8.502c2.175.012 3.353.109 4.12.877.88.879.88 2.293.88 5.121v1c0 2.829 0 4.243-.88 5.122-.877.878-2.292.878-5.12.878h-8c-2.828 0-4.243 0-5.121-.878-.88-.88-.88-2.293-.88-5.122v-1c0-2.828 0-4.242.88-5.121.768-.768 1.946-.865 4.12-.877">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M11.512 14.5v-13m0 0 3 3.5m-3-3.5-3 3.5"></path>
                            </svg>
                        </label>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.reminder.index') }}">
                        <label
                            class="relative cursor-pointer flex items-center gap-4 text-sm font-normal text-neutral-80 duration-300 ease-in-out hover:text-primary-base false {{ $active === 'reminder' ? 'text-primary-base' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="22" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M6.672 1.2a.7.7 0 0 1 .7-.7h4.2a.7.7 0 0 1 0 1.4h-1.4v1.568A8.907 8.907 0 0 1 14.36 4.89a.888.888 0 0 1 .093-.11l1.12-1.12a.875.875 0 0 1 1.237 1.238l-1.085 1.085a8.959 8.959 0 1 1-6.953-2.517V1.9h-1.4a.7.7 0 0 1-.7-.7Zm-4.76 11.199a7.56 7.56 0 1 1 15.12 0 7.56 7.56 0 0 1-15.12 0Zm8.26-5.6a.7.7 0 1 0-1.4 0v7a.7.7 0 1 0 1.4 0v-7Z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </label>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.manage-schedule.index') }}">
                        <label
                            class="relative cursor-pointer flex items-center gap-4 text-sm font-normal text-neutral-80 duration-300 ease-in-out hover:text-primary-base false {{ $active === 'manage-schedule' ? 'text-primary-base' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" fill="none"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-width="1.5"
                                    d="M12.297 19.12H8.702c-3.39 0-5.085 0-6.137-1.053-1.053-1.052-1.053-2.747-1.053-6.137v-1.797c0-3.39 0-5.084 1.053-6.137s2.748-1.053 6.137-1.053h3.595c3.389 0 5.084 0 6.136 1.053 1.054 1.053 1.054 2.748 1.054 6.137v1.797c0 3.39 0 5.085-1.053 6.137-.587.588-1.374.848-2.542.962M6.005 2.943V1.595m8.988 1.348V1.595m4.044 5.842H9.376m-7.864 0h3.482">
                                </path>
                                <path
                                    d="M15.89 14.627a.899.899 0 1 1-1.797 0 .899.899 0 0 1 1.797 0Zm0-3.595a.9.9 0 1 1-1.798 0 .9.9 0 0 1 1.798 0Zm-4.493 3.595a.898.898 0 1 1-1.797 0 .898.898 0 0 1 1.797 0Zm0-3.595a.899.899 0 1 1-1.798 0 .899.899 0 0 1 1.798 0Zm-4.494 3.595a.899.899 0 1 1-1.797 0 .899.899 0 0 1 1.797 0Zm0-3.595a.899.899 0 1 1-1.798 0 .899.899 0 0 1 1.798 0Z">
                                </path>
                            </svg>
                        </label>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.facebook-account.index') }}">
                        <label
                            class="relative cursor-pointer flex items-center gap-4 text-sm font-normal text-neutral-80 duration-300 ease-in-out hover:text-primary-base false {{ $active === 'facebook-account' ? 'text-primary-base' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor">
                                <path
                                    d="M7.252 14.59H5.754v-1.498A2.25 2.25 0 0 1 8 10.845h4.495v1.498H8a.75.75 0 0 0-.749.75v1.498Zm2.997-4.494a2.996 2.996 0 1 1 0-5.993 2.996 2.996 0 0 1 0 5.993Zm0-4.495a1.498 1.498 0 1 0 0 2.997 1.498 1.498 0 0 0 0-2.997Zm6.742 9.739a2.997 2.997 0 1 1 0-5.994 2.997 2.997 0 0 1 0 5.994Zm0-4.495a1.498 1.498 0 1 0 0 2.997 1.498 1.498 0 0 0 0-2.997Zm4.494 8.99h-1.498v-1.499a.75.75 0 0 0-.75-.749h-4.494a.75.75 0 0 0-.749.75v1.497h-1.498v-1.498a2.25 2.25 0 0 1 2.247-2.247h4.495a2.25 2.25 0 0 1 2.247 2.247v1.498Z">
                                </path>
                                <path
                                    d="m9.501 19.634-3.92-2.09a6.732 6.732 0 0 1-3.571-5.95V1.856h14.982V6.35h1.498V1.856A1.5 1.5 0 0 0 16.992.357H2.01A1.5 1.5 0 0 0 .512 1.856v9.738a8.226 8.226 0 0 0 4.363 7.272L9.5 21.332v-1.698Z">
                                </path>
                            </svg>
                        </label>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-30 w-64 h-screen transition-transform -translate-x-full md:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-8 py-10 overflow-y-auto bg-white shadow-xl">
            <a href="{{ route('user.dashboard') }}" class="flex items-center ps-2 mb-5">
                <div
                    class="w-9 h-9 rounded-lg bg-gradient-to-b from-[#2E6AFF] to-[#4D2DED] flex items-center justify-center mr-2">
                    <img src="/assets/images/logo-white.png" class="w-6 h-7" />
                </div>
                <div
                    class="font-extrabold text-transparent text-3xl bg-clip-text bg-gradient-to-b from-[#2E6AFF] to-[#4D2DED]">
                    ShareIn
                </div>
            </a>
            <ul class="mt-16 ms-4 space-y-5 font-normal">
                <li>
                    <a href="{{ route('user.dashboard') }}">
                        <label
                            class="relative cursor-pointer flex items-center gap-4 text-sm font-normal text-neutral-80 duration-300 ease-in-out hover:text-primary-base false {{ $active === 'dashboard' ? 'text-primary-base' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" fill="currentColor">
                                <path
                                    d="M14.578 0h3.386a2.549 2.549 0 0 1 2.538 2.56v3.415a2.549 2.549 0 0 1-2.538 2.56h-3.386a2.549 2.549 0 0 1-2.539-2.56V2.56A2.549 2.549 0 0 1 14.578 0Z"
                                    opacity="0.4"></path>
                                <path fill-rule="evenodd"
                                    d="M3.039 0h3.385a2.549 2.549 0 0 1 2.539 2.56v3.415a2.549 2.549 0 0 1-2.539 2.56H3.04A2.549 2.549 0 0 1 .5 5.974V2.56A2.549 2.549 0 0 1 3.039 0Zm0 11.466h3.385a2.549 2.549 0 0 1 2.539 2.56v3.414A2.55 2.55 0 0 1 6.424 20H3.04A2.55 2.55 0 0 1 .5 17.44v-3.415a2.549 2.549 0 0 1 2.539-2.56Zm14.923 0h-3.386a2.549 2.549 0 0 0-2.539 2.56v3.414A2.55 2.55 0 0 0 14.575 20h3.387a2.55 2.55 0 0 0 2.538-2.56v-3.415a2.549 2.549 0 0 0-2.538-2.56Z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Dashboard
                        </label>
                    </a>
                </li>
                {{-- <li>
                    <div class="mb-5 text-xs font-medium text-neutral-70">Post Tools</div>
                    <a href="{{ route('user.group-post') }}">
                        <label
                            class="relative cursor-pointer flex items-center gap-4 text-sm font-normal text-neutral-80 duration-300 ease-in-out hover:text-primary-base false {{ $active === 'group-post' ? 'text-primary-base' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="none"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-width="1.5"
                                    d="M16.512 8.502c2.175.012 3.353.109 4.12.877.88.879.88 2.293.88 5.121v1c0 2.829 0 4.243-.88 5.122-.877.878-2.292.878-5.12.878h-8c-2.828 0-4.243 0-5.121-.878-.88-.88-.88-2.293-.88-5.122v-1c0-2.828 0-4.242.88-5.121.768-.768 1.946-.865 4.12-.877">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M11.512 14.5v-13m0 0 3 3.5m-3-3.5-3 3.5"></path>
                            </svg>
                            Group Post
                        </label>
                    </a>
                </li> --}}
                <li>
                    <div class="mb-5 text-xs font-medium text-neutral-70">Post Tools</div>

                    <a href="{{ route('user.auto-post.index') }}">
                        <label
                            class="relative cursor-pointer flex items-center gap-4 text-sm font-normal text-neutral-80 duration-300 ease-in-out hover:text-primary-base false {{ $active === 'auto-post' ? 'text-primary-base' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="none"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-width="1.5"
                                    d="M16.512 8.502c2.175.012 3.353.109 4.12.877.88.879.88 2.293.88 5.121v1c0 2.829 0 4.243-.88 5.122-.877.878-2.292.878-5.12.878h-8c-2.828 0-4.243 0-5.121-.878-.88-.88-.88-2.293-.88-5.122v-1c0-2.828 0-4.242.88-5.121.768-.768 1.946-.865 4.12-.877">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M11.512 14.5v-13m0 0 3 3.5m-3-3.5-3 3.5"></path>
                            </svg>
                            Auto Post
                        </label>
                    </a>
                </li>
                <li>
                    <div class="mb-5 text-xs font-medium text-neutral-70">Management</div>
                    <a href="{{ route('user.reminder.index') }}">
                        <label
                            class="relative cursor-pointer flex items-center gap-4 text-sm font-normal text-neutral-80 duration-300 ease-in-out hover:text-primary-base false {{ $active === 'reminder' ? 'text-primary-base' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="22"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M6.672 1.2a.7.7 0 0 1 .7-.7h4.2a.7.7 0 0 1 0 1.4h-1.4v1.568A8.907 8.907 0 0 1 14.36 4.89a.888.888 0 0 1 .093-.11l1.12-1.12a.875.875 0 0 1 1.237 1.238l-1.085 1.085a8.959 8.959 0 1 1-6.953-2.517V1.9h-1.4a.7.7 0 0 1-.7-.7Zm-4.76 11.199a7.56 7.56 0 1 1 15.12 0 7.56 7.56 0 0 1-15.12 0Zm8.26-5.6a.7.7 0 1 0-1.4 0v7a.7.7 0 1 0 1.4 0v-7Z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Reminder
                        </label>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.manage-schedule.index') }}">
                        <label
                            class="relative cursor-pointer flex items-center gap-4 text-sm font-normal text-neutral-80 duration-300 ease-in-out hover:text-primary-base false {{ $active === 'manage-schedule' ? 'text-primary-base' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" fill="none"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-width="1.5"
                                    d="M12.297 19.12H8.702c-3.39 0-5.085 0-6.137-1.053-1.053-1.052-1.053-2.747-1.053-6.137v-1.797c0-3.39 0-5.084 1.053-6.137s2.748-1.053 6.137-1.053h3.595c3.389 0 5.084 0 6.136 1.053 1.054 1.053 1.054 2.748 1.054 6.137v1.797c0 3.39 0 5.085-1.053 6.137-.587.588-1.374.848-2.542.962M6.005 2.943V1.595m8.988 1.348V1.595m4.044 5.842H9.376m-7.864 0h3.482">
                                </path>
                                <path
                                    d="M15.89 14.627a.899.899 0 1 1-1.797 0 .899.899 0 0 1 1.797 0Zm0-3.595a.9.9 0 1 1-1.798 0 .9.9 0 0 1 1.798 0Zm-4.493 3.595a.898.898 0 1 1-1.797 0 .898.898 0 0 1 1.797 0Zm0-3.595a.899.899 0 1 1-1.798 0 .899.899 0 0 1 1.798 0Zm-4.494 3.595a.899.899 0 1 1-1.797 0 .899.899 0 0 1 1.797 0Zm0-3.595a.899.899 0 1 1-1.798 0 .899.899 0 0 1 1.798 0Z">
                                </path>
                            </svg>
                            Manage Schedule
                        </label>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.facebook-account.index') }}">
                        <label
                            class="relative cursor-pointer flex items-center gap-4 text-sm font-normal text-neutral-80 duration-300 ease-in-out hover:text-primary-base false {{ $active === 'facebook-account' ? 'text-primary-base' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                fill="currentColor">
                                <path
                                    d="M7.252 14.59H5.754v-1.498A2.25 2.25 0 0 1 8 10.845h4.495v1.498H8a.75.75 0 0 0-.749.75v1.498Zm2.997-4.494a2.996 2.996 0 1 1 0-5.993 2.996 2.996 0 0 1 0 5.993Zm0-4.495a1.498 1.498 0 1 0 0 2.997 1.498 1.498 0 0 0 0-2.997Zm6.742 9.739a2.997 2.997 0 1 1 0-5.994 2.997 2.997 0 0 1 0 5.994Zm0-4.495a1.498 1.498 0 1 0 0 2.997 1.498 1.498 0 0 0 0-2.997Zm4.494 8.99h-1.498v-1.499a.75.75 0 0 0-.75-.749h-4.494a.75.75 0 0 0-.749.75v1.497h-1.498v-1.498a2.25 2.25 0 0 1 2.247-2.247h4.495a2.25 2.25 0 0 1 2.247 2.247v1.498Z">
                                </path>
                                <path
                                    d="m9.501 19.634-3.92-2.09a6.732 6.732 0 0 1-3.571-5.95V1.856h14.982V6.35h1.498V1.856A1.5 1.5 0 0 0 16.992.357H2.01A1.5 1.5 0 0 0 .512 1.856v9.738a8.226 8.226 0 0 0 4.363 7.272L9.5 21.332v-1.698Z">
                                </path>
                            </svg>
                            Facebook Account
                        </label>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <script type="text/javascript">
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            var sidebar = document.getElementById('logo-sidebar');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });

        document.addEventListener('click', function(event) {
            var sidebar = document.getElementById('logo-sidebar');
            var toggleButton = document.getElementById('sidebarToggle');
            if (!sidebar.contains(event.target) && !toggleButton.contains(event.target)) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>

</nav>
