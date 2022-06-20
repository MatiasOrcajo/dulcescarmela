@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/admin/homeSliders.css')}}">

@section('title', 'Opiniones')

@section('content_header')
    <h1>Opiniones</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        @if(session('success') && session('success') == 'added')
            <div class="alert alert-dismiss alert-success">
                <button type="button" class="btn-close" data-bs-dismiss="alert">
                <h4>Listo!</h4>
                <p>Nueva opinión agregada</p>
                </button>
            </div>
        @endif
        @if(session('success') && session('success') == 'edited')
            <div class="alert alert-dismiss alert-success">
                <button type="button" class="btn-close" data-bs-dismiss="alert">
                <h4>Listo!</h4>
                <p>Opinión editada</p>
                </button>
            </div>
        @endif
        @if(session('success') && session('success') == 'deleted')
            <div class="alert alert-dismiss alert-success">
                <button type="button" class="btn-close" data-bs-dismiss="alert">
                <h4>Listo!</h4>
                <p>Opinión eliminada</p>
                </button>
            </div>
        @endif
        @if (count($errors))
            @if ($errors->get('name'))
                @foreach ($errors->get('name') as $error)
                    <div class="alert alert-danger">{{ $error }}</div><br>
                @endforeach
            @endif
            @if ($errors->get('content'))
                @foreach ($errors->get('content') as $error)
                    <div class="alert alert-danger">{{ $error }}</div><br>
                @endforeach
            @endif
            @if ($errors->get('image'))
                @foreach ($errors->get('image') as $error)
                    <div class="alert alert-danger">{{ $error }}</div><br>
                @endforeach
            @endif
        @endif
        <div class="col-12 d-flex flex-wrap">
            @forelse ($opinions as $opinion)
            <div class="col-md-4 mt-3 pl-0 contenedor-slider-admin">
                <div class="card">
                    <div class="card-header">
                        <h5>Nombre: {{$opinion->name}}</h5>
                        <img src="{{asset($opinion->image)}}" alt="">
                    </div>
                    <div class="card-body">
                        <h5>Texto: {{$opinion->content}}</h5>
                    </div>
                    <div class="card-footer">
                        <h5>Orden: {{$opinion->order}}</h5>
                    </div>
                </div>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar{{$opinion->id}}">
                    Eliminar
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditar{{$opinion->id}}">
                    Editar
                </button>

                {{-- modal para editar --}}
                
                <div class="modal fade" id="modalEditar{{$opinion->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="modalEditarLabel">Editar Opinión</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.editarOpinion', $opinion->id)}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" id="name" class="form-control" name="name" value="{{$opinion->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="orden">Orden</label>
                                    <input type="text" id="orden" class="form-control" name="order" value="{{$opinion->order}}">
                                </div>
                                <div class="form-group">
                                    <label for="content">Contenido</label>
                                    <textarea name="content" id="content" class="w-100" rows="20">{{$opinion->content}}</textarea>
                                </div>
                                <div class="form-group mt-5">
                                    <img src="{{asset($opinion->image)}}" alt="" style="height: 150px; width: auto;" class="mb-4">
                                    <br>
                                    <input type="file" name="image">
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

                {{-- eliminar --}}

                <div class="modal fade" id="modalEliminar{{$opinion->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="modalEliminarLabel">Eliminar Opinión</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body pb-0">
                                <form action="{{route('admin.eliminarOpinion', $opinion->id)}}" method="POST" enctype="multipart/form-data">
                                    @method('DELETE')
                                    @csrf
                                    
                                    <h3>¿Segura que deseas eliminar la opinión?</h3>

                                    <div class="modal-footer p-0 mt-4">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @empty
                <p>No se han encontrado opiniones</p>
            @endforelse
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary my-5" data-toggle="modal" data-target="#exampleModal">
        Agregar Opinión
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Subir Opinión</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.subirOpinion')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="order">Orden</label>
                            <input type="text" id="order" class="form-control" name="order" placeholder="01" value="{{ old('order') }}">
                        </div>
                        <div class="form-group">
                            <label for="content">Texto</label>
                            <br>
                            <textarea name="content" id="content" class="w-100" rows="20">{{ old('content') }}</textarea>
                        </div>
                        <div class="form-group mt-5">
                            <input type="file" name="image">
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
@stop