@extends('dashboard')

@php
    $title = "Account";
@endphp

@section('content')
    <div class="body-section">
        <x-top-bar :title="$title"></x-top-bar>
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
            <form id="User_form" class="User-form" action="/User/{{ Auth::User()->id }}" method="POST">
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
                            <label for="exampleInputEmail1">Preferred Payment Method </label>
                            <select name="paymentMethode" id="">
                                <option value="Mpesa" {{ Auth::User()->visbility == 'Mpesa' ? 'selected="selected"' : "" }}>Mpesa</option>
                                <option value="Bank" {{ Auth::User()->visbility == 'Bank' ? 'selected="selected"' : "" }} >Bank</option>
                            </select>
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
        </div>
    </div>
    <script src=" {{ asset("js/App/user.js") }} " ></script>
@endsection
