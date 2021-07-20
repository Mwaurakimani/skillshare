<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <!-- end scripts -->

    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    <link rel="stylesheet" href="{{ asset("css/Assets/app.css") }}">
    <!-- end css -->

    <title>Document</title>
</head>

<body>
<nav>
    <div class="logo_holder">
        <div class="img_holder">
            <img src=" {{ asset('storage/Logo_red.png') }} " alt="">
            <p>Company Name</p>
        </div>
    </div>
    <div class="navigation_links">
        <ul>
            <li>
                <a href="#">Contractors</a>
            </li>
            <li>
                <a href="#">Projects</a>
            </li>
        </ul>
    </div>
    <div class="user_action">
        <div class="button_holder">
            <a href="/register" >Register</a>
        </div>
    </div>
</nav>

<div class="home_banner">
    <div class="banner_overlay">
        <div class="dec1">

        </div>
        <div class="dec2">
            <img src=" {{ asset('storage/logo.png') }} " alt="">
        </div>
        <section class="log_in_section">
            <h3>Welcome to Kenya's number 1 <br> contractors market place</h3>
            <h4>Log in as...</h4>
            <div class="login_button_holder">
                <a href="/login">Client</a>
                <a href="/login">Contractor</a>
            </div>
        </section>
        <section class="description_section">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Minima, laborum ducimus. Natus quae, veniam est cum eveniet exercitationem delectus. Non itaque voluptate libero. Accusantium culpa ullam ut incidunt, molestias pariatur.
            </p>
        </section>
    </div>
</div>

<h3>Professionals</h3>

<div class="content_body">
    <div class="filter_section">
        <div class="filter_panel">
            <div class="filter_input_group">
                <h5>Category</h5>
                <select name="" id="">
                    <option value="">All</option>
                </select>
            </div>
            <div class="filter_input_group">
                <h5>Rating</h5>
                <select name="" id="">
                    <option value="">All</option>
                </select>
            </div>
            <div class="filter_input_group">
                <h5>Location</h5>
                <select name="" id="">
                    <option value="">All</option>
                </select>
            </div>
        </div>
    </div>
    <div class="items_section">
        <div class="nav_panel">
            <div class="filter_display">
                <h6>Filters :</h6>
                <p title="Remove">None <span>X</span> </p>
                <p title="Remove">Architect <span>X</span> </p>
            </div>
            <div class="search_bar">
                <input type="text" placeholder="Type to search...">
            </div>
        </div>
        <div class="project_card_panel">
            <?php
            for ($i=0; $i < 20; $i++) {
            ?>
            <div class="project_card_holder">
                <div class="check_box">
                    <input type="checkbox">
                </div>
                <div class="image_area">
                    <img src=" {{ asset("storage/banner.jpg") }}" alt="">
                </div>
                <div class="project_details_area">
                    <div class="card_heading">
                        <h6>Title</h6>
                        <p>Complexity</p>
                    </div>
                    <div class="description">
                        <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available...</p>
                    </div>
                    <div class="card_control">
                        <div class="card_desq">
                            <div class="sect">
                                <p>Cost :</p>
                                <p style="color:#47E15C;font-weight:600;">Ksh 5,000,000</p>
                            </div>
                            <div class="sect">
                                <p title="Estimated time to completion">Ettc :</p>
                                <p>5 months</p>
                            </div>
                        </div>
                        <div class="card_actions">
                            <a href="#"><img src=" {{ asset("storage/icons8-eye-60.png") }} " alt=""></a>
                            <a href="#"><img src="{{ asset("storage/icons8-edit-60.png") }}" alt=""></a>
                            <a href="#"><img src="{{ asset("storage/icons8-trash-60.png") }}" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="pagination_panel">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- script -->

<script data-main="libs/js/main.js" src=" {{ asset('js/res/live.js') }} "></script>

<!-- end script -->
</body>

</html>
