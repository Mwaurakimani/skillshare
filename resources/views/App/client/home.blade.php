@extends('dashboard')

@section('content')
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
                <div class="section-1">
                    <h4>User Form</h4>
                    <div class="field-area">
                        <div class="form-group">
                            <label for="exampleInputEmail1">UserName</label>
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
                        </div>
                    </div>
                </div>
                <div class="section-2">
                    <h4>User Form</h4>
                    <div class="field-area">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Visibility</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  >
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
