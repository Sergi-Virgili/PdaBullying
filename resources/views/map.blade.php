<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Map
    
        </title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Scripts -->

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="container">
                <div class="map" id="map">
                </div>
                
                <div class="mapform">
                    <div class="form-control">
                        <div class="form-group">
                            <label for="adress">Direcció</label>
                            <input type="text" id='street' name="street" placeholder="Carrer" required>
                            <input type='number' id='streetNumber' name="streetNumber" placeholder="Numero" required>
                        
                        </div>
                        <div>
                            <label for="lat">Geo</label>
                            <input type="text" id='lat' placeholder="lat">
                            <input type="text" id= 'long' placeholder="long">
                        </div>
                        <button class="btn btn-success mt-4 " id='sendPlace'>send</button>
                    </div>
                    <div class="form-control">
                        <div class="form-group">
                           <input type="email" placeholder="email">
                           
                        </div>
                        <div class="form-group">
                           <input type="password" placeholder="password">
                           
                        </div>
                        <button class="btn btn-success mt-4 " id='sendPlace'>Login</button>
                    </div>
                    <div class="form-control">
                        <div class="form-group">
                           <input type="email" placeholder="email">
                           
                        </div>
                        <div class="form-group">
                           <input type="password" placeholder="password">
                           
                        </div>
                        <button class="btn btn-success mt-4 " id='sendPlace'>Register</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
