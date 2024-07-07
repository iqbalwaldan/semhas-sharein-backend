@extends('client.layouts.main')

@section('container')
    <div class="flex flex-col md:flex-row">
        <div class="h-screen w-register-left mx-auto p-20 bg-[url('/assets/images/Register-bg.png')] bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{ asset('assets/images/Register-bg.png') }}');">
            <div
                class="h-full bg-blue-500 bg-opacity-30 backdrop-blur-lg rounded-2xl border-[6px] border-[#5882C1] border-opacity-50">
                <div class="h-full flex flex-col items-center justify-center">
                    <div class="mx-auto w-[350px] h-[300px] 2xl:w-[502px] 2xl:h-[502px]">
                        <img src="{{ asset('/assets/images/chat-image.png') }}" alt="Person Image" />
                    </div>
                    <p class="text-center font-extrabold text-3xl 2xl:text-5xl text-white px-14">
                        <span class="font-extrabold text-3xl 2xl:text-5xl text-[#F7B217]">
                            Simplify
                        </span>
                        Social Media Strategy with Sharein
                    </p>
                    <div class="flex mx-auto mt-16 2xl:mt-20 mb-6">
                    </div>
                </div>
            </div>
        </div>
        <div class="md:w-register-right w-full h-full">
            <div class="bg-white px-32 py-32 2xl:py-40">
                <div
                    class="w-10 h-10 2xl:w-16 2xl:h-16 bg-gradient-to-b from-primary-base to-secondary-base rounded-lg flex items-center justify-center mb-3 2xl:mb-6">
                    <div class="w-7 h-7 2xl:w-[50px] 2xl:h-[50px]">
                        <img src="/assets/images/logo-white.png" />
                    </div>
                </div>
                <h1 class="font-bold text-3xl 2xl:text-4xl text-neutral-80 mb-4">
                    Reset Password
                </h1>
                <form action="{{ route('user.update-password') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ request()->email }}">
                    <div class="flex flex-col gap-4">
                        <div class="flex flex-col w-full">
                            <label for="password" class="flex">
                                <p class="font-normal text-base text-neutral-70">
                                    Password
                                </p>
                                <p class="font-normal text-sm text-error-base">*</p>
                            </label>
                            <div class="relative">
                                <input id="password" name="password"
                                    class="border border-[#CFCFCF] p-3 text-neutral-70 focus:outline-none h-12 rounded-md text-sm font-light w-full"
                                    type="password" placeholder="your new password" />
                                <span id="password_check"
                                    class="hidden absolute right-3 top-[25px] transform -translate-y-1/2 text-green-500"><i
                                        class="fa-solid fa-circle-check"></i></span>
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="password_confirmation" class="flex ">
                                <p class="font-normal text-base text-neutral-70">
                                    Password Confirmation
                                </p>
                                <p class="font-normal text-sm text-error-base">*</p>
                            </label>
                            <div class="relative">
                                <input id="password_confirmation" name="password_confirmation"
                                    class="border border-[#CFCFCF] p-3 text-neutral-70 focus:outline-none h-12 rounded-md text-sm font-light w-full"
                                    type="password" placeholder="your confirm password" />
                                <span id="password_confirmation_check"
                                    class="hidden absolute right-3 top-[25px] transform -translate-y-1/2 text-green-500"><i
                                        class="fa-solid fa-circle-check"></i></span>
                            </div>
                        </div>
                        <button type="submit"
                            class="bg-primary-base w-full h-[51px] mt-4 rounded-md py-2 px-4 text-xl font-semibold text-white">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
