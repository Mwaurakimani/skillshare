@extends('dashboard')


@php
    $title = "Dashboard";
@endphp


@section('content')
    <div class="body-section">
        <x-Elem.top-bar :title="$title"></x-Elem.top-bar>
    </div>
    <script src=" {{ asset("js/App/user.js") }} "></script>
@endsection
