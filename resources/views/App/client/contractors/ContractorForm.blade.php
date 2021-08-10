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
                    <button type="submit" form="User_form" id="Hire_User">Hire
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
                <form id="Application_form" class="contractor-job-display"
                      data-userID="{{ $user->id }}">
                    <div class="img-display">
                        <img src="{{ asset('storage/ProjectImages/20210728100331.png') }}" alt="">
                    </div>
                    <div class="user-details">
                        <div class="user-details-holder">
                            <h3>Name:</h3>
                            <p>{{ $user->name }}</p>
                        </div>
                        <div class="user-details-holder">
                            <h3>Email:</h3>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div class="user-details-holder">
                            <h3>Location:</h3>
                            <p>{{ $user->location }}</p>
                        </div>
                        <div class="user-details-holder">
                            <h3>Payment Method:</h3>
                            <p>{{ $user->paymentMethode }}</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="user-skill-display">
                <h4>Skill Set</h4>
                <div class="user-skill-set-display">
                    <p>Architecture</p>
                </div>
            </div>
            <div class="projects_display">
                @foreach($projects as $project)
                    @php
                    $app = null;
                    foreach ($applications as $application){

                        $app_id = $application->id;
                        if($project->id == $app_id){
                            $app = $application;
                            break;
                        }
                    }
                    @endphp
                    <x-Cards.project-card :project="$project" :view="__('Contractor')" :application="$application">

                    </x-Cards.project-card>
                @endforeach
            </div>

        </div>
    </div>
    <script src=" {{ asset("js/App/user.js") }} "></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.Hire_User').on('click', () => {
            event.preventDefault();
            let elem = $(event.currentTarget).closest('.project_card_holder');
            let project_id = elem.attr('data-id');
            let user_id = $('#Application_form').attr('data-userID');

            $.ajax({
                type: 'POST',
                url: '/Contractor/hire',
                data: {
                    'project_id': project_id,
                    'user_id': user_id,
                },
                success: function (data) {
                    alert('Hired Successfuly')
                },
                error: function (data){
                    console.log(data);
                }
            });
        });

        $('.Fire_User').on('click', () => {
            event.preventDefault();
            let elem = $(event.currentTarget).closest('.project_card_holder');
            let project_id = elem.attr('data-id');
            let user_id = $('#Application_form').attr('data-userID');


            $.ajax({
                type: 'POST',
                url: '/Contractor/fire',
                data: {
                    'project_id': project_id,
                    'user_id': user_id,
                },
                success: function (data) {
                    alert('Hired Successfuly')
                },
                error: function (data){
                    console.log(data);
                }
            });
        });

    </script>
@endsection
