@extends('dashboard')

@php
    $title = "Account";
@endphp

@section('content')
    <div class="body-section">
        <x-Layout.top-bar :title="$title"></x-Layout.top-bar>
        <div class="content-body">
            <div class="panel-heading">
                                <div class="btn-Update-Account">
                                    <button onclick="new_skill()" type="submit" form="User_form">New</button>
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
            <div class="skill-display">
                <div class="table-display">
                    @if(count($skills) > 0)

                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($skills as $skill)
                                <tr onclick="get_skill({{ $skill->id }})">
                                    <th scope="row">{{ ($loop->index) + 1 }}</th>
                                    <td> {{ $skill->name }}</td>
                                    <td>{{ $skill->description = (strlen($skill->description) > 30) ? substr($skill->description,0,27).'...' : $skill->description }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    @else
                        <p>No Skills were Found</p>
                    @endif
                </div>
                <div class="form-display">
                    <x-Forms.skill-form>

                    </x-Forms.skill-form>
                </div>
            </div>

        </div>
    </div>
    <script src=" {{ asset("js/App/user.js") }} "></script>
    <script>
        //add skill to user
        //set up ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function new_skill(){
            $.ajax({
                type: 'POST',
                url: '/getSkill',
                dataType: 'json',
                data: {
                },
                success: function (data) {
                    $('.form-display').html(data.resp);
                },
                error: function (xhr) {
                    console.log(xhr.responseJSON);
                }
            });
        }

        function get_skill(id) {
            if (id == undefined) {
                alert('No skill selected');
            }

            $.ajax({
                type: 'POST',
                url: '/getSkill',
                dataType: 'json',
                data: {
                    skill_id: id,
                },
                success: function (data) {
                    $('.form-display').html(data.resp);
                },
                error: function (xhr) {
                    console.log(xhr.responseJSON);
                }
            });

        }

        function update_skill(){
            event.preventDefault();
            let skill_name = $('#skillName').val();
            let skill_description = $('#SkillDescription').val();
            let skill_id = $('.form-display form').attr('data-id');
            let url = '/Skill/' + skill_id;

            if(skill_name && skill_description){
                $.ajax({
                    type: 'PUT',
                    url: url,
                    dataType: 'json',
                    data: {
                        'skill_id' : skill_id,
                        'skill_name' : skill_name,
                        'skill_description' : skill_description,
                    },
                    success: function (data) {
                        if(data.resp){
                            alert("Updated successfully");
                            window.location.reload();
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr.responseJSON);
                    }
                });
            }
            return false;
        }

        function add_new_skill(){
            event.preventDefault();
            let skill_name = $('#skillName').val();
            let skill_description = $('#SkillDescription').val();


            if(skill_name && skill_description){
                $.ajax({
                    type: 'POST',
                    url: '/addNewSkill',
                    dataType: 'json',
                    data: {
                        'skill_name' : skill_name,
                        'skill_description' : skill_description,
                    },
                    success: function (data) {
                        if(data.resp){
                            window.location.reload();
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr.responseJSON);
                    }
                });
            }
            return false;

        }

        function delete_skill(){
            event.preventDefault();
            let skill_id = $('.form-display form').attr('data-id');
            let url = '/Skill/' + skill_id;

            $.ajax({
                type: 'DELETE',
                url: url,
                dataType: 'json',
                data: {
                    'skill_id' : skill_id,
                },
                success: function (data) {
                    alert("Deleted successfully");
                    window.location.reload();
                },
                error: function (xhr) {
                    console.log(xhr.responseJSON);
                }
            });

            return false;
        }
    </script>
@endsection
