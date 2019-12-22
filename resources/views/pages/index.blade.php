<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>{{config('app.name', 'Laravel')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
       
    </head>
    <body>
     
        @include('layouts.app')
        <div class="container">


       <h1>{{$title}}</h1>
    
       <h2>Version 2.1</h2>
       <p>Denna applikation använder sig av följande url:er enligt CRUD standard</p>

       <ul class="list-group mb-2">
        <li class="list-group-item">GET products/</li>
        <li class="list-group-item">GET products/id</li>

        <li class="list-group-item">POST products/ (kräver inloggning)</li>
        <li class="list-group-item">PATCH products/id  (kräver inloggning)</li>
        <li class="list-group-item">DELETE products/id  (kräver inloggning)</li>
      </ul>

      <ul class="list-group mb-2">
        <li class="list-group-item">GET reviews/</li>
      </ul>

      <ul class="list-group mb-2">
        <li class="list-group-item">GET stores/</li>
      </ul>
      
        </div>
        </div>
    </body>
</html>