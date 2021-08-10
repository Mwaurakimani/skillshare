@extends('dashboard')


@php
    $title = "Contractors";
@endphp


@section('content')
    <div class="body-section">
        <x-Layout.top-bar :title="$title"></x-Layout.top-bar>
        <div class="content-body">
            <div class="panel-heading">
                <div class="btn-Update-Project">
                    <button type="submit" form="User_form" onclick="window.location.href = '/project/create';">New</button>
                </div>
            </div>
            @if(Session::has('message'))
                <p class="alert success-Update {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="contractor-display">

                @if(isset($projects))
                    @foreach($projects as $project)
                        <x-Elem.project-card :project="$project">

                        </x-Elem.project-card>
                    @endforeach
                @else
                    <p style="
                                text-align: center;
                                padding: 20px"
                    >No data Found</p>
                @endif

            </div>

        </div>
    </div>
    <script src=" {{ asset("js/App/user.js") }} "></script>
@endsection
