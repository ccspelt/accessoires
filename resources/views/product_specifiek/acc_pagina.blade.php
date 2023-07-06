  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- slick slider CSS library files -->
      <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
      <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <!-- slick slider JS library file -->
  <script type="text/javascript" src="slick/slick.min.js"></script>
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  @laravelViewsStyles 
  <div class="container">
  @livewire('letop')    <!--De 'geld lenen kost geld' bar -->
  @livewire('menu')     <!--Menu  rond de website. Moet nog linken-->
  @livewire('lowmenu')  <!--Menu van alle informtie-->
  @livewire('slideshow')