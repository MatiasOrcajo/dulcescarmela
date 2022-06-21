@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/admin/homeSliders.css')}}">

@section('title', 'Opiniones')

@section('content_header')
    <h1>WhatsApp</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        @if(session('success') && session('success') == 'added')
            <div class="alert alert-dismiss alert-success">
                <button type="button" class="btn-close" data-bs-dismiss="alert">
                <h4>Listo!</h4>
                <p>WhatsApp agregado</p>
                </button>
            </div>
        @endif
        @if(session('success') && session('success') == 'edited')
            <div class="alert alert-dismiss alert-success">
                <button type="button" class="btn-close" data-bs-dismiss="alert">
                <h4>Listo!</h4>
                <p>WhatsApp editado</p>
                </button>
            </div>
        @endif
        @if (count($errors))
            @if ($errors->get('number'))
                @foreach ($errors->get('number') as $error)
                    <div class="alert alert-danger">{{ $error }}</div><br>
                @endforeach
            @endif
            @if ($errors->get('text'))
                @foreach ($errors->get('text') as $error)
                    <div class="alert alert-danger">{{ $error }}</div><br>
                @endforeach
            @endif
        @endif
        <div class="col-12 d-flex flex-wrap">
            @if ($whatsapp)
            <div class="col-md-4 mt-3 pl-0 contenedor-slider-admin">
                <div class="card">
                    <div class="card-header">
                        <h5>Numero: {{$whatsapp->number}}</h5>
                    </div>
                    <div class="card-body">
                        <h5>Texto: {{$whatsapp->text}}</h5>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditar{{$whatsapp->id}}">
                    Editar
                </button>

                {{-- modal para editar --}}
                
                <div class="modal fade" id="modalEditar{{$whatsapp->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="modalEditarLabel">Editar WhatsApp</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.editarWhatsApp', $whatsapp->id)}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="number">Numero</label>
                                    <input type="number" id="number" class="form-control" name="number" value="{{$whatsapp->number}}">
                                </div>
                                <div class="form-group">
                                    <label for="orden">Texto</label>
                                    <span>(La palabra "{title}" se reemplazará automáticamente por el título del producto)</span>
                                    <input type="text" id="text" class="form-control" name="text" value="{{$whatsapp->text}}">
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
            @else
                <p>No se ha cargado ningún WhatsApp</p>
            @endif
        </div>
    </div>

    <!-- Button trigger modal -->
    @if (!$whatsapp)
        <button type="button" class="btn btn-primary my-5" data-toggle="modal" data-target="#exampleModal">
            Agregar WhatsApp
        </button>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Añadir WhatsApp</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.subirWhatsApp')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="number">Número</label>
                            <input type="number" id="number" class="form-control" name="number" value="{{ old('number') }}">
                        </div>
                        <div class="form-group">
                            <label for="text">Texto</label>
                            <span>(La palabra "{title}" se reemplazará automáticamente por el título del producto)</span>
                            <br>
                            <textarea name="text" id="text" class="w-100" rows="20">{{ old('text') }}</textarea>
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