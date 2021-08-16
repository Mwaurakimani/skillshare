@extends('layouts.fontEnd')
@php
use App\Models\Project;
@endphp

@section('content')
    <h3>{{ $user->name }}</h3>
    <div class="content_body">
        <div class="Contractor-view">
            <div class="user_details">
                <div class="image-viewer">
                    <img src="{{ asset('storage/ProjectImages/20210728100331.png') }}" alt="">
                </div>
                <div class="info-group">
                    <h4>Email</h4>
                    <p>{{ $user->email }}</p>
                </div>
                <div class="info-group">
                    <h4>Location</h4>
                    <p>{{ $user->location }}</p>
                </div>
                <div class="info-group">
                    <h4>Payment Method</h4>
                    <p>{{ $user->paymentMethode ?: 'N/A'  }}</p>
                </div>
                <div class="info-group">
                    <h4>Bio</h4>
                    <p>{{ $user->Bio }}</p>
                </div>
            </div>
            <div class="account_details">
                <h5>Stats</h5>
                <div class="info-group">
                    <h4>Skills</h4>
                    <div class="skill-set-display">
                        @php
                        $skills = $user->Skill;
                        @endphp

                        @forelse($skills as $skill)
                            <ul style="list-style: circle;margin-left: 30px">
                                <li>{{ $skill->name }}</li>
                            </ul>
                        @empty
                            <p>No skill to display</p>
                        @endforelse
                    </div>
                </div>
                <div class="info-group">
                    <h4>On going Projects</h4>
{{--                    @php--}}
{{--                    $projects = count($projects);--}}
{{--                    @endphp--}}
{{--                    <h4>: {{ $projects }}</h4>--}}
                </div>
                <div class="info-group">
                    <h4>Applied Jobs</h4>
                    @php
                        $projects = count($user->Project);

                    @endphp
                    <h4>: {{ $projects }}</h4>
                </div>
                <div class="info-group">
                    <h4>Hired Jobs</h4>
                    @php
                        $projects = count($user->Project->where('assigned','1'));
                    @endphp
                    <h4>: {{ $projects }}</h4>
                </div>
                <div class="info-group">
                    <h4>Completed Jobs</h4>
                    @php
                        $projects = count($user->Project->where('assigned','1'));

                    @endphp
                    <h4>: {{ $projects }}</h4>
                </div>
                <div class="info-group">
                    <h4>Average Rating</h4>
                    @php
                        $projects = count($user->Project->where('assigned','1'));

                    @endphp
                    <h4>: {{ $projects }}</h4>
                </div>

            </div>
        </div>
    </div>
@endsection
