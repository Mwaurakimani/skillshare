<div class="project_card_holder" data-id="{{ $project->id }}">
    <div class="check_box">
    </div>
    <div class="image_area">
        <img
            src=" {{ $project->image ? asset("storage/ProjectImages/".$project->image) : asset("storage/ProjectImages/20210728100331.png")}}"
            alt="">
    </div>
    <div class="project_details_area">
        <div class="card_heading">
            <h6> {{ $project->title }} </h6>
            <p> {{ $project->complexity }} </p>
        </div>
        <div class="description">
            <p> {{ $project->Description }} </p>
        </div>
        <div class="card_control">
            <div class="card_desq">
                <div class="sect">
                    <p>Cost :</p>
                    <p style="color:#47E15C;font-weight:600;">Ksh {{ number_format( $project->price)  }}</p>
                </div>
                <div class="sect">
                    <p title="Estimated time to completion">Ettc :</p>
                    <p> {{ $project->period['years'] }} years {{ $project->period['months'] }}
                        months {{ $project->period['days'] }} days {{ $project->period['hours'] }} hours </p>
                </div>
            </div>
            <div class="card_actions">
                @if($view == "Home")
                    <a href="/Projects/{{ $project->id }}">
                        <img src=" {{ asset("storage/icons8-eye-60.png") }} " alt="">
                    </a>
                @elseif($view == "Dashboard")
                    <a href="/project/{{ $project->id }}">
                        <img src=" {{ asset("storage/icons8-eye-60.png") }} " alt="">
                    </a>
                    <a href="#" class="deleteProject" onclick="delete_project()">
                        <img src="{{ asset("storage/icons8-trash-60.png") }}" alt="">
                    </a>
                @elseif($view == "Contractor")
                    <a href="/project/{{ $project->id }}">
                        <img src=" {{ asset("storage/icons8-eye-60.png") }} " alt="">
                    </a>
                    @if($application->assigned)
                        <a style="background-color: red" class="Fire_User" href="/project/{{ $project->id }}">
                            Fire
                        </a>
                    @else
                        <a class="Hire_User" href="/project/{{ $project->id }}">
                            Hire
                        </a>
                    @endif
                @elseif($view == "Contractor_display")
                    <a href="/Projects/{{ $project->id }}">
                        <img src=" {{ asset("storage/icons8-eye-60.png") }} " alt="">
                    </a>
                @else
                    <a href="/Projects/{{ $project->id }}">
                        <img src=" {{ asset("storage/icons8-eye-60.png") }} " alt="">
                    </a>
                    <a href="/project/{{ $project->id }}">
                        <img src=" {{ asset("storage/icons8-eye-60.png") }} " alt="">
                    </a>
                    <a href="#" class="deleteProject" onclick="delete_project()">
                        <img src="{{ asset("storage/icons8-trash-60.png") }}" alt="">
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
