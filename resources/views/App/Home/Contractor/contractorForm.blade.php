@extends('layouts.fontEnd')
@php
    use App\Models\Project;
    $projects = $user->Project->where('assigned','1');

    $project_ids = array();
    foreach ($projects as $project){
        array_push($project_ids,$project->id);
    }
    $completed_projects = array();
    foreach ($project_ids as $project_id){
        $project = Project::where('id',$project_id)->where('complete',1)->get();
        array_push($completed_projects,$project);
    }

@endphp

@section('content')
    <h3>{{ $user->name }}</h3>
    <div class="content_body">
        <div class="Contractor-view">
            <div class="user_details">
                <div class="image-viewer">
                    <img src="https://picsum.photos/300" alt="">
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
                    <h4>User ID</h4>
                    <h4>: {{ $user->id }}</h4>
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
                    @if(count($completed_projects) > 0)
                        <h4>: {{ count($completed_projects[0]) }}</h4>
                    @endif
                </div>
                <div class="info-group">
                    <h4>Average Rating</h4>
                    @php
                        $user->rating = 0;
                        $app_count = 0;
                        $applications = \App\Models\Application::where('user_id',$user->id)->where('Rating','!=','null')->get();
                        if(count($applications) >0 ){
                            $app_count = count($applications);
                            $counter = intval(0);
                            foreach ($applications as $application){
                                $rating = $application->Rating;

                                $counter = $counter + intval($rating);
                            }

                            $user->rating =  intval($counter/$app_count);
                        }
                    @endphp
                    <h4>: {{ $user->rating }}</h4>
                </div>

            </div>
        </div>
    </div>
@endsection
