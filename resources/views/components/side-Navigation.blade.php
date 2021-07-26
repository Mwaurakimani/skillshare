<div class="navigation-section">
    <div class="logo-section">
        <img src=" {{asset( 'storage/logo.png' )}} " alt="">
    </div>
    <p>{{ Auth::User()->name }}</p>
    <div class="navigation-button-section">
        <h3>Navigation</h3>
        <div class="link-section">
            <a href="/dashboard" class="active-panel">
                <img src=" {{ asset( 'storage/menu.png') }} " alt="">
                <p>Dashboard</p>
            </a>
            <a href="/account">
                <img src=" {{ asset('storage/account.png')  }} " alt="">
                <p>Account</p>
            </a> <a href="/project">
                <img src=" {{ asset( 'storage/icons8-project-60.png') }} " alt="">
                <p>Projects</p>
            </a>
            <a href="/contractors">
                <img src=" {{ asset('storage/workers.png')  }} " alt="">
                <p>Contractors</p>
            </a>
        </div>
    </div>
</div>
