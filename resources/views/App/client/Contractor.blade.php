@extends('dashboard')


@php
    $title = "Contractors";
@endphp


@section('content')
    <div class="body-section">
        <x-top-bar :title="$title"></x-top-bar>
    </div>
    <script src=" {{ asset("js/App/user.js") }} "></script>
@endsection
