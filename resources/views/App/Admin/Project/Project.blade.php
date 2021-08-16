@extends('dashboard')

@php
    $title = "Dashboard";
if(!isset($projects)){
    $projects = null;
}
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
            <div class="project-form-body">
                @php
                    $view = 'Dashboard';
                @endphp
                @if(isset($projects))

                    @foreach($projects as $project)
                        <x-Cards.project-card :project="$project" :view="$view">

                        </x-Cards.project-card>
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
@endsection
