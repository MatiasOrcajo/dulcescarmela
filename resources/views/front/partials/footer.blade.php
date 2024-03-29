<div class="container-fluid"
     style="{{Route::is('front.showProduct') || Route::is('front.products') ? 'transform: translateY(250px)' : ''}}">
    <div class="row">
        <div class="footer-container py-5">
            <div class="col-md-12 d-flex flex-wrap justify-content-center align-items-center">
                <div class="col-md-3 footer-logo d-flex justify-content-center align-items-center flex-column">
                    <img src="{{$logo->image}}">
                    <div class="d-flex justify-content-center align-items-center">
                        <a target="_blank" href="{{$social->facebook}}">
                            <div class="social-container me-3 d-flex justify-content-center align-items-center p-2">
                                <i class="fa-brands fa-facebook-f"></i>
                            </div>
                        </a>
                        <a target="_blank" href="{{$social->facebook}}">
                            <div class="social-container me-3 d-flex justify-content-center align-items-center p-2">
                                <i class="fa-brands fa-instagram"></i>
                            </div>
                        </a>
                        @if($social->tiktok)
                            <a target="_blank" href="{{$social->tiktok}}">
                                <div class="social-container me-3 d-flex justify-content-center align-items-center p-2">
                                    <i class="fa-brands fa-tiktok"></i>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="col-md-3 footer-contact d-flex justify-content-center align-items-center flex-column">
                    <div class="text-center">
                        <h3>Contacta con nosotras</h3>
                        <br>
                        <span>{{$social->address}}</span>
                        <br>
                        <a style="color: #214abf" href="https://wa.me/{{$whatsapp->number}}">
                            <span>+54 {{$whatsapp->number}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 footer-copyright py-2 text-center">
            © Copyright <strong>Dulces Carmela</strong>. Desarrollado por <a
                href="https://www.linkedin.com/in/matiasorcajo" target="blank">Mati</a>.
        </div>
    </div>
</div>

<style>

    .footer-copyright {
        background: black;
        color: #777;
        font-size: 14px;
    }

    .footer-copyright strong {
        color: white;
    }

    .footer-copyright a {
        color: #cd9b33;
    }

    .footer-contact h3 {
        font-size: 28px;
        color: #214abf;
        font-weight: 700;
    }

    .footer-logo img {
        height: 200px;
        width: auto;
    }

    .social-container {
        background: white;
        margin-top: 30px;
        height: 30px;
        width: 30px;
        border-radius: 50%;
        border: 2px solid #214abf;
    }

    .social-container i {
        color: #214ABF;
    }

    .footer-container {
        background-color: #F5F6F6;
    }
</style>
