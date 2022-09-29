@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Panel de Administrador</h1>
@stop

@section('content')
    <p>Actualizar logo de la marca</p>

    @if(isset($logo))
        <img src="{{$logo->image}}" style="max-width: 300px;">
    @endif
    <br>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary my-5" data-toggle="modal" data-target="#exampleModal">
        @if(isset($logo))
            Editar Imagen
        @else
            Añadir Imagen
        @endif
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Subir Imagen</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_image_form" action="{{route('admin.logo.add')}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @if(isset($logo))
                            <img src="{{$logo->image}}" style="max-width: 100%;">
                        @endif
                        <div class="form-group mt-5">
                            <input type="file" name="imagen">
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
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
