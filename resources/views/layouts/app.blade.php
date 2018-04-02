<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head profile="{{ url('/')}}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('storage/logos/healthy-logo2.svg')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="header-nav">
            <nav class="navbar navbar-expand-md navbar-light">
              <div class="container">
                <a class="navbar-brand" href="{{ url('/')}}">
                    <img src="{{ asset('storage/logos/healthy-logo2.svg')}}" height="48" width="100%" class="logo d-inline-block align-top" alt="logo">
                </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
              </button>
               <div class="collapse navbar-collapse" id="navbarNav">
                   <ul class="navbar-nav nav justify-content-center mr-auto">
                      <li class="nav-item">
                        <a class="nav-link active" href="#">HOME</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">ABOUT US</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">CATEGORIES</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " href="#">CONTACTS</a>
                      </li>
                    </ul>

                    <ul class=" navbar-nav nav justify-content-end">
                      @guest
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">LOGIN</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">SIGNUP</a>
                      </li>
                      @else

                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <ul class="dropdown-item">
                                <li>
                                    <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                                      
                        </div>
                      </li>

                      @endguest

                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <div class="input-group" style="display: none;">
                          <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon1">
                          <span class="input-group-addon" id="basic-addon1"><i class="fa fa-search"></i></span>
                        </div>
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link"><i class="fa fa-search"></i></a>
                            </li>
                            
                        </ul>
                    </form>

                    
               </div>
              </div> 
            </nav>
            
        </div>

        <div class="container">
          <div class="row mt-2">
            <div class="col"> 
            @yield('content')
            </div>
            <div id="notforlogin" class="col-3">
            @section('sidebar')
                @include('components.sidebar')
            @show

            </div>
          </div>
        </div>

        <footer class="footer">
          <div class="bottom-footer py-3">
            <div class="container">&copy Oval UI 2018</div>
          </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" charset="utf-8">
        function like(type,type_id){
          var _token= '<?php echo csrf_token() ?>';
          var data = {type,type_id,_token};
          ajax_request_like(data);
        }

        function ajax_request_like(input){
            var _url = '<?php echo route('like.store'); ?>';
            
            $.ajax({ 
                     type:'POST', 
                     url:_url, 
                     data:input, 
                     success:function(data){ 
                        console.log(data);
                     } 
            });
        }

        function dislike(type,type_id){
          var _token= '<?php echo csrf_token() ?>';
          var data = {type,type_id,_token};
          ajax_request_dislike(data);
        }

        function ajax_request_dislike(input){
            var _url = '<?php echo route('dislike.store'); ?>';
            
            $.ajax({ 
                     type:'POST', 
                     url:_url, 
                     data:input, 
                     success:function(data){ 
                        console.log(data);
                     } 
            });
        }

        var path = window.location.pathname;

        if(path =='/login'){
          $('#notforlogin').hide();
        }else{
          $('#notforlogin').show();
        }



    </script>
</body>
</html>
