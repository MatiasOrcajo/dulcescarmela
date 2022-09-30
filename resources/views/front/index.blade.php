@extends('app')
@include('front.partials.header')
@include('front.partials.slidemenu')
@section('title', 'Dulces Carmela')
@section('content')
    <div class="row">
        <div class="col-12 my-2">
            <div class="swiper mt-5 mb-md-5">
                <div class="swiper-wrapper">
                    @foreach ($sliders as $slider)
                        <div class="swiper-slide d-flex align-items-center justify-content-center position-relative">
                            <img src="{{asset($slider->image)}}" alt="">
                            <div class="position-absolute image-text ms-5" style="left: 0; top: 50%; ">
                                <span>Todos los días hacemos</span>
                                <h2>{{$slider->texto}}</h2>

                                <a href="{{route('front.showProduct', $slider->product()->slug)}}">
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

        <div class="col-12 mt-md-3 mt-5 mb-4 nosotras-section" id="nosotras">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#214abf" fill-opacity="1"
                      d="M0,160L48,176C96,192,192,224,288,240C384,256,480,256,576,229.3C672,203,768,149,864,122.7C960,96,1056,96,1152,85.3C1248,75,1344,53,1392,42.7L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>

            <div class="row justify-content-center" style="background: #214abf">
                <div class="col-md-6 d-flex justify-content-center">
                    @if(isset($nosotras))
                        <img src="{{asset($nosotras->image)}}" alt="">
                    @endif
                </div>
                <div class="nosotras-text col-md-6 px-md-5 px-4 mt-5 mt-md-0">
                    <h2 class="d-block mb-md-0 mb-3">Quienes somos...</h2>
                    @if(isset($nosotras))
                        <p>{!! $nosotras->text !!}</p>
                    @endif
                </div>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#214abf" fill-opacity="1"
                      d="M0,288L26.7,277.3C53.3,267,107,245,160,240C213.3,235,267,245,320,229.3C373.3,213,427,171,480,144C533.3,117,587,107,640,112C693.3,117,747,139,800,128C853.3,117,907,75,960,85.3C1013.3,96,1067,160,1120,165.3C1173.3,171,1227,117,1280,106.7C1333.3,96,1387,128,1413,144L1440,160L1440,0L1413.3,0C1386.7,0,1333,0,1280,0C1226.7,0,1173,0,1120,0C1066.7,0,1013,0,960,0C906.7,0,853,0,800,0C746.7,0,693,0,640,0C586.7,0,533,0,480,0C426.7,0,373,0,320,0C266.7,0,213,0,160,0C106.7,0,53,0,27,0L0,0Z"></path>
            </svg>
        </div>

        <section>
            <div class="col-12 productos-destacados my-5" id="destacados">
                <h2>Nuestros productos destacados</h2>
                <div class="container">
                    <div class="row my-5 justify-content-center align-items-center flex-wrap px-md-5"
                         data-aos="zoom-in">
                        @foreach ($featured as $product)

                            <div
                                class="col-md-4 my-5 card-container d-flex align-items-center position-relative flex-md-row">
                                <a href="{{route('front.showProduct', $product->slug)}}">
                                    <div style="float: left">

                                        <img src="{{asset($product->cover_photo)}}" alt="">

                                        <div
                                            class="ver-producto position-absolute d-flex justify-content-center align-items-center"
                                            style="top: 0;">
                                            <div class="lupa">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="ms-3">
                                    <div class="position-absolute" style="top: 0;">
                                        <h3>{{$product->title}}</h3>
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
        </section>

        <section>
            <div class="col-md-8 contadores my-5" style="margin: 0 auto">
                <div class="d-flex flex-md-row flex-column justify-content-around align-items-center contador">
                    @if(isset($counters))
                        @foreach($counters as $counter)
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <img src="{{$counter->icon}}">
                                <div class="contador_cantidad" data-cantidad-total="{{$counter->quantity}}">
                                    0
                                </div>
                                <span class="counter-title">{{$counter->title}}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>


        <div class="col-12 testimonios my-5">
            <div class="w-100 d-flex justify-content-center align-items-center" id="testimonios">
                @if(isset($background))
                    <div style="background-image: url({{asset($background->image)}});
                        background-size: cover;
                        background-repeat: no-repeat;
                        background-position: center;"
                         class="background-testimonios d-flex justify-content-center align-items-center">
                        <div class="h-75 opinion-container">
                            <div class="swiper2">
                                <div class="swiper-wrapper">
                                    @foreach ($opinions as $opinion)

                                        <div
                                            class="opinion-image swiper-slide d-flex justify-content-center align-items-center flex-column">
                                            <img class="position-absolute" src="{{asset($opinion->image)}}" alt="">
                                            <div class="opinion-stars">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div>
                                            <div class="opinion-text mt-5 px-md-5 px-2 text-center">
                                                <p>“{{$opinion->content}}”</p>
                                            </div>
                                            <div class="opinion-separator mt-0"></div>
                                            <div class="opinion-name text-center mt-0">
                                                <strong>{{$opinion->name}}</strong>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                                <div class="swiper-pagination2 d-flex justify-content-center align-items-center"
                                     style="margin: 0 auto"></div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>


        <section id="contacto">
            <div class="col-12 d-md-flex d-none container my-5" data-aos="fade-up">
                <div class="col-md-3 d-md-block d-none">
                    @if(isset($contact))
                        <div class="contact-container">
                            <img src="{{asset($contact->image_1)}}" alt="imagen 1"
                                 style="width: 100%; height: 100%; object-fit: cover">
                        </div>
                    @endif
                </div>
                <div class="col-md-3 d-md-block d-none">
                    <div class="contact-container d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3 text-center">
                            <h3 class="d-block mb-3">NUESTRA COCINA</h3>
                            <h4 class="d-block mb-4">Biglieri 3060, Lanús</h4>
                            <span><i class="fa-brands fa-whatsapp"></i> @if(isset($whatsapp))
                                    {{$whatsapp->number}}
                                @endif</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-md-block d-none">
                    @if(isset($contact))
                        <div class="contact-container">
                            <img src="{{asset($contact->image_2)}}" alt="imagen 1"
                                 style="width: 100%; height: 100%; object-fit: cover">
                        </div>
                    @endif
                </div>
                <div class="col-md-3 d-md-block d-none">
                    <div class="contact-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d669.9006415950307!2d-58.414326426637835!3d-34.70576021867833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcccfe2d1fb757%3A0xd5462002700a02db!2sCalle%20Dr.%20Yolivan%20Alberto%20Biglieri%203060%2C%20B1825DWP%20Lan%C3%BAs%2C%20Provincia%20de%20Buenos%20Aires!5e0!3m2!1ses!2sar!4v1656870077818!5m2!1ses!2sar"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

            <div class="row p-0 mx-0 w-100 d-md-none container my-5" data-aos="fade-up" id="contacto">
                <div class="col-md-3 d-md-none d-block">
                    @if(isset($contact))
                        <div class="contact-container">
                            <img src="{{asset($contact->image_1)}}" alt="imagen 1"
                                 style="width: 100%; height: 100%; object-fit: cover">
                        </div>
                    @endif
                </div>
                <div class="col-md-3 d-md-none d-block">
                    <div class="contact-container d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3 text-center">
                            <h3 class="d-block mb-3">NUESTRA COCINA</h3>
                            <h4 class="d-block mb-4">Biglieri 3060, Lanús</h4>
                            <span><i class="fa-brands fa-whatsapp"></i> @if(isset($whatsapp))
                                    {{$whatsapp->number}}
                                @endif</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-md-none d-block">
                    @if(isset($contact))
                        <div class="contact-container">
                            <img src="{{asset($contact->image_2)}}" alt="imagen 1"
                                 style="width: 100%; height: 100%; object-fit: cover">
                        </div>
                    @endif
                </div>
                <div class="col-md-3 d-md-none d-block">
                    <div class="contact-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d669.9006415950307!2d-58.414326426637835!3d-34.70576021867833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcccfe2d1fb757%3A0xd5462002700a02db!2sCalle%20Dr.%20Yolivan%20Alberto%20Biglieri%203060%2C%20B1825DWP%20Lan%C3%BAs%2C%20Provincia%20de%20Buenos%20Aires!5e0!3m2!1ses!2sar!4v1656870077818!5m2!1ses!2sar"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

        {{--        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13125.327965428385!2d-58.34978525379637!3d-34.67156962109624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a333156977ebc1%3A0x66d3de00eb1f9d7a!2sIguaz%C3%BA%20406%2C%20B1873CFJ%20Crucecita%2C%20Provincia%20de%20Buenos%20Aires!5e0!3m2!1ses!2sar!4v1656866213436!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>--}}

    </div>


    <style>

        /**{*/
        /*    box-sizing: border-box;*/
        /*    background: rgb(0 100 0 / 0.1) !important;*/
        /*}*/


        .contact-container {
            height: 340px;
            width: 100%;
            background-color: #f9f9f9;
        }

        .contact-container h3 {
            font-family: 'Lora', serif;
            font-size: 26px;
            font-weight: 700;
        }

        .contact-container h4 {
            font-family: 'Lora', serif;
            color: #767676;
            font-size: 20px;
            text-transform: uppercase;
        }

        .contact-container span {
            font-family: 'Lora', serif;
            color: #767676;
            font-size: 16px;
        }

        .swiper {
            width: 80%;
            height: 540px;
        }

        @media (max-width: 900px) {
            .swiper {
                width: 100%;
                height: 540px;
            }
        }

        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>

        AOS.init();

        $(document).ready(function () {
            const contadores = document.querySelectorAll('.contador_cantidad');
            const velocidad = 3000;

            const animarContadores = () => {
                for (const contador of contadores) {
                    const actualizar_contador = () => {
                        let cantidad_maxima = +contador.dataset.cantidadTotal,
                            valor_actual = +contador.innerText,
                            incremento = cantidad_maxima / velocidad;
                        if (valor_actual < cantidad_maxima) {
                            contador.innerText = Math.ceil(valor_actual + incremento)
                            setTimeout((actualizar_contador), 5);
                        } else {
                            contador.innerText = cantidad_maxima;

                        }
                    }
                    actualizar_contador();
                }
            }

            const mostrarContadores = elementos => {
                elementos.forEach(element => {
                    if (element.isIntersecting) {
                        setTimeout(animarContadores, 300)
                    }
                });
            }

            const observer = new IntersectionObserver(mostrarContadores, {
                threshold: 0 //0 - 1
            })

            const elementosHTML = document.querySelectorAll('.contador')
            elementosHTML.forEach(elementoHTML => {
                observer.observe(elementoHTML)
            })
        })


        const swiper = new Swiper('.swiper', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: true,
            },

            // If we need pagination
//   pagination: {
//     el: '.swiper-pagination',
//   },

            // Navigation arrows
//   navigation: {
//     nextEl: '.swiper-button-next',
//     prevEl: '.swiper-button-prev',
//   },

            // And if we need scrollbar
//   scrollbar: {
//     el: '.swiper-scrollbar',
//   },
            effect: "fade",
        });


        const swiper2 = new Swiper('.swiper2', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,
            autoplay: {
                delay: 6000,
            },
            slidesPerView: 1,

            // If we need pagination
            pagination: {
                el: ".swiper-pagination2",
                dynamicBullets: true,
            },

            // And if we need scrollbar
//   scrollbar: {
//     el: '.swiper-scrollbar',
//   },
            effect: "fade",
            fadeEffect: {
                crossFade: true
            }
        });
    </script>
