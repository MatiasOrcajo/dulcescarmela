<div class="container">
    <!-- carrito -->
    <!-- <div class="carrito">
        <div style="background-image: url(/images/cake.png); background-size: cover; background-repeat: no-repeat; background-position: center; height: 30px;
        width: 30px; float: right; position: sticky;">
            <span></span>
        </div>
    </div> -->
    <!-- navbar desktop -->
    <div class="m-0 p-0">
        <div class="d-flex justify-content-center align-items-center">
            <a class="d-flex mt-5 justify-content-center align-items-center" href="#">
                <img src="/images/dulces_carmela_logo.jpg" alt="" width="150" height="150">
            </a>
        </div>
        <ul class="me-auto mt-2 d-flex justify-content-center align-items-center mb-2 mb-lg-0">
            <li class="nav-item mx-5">
                <a class="nav-link active" aria-current="page">Home</a>
            </li>
            <li class="nav-item mx-5">
                <a class="nav-link">Nosotras</a>
            </li>   
            <li class="nav-item mx-5">
                <a class="nav-link">Productos</a>
            </li>  
            <li class="nav-item mx-5">
                <a class="nav-link">Categorías</a>
            </li>  
            <li class="nav-item mx-5">
                <a class="nav-link">Opiniones</a>
            </li>  
            <li class="nav-item mx-5">
                <a class="nav-link">Contacto</a>
            </li>    
        </ul>
    </div>
</div>


<style scoped>
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

    li:before{
        content: '';
        position: absolute;
        bottom: 0;
        width:0%;
        height: 2px;
        background: #214ABF;
        transition: .5s ease;
    }

    li:hover:before{
        width: 100%;
        background: #214ABF;
        transition: .5s ease;
    }

    li:hover{
        cursor: pointer;
    }
</style>