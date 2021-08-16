@extends('dashboard')

@php
    $title = "Accounts";
if(!isset($users)){
    $users = null;
}
@endphp

@section('content')
    <div class="body-section">
        <x-Layout.top-bar :title="$title"></x-Layout.top-bar>
        <div class="content-body">
            <div class="panel-heading">
                <div class="btn-Update-Project">
                    <button type="submit" form="User_form" onclick="window.location.href = '/project/create';">New
                    </button>
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
            <div class="project-form-body">
                @php
                    $view = 'Dashboard';
                @endphp
                @if(isset($users))
                    <table class="table table-sm Accounts-table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Role</th>
                            <th scope="col">date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr onclick="window.location.href='/Admin/Accounts/{{$user->id}}'" >
                                <th scope="row"> {{ ($loop->index)+1 }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->status }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p style="
                                text-align: center;
                                padding: 20px"
                    >No Users Found</p>
                @endif
            </div>

        </div>
    </div>
@endsection
