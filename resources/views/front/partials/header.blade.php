<div class="container">
    <!-- carrito -->
    <!-- <div class="carrito">
        <div style="background-image: url(/images/cake.png); background-size: cover; background-repeat: no-repeat; background-position: center; height: 30px;
        width: 30px; float: right; position: sticky;">
            <span></span>
        </div>
    </div> -->
    <!-- navbar desktop -->
    <div class="m-0 mt-md-5 p-0">
        <div class="d-flex justify-content-center align-items-center">
            <a class="d-flex mt-5 justify-content-center align-items-center" href="{{route('front.index')}}">
                <img src="{{$logo->image}}" alt="" width="150" height="150">
            </a>
        </div>
    </div>
</div>
<!-- top banner -->

<div class="col-12 d-flex justify-content-between align-items-center position-absolute top-banner" style="top: 0;">
    <span class="d-block ps-5">Aprovechá las ofertas de Dulces Carmela por tiempo limitado</span>
    <a href="">
        <button class="btn d-block me-5">Ver Productos</button>
    </a>
</div>


<style scoped>
    .top-banner{
        background-color: #214ABF;
        height: 50px;
        box-shadow: 0px 7px 12px -8px #000000;
    }

    .top-banner span{
        font-family: 'Montserrat-Bold', serif;
        font-size: 15px;
        color: white;
    }

    .top-banner button{
        background: #59C3A6;
        /*font-family: 'Montserrat-Regular', sans-serif;*/
        color: white;
    }

    .top-banner button:hover{
        background: #59C3A6;
        /*font-family: 'Montserrat-Regular', sans-serif;*/
        color: white;
    }
/* main color: #59C3A6 */
/* blue color: #214ABF */
    .navbar-brand img{
        border-radius: 50%;
    }

    .nav-link{
        font-family: 'Lora-Regular', serif;
        font-size: 15px;
        text-decoration: none;
        color: black !important;
        text-transform: uppercase;
        width: 150px;
        text-align: center
    }

    .nav-item{
        position: relative
    }

    li:hover{
        cursor: pointer;
    }
</style>
