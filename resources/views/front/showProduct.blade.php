@extends('app')
@include('front.partials.productHeader')
@section('title', $product->title)
@section('content')

    <h1>Detalles del Producto</h1>
    <span>Home > Productos > Detalle</span>
    </div>
    </div>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>

    <div class="container-fluid">
        <div class="row product-container">
            <div class="col-lg-6 position-relative image-column">
                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                    <div class="swiper-wrapper position-absolute swiper-wrapper-principal" style="top: 0">
                        @foreach($product->getProductImages as $image)
                            <div class="swiper-slide slider-principal">
                                <img src="{{asset($image->image)}}"/>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <div thumbsSlider="" class="thumbs mt-0 swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach($product->getProductImages as $image)
                            <div class="swiper-slide">
                                <img src="{{asset($image->image)}}"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-6 position-relative product-details">
                <div class="position-relative">
                    <h1 class="product-title text-uppercase">{{$product->title}}</h1>
                    <div class="position-absolute mt-md-0" style="">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
                <div class="mt-5"></div>

                <div class="product-description">
                    <h3>DESCRIPCIÓN</h3>
                    <h4 class="d-block mt-4">{!! $product->description !!}</h4>

                    <h3 class="d-block mt-5">CATEGORÍA: <a href=""><strong>{{$product->category->name}}</strong></a>
                    </h3>
                    <a href="{{$whatsappText}}" target="_blank">
                        <button class="mt-5 p-3 btn rounded-pill d-flex align-items-center justify-content-center">
                            <div class="me-2">
                                Comprar Ahora
                            </div>
                            <i class="fa-brands fa-whatsapp"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- Demo styles -->
    <style>

        .image-column{
            max-height: 340px
        }

        .product-details button {
            background: linear-gradient(45deg, #00A143, #00A783);
            color: white;
            font-family: 'Montserrat-Bold', sans-serif;
        }

        .product-details button:hover {
            color: white;
        }

        .product-details button i {
            color: white !important;
            font-size: 30px;
        }

        .product-description {
            font-family: 'Lora', serif;
        }

        .product-description h3 {
            font-weight: 400;
            font-size: 20px;
        }

        .product-description h4 {
            font-weight: 400;
            font-size: 20px;
            color: #5b5b5b;
        }

        .product-details i {
            color: #EDB867;
        }

        .product-title {
            font-family: 'Lora', serif;
            font-size: 30px;
            font-weight: 600;
        }

        .product-container {
            margin-top: 150px !important;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;

            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
            max-height: 450px !important;
        }

        .swiper-slide img {
            display: block;
            width: 70% !important;
            height: 70% !important;
            object-fit: cover !important;
        }

        .swiper {
            width: 100%;
            height: 100px;
            margin-left: auto;
            margin-right: auto;
        }

        .swiper-slide {
            background-size: cover;
            background-position: center;
        }

        /** contenedor principal principal **/
        .mySwiper2 {
            height: 130%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /** contenedor principal **/
        .slider-principal {
            height: 400px !important;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-wrapper-principal {
            max-height: 400px !important;
        }

        .slider-principal img {
            margin: 0 auto;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #214ABF !important;
        }


        .slider-principal img {
            display: block;
            width: 100% !important;
            height: 100% !important;
            object-fit: contain !important;
        }

        .mySwiper {
            height: 25%;
            box-sizing: border-box;
            padding: 10px 0;
        }

        .mySwiper .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
        }

        .mySwiper .swiper-slide-thumb-active {
            opacity: 1;
        }

        .mySwiper .swiper-slide-thumb-active img {
            border: 3px solid #214ABF;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        @media(max-width: 900px){
            .image-column{
                max-height: 340px;
                height: 750px;
            }

            .product-container {
                margin-top: 15px !important;
                margin-bottom: 0px!important;
            }

            .product-details{
                transform: translateY(150px);
            }

            .thumbs{
                transform: translateY(-60px);
            }
        }
    </style>


    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>



