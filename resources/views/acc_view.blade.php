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
<div class="banner">
<img class="acc_img" src="{{asset('img/acc_banner.png')}}"> 
</div>
<div class="main">
    
    <div class="basis">
      <div class="menus"> 
      <div class="menu-sort">
        @livewire('sort') <!-- filter of sorteren-->
      </div>
      <div class="menu-sort">
        @livewire('sort-type')
      </div>
      </div>
      <div class="products">
      @livewire('producten') <!-- producten die je moet zien-->
      </div>
    </div>
  </div>
</div>
</body>
</html> 
