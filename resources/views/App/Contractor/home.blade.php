@extends('dashboard')


@php
    $title = "Dashboard";
@endphp


@section('content')
    <div class="body-section">
        <x-Layout.top-bar :title="$title"></x-Layout.top-bar>
    </div>
    <script src=" {{ asset("js/App/user.js") }} "></script>
@endsection
