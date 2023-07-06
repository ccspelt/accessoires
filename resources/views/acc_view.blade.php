<!DOCTPE html>
<html>
<head>
<link rel="stylesheet" href="{{asset('css/style.css')}}">
@laravelViewsStyles
</head>  
<body>  

<div class="container">
@livewire('letop') <!--De 'geld lenen kost geld' bar -->
@livewire('menu') <!--Menu  rond de website. Moet nog linken-->
@livewire('lowmenu') <!--Menu van alle informtie-->
<img class="acc_img" src="{{asset('img/acc_banner.png')}}"> 
<div class="main">
<!--winkelmandje tab here -->

<!--product list here: xxxx products -->

    <div class="basis">
      <div class="menu-sort">
      <form method="get" action="<?php echo ($_SERVER['PHP_SELF']); ?>">
        @livewire('sort') <!-- filter of sorteren-->
      </div>
      <div class="infinite-scroll">
        <div class="products">
          @livewire('producten')<!-- producten die je moet zien-->
        </div>
      </div>
    </div>
  </div>
</div>
