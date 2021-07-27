<div class="project_card_holder">
    <div class="check_box">
        <input type="checkbox">
    </div>
    <div class="image_area">
        <img src=" {{ asset("storage/".$project->image) }}" alt="">
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
                    <p> {{ $project->period }} </p>
                </div>
            </div>
            <div class="card_actions">
                <a href="/project/{{ $project->id }}"><img src=" {{ asset("storage/icons8-eye-60.png") }} " alt=""></a>
                <a href="#"><img src="{{ asset("storage/icons8-edit-60.png") }}" alt=""></a>
                <a href="#"><img src="{{ asset("storage/icons8-trash-60.png") }}" alt=""></a>
            </div>
        </div>
    </div>
</div>
