@extends('client.layouts.main')

@section('container')
    <div class="flex flex-col justify-between items-center h-screen p-3">
        <div></div>
        <div class="flex flex-col gap-3  items-center">
            <img class="h-32" src="/assets/icons/alert-circle-success.png" alt="">
            <h1 class="text-3xl font-">{{ $title }}</h1>
            <p class="text-sm">{{ $description }}</p>
            <a href="{{ route('user.login') }}"
                class="inline-block px-3 py-2 text-xs font-medium text-center text-white bg-primary-base rounded-lg hover:bg-primary-70 focus:ring-4 focus:outline-none focus:ring-blue-300">
                Back to Login Page
            </a>
        </div>
        <div>
            <p class="box-border font-sans relative leading-6 mt-0 text-gray-400 text-xs text-center">
                © {{ $year }} ShareIn. All rights reserved.
            </p>
        </div>
    </div>
@endsection
