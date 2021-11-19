@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/admin/homeSliders.css')}}">

@section('title', 'Home Sliders')

@section('content_header')
    <h1>Imagenes del slider</h1>
@stop

@section('content')
    

<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex flex-wrap">
            @forelse ($sliders as $slider)
            <div class="col-md-4 mt-3 pl-0 contenedor-slider-admin">
                <div class="card">
                    <div class="card-header">
                        <img src="{{asset($slider->image)}}" alt="">
                    </div>
                    <div class="card-body">
                        <h5>Texto: {{$slider->text}}</h5>
                    </div>
                    <div class="card-footer">
                        <h5>Orden: {{$slider->order}}</h5>
                    </div>
                </div>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar{{$slider->id}}">
                    Eliminar
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditar{{$slider->id}}">
                    Editar
                </button>
                {{-- <a href="{{route('admin.editarSlider', $slider->id)}}">
                    <div class="btn btn-primary">Editar</div>
                </a> --}}




                {{-- modal para editar --}}
                
                @include('admin.layouts.modalEditarSlider')

                {{-- modal para eliminar --}}
                
                @include('admin.layouts.modalEliminarSlider')

            </div>
            @empty
                <p>No se han encontrado sliders</p>
            @endforelse
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary my-5" data-toggle="modal" data-target="#exampleModal">
        Agregar Slider
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
                            <label for="orden">Orden</label>
                            <input type="text" id="orden" class="form-control" name="orden" placeholder="01">
                        </div>
                        <div class="form-group">
                            <label for="texto">Texto</label>
                            <input type="text" id="texto" class="form-control" name="texto">
                        </div>
                        <div class="form-group mt-5">
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
</div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop