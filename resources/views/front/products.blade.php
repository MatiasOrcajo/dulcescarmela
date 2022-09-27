@extends('app')
@include('front.partials.productHeader')
@section('content')

    <h1>Productos</h1>
    <span>Home > Productos</span>
    </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-2 mt-5 ps-5">
                <aside class="categorias-aside">

                    <div style="border-bottom: 1px solid #214ABF;" class="pb-3">
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" id="search_product"
                                       placeholder="Buscar Producto">
                            </div>
                        </form>
                    </div>

                    <div style="border-bottom: 1px solid #214ABF;" class="pb-3 pt-4">
                        <div>
                            <h3>CATEGORÍAS</h3>
                        </div>
                        @foreach($categories as $category)
                            <div class="form-check my-2">
                                <input class="form-check-input category-input" type="checkbox" value="{{$category->id}}"
                                       id="{{$category->id}}" name="category_checkbox" onclick="queryCheckbox()">
                                <label class="form-check-label" for="{{$category->id}}">
                                    {{$category->name}} ({{$category->countProducts()}})
                                </label>
                            </div>
                        @endforeach
                    </div>
                </aside>
            </div>

            <div class="col-md-10 mt-5 d-flex flex-wrap justify-content-between align-items-center"
                 id="products_container">
                @foreach($products as $product)
                    <div class="product-list-container text-center d-flex flex-column">
                        <img src="{{$product->cover_photo}}" alt="product_image">
                        <h3 class="d-block mt-3 mb-2">
                            {{$product->title}}
                        </h3>
                        <span class="d-block mb-4">
                            {{$product->category->name}}
                        </span>
                        <a href="{{route('front.showProduct', $product->slug)}}">
                            <button class="btn rounded-pill">
                                VER
                            </button>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>

    <style>

        .display {
            opacity: 0;
            visibility: hidden;
            order: 1;
        }

        .form-check-input[type=checkbox] {
            height: 20px;
            width: 20px;
            margin: 0 auto;
        }

        .categorias-aside h3 {
            font-family: 'Lora', serif;
            font-size: 21px;
            font-weight: 700;
        }

        .categorias-aside label {
            font-family: 'Lora', serif;
            font-size: 17px;
            font-weight: 400;
        }

        .product-list-container h3 {
            font-family: 'Lora', serif;
            font-size: 28px;
            font-weight: 400;
        }

        .product-list-container {
            width: 280px;
            height: 360px;
            border: 1px solid #e0e0e0;
            box-shadow: 2px 5px 8px -6px #000000;
            -webkit-box-shadow: 2px 5px 8px -6px #000000;
            -moz-box-shadow: 2px 5px 8px -6px #000000;
            border-radius: 20px;
            overflow: hidden;
        }

        .product-list-container img {
            height: 200px;
            width: auto;
        }

        .product-list-container button {
            font-family: 'Montserrat-Bold', sans-serif;
            background-color: #214ABF;
            padding: 10px 25px 10px 25px;
            color: white;
            text-align: center;
        }

        .product-list-container button:hover {
            color: white;
        }


    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script>

        function searchProduct() {
            document.getElementById('search_product').addEventListener('keyup', (e) => {
                let value = e.target.value;
                let cards = document.querySelectorAll('.product-list-container');
                cards.forEach(card => card.textContent.toLocaleLowerCase().includes(value) ? card.classList.remove('display') : card.classList.add('display'));
            })
        }
        searchProduct();

        function getBaseURL() {
            return location.protocol + "//" + location.hostname + (location.port && ":" + location.port) + "/";
        }

        function getBaseURLForImages() {
            return location.protocol + "//" + location.hostname + (location.port && ":" + location.port);
        }

        function queryCheckbox() {

            let categories = []
            let checkboxes = document.querySelectorAll('input[type=checkbox]:checked')

            for (let i = 0; i < checkboxes.length; i++) {
                categories.push(checkboxes[i].value)
            }

            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: "GET",
                url: getBaseURL() + 'filtrar-productos',
                data: {categories: categories},
                dataType: 'json',
                cache: false,
                success: function (data) {
                    $('#products_container').empty();
                    for (product of data) {
                        $('#products_container').append(`

                         <div class="product-list-container text-center d-flex flex-column">
                            <img src="${getBaseURLForImages() + product.cover}" alt="product_image">
                            <h3 class="d-block mt-3 mb-2">
                                ${product.title}
                            </h3>
                            <span class="d-block mb-4">
                                ${product.category}
                            </span>
                            <a href="${getBaseURL() + 'producto/' + product.slug}" target="_blank">
                                <button class="btn rounded-pill">
                                    VER
                                </button>
                            </a>
                         </div>

                         `);
                    }
                },
                error: function (err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection


