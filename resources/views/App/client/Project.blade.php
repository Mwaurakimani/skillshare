@extends('dashboard')


@php
    $title = "Projects";
@endphp


@section('content')
    <div class="body-section">
        <x-top-bar :title="$title"></x-top-bar>
        <div class="content-body">
            <div class="panel-heading">
                <div class="project-update-btn">
                    <button type="submit" form="User_form">Update</button>
                </div>
                <div class="project-delete-btn">
                    <button id="btn_delete_user">Delete</button>
                </div>
                <div class="project-set-as-complete-btn">
                    <button id="btn_delete_user">Set as Complete</button>
                </div>
            </div>
            <form class="project-form-body">
                <div class="section-details">
                    <div class="section-image">
                        <img id="image_select" src=" {{ asset('storage/default_project_image.png') }}" alt="">
                        <input type="file">
                    </div>
                    <div class="section-project-details">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Project Title</label>
                            <input type="text" class="form-control" name="name"  aria-describedby="emailHelp"  value="{{ $project->title }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Complexity</label>
                            <input type="text" class="form-control" name="name"  aria-describedby="emailHelp"  value="{{ $project->complexity }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Period</label>
                            <input type="text" class="form-control" name="name"  aria-describedby="emailHelp"  value="{{ $project->period }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Price</label>
                            <input type="number" class="form-control" name="name"  aria-describedby="emailHelp"  value="{{ $project->price }}">
                        </div>
                    </div>
                </div>
                <div class="section-description">
                    <label for="Description">Project Description</label>
                    <textarea name="Description" id="Description">{{ $project->Description }}</textarea>
                </div>
                <div class="section-skill"></div>
            </form>
        </div>
    </div>
    <script src=" {{ asset("js/App/user.js") }} "></script>
@endsection
