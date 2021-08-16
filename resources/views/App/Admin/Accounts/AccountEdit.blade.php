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

            <form id="User_form" class="User-form" action="/User/{{ $user->id }}" method="POST">
                @method('PUT')
                @csrf

                <div class="section-1">
                    <h4>User Form</h4>
                    <div class="field-area">
                        <div class="form-group">
                            <label for="exampleInputEmail1">UserName</label>
                            <input type="text" class="form-control" name="name"  aria-describedby="emailHelp"  value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp"   value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role</label>
                            <input type="text" class="form-control" name="email" aria-describedby="emailHelp"   value="{{ $user->role }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role</label>
                            <input type="text" class="form-control" name="location" aria-describedby="emailHelp"   value="{{ $user->location }}" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Preferred Payment Method </label>
                            <select name="paymentMethode" id="">
                                <option value="Mpesa" {{ $user->paymentMethode == 'Mpesa' ? 'selected="selected"' : "" }}>Mpesa</option>
                                <option value="Bank" {{ $user->paymentMethode == 'Bank' ? 'selected="selected"' : "" }} >Bank</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="section-2">
                    <h4>User Form</h4>
                    <div class="field-area">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Visibility</label>
                            <select name="visibility" id="">
                                <option value="true" {{ $user->visibility == 1 ? 'selected="selected"' : "" }}>Visible</option>
                                <option value="false" {{ $user->visibility == 0 ? 'selected="selected"' : "" }} >Invisible</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select name="status" id="">
                                <option value="Active" {{ $user->status == 'Active' ? 'selected="selected"' : "" }}>Active</option>
                                <option value="Inactive" {{ $user->status == 'Inactive' ? 'selected="selected"' : "" }} >Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src=" {{ asset("js/App/user.js") }} " ></script>
@endsection
