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
@extends('layouts.app')

@section('content')
<div class="container">
    @if(!Auth::guest())
    <h1>Ny produkt</h1>
    {{ Form::open(['action' => 'ProductsController@store', 'method' => 'POST']) }}
        <div class="form-group">
            {{ Form::label('title', 'Titel') }}
            {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Titel']) }}
        </div>
        <div class="form-group">
            {{ Form::label('brand', 'Märke') }}
            {{ Form::text('brand', '', ['class' => 'form-control', 'placeholder' => 'Märke']) }}
        </div>
        <div class="form-group">
            {{ Form::label('price', 'Pris') }}
            {{ Form::text('price', '', ['class' => 'form-control', 'placeholder' => 'Pris']) }}
        </div>
        <div class="form-group">
            {{ Form::label('image', 'Bild') }}
            {{ Form::text('image', '', ['class' => 'form-control', 'placeholder' => 'Länk till bild']) }}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Beskrivning') }}
            {{ Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Beskrivning...']) }}
        </div>
        
        @foreach ($stores as $store)

        <div class="form-group">
            <label for="{{$store->name}}">{{$store->name}}</label>
            <input type="checkbox" class="checkbox1" name="stores[{{$store->id}}]" value="{{$store->id}}">
        </div>
        @endforeach
        {{ Form::submit('Uppdatera', ['class' => 'btn btn-success']) }}
       {{ Form::close() }}
       @else
        <h1>Du måste logga in för att skapa nya produkter!</h1>
       @endif
      </div>

@endsection
    </body>
</html>