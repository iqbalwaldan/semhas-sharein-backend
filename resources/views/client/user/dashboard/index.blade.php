@extends('client.layouts.main')

@section('container')
    <h1>dashboard client</h1>
    <form action="{{ route('user.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
@endsection
