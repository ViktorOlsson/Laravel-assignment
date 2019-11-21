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
        <div class="list-group">
            @if(count($products) > 1)
            @foreach ($products as $product)
            <a class="list-group-item list-group-item-action"
                href="/products/{{$product->id}}">{{ $product->title }}</a>
            @endforeach
        </div>
        @else
        <h1>Inga produkter i systemet</h1>
        @endif

    </div>
</body>

</html>