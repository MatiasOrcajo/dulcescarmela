@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/admin/homeSliders.css')}}">
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

@section('title', 'Nosotras')

@section('content_header')
    <h1>Lista de productos</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex flex-wrap justify-content-center align-items-center">

                <table id="products" class="table display w-100">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Descripción</th>
                        <th>Portada</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($products as $product)

                        <div class="modal fade" id="modalEliminar{{$product->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="modalEliminarLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEliminarLabel">Eliminar Slider</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body pb-0">
                                        <form action="{{route('admin.product.delete', $product->id)}}" method="POST"
                                              enctype="multipart/form-data">
                                            @method('DELETE')
                                            @csrf

                                            <h3>¿Segura que deseas eliminar el producto {{$product->title}}?</h3>

                                            <div class="modal-footer p-0 mt-4">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Cerrar
                                                </button>
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$product->title}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->description}}</td>
                            <td><img src="{{asset($product->cover_photo)}}" style="max-width: 140px;"></td>
                            <td><a href="{{route('admin.product.show', $product->slug)}}">
                                    <button class="btn btn-primary">
                                        Ver
                                    </button>
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-danger" data-target="#modalEliminar{{$product->id}}" data-toggle="modal">
                                    Eliminar
                                </button>
                            </td>
                        </tr>

                    @empty
                        No se han encontrado productos
                    @endforelse

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <style>
        .dataTables_wrapper{
            width: 100% !important;
        }
    </style>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}

@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('ckeditor/build/ckeditor.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>

        $(document).ready(function () {
            $('#products').DataTable();
        });


    </script>
@stop
