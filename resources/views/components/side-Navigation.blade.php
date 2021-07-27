
@php

$btns = [
    ['dashboard','storage/menu.png'],
    ['account','storage/account.png'],
    ['project','storage/icons8-project-60.png'],
    ['contractor','storage/workers.png']
];

@endphp

<div class="navigation-section">
    <div class="logo-section">
        <img src=" {{asset( 'storage/logo.png' )}} " alt="">
    </div>
    <p>{{ Auth::User()->name }}</p>
    <div class="navigation-button-section">
        <h3>Navigation</h3>
        <div class="link-section">

            @foreach($btns as $btn)
                <x-side-bar-btn :name="$btn">

                </x-side-bar-btn>
            @endforeach
        </div>
    </div>
</div>
