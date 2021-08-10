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
                    <button type="submit" form="User_form">Update</button>
                </div>
            </div>
            @if(Session::has('message'))
                <p  class="alert success-Update {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
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
            <form data-id="{{ Auth::user()->id }}" id="User_form" class="User-form" action="/User/{{ Auth::User()->id }}" method="POST">
                @method('PUT')
                @csrf

                <div class="section-1">
                    <h4>User Form</h4>
                    <div class="field-area">
                        <div class="form-group">
                            <label for="exampleInputEmail1">UserName</label>
                            <input type="text" class="form-control" name="name"  aria-describedby="emailHelp"  value="{{ Auth::User()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp"   value="{{ Auth::User()->email }}">
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" name="location" aria-describedby="emailHelp"   value="{{ Auth::User()->location }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Preferred Payment Method </label>
                            <select name="paymentMethode" id="">
                                <option value="Mpesa" {{ Auth::User()->visbility == 'Mpesa' ? 'selected="selected"' : "" }}>Mpesa</option>
                                <option value="Bank" {{ Auth::User()->visbility == 'Bank' ? 'selected="selected"' : "" }} >Bank</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Bio">Bio</label>
                            <textarea name="Bio" id="Bio" cols="30" rows="10">{{ Auth::user()->Bio }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="section-2">
                    <h4>User Form</h4>
                    <div class="field-area">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Visibilit</label>
                            <select name="visibility" id="">
                                <option value="true" {{ Auth::User()->visibility == 1 ? 'selected="selected"' : "" }}>true</option>
                                <option value="false" {{ Auth::User()->visibility == 0 ? 'selected="selected"' : "" }} >false</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select name="status" id="">
                                <option value="Active" {{ Auth::User()->status == 'Active' ? 'selected="selected"' : "" }}>Active</option>
                                <option value="Inactive" {{ Auth::User()->status == 'Inactive' ? 'selected="selected"' : "" }} >Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

            </form>
            <div class="contractor_skill_holder">
                <div class="section-skill">
                    <label for="Description">Skill Set Required</label>
                    <div class="skill-input-area">
                        <input list="skills" id="skill_input_selector">
                        <datalist id="skills">
                            <option value="Architecture">
                            <option value="Construction Engineer">
                        </datalist>
                        <button id="add_skill_to_user">Add Skill</button>
                    </div>
                    <div class="skill-lister">

                        @if(isset($skills))
                            @forelse($skills as $skill)
                                <p data-id="{{ $skill->id }}"> {{ $skill->name }} <span class="exclude_skill">X</span>
                                </p>
                            @empty
                            @endforelse
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src=" {{ asset("js/App/user.js") }} " ></script>
    <script>
        //add skill to user
        //set up ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#add_skill_to_user').on('click', (e) => {
            e.preventDefault();
            let skill_name = $('#skill_input_selector').val();
            let skill_id = $($('#skills').children()[0]).attr('data-id');
            let user_id = $('#User_form').attr('data-id');


            if (skill_id == undefined) {
                alert('No skill selected');
            }

            console.log(user_id);


            $.ajax({
                type: 'POST',
                url: '/addSkillToUser',
                dataType: 'json',
                data: {
                    skill_name: skill_name,
                    skill_id: skill_id,
                    user_id: user_id
                },
                success: function (data) {
                    console.log(data);
                    let status = data.status_code;


                    if (status == 1) {

                        $('<p data-id="' + data.skill.id + '">' +
                            ' ' + data.skill.name + ' <span class="exclude_skill">X</span>' +
                            '</p>')
                            .appendTo('.skill-lister')
                            .find('span')
                            .on('click', exclude_skill_fun);
                    } else if (status == 0) {
                        console.log("Exists here");
                    } else {
                        console.log(data);
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseJSON);
                }
            });
        });
    </script>
@endsection
