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
        
       
          <p>{{ $product->brand }} {{ $product->title }}</p>
        <img src="{{$product->image}}" class="img-thumbnail mx-auto d-block" alt="Responsive image">
      
        <p>{{ $product->description }}</p>
        <p>{{ $product->price }}:-</p>
        
        <h4>Butiker</h4>
        <ul class="list-group mb-5">
        @foreach($product->stores as $store)
        <li class="list-group-item">{{ $store->name }}, {{ $store->city }}</li>
        @endforeach
        <div class="w-50">
          <img src={{ $product->image }} class="img-thumbnail" />
        </div>
        <h4>Recensioner</h4>
        @foreach($product->reviews as $review)

        <div class="card">
          <div class="card-body">
            
            <p class="card-text ">{{ $review->comment }} <span class="badge badge-pill badge-success float-right">{{ $review->grade }}</span></p>
            
            
         
            
            
          </div>
          <div class="card-footer text-right">Skriven av: {{ $review->name }}</div>
        </div>
          <p></p>
          
          <br>
        @endforeach
  
    @if(!Auth::guest())

    <div class="row">
        <a href="/products/{{$product->id}}/edit" class="btn btn-success ml-3 mb-3">Redigera</a>
        {!!Form::open(['action' => ['ProductsController@destroy', $product->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('Ta bort', ['class' => 'btn btn-danger ml-1']) }}
        {!!Form::close() !!}
      </div>
    @endif
        </div>
    </body>
</html>

