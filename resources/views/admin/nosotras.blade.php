@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/admin/homeSliders.css')}}">

@section('title', 'Nosotras')

@section('content_header')
    <h1>Nosotras</h1>
@stop

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-6 d-flex flex-wrap">
            @forelse ($images as $image)
            <div class="col-md-4 mt-3 pl-0 contenedor-slider-admin">
                <div class="card">
                    <div class="card-header">
                        <img src="{{asset($image->image)}}" alt="" style="width: 100%;">
                    </div>
                    <div class="card-body" style="overflow-y: scroll">
                        {!!$image->text!!}
                    </div>
                    <div class="card-footer">
                        Activo: {{$image->active}}
                    </div>
                </div>
                <button type="button" id="delete_image" data="{{$image->id}}" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar">
                    Eliminar
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditar{{$loop->iteration}}">
                    Editar
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalEditar{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><strong>Subir Imagen</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="add_image_form" action="{{route('admin.nosotras.add')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="edit" value="{{$image->id}}">
                                <div class="form-group">
                                    <label for="texto">Texto</label>
                                    <textarea type="text" class="text" class="form-control" name="texto" cols="30" rows="30">
                                        {!!$image->text!!}
                                    </textarea>
                                </div>
                                <div class="form-group mt-5">
                                    <input type="file" name="imagen">
                                </div>
                                <div class="form-group mt-5">
                                    <label for="visible">Visible:</label>
                                    <select name="active" id="">
                                        <option value="Si" {{$image->active == App\Models\Constants::IMAGE_IS_ACTIVE ? 'selected' : ''}}>Si</option>
                                        <option value="No" {{$image->active == App\Models\Constants::IMAGE_IS_INACTIVE ? 'selected' : ''}}>No</option>
                                    </select>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button id="guardar_cambios" type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            @empty
                <p>No se ha encontrado ningún texto</p>
            @endforelse
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary my-5" data-toggle="modal" data-target="#exampleModal">
        Agregar Texto
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Subir Imagen</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_image_form" action="{{route('admin.nosotras.add')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="texto">Texto</label>
                            <textarea type="text" class="text" class="form-control" name="texto" cols="30" rows="30"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button id="guardar_cambios" type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}

@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('ckeditor/build/ckeditor.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script>


// eliminar imagen
    document.querySelectorAll('#delete_image').forEach(el => {
        el.addEventListener('click', function(){
            let id = el.getAttribute('data');
            let route = '{{route('admin.nosotras.delete')}}'

            Swal.fire({
                title: '<strong>¿Segura de que deseas eliminar la imagen?</strong>',
                icon: 'question',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText:
                    '<button id="delete_button" class="btn btn-danger w-100 h-100">Si</button>',
                cancelButtonText:
                    '<button id="" class="btn btn-primary w-100 h-100">No</button>',
            })

            document.getElementById('delete_button').addEventListener('click', function(){
                $.ajax({
                    url: route,
                    type: "DELETE",
                    datatype: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            // title: 'Oops...',
                            confirmButtonText:
                                '<button id="delete_button" class="btn btn-success w-100 h-100">OK</button>',
                            title: '<strong>Imagen eliminada</strong>',
                            // footer: '<a href="">Why do I have this issue?</a>'
                        })
                        .then(function(){
                            location.reload();
                        })
                    },
                })
            })

        })
    });

// disparar alerta cuando se sube la imagen
    document.getElementById('add_image_form').addEventListener('submit', function(e)
    {
        e.preventDefault();
        Swal.fire({
            icon: 'success',
            // title: 'Oops...',
            title: '<strong>Imagen añadida</strong>',
            confirmButtonText:
                    '<button id="delete_button" class="btn btn-success w-100 h-100">OK</button>',
            // footer: '<a href="">Why do I have this issue?</a>'
        })
        .then(function(){
            $('#add_image_form').submit();
        })
    })

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
