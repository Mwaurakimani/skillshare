@extends('dashboard')

@section('content')
    <div class="body-section">
        <x-top-bar></x-top-bar>
        <div class="content-body">
            <div class="panel-heading">
                <div class="btn-sect">
                    <button type="submit" form="User_form">Update</button>
                </div>
                <div class="btn-sect">
                    <button id="btn_delete_user">Delete</button>
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
        </div>
        <div class="project-form-body">

            @if(!empty($projects))
                @foreach($projects as $project)
                    <x-project-card :project="$project">

                    </x-project-card>
                @endforeach
            @else
                <p style="
                                text-align: center;
                                padding: 20px"
                >No data Found</p>
            @endif


            {{--            @forelse($projects as $project)--}}

            {{--            @empty--}}

            {{--            @endforelse--}}
        </div>
    </div>
    <script src=" {{ asset("js/App/user.js") }} "></script>
@endsection
