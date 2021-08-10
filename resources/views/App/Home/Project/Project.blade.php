@extends('layouts.fontEnd')

@section('content')
    <h3>Projects</h3>
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
                    <h5>Location</h5>
                    <select name="" id="">
                        <option value="">All</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="items_section">
            <div class="nav_panel">
                {{--            <div class="filter_display">--}}
                {{--                <h6>Filters :</h6>--}}
                {{--                <p title="Remove">None <span>X</span> </p>--}}
                {{--                <p title="Remove">Architect <span>X</span> </p>--}}
                {{--            </div>--}}
                <div class="search_bar">
                    <input type="text" placeholder="Type to search...">
                </div>
            </div>
            <div class="project_card_panel card_display_panel">
                @if(!is_null($projects))
                    @foreach($projects as $project)
                        @php
                        $view = "Home";
                        @endphp
                        <x-Cards.project-card :project="$project" :view="$view">

                        </x-Cards.project-card>
                    @endforeach

                @else
                    <p class="No-data-found">No Projects was found</p>
                @endif
            </div>
            {{--        <div class="pagination_panel">--}}
            {{--            <nav aria-label="Page navigation example">--}}
            {{--                <ul class="pagination">--}}
            {{--                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>--}}
            {{--                    <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
            {{--                    <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
            {{--                    <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
            {{--                    <li class="page-item"><a class="page-link" href="#">Next</a></li>--}}
            {{--                </ul>--}}
            {{--            </nav>--}}
            {{--        </div>--}}
        </div>
    </div>
@endsection
