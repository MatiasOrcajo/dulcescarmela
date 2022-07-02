@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/admin/homeSliders.css')}}">

@section('title', 'Contadores')

@section('content_header')
    <h1>Contadores</h1>

@stop

@section('content')

    <div>
        <h4>Instructivo</h4>
        <ul>
            <li>1) Entrar en <a href="https://iconscout.com/">https://iconscout.com/</a></li>
            <li>2) Seleccionar "icons" y buscar el ícono gratuito</li>
            <li>3) Una vez elegido, seleccionar "Download Icon". Descargar como .PNG en tamaño 96</li>
            <li>   Haciendo click en "Recolor" se puede elegir el color del ícono </li>
            <li>   Agregar no mas de 4 contadores </li>
        </ul>
    </div>

    @if(session('success') && session('success') == 'added')
        <div class="alert alert-dismiss alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert">
                <h4>Listo!</h4>
                <p>Nuevo contador creado</p>
            </button>
        </div>
    @endif
    @if(session('success') && session('success') == 'deleted')
        <div class="alert alert-dismiss alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert">
                <h4>Listo!</h4>
                <p>Contador eliminado</p>
            </button>
        </div>
    @endif
    @if(session('success') && session('success') == 'edited')
        <div class="alert alert-dismiss alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert">
                <h4>Listo!</h4>
                <p>Contador editado</p>
            </button>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex flex-wrap">
                @forelse ($counters as $counter)
                    <div class="col-md-4 mt-3 pl-0 contenedor-slider-admin">
                        <div class="card">
                            <div class="card-header">
                                <img src="{{asset($counter->icon)}}" style="width: auto; height: auto">
                            </div>
                            <div class="card-body" style="overflow-y: scroll">
                                {!!$counter->title!!}
                            </div>
                            <div class="card-footer">
                                {{$counter->quantity}}
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modalEditar{{$loop->iteration}}">
                                Editar
                            </button>
                            <form class="mb-0 ml-2" action="{{route('admin.eliminarContador', $counter->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modalEditar{{$loop->iteration}}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><strong>Subir Imagen</strong></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="add_image_form" action="{{route('admin.editarContador', $counter->id)}}" method="POST"
                                          enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <input class="form-control" type="hidden" name="edit" value="{{$counter->id}}">
                                        <div class="form-group">
                                            <label for="title">Texto</label>
                                            <input class="form-control" name="title" type="text" value="{{$counter->title}}">
                                        </div>
                                        <div class="form-group mt-5">
                                            <label for="icon">Icono:</label>
                                            <br>
                                            <input type="file" name="icon">
                                        </div>
                                        <div class="form-group mt-5">
                                            <label for="quantity">Cantidad:</label>
                                            <input class="form-control" type="number" name="quantity" value="{{$counter->quantity}}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Cerrar
                                            </button>
                                            <button id="guardar_cambios" type="submit" class="btn btn-primary">Guardar
                                            </button>
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
            Agregar Contador
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><strong>Subir Imagen</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="add_image_form" action="{{route('admin.subirContador')}}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Texto</label>
                                <input class="form-control" name="title" type="text">
                            </div>
                            <div class="form-group mt-5">
                                <label for="icon">Icono:</label>
                                <br>
                                <input type="file" name="icon">
                            </div>
                            <div class="form-group mt-5">
                                <label for="quantity">Cantidad:</label>
                                <input class="form-control" type="number" name="quantity">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Cerrar
                                </button>
                                <button id="guardar_cambios" type="submit" class="btn btn-primary">Guardar
                                </button>
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
@stop
