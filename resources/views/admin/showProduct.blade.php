@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/admin/homeSliders.css')}}">
<link
rel="stylesheet"
href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
/>

@section('title', '{{$product->title}}')

@section('content_header')
    <h1>{{$product->title}}</h1>
@stop

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 m-2">
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach ($product->getProductImages as $image)
                        <div class="swiper-slide">
                            <img src="{{asset($image->image)}}" alt="">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary my-5" id="create_category">
        Crear Categoria
    </button>
</div>


@stop

@section('css')
<style>
    .swiper {
        width: 800px;
        height: 600px;
    }
    .swiper-slide img{
        max-width: 100%;
        max-height: 100%;
        object-fit: cover
    }
</style>
  
@stop

@section('js')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
const swiper = new Swiper('.swiper', {
  // Optional parameters
  direction: 'vertical',
  loop: true,

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // And if we need scrollbar
  scrollbar: {
    el: '.swiper-scrollbar',
  },
});
</script>