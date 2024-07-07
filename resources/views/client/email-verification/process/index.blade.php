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
            {{-- <div class="justify-center items-center">
                <img src="/assets/icons/verify-email-icon.png" alt="">
                <a href="{{ route('user.login') }}"
                    class="inline-block px-3 py-2 text-xs font-medium text-center text-white bg-primary-base rounded-lg hover:bg-primary-70 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Back to Login Page
                </a>
            </div> --}}
            <div class="md:w-register-right h-screen">
                <div class="w-full h-full flex flex-col justify-center items-center">
                    <div>
                        <img src="/assets/icons/verify-email-icon.png" alt="verify-email" />
                    </div>
                    <h1 class="text-4xl font-semibold text-neutral-90">
                        Confirmation Email
                    </h1>
                    <div class="mb-4 font-medium text-sm text-green-600">
                        A new verification link has been sent to the email address you
                        provided during registration.
                    </div>
                    <a href="{{ route('user.login') }}"
                        class="inline-block px-3 py-2 text-xs font-medium text-center text-white bg-primary-base rounded-lg hover:bg-primary-70 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Resend Email
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
