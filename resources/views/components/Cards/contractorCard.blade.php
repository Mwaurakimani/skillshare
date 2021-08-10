<div class="contractorCard" class="app" data-id="{{ $contractor->id }}">
    <div class="image-sect">
        <img src="https://picsum.photos/200" alt="">
    </div>
    <div class="h6">{{ $contractor->name }}</div>
    <p>{{ isset($contractor['skill'][0]['name']) ? $contractor['skill'][0]['name'] : 'N/A' }}</p>
    <div class="rating">
        <img src=" {{ asset('storage/icons8-star-60.png')  }} " alt="">
        @php
            $contractor->rating = 0;
            $app_count = 0;
                        $applications = \App\Models\Application::where('user_id',$contractor->id)->where('Rating','!=','null')->get();
            if(count($applications) >0 ){
                $app_count = count($applications);
                $counter = intval(0);
                foreach ($applications as $application){
                    $rating = $application->Rating;

                    $counter = $counter + intval($rating);
                }

                $contractor->rating =  intval($counter/$app_count);
            }
        @endphp
        <p>{{ $contractor->rating }}</p>
    </div>
    <div class="location">
        <img src=" {{ asset('storage/icons8-location-60.png')  }} " alt="">
        <p>{{ $contractor->location }}</p>
    </div>
    <a href="{{ $anchor }}/{{ $contractor->id }}">View</a>
</div>
<script src="{{ asset('js/App/contractorCard.js') }}"></script>
