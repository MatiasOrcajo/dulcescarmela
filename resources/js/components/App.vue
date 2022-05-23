<template>
    <main>
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
                <ul class="me-auto mt-5 d-flex justify-content-center align-items-center mb-2 mb-lg-0">
                    <li class="nav-item mx-5">
                        <router-link exact-active-class="active" to="/" class="nav-link active" aria-current="page">Home</router-link>
                    </li>
                    <li class="nav-item mx-5">
                        <router-link exact-active-class="active" to="/categories" class="nav-link">Nosotras</router-link>
                    </li>   
                    <li class="nav-item mx-5">
                        <router-link exact-active-class="active" to="/categories" class="nav-link">Productos</router-link>
                    </li>  
                    <a class="d-flex justify-content-center align-items-center" href="#">
                        <img src="/images/dulces_carmela_logo.jpg" alt="" width="150" height="150">
                    </a>
                    <li class="nav-item mx-5">
                        <router-link exact-active-class="active" to="/categories" class="nav-link">Categorías</router-link>
                    </li>  
                    <li class="nav-item mx-5">
                        <router-link exact-active-class="active" to="/categories" class="nav-link">Opiniones</router-link>
                    </li>  
                    <li class="nav-item mx-5">
                        <router-link exact-active-class="active" to="/categories" class="nav-link">Contacto</router-link>
                    </li>    
                </ul>
            </div>
        </div>
        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </main>
</template>

<style scoped>
/* main color: #59C3A6 */
/* blue color: #214ABF */
    .navbar-brand img{
        border-radius: 50%;
    }

    .carrito span{
        height: 10px;
        width: 10px;
        background: #59C3A6;
        border-radius: 50%;
    }

    .nav-link{
        font-family: 'Montserrat-Bold', serif;
        font-size: 18px;
        text-decoration: none;
        color: #214ABF;
    }
</style>

<script>
    export default {}
</script>