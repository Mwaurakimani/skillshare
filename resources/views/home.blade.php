@extends('layouts.fontEnd')

@section('content')
    <div class="home_banner">
        <div class="banner_overlay">
            <div class="dec1">

            </div>
            <div class="dec2">
                <img src=" {{ asset('storage/logo.png') }} " alt="">
            </div>
            <section class="log_in_section">
                <h3>Welcome to Kenya's number 1 <br> contractors market place</h3>
                @if(Auth::user() == null)
                @endif
                <div class="login_button_holder">
                    @if(Auth::user() == null)
                        <a href="/login">Log In</a>

                    @else
                        <a href="/dashboard">Dashboard</a>
                    @endif
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
                    <select name="Category" id="category_select" onchange="filter_contractorCard()">
                        <option value="All">All</option>
                        <option value="1">Architecture</option>
                        <option value="2">Road Engineer</option>
                        <option value="3">Bridge Engineer</option>
                    </select>
                </div>
                <div class="filter_input_group">
                    <h5>Location</h5>
                    <select name="Location" id="location_select" onchange="filter_contractorCard()">
                        <option value="All">All</option>
                        <option value="Nairobi">Nairobi</option>
                        <option value="Kiambu">Kiambu</option>
                        <option value="Coast">Coast</option>
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
            <div class="project_card_panel card_display_panel">
                @if(!is_null($contractors))
                    @foreach($contractors as $contractor)
                        <x-Cards.contractorCard :contractor="$contractor" :anchor="__('/Home/contractor')">

                        </x-Cards.contractorCard>
                    @endforeach

                @else
                    <p class="No-data-found">No Contractor was found</p>
                @endif
            </div>
        </div>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            window.filter_contractorCard = () =>{
                let category = $('#category_select').val();
                let Location = $('#location_select').val();

                $.ajax({
                    type: 'POST',
                    url: '/filterContractor',
                    dataType: 'json',
                    data: {
                        'Category':category,
                        'Location':Location
                    },
                    success: function (data) {
                        // console.log(data);
                        $('.project_card_panel').html(data.data);
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }


        </script>
    </div>
@endsection
