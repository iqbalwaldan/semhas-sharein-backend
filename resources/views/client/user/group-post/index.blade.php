@extends('client.layouts.main')

@section('container')
    @include('client.user.partials.sidebar')
    <div class="ml-[60px] sm:ml-64">
        <x-navbar :name="auth()->user()->first_name">
            {{ $title }}
        </x-navbar>
        <div class="p-4 mx-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3  gap-4 mb-4">
                <div class="flex p-3 flex-col gap-5 rounded bg-gray-200 ">
                    {{-- Choose Account --}}
                    <div class="w-full h-96">
                        <div class="text-lg font-semibold text-black mb-4">Choose Account</div>
                        <div class="w-full overflow-y-auto max-h-80">
                            <div class="flex flex-col gap-1">
                                <div
                                    class="border border-neutral-20 p-1 rounded flex flex-row justify-between items-center cursor-pointer">
                                    <div class="flex items-center">
                                        <div class="flex w-7 h-7 2xl:w-[33px] 2xl:h-[33px] items-center mr-2">
                                            <img src="/" />
                                        </div>
                                        <div>
                                            <p class="text-xs 2xl:text-sm font-normal text-black">{item.name}</p>
                                            <p class="text-[10px] font-light text-black">{item.member}-Jawa Timur
                                            </p>
                                        </div>
                                    </div>
                                    <input type="checkbox" class="w-4 h-4 mt-1" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex p-3 rounded bg-gray-100">
                    <form action="/" method="POST" class="w-full">
                        @csrf
                        <div class="w-full">
                            <div class="mb-4 w-full">
                                <div class="flex flex-row">
                                    <label for="title" class="mb-2 text-base font-light text-gray-900">
                                        Your Title
                                    </label>
                                    <label for="title" class="mb-2 text-base font-light text-red-500">
                                        *
                                    </label>
                                </div>
                                <input type="text" id="title" aria-describedby="helper-text-explanation"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Enter your title">
                            </div>
                            <div class="mb-4 w-full">
                                <div class="flex flex-row">
                                    <label for="price" class="mb-2 text-base font-light text-gray-900">
                                        Your Price
                                    </label>
                                    <label for="price" class="mb-2 text-base font-light text-red-500">
                                        *
                                    </label>
                                </div>
                                <input type="text" id="price" aria-describedby="helper-text-explanation"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Enter your price">
                            </div>
                            <div class="mb-4 w-full">
                                <div class="flex flex-row">
                                    <label for="caption" class="mb-2 text-base font-light text-gray-900">
                                        Caption
                                    </label>
                                    <label for="caption" class="mb-2 text-base font-light text-red-500">
                                        *
                                    </label>
                                </div>
                                <div id="caption">

                                </div>
                                <script>
                                    ClassicEditor
                                        .create(document.querySelector('#caption'))
                                        .catch(error => {
                                            console.error(error);
                                        });
                                </script>
                            </div>
                            <div class="mb-4 w-full">
                                <div class="flex flex-row">
                                    <label for="hashtag" class="mb-2 text-base font-light text-gray-900">
                                        Your Hashtag
                                    </label>
                                    <label for="hashtag" class="mb-2 text-base font-light text-red-500">
                                        *
                                    </label>
                                </div>
                                <input type="text" id="hashtag" aria-describedby="helper-text-explanation"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Enter your hashtag">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
