@extends('dashboard')


@php
    $title = "Projects";
@endphp


@section('content')
    <div class="body-section">
        <x-top-bar :title="$title"></x-top-bar>
        <div class="content-body">
            <div class="panel-heading">
                <div class="project-update-btn">
                    <button type="submit" form="User_form">Update</button>
                </div>
                <div class="project-delete-btn">
                    <button id="btn_delete_user">Delete</button>
                </div>
                <div class="project-set-as-complete-btn">
                    <button id="btn_delete_user">Set as Complete</button>
                </div>
            </div>
        </div>
    </div>
    <script src=" {{ asset("js/App/user.js") }} "></script>
@endsection

