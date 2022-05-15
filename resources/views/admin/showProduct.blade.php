@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/admin/homeSliders.css')}}">

@section('title', '{{$product->title}}')

@section('content_header')
    <h1>{{$product->title}}</h1>
@stop

@section('content')
    

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 m-2">
            {{-- <img src="{{$product->}}" alt=""> --}}
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary my-5" id="create_category">
        Crear Categoria
    </button>
</div>


@stop

@section('css')
  
@stop

@section('js')