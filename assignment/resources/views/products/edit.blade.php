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
          <h1>Redigera Produkt</h1>
        {{ Form::open(['action' => ['ProductsController@update', $product->id], 'method' => 'POST']) }}
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', $product->title, ['class' => 'form-control', 'placeholder' => 'Title']) }}
        </div>
        <div class="form-group">
            {{ Form::label('brand', 'Märke') }}
            {{ Form::text('brand', $product->brand, ['class' => 'form-control', 'placeholder' => 'Märke']) }}
        </div>
        <div class="form-group">
            {{ Form::label('price', 'Pris') }}
            {{ Form::text('price', $product->price, ['class' => 'form-control', 'placeholder' => 'Pris']) }}
        </div>
        <div class="form-group">
            {{ Form::label('image', 'Bild') }}
            {{ Form::text('image', $product->image, ['class' => 'form-control', 'placeholder' => 'Länk till bild']) }}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Beskrivning') }}
            {{ Form::textarea('description', $product->description, ['class' => 'form-control', 'placeholder' => 'Beskrivning...']) }}
        </div>
        <div class="form-group">
            {{ Form::label('elgiganten', 'Elgiganten') }}
            @foreach($product->stores as $store)
              @if($store->name == 'Elgiganten')
                <input type="checkbox" class="checkbox1" name="stores[]" value="1" checked>
                @break
              @elseif($product->stores !== 'Elgiganten' && $loop->last)
                <input type="checkbox" class="checkbox1" name="stores[]" value="1">
              @endif
            @endforeach
        </div>
        <div class="form-group">
            {{ Form::label('media-markt', 'Media Markt') }}
            @foreach($product->stores as $store)
              @if($store->name == 'Media Markt')
                <input type="checkbox" class="checkbox1" name="stores[]" value="2" checked>
                @break
              @elseif($store->name !== 'Media Markt' && $loop->last)
                <input type="checkbox" class="checkbox1" name="stores[]" value="2">
              @endif
            @endforeach
            
        </div>
        <div class="form-group">
            {{ Form::label('expert', 'Expert') }}
            @foreach($product->stores as $store)
              @if($store->name == 'Expert')
                <input type="checkbox" class="checkbox1" name="stores[]" value="3" checked>
                @break
              @elseif($store->name !== 'Expert' && $loop->last)
                <input type="checkbox" class="checkbox1" name="stores[]" value="3">
              @endif
            @endforeach
            
        </div>
        <div class="form-group">
            {{ Form::label('siba', 'Siba') }}
            @foreach($product->stores as $store)
              @if($store->name == 'Siba')
                <input type="checkbox" class="checkbox1" name="stores[]" value="4" checked>
                @break
              @elseif($store->name !== 'Siba' && $loop->last)
                <input type="checkbox" class="checkbox1" name="stores[]" value="4">
              @endif
            @endforeach
            
        </div>
        {{ Form::hidden('_method', 'PUT') }}
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
        </div>
    </body>
</html>