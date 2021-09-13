@php

    if(Auth::user()->role == 'Client'){
        $btns = [
            ['account','storage/account.png'],
            ['project','storage/icons8-project-60.png'],
            ['Contractor','storage/workers.png'],
            ['Skills','storage/skill.png']
        ];
    } elseif (Auth::user()->role == 'Admin') {
                $btns = [
                    ['Accounts','storage/account.png'],
                    ['Projects','storage/icons8-project-60.png'],
                    ['Skills','storage/skill.png']
                ];
    }else{
        $btns = [
            ['account','storage/account.png'],
            ['project','storage/icons8-project-60.png'],
        ];

    }

@endphp

<div class="navigation-section">
    <div class="logo-section" onclick="window.location.href='/'">
        <img src=" {{asset( 'storage/logo.png' )}} " alt="">
    </div>
    <p>{{ Auth::User()->name }}</p>
    <div class="navigation-button-section">
        <h3>Navigation</h3>
        <div class="link-section">

            @foreach($btns as $btn)
                <x-Elem.side-bar-btn :name="$btn">

                </x-Elem.side-bar-btn>
            @endforeach
        </div>
    </div>
</div>
