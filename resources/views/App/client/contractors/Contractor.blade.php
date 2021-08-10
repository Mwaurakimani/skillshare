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
                    <button type="submit" form="User_form" onclick="window.location.href = '/project/create';">New
                    </button>
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
                @if($contractors != null)
                @foreach($contractors as $contractor)
                <x-Cards.contractorCard :contractor="$contractor" :anchor="__('/Contractor')">

                </x-Cards.contractorCard>
                    @endforeach
                @else
                    <p>No data was found</p>
                @endif
            </div>

        </div>
    </div>
    <script src=" {{ asset("js/App/user.js") }} "></script>
@endsection
