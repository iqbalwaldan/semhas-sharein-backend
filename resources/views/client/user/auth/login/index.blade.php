@extends('client.layouts.main')

@section('container')
    <div class="flex flex-col md:flex-row">
        {{-- <CarouselSharein /> --}}
        <div class="h-screen w-register-left mx-auto p-20 bg-[url('/assets/images/Register-bg.png')] bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{ asset('assets/images/Register-bg.png') }}');">
            <div
                class="h-full bg-blue-500 bg-opacity-30 backdrop-blur-lg rounded-2xl border-[6px] border-[#5882C1] border-opacity-50">
                <div class="h-full flex flex-col items-center justify-center">
                    <div class="mx-auto w-[350px] h-[300px] 2xl:w-[502px] 2xl:h-[502px]">
                        {{-- {renderImages()} --}}
                        <img src="{{ asset('/assets/images/chat-image.png') }}" alt="Person Image" />
                    </div>
                    <p class="text-center font-extrabold text-3xl 2xl:text-5xl text-white px-14">
                        <span class="font-extrabold text-3xl 2xl:text-5xl text-[#F7B217]">
                            {{-- {slides[currentIndex].span}{" "} --}}
                            Simplify
                        </span>
                        {{-- {slides[currentIndex].text} --}}
                        Social Media Strategy with Sharein
                    </p>
                    <div class="flex mx-auto mt-16 2xl:mt-20 mb-6">
                        {{-- {renderDots()} --}}
                    </div>
                </div>
            </div>
        </div>
        {{--  --}}
        <div class="md:w-register-right w-full h-full">
            <div class="bg-white px-24 py-10 2xl:px-32 2xl:py-52">
                {{-- <LogoSharein /> --}}
                <div
                    class="w-10 h-10 2xl:w-16 2xl:h-16 bg-gradient-to-b from-primary-base to-secondary-base rounded-lg flex items-center justify-center mb-3 2xl:mb-6">
                    <div class="w-7 h-7 2xl:w-[50px] 2xl:h-[50px]">
                        <img src="/assets/images/logo-white.png" />
                    </div>
                </div>
                {{--  --}}
                <h1 class="font-bold text-3xl 2xl:text-4xl text-neutral-80 mb-2 2xl:mb-4">Sign In</h1>
                <p class="text-xs 2xl:text-base font-light text-neutral-70">Welcome back! Please enter your details</p>
                {{-- <form action="{{ route('login') }}" method="POST"> --}}
                <form action="{{ route('user.loginPost') }}" method="POST">
                    @csrf
                    <div class="flex flex-col mt-3 2xl:mt-6 w-full">
                        <div class="flex mb-1">
                            <p class="font-normal text-base text-neutral-70">Email</p>
                            <p class="font-normal text-base text-error-base">*</p>
                        </div>
                        {{-- <x-input disabled=false id="email" type="email" autofocus placeholder="your email" :value="old('email')"
                            required /> --}}

                        {{-- <x-input-error for="email" class="mt-2" /> --}}
                        {{-- <x-input type="email" name="email" placeholder="your email" :value="old('email')" required autofocus /> --}}
                        <input type="email" name="email" placeholder="your email" :value="old('email')" required autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-red-500">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="flex flex-col mt-3 2xl:mt-6 w-full">
                        <div class="flex mb-1">
                            <p class="font-normal text-base text-neutral-70">Password</p>
                            <p class="font-normal text-base text-error-base">*</p>
                        </div>
                        <div class="relative">
                            {{-- <x-input id="password" type="password" placeholder="your password"
                            autocomplete="current-password" required /> --}}
                            {{-- <x-input name="password" type="password" placeholder="your password" required /> --}}
                            <input name="password" type="password" placeholder="your password" required>
                            {{-- <span class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-neutral-70"
                                onclick="togglePasswordVisibility()">
                                <x-icons.eye-off />
                            </span> --}}
                        </div>
                        {{-- <x-input-error for="password" class="mt-2" /> --}}
                    </div>
                    <div class="w-full flex items-center justify-between mt-4">
                        <div class="w-full flex items-center">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" name="remember"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    onchange="setShouldRemember(this.checked)" />
                                <span class="ml-2 text-sm text-gray-600">Remember me</span>
                            </label>
                        </div>
                        <a href="/forgot-password" class="text-sm  font-bold whitespace-nowrap text-[#2652FF]">Forgot
                            Password?</a>
                    </div>
                    <button type="submit"
                        class="bg-[#2652FF] w-full h-[51px] mt-10 rounded-md py-2 px-4 text-xl font-semibold text-white">
                        Sign In
                        {{-- {{ $loading ? 'disabled' : '' }}>
                        {{ $loading ? 'Signing In...' : 'Sign In' }} --}}
                    </button>
                </form>
                <div class="flex mx-auto mt-3 justify-center">
                    <p class="font-normal text-base text-neutral-70">Already have an account?&nbsp;</p>
                    <a class="font-semibold text-base text-primary-base" href="{{ route('user.register') }}">Sign up</a>
                </div>
            </div>
        </div>
    </div>
@endsection
