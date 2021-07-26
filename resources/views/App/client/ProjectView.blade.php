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
    <script src=" {{ asset("js/App/user.js") }} "></script>
@endsection
