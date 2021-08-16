@extends('layouts.fontEnd')

@section('content')
    <h3>{{ $project->title }}</h3>
    <div class="content_body">
        <div class="project-view">
            <div class="image-viewer">
                @if(isset($project->image))
                    <img src="{{ asset('storage/ProjectImages/20210728100331.png') }}" alt="">
                @else
                    <img src="{{asset('storage/default_project_image.png')}}" alt="">
                @endif

            </div>
            <div class="content-viewer">
                <h5>Project Sub-Details:</h5>
                <ul>
                    <li>
                        <p class="heading">Complexity:</p>
                        <p class="content">{{ $project->complexity }}</p>
                    </li>
                    <li>
                        <p class="heading">Period:</p>
                        @php

                            @endphp
                        <p class="content">{{ $project->period_string }}</p>
                    </li>
                    <li>
                        <p class="heading">Pricing:</p>
                        <p class="content">Ksh {{ number_format( $project->price) }}</p>
                    </li>
                    <li>
                        <p class="heading">Date Created:</p>
                        <p class="content">{{ $project->created_at->diffForHumans() }}</p>
                    </li>
                </ul>
                <h5>Project Details:</h5>
                <p>{{ $project->Description }}</p>
            </div>
            <div class="skill-set-view">
                <h5>Skill Set:</h5>
                <div class="skill-set-panel">
                    @foreach($skills as $skill)
                        <p>{{ $skill->name }}</p>
                    @endforeach
                </div>
            </div>
            {{--            {{ dd($Application) }}--}}
            @if(Auth::check() && Auth::user()->role == 'Contractor')
                @if(count($Application) > 0)
                    @if($Application[0]->assigned == 0)
                        <div class="call-to-action">
                            <p>Project not yet assigned</p>
                        </div>
                    @else
                        <div class="call-to-action">
                            <p>You have been assigned this project</p>
                        </div>
                    @endif
                @else
                    <div class="call-to-action">
                        <button data-projectID='{{ $project->id }}'
                                data-userID={{ Auth::user()->id }} id="apply-for-job">Apply
                        </button>
                    </div>
                @endif
            @endif
        </div>
        <script>


            $('#apply-for-job').on('click', () => {
                let user_id = $(event.currentTarget).attr('data-userID');
                let project_id = $(event.currentTarget).attr('data-projectID');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/applyForJob',
                    dataType: 'json',
                    data: {
                        "user_id": user_id,
                        "project_id": project_id
                    },
                    success: (msg) => {
                        alert(msg.stmt);
                    },
                    error: (xhr) => {
                        console.log(xhr.responseJSON);
                    }
                });
            });
        </script>
    </div>
@endsection
