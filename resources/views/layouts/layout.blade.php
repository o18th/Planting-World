<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/icon.svg') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">

    <title>@yield('title')</title>
    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
  </head>
  <body>

  <header class="border-bottom sticky-top">
    <div class="container">


      <nav class="navbar navbar-expand-lg navbar-light justify-content-between">
        <a href="/" class="navbar-brand justify-content-start px-0 mr-5">
          <img src="{{ asset('img/logo-2.svg') }}" height="50">
        </a>

        <!-- <div class="col-sm-6 col-md-4"></div> -->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse col-md-auto row justify-content-between align-items-start" id="navbarNavDropdown" style="max-width: 110%;">
          <ul class="navbar-nav list-group">
            <li class="nav-item mr-2 @if(\Request::is('/')) active @endif">
              <a class="nav-link" href="{{ route('index') }}">Главная</a>
            </li>
            <li class="nav-item mr-2 @if(\Request::is('about')) active @endif">
              <a class="nav-link" href="{{ route('about') }}">Контакты</a>
            </li>
            <li class="nav-item mr-2 @if(\Request::is('catalog')) active @endif">
              <a class="nav-link" href="{{ route('catalog') }}">Каталог</a>
            </li>

            <li class="nav-item mr-2 dropdown @if(\Request::is('category/*')) active @endif">
              <span class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Категории
              </span>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                @foreach($categories as $category)
                  <a class="dropdown-item @if(\Request::is('category/'.$category->id)) active @endif" href="{{route('category.show', $category->id)}}">{{$category->title}}</a>
                @endforeach
              </div>
            </li>
            
          </ul>

          
          <div class="dropdown plnt-person justify-content-end">
              <div class="dropdown-toggle rounded-circle justify-content-end" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @guest
                  <img src="{{ asset('img/account.svg') }}" height="45" class="">
                @else
                  @if (Auth::user()->is_admin == 1)
                    <img src="{{ asset('img/account-admin.svg') }}" height="45" class="">
                  @else 
                    <img src="{{ asset('img/account-auth.svg') }}" height="45" class="">
                  @endif
                @endguest
              </div>
              
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                @guest
                  @if (Route::has('login'))
                    <a class="dropdown-item" href="{{ route('login') }}">{{ __('Вход') }}</a>
                  @endif
                  @if (Route::has('register'))
                    <a class="dropdown-item" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                  @endif
                @else
                  <h6 class="dropdown-header">{{ Auth::user()->name }}</h6>

                  @if (Auth::user()->is_admin == 1)
                    <a class="dropdown-item" href="{{ route('admin.home') }}">Админ панель</a>
                  @endif

                  <a class="dropdown-item @if(\Request::is('basket')) active @endif" href="{{ route('basket.index') }}">Корзина <span class="badge badge-success font-weight-bold">{{session('countOrder')==0?0: session('countOrder')}}</span></a>

                  <a class="dropdown-item @if(\Request::is('orders')) active @endif" href="{{ route('orders') }}">Заказы</a>

                  <div class="dropdown-divider"></div>
                  <!-- <a class="dropdown-item" href="#">Выйти</a> -->

                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Выйти') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
                  
                @endguest
            </div>
          </div>


        </div>





      </nav>


    </div>
  </header>
  <!-- <div id="element"> -->
        @yield('main_content')
  <!-- </div> -->



  <footer class="border-top">
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="text-center">
          <a href="/" class="logo footer-heading">
            <img src="{{ asset('img/logo-2.svg') }}">
          </a>

          <nav class="navbar navbar-expand-lg navbar-light">
            <div class=" navbar-collapse justify-content-center py-3">
              <ul class="navbar-nav justify-content-center flex-row">
                <li class="nav-item mx-2">
                  <a class="nav-link @if(\Request::is('/')) active @endif" href="{{ route('index') }}">Главная</a>
                </li>
                <li class="nav-item mx-2">
                  <a class="nav-link @if(\Request::is('catalog')) active @endif" href="{{ route('catalog') }}">Каталог</a>
                </li>
                <li class="nav-item mx-2">
                  <a class="nav-link @if(\Request::is('about')) active @endif" href="{{ route('about') }}">Контакты</a>
                </li>
                <li class="nav-item mx-2">
                  <a class="nav-link @if(\Request::is('price')) active @endif" href="{{ route('price') }}">Прайс-лист</a>
                </li>
              </ul>
            </div>
          </nav>
          
            <div class="text-center">
              <p class="copyright">Copyright © <script>document.write(new Date().getFullYear());</script> Все права защищены<br>
              Planting World - магазин комнатных растений</p>
            </div>

        </div>
      </div>
    </div>
  </footer>






    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script> -->
   
  </body>
</html>