<div class="menu-hamburguesa" id="menu_hamburguesa">
    <img src="{{asset('images/menu.svg')}}">
</div>
<div class="slide-menu-hide" id="menu_to_display">
    <div class="menu-cerrar" id="menu_cerrar">
        <img src="{{asset('images/cross.svg')}}">
    </div>
    <ul class="mt-2 d-flex flex-column justify-content-center align-items-center mb-2 mb-lg-0">
        <li class="nav-item mx-3">
            <a class="nav-link active" href="{{route('front.index')}}">Home</a>
        </li>
        <li class="nav-item mx-3">
            <a class="nav-link" href="{{route('front.index').'#nosotras'}}">Nosotras</a>
        </li>
        <li class="nav-item mx-3">
            <a class="nav-link" href="{{route('front.index').'#destacados'}}">Destacados</a>
        </li>
        <li class="nav-item mx-3">
            <a class="nav-link" href="{{route('front.products')}}">Productos</a>
        </li>
        <li class="nav-item mx-3">
            <a class="nav-link" href="{{route('front.index').'#testimonios'}}">Testimonios</a>
        </li>
        <li class="nav-item mx-3">
            <a class="nav-link" href="{{route('front.index').'#contacto'}}">Contacto</a>
        </li>
    </ul>
</div>

<script>
    const menu = document.getElementById('menu_hamburguesa');

    menu.addEventListener('click', function(e){
        const menu_to_display = document.getElementById('menu_to_display');
        menu_to_display.classList.add('slide-menu');
        menu_to_display.classList.remove('slide-menu-hide');
    })

    const menuCerrar = document.getElementById('menu_cerrar');

    menuCerrar.addEventListener('click', function(){
        const menu_to_display = document.getElementById('menu_to_display');
        menu_to_display.classList.add('slide-menu-hide');
        menu_to_display.classList.remove('slide-menu');
    })
</script>

<style>

    .menu-cerrar:hover{
        cursor: pointer;
    }

    .menu-cerrar img{
        position: absolute;
        top: 0;
        right: 0;
        height: 50px;
        width: 50px;
        filter:  brightness(0) invert(1);
    }

    .menu-hamburguesa:hover{
        cursor: pointer;
    }

    .menu-hamburguesa{
        height: 50px;
        width: 50px;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 999999999999999999999999999;
        background: #0d6efd;
        margin-top: 70px;
    }

    .menu-hamburguesa img{
        height: 50px;
        width: 50px;
        filter:  brightness(0) invert(1);
    }

    .slide-menu{
        height: 100vh;
        width: 350px;
        transition: .5s ease;
        top: 0;
        background: #0d6efd;
        z-index: 999999999999999999999999999;
        position: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        text-after-overflow: center;
        transform: translateX(0%);
    }

    .slide-menu-hide{
        height: 100vh;
        width: 350px;
        transition: .5s ease;
        top: 0;
        background: #0d6efd;
        z-index: 999999999999999999999999999;
        position: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        text-after-overflow: center;
        transform: translateX(-100%);
    }

    .slide-menu li a,
    .slide-menu-hide li a{
        font-family: 'Montserrat-Bold', sans-serif;
        margin: 25px 0px 25px 0px;
        color: white!important;
    }
</style>
