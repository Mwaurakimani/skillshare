@extends('dashboard')

@php
    $title = "Projects";
if(!isset($project)){
    $project = null;
}
@endphp

@section('content')
    <div class="body-section">
        <x-Layout.top-bar :title="$title"></x-Layout.top-bar>
        <div class="content-body">
            <div class="panel-heading">
                <div class="btn-New-Project">
                    <a href="/project/create">New</a>
                </div>

                @if(isset($project))
                    <div class="btn-Update-Project">
                        <button type="submit" form="project_form">Update</button>
                    </div>
                @else
                    <div class="btn-Create-Project">
                        <button type="submit" form="project_form">Create</button>
                    </div>
                @endif

                @if($project->complete)
                    <div class="btn-set-complete-Project">
                        <button>Set as Complete</button>
                    </div>
                @endif
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
        <form
            @if(isset($project))
            data-id="{{isset($project) ? $project->id : ''}}"
            action="/project/{{$project->id}}"
            method="POST"
            @else
            action="/project"
            method="POST"
            @endif
            id="project_form" class="project-form-body"
            enctype="multipart/form-data">
            @if(isset($project))
                @method('PUT')
            @endif
            @csrf
            <div class="section-details">
                <div class="section-image">
                    @if($project and $project->image)
                        <img src="{{ asset('storage/ProjectImages/'.$project->image) }}" alt="">
                    @else
                        <img src="{{ asset('storage/default_project_image.png') }}" alt="">
                    @endif
                    <input type="file" name="project_image">
                </div>
                <div class="section-project-details">
                    <div class="form-group">
                        <label for="title">Project Title</label>
                        <input type="text" class="form-control" name="title" aria-describedby="title"
                               value="{{ $project ? $project->title : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="Complexity">Complexity</label>
                        <select name="Complexity" id="Complexity">
                            @php
                                $complexities = [
                                    'Easy',
                                    'Medium',
                                    'Difficult',
                                    'Advanced',
                                    'Expert'
                                ];
                            @endphp

                            @foreach($complexities as $complexity)
                                @if(isset($project))
                                    <x-select-options :complexity="$complexity" :project="$project">

                                    </x-select-options>
                                @else
                                    <x-Elem.select-options :complexity="$complexity">

                                    </x-Elem.select-options>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group period-selector">
                        <label for="exampleInputEmail1">Period</label>
                        <p>Years</p>
                        <p>Months</p>
                        <p>Days</p>
                        <p>Hours</p>
                        <input min="0" type="number" class="form-control" name="period_years"
                               aria-describedby="emailHelp"
                               value="{{ $project ? $project->period['years'] : '' }}">
                        <input max="12" min="0" type="number" class="form-control" name="period_months"
                               aria-describedby="emailHelp"
                               value="{{ $project ? $project->period['months'] : '' }}">
                        <input max="31" min="0" type="number" class="form-control" name="period_days"
                               aria-describedby="emailHelp"
                               value="{{ $project ? $project->period['days'] : '' }}">
                        <input max="24" min="0" type="number" class="form-control" name="period_hours"
                               aria-describedby="emailHelp"
                               value="{{ $project ? $project->period['hours'] : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Price (Ksh)</label>
                        <input min="0" type="number" class="form-control" name="price" aria-describedby="emailHelp"
                               value="{{ $project ? $project->price : '' }}">
                    </div>
                </div>
            </div>
            <div class="section-description">
                <label for="Description">Project Description</label>
                <textarea name="Description" id="Description">{{ $project ? $project->Description : '' }}</textarea>
            </div>
            <div class="section-skill">
                <label for="Description">Skill Set Required</label>
                <div class="skill-input-area">
                    <input list="skills" id="skill_input_selector">
                    <datalist id="skills">
                        <option value="Architecture">
                        <option value="Construction Engineer">
                    </datalist>
                    <button id="add_skill_to_project">Add Skill</button>
                </div>
                <div class="skill-lister">
                    @if(isset($project))
                        @forelse($skills as $skill)
                            <p data-id="{{ $skill->id }}"> {{ $skill->name }} <span class="exclude_skill">X</span></p>
                        @empty
                        @endforelse
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection
