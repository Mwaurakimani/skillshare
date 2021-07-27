@php

    $located = false;

    if(Request::is($name[0]) || Request::is($name[0].'/*')){
        $located = true;
    }else{
        $located = false;
    }

@endphp


<a href="/{{$name[0]}}" class="{{ $located ? 'active-panel' : ""  }}">
    <img src=" {{ asset($name[1]) }} " alt="">
    <p>{{ $name[0] }}</p>
</a>
