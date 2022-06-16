@extends('app')
@include('front.partials.header')
@section('content')
<div class="row">
    <div class="col-12 my-2">
        <div class="swiper mt-5">
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                    <div class="swiper-slide d-flex align-items-center justify-content-center position-relative">
                        <img src="{{asset($slider->image)}}" alt="">
                        <div class="position-absolute image-text ms-5" style="left: 0; top: 50%; ">
                            <span>Todos los días hacemos</span>
                            <h2>{{$slider->texto}}</h2>

                            <a href="">
                                <button class="btn rounded-pill mt-4">
                                    Comprar ahora
                                </button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        
            <!-- If we need navigation buttons -->
            {{-- <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div> --}}
        </div>
        <!-- Button trigger modal -->
        {{-- <a href="{{route('admin.product.images', $product->id)}}">
            <button type="button" class="btn btn-primary my-5" id="create_category">
                Editar fotos
            </button>
        </a> --}}
    </div>

    <div class="col-12 mt-3 mb-4 nosotras-section">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#214abf" fill-opacity="1" d="M0,160L48,176C96,192,192,224,288,240C384,256,480,256,576,229.3C672,203,768,149,864,122.7C960,96,1056,96,1152,85.3C1248,75,1344,53,1392,42.7L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>

        <div class="d-flex justify-content-center" style="background: #214abf">
            <div class="col-md-6 d-flex justify-content-center">
                <img src="{{asset($nosotras->image)}}" alt="">
            </div>
            <div class="nosotras-text col-md-6 px-md-5">
                <h2>Quienes somos...</h2>
                <p>{!! $nosotras->text !!}</p>
            </div>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#214abf" fill-opacity="1" d="M0,288L26.7,277.3C53.3,267,107,245,160,240C213.3,235,267,245,320,229.3C373.3,213,427,171,480,144C533.3,117,587,107,640,112C693.3,117,747,139,800,128C853.3,117,907,75,960,85.3C1013.3,96,1067,160,1120,165.3C1173.3,171,1227,117,1280,106.7C1333.3,96,1387,128,1413,144L1440,160L1440,0L1413.3,0C1386.7,0,1333,0,1280,0C1226.7,0,1173,0,1120,0C1066.7,0,1013,0,960,0C906.7,0,853,0,800,0C746.7,0,693,0,640,0C586.7,0,533,0,480,0C426.7,0,373,0,320,0C266.7,0,213,0,160,0C106.7,0,53,0,27,0L0,0Z"></path></svg>
    </div>

    <div class="col-12 productos-destacados">
        <h2>Nuestros productos destacados</h2>
        <div class="container">
            <div class="row my-5 justify-content-center align-items-center flex-wrap px-md-5">
                @foreach ($featured as $product)
                    <div class="col-md-4 my-5 card-container d-flex align-items-center position-relative flex-md-row flex-column">
                        <div style="float: left">
                            <img src="{{asset($product->cover_photo)}}" alt="">
                            <div class="ver-producto position-absolute d-flex justify-content-center align-items-center" style="top: 0;">
                                <div class="lupa">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </div>
                        </div>
                        <div class="ms-3">
                            <div class="position-absolute" style="top: 0;">
                                <h3 >{{$product->title}}</h3>
                                <span>{{$product->category->name}}</span>
                            </div>
                            <div class="position-absolute mb-2" style="bottom: 0">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .swiper {
        width: 80%;
        height: 540px;
    }
    .swiper-slide img{
        width: 100%;
        height: 100%;
        object-fit: cover
    }
</style>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
const swiper = new Swiper('.swiper', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,
  autoplay: {
    delay: 5000,
    disableOnInteraction: true,  
  },

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  // Navigation arrows
//   navigation: {
//     nextEl: '.swiper-button-next',
//     prevEl: '.swiper-button-prev',
//   },

  // And if we need scrollbar
  scrollbar: {
    el: '.swiper-scrollbar',
  },
  effect: "fade",
});
</script>