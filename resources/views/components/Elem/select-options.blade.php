
@if(isset($project))
    <option
        {{ $project->complexity == $complexity ? "selected" : ""  }} value="{{ $complexity }}">
        {{ $complexity }}
    </option>
@else
    <option value="{{ $complexity }}">
        {{ $complexity }}
    </option>
@endif

