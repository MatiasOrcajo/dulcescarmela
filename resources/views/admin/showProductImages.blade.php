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
    <div class="row">
        @foreach ($product->getProductImages as $image)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <img src="{{asset($image->image)}}" alt="" class="w-100">
                    </div>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary change_image" data="{{$image->id}}">
                    Cambiar
                </button>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger delete_image" data="{{$image->id}}">
                    Eliminar
                </button>
            </div>
        @endforeach
    </div>

    <div class="row">
        <button type="button" class="btn btn-primary add_image my-5" data="{{$product->id}}">
            Añadir Imagen
        </button>
    </div>

@stop

@section('css')
  
@stop

@section('js')
<script src="{{asset('js/app.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('.add_image').on('click', function(e){
            const { value: formValues } = Swal.fire({
                    title: 'Añadir nueva imagen',
                    html:
                        '<input id="image" name="image" type="file" class="mt-3 w-75">',
                    focusConfirm: false,
                    confirmButtonText: 'AÑADIR',
                    showCloseButton: true,
                    preConfirm: () => {
                        
                        const image = $('#image')[0].files[0];
                        const route = '{{route('admin.product.addProductImage')}}';

                        const form = new FormData();
                        form.append('_token', '{{ csrf_token() }}')
                        form.append('id', e.target.getAttribute('data'))
                        form.append('image', image);

                        $.ajax({
                            url : route,
                            type : 'POST',
                            datatype : 'json',
                            data: form,
                            processData: false,  // tell jQuery not to process the data
                            contentType: false,   // tell jQuery not to set contentType
                            success: function(res){
                                Swal.fire({
                                    icon: 'success',
                                    confirmButtonText:
                                        '<button id="delete_button" class="btn btn-success w-100 h-100">OK</button>',
                                    title: '<strong>Imagen añadida</strong>',
                                })
                                .then(function(){
                                    location.reload();
                                })
                            } 
                        })
                        return null;
                    }
                })

                if (formValues) {
                    Swal.fire(JSON.stringify(formValues))
                }
        })

        $.each($('.change_image'), function(){
            $(this).click(function(e){
                const { value: formValues } = Swal.fire({
                    title: 'Selecciona la nueva imagen',
                    html:
                        '<input id="image" name="image" type="file" class="mt-3 w-75">',
                    focusConfirm: false,
                    confirmButtonText: 'CAMBIAR',
                    showCloseButton: true,
                    preConfirm: () => {
                        
                        const image = $('#image')[0].files[0];
                        const id = e.target.getAttribute('data');
                        const route = '{{route('admin.product.editProductImage')}}';

                        const form = new FormData();
                        form.append('_token', '{{ csrf_token() }}')
                        form.append('id', id)
                        form.append('image', image);

                        $.ajax({
                            url : route,
                            type : 'POST',
                            datatype : 'json',
                            data: form,
                            processData: false,  // tell jQuery not to process the data
                            contentType: false,   // tell jQuery not to set contentType
                            success: function(res){
                                Swal.fire({
                                    icon: 'success',
                                    confirmButtonText:
                                        '<button id="delete_button" class="btn btn-success w-100 h-100">OK</button>',
                                    title: '<strong>Imagen editada</strong>',
                                })
                                .then(function(){
                                    location.reload();
                                })
                            } 
                        })
                        return null;
                    }
                })

                if (formValues) {
                    Swal.fire(JSON.stringify(formValues))
                }
            })
        })

        $.each($('.delete_image'), function(){
            $(this).click(function(e){
                const id = e.target.getAttribute('data');
                // console.log(id)
                Swal.fire({
                    title: '<strong>¿Segura de que deseas eliminar la imagen?</strong>',
                    icon: 'question',
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonText:
                        '<button id="delete_button" class="btn w-100 h-100" style="color: white;">Si</button>',
                    cancelButtonText:
                        '<button id="" class="btn w-100 h-100" style="color: white;">No</button>',
                })
                .then(function(){
                    $.ajax({
                        url: '\\'+`admin/producto/delete-image/${id}`,
                        type: "POST",
                        datatype: "json",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: id,
                            _method: 'DELETE'
                        },
                        success: function(res){
                            Swal.fire({
                                icon: 'success',
                                confirmButtonText:
                                    '<button id="delete_button" class="btn btn-success w-100 h-100">OK</button>',
                                title: '<strong>Imagen eliminada</strong>',
                            })
                            .then(function(){
                                location.reload();
                            })
                        }
                    })
                })
            })
        })
    })
</script>

