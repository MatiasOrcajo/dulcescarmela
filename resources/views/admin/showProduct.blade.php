@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/admin/homeSliders.css')}}">
<link
rel="stylesheet"
href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
/>

@section('title', '{{$product->title}}')

@section('content_header')
    <h1>{{$product->title}}</h1>
@stop

@section('content')


<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-dismiss alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert">
        <h4>Listo!</h4>
        <p>Producto editado</p>
        </button>
    </div>
    @endif
    <div class="row">
        <div class="col-md-6 my-2">
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach ($product->getProductImages as $image)
                        <div class="swiper-slide d-flex align-items-center justify-content-center position-relative">
                            <img src="{{asset($image->image)}}" alt="">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <!-- Button trigger modal -->
            <a href="{{route('admin.product.images', $product->id)}}">
                <button type="button" class="btn btn-primary my-5" id="create_category">
                    Editar fotos
                </button>
            </a>
        </div>

        <div class="col-md-6 px-md-5">
            <form action="{{route('admin.product.edit', $product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="category">Categoría:</label>
                    <select name="category" id="" class="form-control">
                        @foreach ($categories as $category)
                            <option @if ($category == $product->category) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Título:</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{$product->title}}">
                </div>
                <div class="form-group">
                    <label for="description">Descripción:</label>
                    <br>
                    {{-- <input type="text" name="description" id="description" class="form-control" value="{{$product->description}}"> --}}
                    <textarea name="description" id="description" style="width: 100%"rows="10" class="text">{!! $product->description !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Precio:</label>

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">$</div>
                        </div>
                        <input type="text" name="price" id="price" class="form-control" value="{{$product->price}}">
                    </div>
                </div>
                <div class="form-group">
                    {{-- <label for="discount_price">Precio de descuento (si no tiene no poner nada):</label>

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">$</div>
                        </div>
                        <input type="text" name="discount_price" id="discount_price" class="form-control" value="{{$product->discount_price}}">
                    </div> --}}
                    <label for="featured">Destacado:</label>
                    <div class="input-group mb-2">
                        <select name="featured" id="featured">
                            <option value="si"@if($product->featured == 'si')selected @endif>Si</option>
                            <option value="no"@if($product->featured == 'no')selected @endif>No</option>
                        </select>
                    </div>
                </div>
                <div class="form-group d-flex align-items-center justify-content-center">
                    @if ($product->cover_photo)
                    <img src="{{asset($product->cover_photo)}}" alt="" style="width: 50%; height: auto;">
                    @endif
                </div>
                <div class="form-group">
                    <label for="files">Seleccionar foto de portada (si no se sube ninguna, se puede seleccionar desde la vista del producto una imagen como portada):</label>
                    <br>
                    <input accept="image/*" type="file" name="cover_photo" id="" class="">
                </div>

                <button type="submit" class="btn btn-success">
                    Guardar cambios
                </button>
            </form>
        </div>
    </div>
</div>




<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
const swiper = new Swiper('.swiper', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,
  autoplay: true,

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // And if we need scrollbar
  scrollbar: {
    el: '.swiper-scrollbar',
  },
});
</script>


@stop

@section('css')
<style>
    .swiper {
        /* width: 800px;
        height: 600px; */
    }
    .swiper-slide img{
        max-width: 100%;
        /* width: 800px; */
        max-height: 100%;
        object-fit: cover
    }
</style>

@stop

@section('js')

    <script src="{{asset('ckeditor/build/ckeditor.js')}}"></script>
    <script>
        // enriquecedor de texto
        document.querySelectorAll('.text').forEach(el=>{
            ClassicEditor
                .create(el,
                    {
                        toolbar:[
                            'heading',
                            '|',
                            'bold',
                            'italic',
                            'fontFamily',
                            'fontColor',
                            'fontSize',
                            'bulletedList',
                            'numberedList',
                            '|',
                            'outdent',
                            'indent',
                            '|',
                            'blockQuote',
                            'undo',
                            'redo',
                            'fontBackgroundColor'
                        ],
                        language: 'es',
                    })
                .catch(error => {
                    console.log(error);
                })
        });
    </script>

    @stop
