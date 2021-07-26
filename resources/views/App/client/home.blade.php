@extends('dashboard')

@section('content')
<<<<<<< HEAD
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

=======
    <div class="navigation-section">
        <div class="logo-section">
            <img src=" {{asset( 'storage/logo.png' )}} " alt="">
        </div>
        <p>Company Name</p>
        <div class="navigation-button-section">
            <h3>Navigation</h3>
            <div class="link-section">
                <a href="" class="active-panel">
                    <img src=" {{ asset( 'storage/menu.png') }} " alt="">
                    <p>Dashboard</p>
                </a>
                <a href="">
                    <img src=" {{ asset('storage/account.png')  }} " alt="">
                    <p>Account</p>
                </a> <a href="">
                    <img src=" {{ asset( 'storage/icons8-project-60.png') }} " alt="">
                    <p>Projects</p>
                </a>
                <a href="">
                    <img src=" {{ asset('storage/workers.png')  }} " alt="">
                    <p>Contractors</p>
                </a>
            </div>
        </div>
    </div>
    <div class="body-section">
        <div class="top-banner">
            <h6>Dashboard</h6>
            <form action="">
                <div class="form-group">
                    <input type="search" class="form-control">
                    <button>Search</button>
                </div>
            </form>
            <div class="icons-section">
                <a href="">
                    <img src=" {{ asset("storage/icons8-gears-60.png")  }} " alt="">
                </a>
                <a href="">
                    <img src=" {{ asset("storage/icons8-sms-60.png") }} " alt="">
                </a>
            </div>
        </div>
        <div class="content-body">
            <div class="panel-heading">
                <div class="btn-sect">
                    <button>Update Project</button>
                </div>
                <div class="btn-sect">
                    <button>Set as Complete</button>
                </div>
            </div>
            <form class="User-form" action="">
>>>>>>> 4bd199ac2787eaadf46a1e77d0a8787a3f6148e2
                <div class="section-1">
                    <h4>User Form</h4>
                    <div class="field-area">
                        <div class="form-group">
                            <label for="exampleInputEmail1">UserName</label>
<<<<<<< HEAD
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
=======
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Preferred Payment Method </label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  >
>>>>>>> 4bd199ac2787eaadf46a1e77d0a8787a3f6148e2
                        </div>
                    </div>
                </div>
                <div class="section-2">
                    <h4>User Form</h4>
                    <div class="field-area">
                        <div class="form-group">
<<<<<<< HEAD
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
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <input type="text" name="accountType" value="{{ Auth::User()->role ? Auth::User()->role : "N/A"  }}" disabled>
=======
                            <label for="exampleInputEmail1">Visibility</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  >
>>>>>>> 4bd199ac2787eaadf46a1e77d0a8787a3f6148e2
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<<<<<<< HEAD
    <script src=" {{ asset("js/App/user.js") }} " ></script>
=======
>>>>>>> 4bd199ac2787eaadf46a1e77d0a8787a3f6148e2
@endsection
