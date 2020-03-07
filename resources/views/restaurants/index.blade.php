@extends('layouts.app')


@section('list of restaurants')
   
    @foreach ($restaurants as $restaurant)

          <li>{{$restaurant->name}} in {{$restaurant->city}}</li>
          
        
    @endforeach




@endsection
