@php

    $located = false;

    if(Request::is($name[0]) || Request::is($name[0].'/*')){
        $located = true;
    }else{
        $located = false;
    }

@endphp

@if(Auth::user()->role == 'Contractor'  && $name[0] == 'project')
    <a href="contractor/{{$name[0]}}" class="{{ $located ? 'active-panel' : ""  }}">
        <img src=" {{ asset($name[1]) }} " alt="">
        <p>{{ $name[0] }}</p>
    </a>
@elseif(Auth::user()->role == 'Admin')
    <a href="/Admin/{{$name[0]}}" class="{{ $located ? 'active-panel' : ""  }}">
        <img src=" {{ asset($name[1]) }} " alt="">
        <p>{{ $name[0] }}</p>
    </a>
@else
    <a href="/{{$name[0]}}" class="{{ $located ? 'active-panel' : ""  }}">
        <img src=" {{ asset($name[1]) }} " alt="">
        <p>{{ $name[0] }}</p>
    </a>
@endif
