<div class="top-banner">
    <h6>{{ $title }}</h6>
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
        <a href="/user/logout">
            <img src=" {{ asset("storage/logout.png") }} " alt="">
        </a>
    </div>
</div>

