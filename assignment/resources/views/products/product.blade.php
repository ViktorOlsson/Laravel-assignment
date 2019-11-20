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
              <h1>{{ $product->title }}</h1>
    <div>
        <p>{{ $product->brand }}</p>
        <p>{{ $product->price }}</p>
        <p>{{ $product->description }}</p>
        <h4>Butiker</h4>
        @foreach($product->stores as $store)
          <p>{{ $store->name }}, {{ $store->city }}</p>
        @endforeach
        <div class="w-50">
          <img src={{ $product->image }} class="img-thumbnail" />
        </div>
        <h4>Recensioner</h4>
        @foreach($product->reviews as $review)
          <p>{{ $review->comment }}</p>
          <p>skriven av: {{ $review->name }}</p>
          <br>
        @endforeach
    </div>
    @if(!Auth::guest())
        <a href="/products/{{$product->id}}/edit" class="btn btn-defaut">Redigera</a>
        {!!Form::open(['action' => ['ProductsController@destroy', $product->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
        {!!Form::close() !!}
    @endif
        </div>
    </body>
</html>