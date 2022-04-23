@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/admin/homeSliders.css')}}">

@section('title', 'Nosotras')

@section('content_header')
    <h1>Nosotras</h1>
@stop

@section('content')
    

<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex flex-wrap">
            @forelse ($images as $image)
            <div class="col-md-4 mt-3 pl-0 contenedor-slider-admin">
                <div class="card">
                    <div class="card-header">
                        <img src="" alt="">
                    </div>
                    <div class="card-body">
                        Activo: 
                    </div>
                </div>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar">
                    Eliminar
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditar">
                    Editar
                </button>
            </div>

            {{-- modal --}}

            <div class="modal fade" id="modalEditar{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="modalEditarLabel">Editar Slider</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.editarSlider', $slider->id)}}" method="POST" enctype="multipart/form-data">
                                {{-- @method('PUT') --}}
                                @csrf
                                <div class="form-group">
                                    <label for="orden">Orden</label>
                                    <input type="text" id="orden" class="form-control" name="orden" value="{{$slider->order}}">
                                </div>
                                <div class="form-group">
                                    <label for="texto">Texto</label>
                                    <input type="text" id="texto" class="form-control" name="texto" value="{{$slider->text}}">
                                </div>
                                <div class="form-group mt-5">
                                    <img src="{{asset($slider->image)}}" alt="" style="height: 150px; width: auto;" class="mb-4">
                                    <input type="file" name="imagen">
                                </div>
        
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            @empty
                <p>No se han encontrado imagenes</p>
            @endforelse
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary my-5" data-toggle="modal" data-target="#exampleModal">
        Agregar Imagen
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
                    <form action="{{route('admin.subirSlider')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="texto">Texto</label>
                            <textarea type="text" id="texto" class="form-control" name="texto" cols="10" rows="20"></textarea>
                        </div>
                        <div class="form-group mt-5">
                            <input type="file" name="imagen">
                        </div>
                        <div class="form-group mt-5">
                            <label for="visible">Visible:</label>
                            <select name="" id="">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="{{asset('ckeditor/build/ckeditor.js')}}"></script>
<script>
    ClassicEditor
        .create(document.getElementById('texto'),
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
            language: 'es'
        })
        
        .catch(error => {
            console.log(error);
        })
</script>
@stop