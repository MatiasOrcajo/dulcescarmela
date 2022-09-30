@include('front.partials.slidemenu')
<div class="w-100">
    <div class="product-background position-absolute" style="z-index: 9"></div>
    <div class="container">
        <div class="m-0 mt-md-3 mt-2 mb-5 p-0 d-flex justify-content-center align-items-center">
            <div class="d-flex justify-content-center align-items-center">
                <a class="d-flex justify-content-center align-items-center" href="{{route('front.index')}}">
                    <img src="{{$logo->image}}" alt="" width="150" height="150" style="z-index: 9999">
                </a>
            </div>
        </div>

        <div class="row">
            <div style="z-index: 999999" class="col-12 text-center product-details-title">







    <style>

        .product-background-cover{
            background: #214ABF;
            width: 100%;
            height: 300px;
            top: 0;
            opacity: .8;
            box-shadow: 3px 4px 15px -6px #000000;
        }

        .product-background{
            background-image: url('../images/product-hero.jpg');
            background-position: 50% 50% !important;
            background-size: cover;
            height: 350px;
            width: 100%;
            top: 0;
        }

        .product-details-title{
            font-family: 'Lora', serif;
            font-size: 48px;
            font-weight: bold;
        }

        .product-details-title span{
            font-family: 'Lora', serif;
            font-size: 21px;
            font-weight: normal;
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

        li:before{
            content: '';
            position: absolute;
            bottom: 0;
            width:0%;
            height: 2px;
            background: white;
            transition: .5s ease;
        }

        li:hover:before{
            width: 100%;
            background: white;
            transition: .5s ease;
        }

        li:hover{
            cursor: pointer;
        }
    </style>
